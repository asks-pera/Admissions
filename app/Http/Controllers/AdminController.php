<?php

namespace App\Http\Controllers;

use App\Classes\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Child;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Church;
use App\Models\Other;
use App\Models\Subject;
use App\Models\Result;
use App\Models\Connections;
use App\Models\General;
use App\Models\Staff;
use App\Models\OBA;
use App\Models\Status;
use App\Exports\BranchExport;
use App\Exports\KindergartenExport;
use App\Exports\OtherExport;
use App\Exports\ALevelExport;
use App\Exports\NurseryExport;
use App\Exports\Grade6Export;
use App\Models\NurseryView;
use App\Models\Sorting;
use App\Models\KindergartenView;
use Hash;
use Session;
use Excel;
use PDF;

class AdminController extends Controller
{
    public function login()
    {
        if(count(User::all()) > 0)
            return view('admin.login');
        return "<h1>OOPS</h1>";
    }

    public function authenticate(Request $request)
    { 
        $request->validate([
            'name'=> 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');
        if(Auth::guard('admin')->attempt($credentials)) {
            if(User::where('id', Auth::guard('admin')->id())->first()['approved'])
                return redirect('admin')->with(['success'=>'Signed in']);
            else
                return redirect('admin/login')->with(['error'=>'User not approved yet. Please speak to Sub Warden.']);
        }
        return redirect('admin/login')->with(['error' => 'Incorrect login details']);
    }

    public function index() 
    {
        return view('admin.index');
    }

    public function refresh(Request $request) 
    {
        $data = $request->validate([
            'section'=>'required',
            'year'=>'required',
        ]);
        $section = $data['section'];
        $year = $data['year'];
        $total = Applicant::where([['section', '=', $section], ['year', '=', $year]])->count();
        $notpurchased = Applicant::where([['purchased', '=', false], ['section', '=', $section], ['year', '=', $year]])->count();
        $purchased = Applicant::where([['purchased', '=' , true], ['section', '=', $section], ['year', '=', $year]])->count() - Applicant::where([['submitted', true], ['section', '=', $section], ['year', '=', $year]])->count();
        $submitted = Applicant::where([['submitted', '=' , true], ['section', '=', $section], ['year', '=', $year]])->count();
        $nursery = [NurseryView::where([['grade_sought', '=', 'Nursery 2+'], ['year', '=', $year]])->count(), NurseryView::where([['grade_sought', '=', 'Nursery 3+'], ['year', '=', $year]])->count(), 
            NurseryView::where([['grade_sought', '=', 'Nursery 4+'], ['year', '=', $year]])->count()];
        return view('admin.admin')->with([
            'applicants'=>Applicant::where([['section', '=', $section], ['year', '=', $year]])->paginate(20)->withPath(url('list?year=' . $year)),
            'total'=>$total,
            'notpurchased'=>$notpurchased,
            'purchased'=>$purchased,
            'submitted'=>$submitted,
            'section'=>$section,
            'nursery'=>$nursery,
            'sections'=>Child::all(),
            'link'=>(new Common())->getLink($section),
        ]);
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect('admin/login')->with(['success'=> 'Logged out Successfully']);
    }

    public function download(Request $request)
    {
        switch ($request['link'])
        {
            case 'nursery':
                return Excel::download(new NurseryExport, 'MasterData-Nursery.xlsx');
            case 'kindergarten':
                return Excel::download(new KindergartenExport, 'MasterData-Kindergarten.xlsx');
            case 'other':
                return Excel::download(new OtherExport, 'MasterData-Other.xlsx');
            case 'grade6':
                return Excel::download(new Grade6Export, 'MasterData-Grade6.xlsx');
            case 'branch':
                return Excel::download(new BranchExport, 'MasterData-Branch.xlsx');
            case 'alevels':
                return Excel::download(new ALevelExport, 'MasterData-ALevels.xlsx');
        }
    }

    public function downloadapplications(Request $request)
    {

        switch ($request['link'])
        {
            case 'nursery':
                return Excel::download(new NurseryExport, 'MasterData-Nursery.xlsx');
            case 'kindergarten':
                return Excel::download(new KindergartenExport, 'MasterData-Kindergarten.xlsx');
            case 'other':
                return Excel::download(new OtherExport, 'MasterData-Other.xlsx');
            case 'grade6':
                return Excel::download(new Grade6Export, 'MasterData-Grade6.xlsx');
            case 'branch':
                return Excel::download(new BranchExport, 'MasterData-Branch.xlsx');
            case 'alevels':
                return Excel::download(new ALevelExport, 'MasterData-ALevels.xlsx');
        }
    }

    public function show(Request $request) {
        $id = $request['id'];
        

        return view('admin.show', [
            'id'=>$id,
            'section'=>$request['section'],
            'status'=>Status::where('id', '=', $id)->first(),
            'child'=>Child::where('id', '=', $id)->first(),
            'father'=>Father::where('id', '=', $id)->first(),
            'mother'=>Mother::where('id', '=', $id)->first(),
            'other'=>Other::where('id', '=', $id)->first(),
            'church'=>Church::where('id', '=', $id)->first(),
            'oba'=>OBA::where('id', '=', $id)->first(),
            'staff'=>Staff::where('id', '=', $id)->first(),
            'results'=>Result::where('id', '=', $id)->first(),
            'subjects'=>Subject::where('id', '=', $id)->first(),
            'connections'=>Connections::where('id', '=', $id)->first(),
            'general'=>General::where('id', '=', $id)->first(),
        ]);
    }

    public function sorting() {
        return view('admin.sorting');
    }

    public function LoadData(Request $request) {
        $data = $request->validate([
           'section'=>'required',
           'year'=>'required',
        ]);
        $applicants = Applicant::where([['section', '=', $data['section']],['year', '=', $data['year']], ['submitted', '=', '1']])->get();
        $sortings = Sorting::where([['section', '=', $data['section']],['year', '=', $data['year']]])->get();
        $retText = "<div style='height:500px; width:100px; font-size:1.3em; overflow-y:auto; display:content;'>Submitted<table border='1'><thead><th>id</th></thead>";
        foreach($applicants as $applicant) {
            $retText .= "<tr><td><a href='https://admissions.stcmount.com/admin/show?id=" . $applicant['id'] . "&section=" . $data['section'] . "'>" . $applicant['id'] . "</a></td><tr>";
        }
        $retText .= "</table></div>";
        $retText .= "<div style='height:500px; width:100px; font-size:1.3em; overflow-y:auto; display:content;'>Old Boys<table border='1'><thead><th>id</th></thead>";
        foreach($applicants as $applicant) {
            $retText .= "<tr><td><a href='https://admissions.stcmount.com/admin/show?id=" . $applicant['id'] . "&section=" . $data['section'] . "'>" . $applicant['id'] . "</a></td><tr>";
        }
        $retText .= "</table></div>";
        return response()->json(['success'=>$retText]);
    }
    
    /*public function createapplication(Request $request) {
        $existing = Applicant::where('email', '=', $request['email'])->first();
        if($existing !== null)
        {
            $existing->email = $existing->email . "1";
            $existing->save();
        }
        $request->validate([
            'section'=>'required',
            'name'=>'required|max:255',
            'nic'=>'required|max:15',
            'mobile'=>'required|max:15',
            'email' => 'required|email|unique:applicants,email|max:255',
            'branch'=>'required_if:section,Branch Schools',
        ]);
        $year = 2025;
        $password = mt_rand(100000, 999999);
        $applicant = new Applicant();
        $applicant->year = $year;
        $applicant->section = $request['section'];
        $applicant->name = $request['name'];
        $applicant->nic = $request['nic'];
        $applicant->mobile = $request['mobile'];
        $applicant->email = $request['email'];
        if($request['section'] == "Branch Schools")
            $applicant->branch = $request['branch'];
        else
            $applicant->branch="";
        $applicant->password = Hash::make($password);
        $applicant->purchased = 1;
        $applicant->save();
        $status = new Status();
        $status->id = $applicant['id'];
        $status->purchased = 1;
        $status->save();
        return "<p>Weblink = <a href='https://admissions.stcmount.com/application/login' target='_blank'>https://admissions.stcmount.com/application/login</a></p><p>Username = " . $request['email'] . "</p><p>Password = " . $password . "</p>";
    }*/
}
