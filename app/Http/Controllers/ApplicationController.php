<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ConfirmEmail;
use App\Mail\ConfirmSubmission;
use Illuminate\Support\Facades\Mail;
use setasign\Fpdi\Fpdi;

use App\Classes\Common;

use App\Models\Setting;
use App\Models\Applicant;
use App\Models\Status;
use App\Models\Child;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Other;
use App\Models\Church;
use App\Models\Connections;
use App\Models\OBA;
use App\Models\Staff;
use App\Models\Result;
use App\Models\Subject;
use App\Models\General;

use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use PDF;
use File;

class ApplicationController extends Controller
{
    public function login()
    {
        return view('application.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('user')->logout();
        return redirect('application/login')->with(['success'=>'Successfully Logged out']);
    }

    public function checklogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);
        $credentials = $request->only('password', 'email');
        if(Auth::guard('user')->attempt($credentials)) {
            $id = Auth::guard('user')->id();
            $section = Applicant::where('id', '=', $id)->first()['section'];
            if(!((new Common())->checkAccess($section)))
                return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
            return redirect('application/status')->with(['success' => "Successfully signed in"]);
        }
        return redirect('application/login')->with(['error'=>'Incorrect login details']);
    }

    public function status()
    {
        $id = Auth::guard('user')->id();
        $section = Applicant::where('id', $id)->first()['section'];
        $appstatus = Status::where('id', $id)->first();
        $child = Child::where('id', $id)->first();
        if($child !== null)
            $religion = $child['religion'];
        else 
            $religion = "";
        $father = Father::where('id', $id)->first();
        if($father !== null)
            $oba = $father['old_thomian'];
        else 
            $oba = 0;
        //$oba = $appstatus['oba'];
        $staffdata = Staff::where('id', $id)->first();
        if($staffdata !== null)
            if(($staffdata['father_staff'] == 1) || ($staffdata['mother_staff'] == 1))
                $staff = 1;
            else
                $staff = 0;
        else
            $staff = 0;
        $completed =$this->checkCompletion($appstatus, $section, $religion, $oba, $staff);
        //return $completed;
        if($completed == 99) {
            Session::flush();
            Auth::guard('user')->logout();
        }
        return view('application.status', [
            'id'=>$id,
            'status'=>$appstatus,
            'state'=>($appstatus['purchased'] == true) ? (($completed == 0) ? 'Purchased but incomplete' : (($completed == 1)? 'Application Filled - awaiting submission' : (($completed == 99)? 'Application Submitted' : (($completed == 2)? 'Minimum Criteria not met - Father musit be an old boy or the father / mother must be a member of staff' : "")))) : 'Unpurchased',
            'section' => $section,
            'religion'=> $religion,
            'oba'=> $oba,
            'submit'=>$completed,
            'year'=>Setting::where('name', '=', $section)->first()['year'],
        ]);
    }

    private function checkCompletion($status, $section, $religion, $oba, $staff)
    {
        if(($section == "ALevels") || ($section == "Grade 6") || ($section == "Branch Schools"))
            if(!$status['results']) return 0;
        if(($section == "ALevels") || ($section == "Branch Schools"))
            if(!$status['subjects']) return 0;
        if($oba)
            if(!$status['oba']) return 0;
        if($religion == "Christian")
            if(!$status['church']) return 0;
        if($section != 'Nursery')  {
            if(!$status['purchased'] || !$status['child'] || !$status['father'] || !$status['mother'] || !$status['other'] || !$status['staff'] || !$status['connections'] || !$status['general'])
                return 0;
        }
        else
            if(!$status['purchased'] || !$status['child'] || !$status['father'] || !$status['mother'] || !$status['other'] || !$status['staff'] || !$status['connections'])
                return 0;
            else
                if((!$status['oba']) && !$staff)
                    return 2;
        if(!$status['submitted']) return 1;
        return 99;
    }

    public function child(Request $request)
    {
        $id = $request['id'];
        $section = Applicant::where('id', $id)->first()['section'];
        $child = Child::where('id', $id)->first();
        if($child !== null)
            return view('application.child', [
                'id'=>$id,
                'child'=>$child,
                'section'=>$section,
                'year'=>Setting::where('name', '=', $section)->first()['year'],
            ]);
        return view('application.child', [
            'id'=>$id,
            'section'=>$section,
            'year'=>Setting::where('name', '=', $section)->first()['year'],
        ]);
    }

    public function childSave(Request $request)
    {
        $minMaxDates = (new Common())->getDates(Applicant::where('id', '=', $request['id'])->first()['section'], $request['grade_sought']);
        $data = $request->validate ([
            'surname'=>'required|max:255',
            'other_names'=>'required|max:255',
            'dob'=>'required|after_or_equal:' . $minMaxDates[0] . '|before_or_equal:' . $minMaxDates[1],
            'bc_num'=>'required',
            'present_school'=>'required|max:255',
            'grade_sought'=>'required',
            'gender'=>'required_if:section,Nursery',
            'medium'=>'required_if:gender,Boy|required_unless:section,Nursery',
            'religion'=>'required',
            'denomination'=>'required_if:religion,Christian|max:255',
            'baptism_date'=>'required_if:religion,Christian',
            'file'=>'required_without:picture',
            'picture'=>'required_without:file|mimes:jpg,png|max:1024',
        ], [
            'medium.required_unless'=>'Medium Required',
            'dob.after'=>'The date of birth does not tally with the selected grade',
            'dob.before'=>'The date of birth does not tally with the selected grade',
        ]);
        $id = $request['id'];
        if($request['picture'] !== null) 
        {
            $filename = $id . '-pic.' . $request->picture->extension();
            $request->picture->move(public_path('uploads'), $filename);
            File::copy(public_path('uploads') ."/" . $filename, $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $filename);
        }
        else {
            $filename = $request['file'];
        }
        if($request['cmdSave'] == "Save Data") 
        {
            $child = new Child();
            $child->id = $id;
            $message = "Successfully saved Child's Details";
            $status = Status::where('id', $id)->first();
            $status->child = true;
            $status->save();
        }
        else 
        {
            $child = Child::where('id', $id)->first();
            $message = "Successfully updated Child's Details";
        }
        $child->surname = $data['surname'];
        $child->other_names = $data['other_names'];
        $child->dob = $data['dob'];
        $child->bc_num = $data['bc_num'];
        $child->present_school = $data['present_school'];
        $child->grade_sought = $data['grade_sought'];
        $child->gender = isset($data['gender'])? $data['gender'] : "";
        $child->medium = (isset($request['medium'])) ? $request['medium'] : "";
        if(isset($request['present_school_joined'])) $child->present_school_joined = $request['present_school_joined'];
        if(isset($request['previous_schools'])) $child->previous_schools = $request['previous_schools'];
        $child->religion = $data['religion'];
        $child->denomination = ($data['religion'] == "Christian")? $data['denomination'] : null;
        $child->baptism_date = ($data['religion'] == "Christian")? $data['baptism_date'] : null;
        $child->picture = $filename;
        $child->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function father(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $father = Father::where('id', $id)->first();
        if($father !== null)
            return view('application.father', [
                'id'=>$id,
                'father'=>$father,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.father', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function fatherSave(Request $request)
    {
        $data = $request->validate ([
            'name'=>'required|max:255',
            'occupation'=>'required|max:255',
            'employment'=>'required|max:255',
            'mobile'=>'required|max:15',
            'email'=>'required|email|max:255',
            'address'=>'required|max:255',
            'religion'=>'required',
            'denomination'=>'required_if:religion,Christian|max:255',
            'baptism_date'=>'required_if:religion,Christian',
            'other'=>'required_if:religion,Other|max:255',
            'nic'=>'required|max:15',
            'old_school'=>'required_without:old_thomian|max:255',
            'income'=>'required|max:20',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $father = new Father();
            $father->id = $id;
            $message = "Successfully saved Father's Details";
            $status = Status::where('id', $id)->first();
            $status->father = true;
            $status->save();
        }
        else 
        {
            $father = Father::where('id', $id)->first();
            $message = "Successfully updated Father's Details";
        }
        $father->name = $data['name'];
        $father->occupation = $data['occupation'];
        $father->employment = $data['employment'];
        $father->mobile = $data['mobile'];
        $father->email = $data['email'];
        $father->address = $data['address'];
        $father->religion = $data['religion'];
        $father->denomination = ($data['religion'] == "Christian")? $data['denomination'] : null;
        $father->baptism_date = ($data['religion'] == "Christian")? $data['baptism_date'] : null;
        $father->other = ($data['religion'] == "Other") ? $data['other'] : null;
        $father->nic = $data['nic'];
        $father->old_school = ($request['old_thomian']) ? null : $data['old_school'];
        $father->old_thomian = ($request['old_thomian']) ? true : false;
        $father->income = $data['income'];
        $father->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function mother(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $mother = Mother::where('id', $id)->first();
        if($mother !== null)
            return view('application.mother', [
                'id'=>$id,
                'mother'=>$mother,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.mother', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function motherSave(Request $request)
    {
        $data = $request->validate ([
            'name'=>'required|max:255',
            'occupation'=>'required|max:255',
            'employment'=>'required|max:255',
            'mobile'=>'required|max:15',
            'email'=>'required|email|max:255',
            'address'=>'required|max:255',
            'religion'=>'required',
            'denomination'=>'required_if:religion,Christian|max:255',
            'baptism_date'=>'required_if:religion,Christian',
            'other'=>'required_if:religion,Other|max:255',
            'nic'=>'required|max:15',
            'old_school'=>'required|max:255',
            'income'=>'required|max:20',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $mother = new Mother();
            $mother->id = $id;
            $message = "Successfully saved Mother's Details";
            $status = Status::where('id', $id)->first();
            $status->mother = true;
            $status->save();
        }
        else 
        {
            $mother = Mother::where('id', $id)->first();
            $message = "Successfully updated Mother's Details";
        }
        $mother->name = $data['name'];
        $mother->occupation = $data['occupation'];
        $mother->employment = $data['employment'];
        $mother->mobile = $data['mobile'];
        $mother->email = $data['email'];
        $mother->address = $data['address'];
        $mother->religion = $data['religion'];
        $mother->denomination = ($data['religion'] == "Christian")? $data['denomination'] : null;
        $mother->baptism_date = ($data['religion'] == "Christian")? $data['baptism_date'] : null;
        $mother->other = ($data['religion'] == "Other") ? $data['other'] : null;
        $mother->nic = $data['nic'];
        $mother->old_school = $data['old_school'];
        $mother->income=$data['income'];
        $mother->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function other(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $other = Other::where('id', $id)->first();
        if($other !== null) {
            $names = [$other['name_1'], $other['name_2'], $other['name_3'], $other['name_4']];
            $sexes = [$other['sex_1'], $other['sex_2'], $other['sex_3'], $other['sex_4']];
            $dobs = [$other['dob_1'], $other['dob_2'], $other['dob_3'], $other['dob_4']];
            $stcs = [$other['stc_1'], $other['stc_2'], $other['stc_3'], $other['stc_4']];
            $classes = [$other['class_1'], $other['class_2'], $other['class_3'], $other['class_4']];
            $housees = [$other['house_1'], $other['house_2'], $other['house_3'], $other['house_4']];
            $admissions = [$other['admission_1'], $other['admission_2'], $other['admission_3'], $other['admission_4']];
            $mediums = [$other['medium_1'], $other['medium_2'], $other['medium_3'], $other['medium_4']];
            $joined = [$other['joined_1'], $other['joined_2'], $other['joined_3'], $other['joined_4']];
            $joinedgrade = [$other['joinedgrade_1'], $other['joinedgrade_2'], $other['joinedgrade_3'], $other['joinedgrade_4']];
            $schools = [$other['school_1'], $other['school_2'], $other['school_3'], $other['school_4']];
            return view('application.other', [
                'id'=>$id,
                'num'=>strval($other['num']),
                'picture' => $picture,
                'text' => "Update Data",
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ])
                ->withNames(json_encode($names))
                ->withSexes(json_encode($sexes))
                ->withDobs(json_encode($dobs))
                ->withStcs(json_encode($stcs))
                ->withClasses(json_encode($classes))
                ->withHouses(json_encode($housees))
                ->withAdmissions(json_encode($admissions))
                ->withMediums(json_encode($mediums))
                ->withJoined(json_encode($joined))
                ->withJoinedGrade(json_encode($joinedgrade))
                ->withSchools(json_encode($schools));
        }
        return view('application.other', [
            'id'=>$id,
            'num'=>0,
            'picture' => $picture,
            'text' => "Save Data",
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ])
            ->withNames(json_encode(['','','','']))
            ->withSexes(json_encode(['','','','']))
            ->withDobs(json_encode(['','','','']))
            ->withStcs(json_encode(['','','','']))
            ->withClasses(json_encode(['','','','']))
            ->withHouses(json_encode(['','','','']))
            ->withAdmissions(json_encode(['','','','']))
            ->withMediums(json_encode(['','','','']))
            ->withJoined(json_encode(['','','','']))
            ->withJoinedGrade(json_encode(['','','','']))
            ->withSchools(json_encode(['','','','']));
    }

    public function otherSave(Request $request)
    {
        $id = $request['id'];
        $other = "";
        if($request['cmdSave'] == 'Save Data') 
        {
            $other = new Other();
            $other->id = $id;
            $message = "Successfully saved details of other children";
            $status = Status::where('id', $id)->first();
            $status->other = true;
            $status->save();
        }
        else 
        {
            $other = Other::where('id', $id)->first();
            $message = "Successfully updated details of other children";
        }
        $other->num = $request["num"];

        $other->name_1 = $request['txtOther_1_Name'];
        $other->name_2 = $request['txtOther_2_Name'];
        $other->name_3 = $request['txtOther_3_Name'];
        $other->name_4 = $request['txtOther_4_Name'];

        $other->sex_1 = $request['txtOther_1_Sex'];
        $other->sex_2 = $request['txtOther_2_Sex'];
        $other->sex_3 = $request['txtOther_3_Sex'];
        $other->sex_4 = $request['txtOther_4_Sex'];

        $other->dob_1 = $request['txtOther_1_DOB'];
        $other->dob_2 = $request['txtOther_2_DOB'];
        $other->dob_3 = $request['txtOther_3_DOB'];
        $other->dob_4 = $request['txtOther_4_DOB'];

        $other->stc_1 = isset($request['chkOther_1_STC']) ? (($request['chkOther_1_STC'] == "on") ? true : false) : false;
        $other->stc_2 = isset($request['chkOther_2_STC']) ? (($request['chkOther_2_STC'] == "on") ? true : false) : false;
        $other->stc_3 = isset($request['chkOther_3_STC']) ? (($request['chkOther_3_STC'] == "on") ? true : false) : false;
        $other->stc_4 = isset($request['chkOther_4_STC']) ? (($request['chkOther_4_STC'] == "on") ? true : false) : false;

        $other->class_1 = isset($request['txtOther_1_Class']) ? $request['txtOther_1_Class'] : "";
        $other->class_2 = isset($request['txtOther_2_Class']) ? $request['txtOther_2_Class'] : "";
        $other->class_3 = isset($request['txtOther_3_Class']) ? $request['txtOther_3_Class'] : "";
        $other->class_4 = isset($request['txtOther_4_Class']) ? $request['txtOther_4_Class'] : "";

        $other->house_1 = isset($request['txtOther_1_House']) ? $request['txtOther_1_House'] : "";
        $other->house_2 = isset($request['txtOther_2_House']) ? $request['txtOther_2_House'] : "";
        $other->house_3 = isset($request['txtOther_3_House']) ? $request['txtOther_3_House'] : "";
        $other->house_4 = isset($request['txtOther_4_House']) ? $request['txtOther_4_House'] : "";

        $other->admission_1 = isset($request['txtOther_1_Admission']) ? $request['txtOther_1_Admission'] : "";
        $other->admission_2 = isset($request['txtOther_2_Admission']) ? $request['txtOther_2_Admission'] : "";
        $other->admission_3 = isset($request['txtOther_3_Admission']) ? $request['txtOther_3_Admission'] : "";
        $other->admission_4 = isset($request['txtOther_4_Admission']) ? $request['txtOther_4_Admission'] : "";

        $other->medium_1 = isset($request['txtOther_1_Medium']) ? $request['txtOther_1_Medium'] : "";
        $other->medium_2 = isset($request['txtOther_2_Medium']) ? $request['txtOther_2_Medium'] : "";
        $other->medium_3 = isset($request['txtOther_3_Medium']) ? $request['txtOther_3_Medium'] : "";
        $other->medium_4 = isset($request['txtOther_4_Medium']) ? $request['txtOther_4_Medium'] : "";

        $other->joined_1 = isset($request['txtOther_1_Joined']) ? $request['txtOther_1_Joined'] : null;
        $other->joined_2 = isset($request['txtOther_2_Joined']) ? $request['txtOther_2_Joined'] : null;
        $other->joined_3 = isset($request['txtOther_3_Joined']) ? $request['txtOther_3_Joined'] : null;
        $other->joined_4 = isset($request['txtOther_4_Joined']) ? $request['txtOther_4_Joined'] : null;

        $other->joinedGrade_1 = isset($request['txtOther_1_Joined_Grade']) ? $request['txtOther_1_Joined_Grade'] : "";
        $other->joinedGrade_2 = isset($request['txtOther_2_Joined_Grade']) ? $request['txtOther_2_Joined_Grade'] : "";
        $other->joinedGrade_3 = isset($request['txtOther_3_Joined_Grade']) ? $request['txtOther_3_Joined_Grade'] : "";
        $other->joinedGrade_4 = isset($request['txtOther_4_Joined_Grade']) ? $request['txtOther_4_Joined_Grade'] : "";

        $other->school_1 = isset($request['txtOther_1_School']) ? $request['txtOther_1_School'] : "";
        $other->school_2 = isset($request['txtOther_2_School']) ? $request['txtOther_2_School'] : "";
        $other->school_3 = isset($request['txtOther_3_School']) ? $request['txtOther_3_School'] : "";
        $other->school_4 = isset($request['txtOther_4_School']) ? $request['txtOther_4_School'] : "";

        $other->save();
        return redirect('/application/status')->with(['success' => $message]);
    }

    public function results(Request $request)
    {
        $id = $request['id'];
        $grade_sought = Applicant::where('id', $id)->first()['section'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $results = Result::where('id', $id)->first();
        if($results !== null)
            return view('application.results', [
                'id'=>$id,
                'results'=>$results,
                'grade_sought'=>$grade_sought,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.results', [
            'id'=>$id,
            'grade_sought'=>$grade_sought,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
        return view('application.results');
    }

    public function resultsSave(Request $request)
    {
        if($request['grade_sought'] == "Grade 6")
        {
            $data = $request->validate([    
                'scholindex'=>'required_with:scholexam|max:255',
                'scholmark'=>'required_with:scholexam|max:255',
            ]);
            $id = $request['id'];
            if($request['cmdSave'] == "Save Data") 
            {
                $result = new Result();
                $result->id = $id;
                $message = "Successfully saved Exam Result Details";
                $status = Status::where('id', $id)->first();
                $status->results = true;
                $status->save();
            }
            else 
            {
                $result = Result::where('id', $id)->first();
                $message = "Successfully updated Exam Result Details";
            }
            $result->scholexam = isset($request['scholexam'])? true : false;
            $result->scholindex = $data['scholindex'];
            $result->scholmark = $data['scholmark'];
            $result->save();
            return redirect('application/status')->with(['success'=>$message]);
        }
        $data = $request->validate([
            'olindex'=>'required_if:grade_sought,ALevels',
            'olreligion'=>'required',
            'olfirstlang'=>'required',
            'olenglish'=>'required',
            'olscience'=>'required',
            'olmath'=>'required',
            'olhistory'=>'required',
            'olbasket1subject'=>'required',
            'olbasket1result'=>'required',
            'olbasket2subject'=>'required',
            'olbasket2result'=>'required',
            'olbasket3subject'=>'required',
            'olbasket3result'=>'required',
        ], [
            'olindex.required'=>'Enter OLevel Index Number',
            'olreligion.required'=>'What is the result for this subject',
            'olfirstlang.required'=>'What is the result for this subject',
            'olenglish.required'=>'What is the result for this subject',
            'olscience.required'=>'What is the result for this subject',
            'olmath.required'=>'What is the result for this subject',
            'olhistory.required'=>'What is the result for this subject',
            'olbasket1subject.required'=>'Please select the basket subject',
            'olbasket1result.required'=>'What is the result for this subject',
            'olbasket2subject.required'=>'Please select the basket subject',
            'olbasket2result.required'=>'What is the result for this subject',
            'olbasket3subject.required'=>'Please select the basket subject',
            'olbasket3result.required'=>'What is the result for this subject',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $result = new Result();
            $result->id = $id;
            $result->scholexam = false;
            $message = "Successfully saved Exam Result Details";
            $status = Status::where('id', $id)->first();
            $status->results = true;
            $status->save();
        }
        else 
        {
            $result = Result::where('id', $id)->first();
            $message = "Successfully updated Exam Result Details";
        }
        $result->olindex = (isset($data['olindex'])) ? $data['olindex'] : null;
        $result->olreligion = $data['olreligion'];
        $result->olfirstlang = $data['olfirstlang'];
        $result->olenglish = $data['olenglish'];
        $result->olscience = $data['olscience'];
        $result->olmath = $data['olmath'];
        $result->olhistory = $data['olhistory'];
        $result->olbasket1subject = $data['olbasket1subject'];
        $result->olbasket1result = $data['olbasket1result'];
        $result->olbasket2subject = $data['olbasket2subject'];
        $result->olbasket2result = $data['olbasket2result'];
        $result->olbasket3subject = isset($request['olbasket3subject']) ? $request['olbasket3subject'] : "";
        $result->olbasket3result = isset($request['olbasket3result']) ? $request['olbasket3result'] : "";
        $result->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function subjects(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $childData = $child;
            $picture = $childData['picture'];
            $grade_sought = $childData['grade_sought'];
            $medium = $childData['medium'];
        }
        else {
            $picture = " ";
            $medium = "";
            $grade_sought = "Not Set";
        }
        $subjects = Subject::where('id', $id)->first();
        if($subjects !== null)
            return view('application.subjects', [
                'id'=>$id,
                'subjects'=>$subjects,
                'grade_sought'=>$grade_sought,
                'picture' => $picture,
                'medium' => $medium,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.subjects', [
            'id'=>$id,
            'grade_sought'=>$grade_sought,
            'picture' => $picture,
            'medium' => $medium,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function subjectsSave(Request $request) 
    {
        $data = $request->validate([
            'alsubject1'=>'required',
            'alsubject2'=>'required',
            'alsubject3'=>'required',
            'alsubject4'=>'required',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $subjects = new Subject();
            $subjects->id = $id;
            $message = "Successfully saved Subject Choices";
            $status = Status::where('id', $id)->first();
            $status->subjects = true;
            $status->save();
        }
        else 
        {
            $subjects = Subject::where('id', $id)->first();
            $message = "Successfully updated Subject Choices";
        }
        $subjects->alsubject1 = $data['alsubject1'];
        $subjects->alsubject2 = $data['alsubject2'];
        $subjects->alsubject3 = $data['alsubject3'];
        $subjects->alsubject4 = $data['alsubject4'];
        $subjects->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function church(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $church = Church::where('id', $id)->first();
        if($church !== null)
            return view('application.church', [
                'id'=>$id,
                'church'=>$church,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.church', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function churchSave(Request $request)
    {
        $data = $request->validate ([
            'parish'=>'required|max:255',
            'priest'=>'required|max:255',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $church = new Church();
            $church->id = $id;
            $message = "Successfully saved Church Details";
            $status = Status::where('id', $id)->first();
            $status->church = true;
            $status->save();
        }
        else 
        {
            $church = Church::where('id', $id)->first();
            $message = "Successfully updated Church Details";
        }
        $church->parish = $data['parish'];
        $church->priest = $data['priest'];
        $church->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function oba(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $oba = OBA::where('id', $id)->first();
        if($oba !== null)
            return view('application.oba', [
                'id'=>$id,
                'oba'=>$oba,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.oba', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
        return view('application.oba');
    }

     public function obaSave(Request $request)
    {
        $data = $request->validate([
            'fathergrandfather'=>'required_with:prep|required_with:guru|required_with:banda|required_with:mount',
            'mount_from'=>'required_with:mount',
            'mount_to'=>'required_with:mount',
            'house'=> 'required_with:mount',
            'admission'=> 'required_with:mount',
            'guru_from'=> 'required_with:guru',
            'guru_to'=> 'required_with:guru',
            'banda_from'=> 'required_with:banda',
            'banda_to'=> 'required_with:banda',
            'prep_from'=> 'required_with:prep',
            'prep_to'=> 'required_with:prep',
            'oba_date'=> 'required_with:oba_member',
            'oba_number'=> 'required_with:oba_member',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $oba = new OBA();
            $oba->id = $id;
            $message = "Successfully saved OBA Details";
            $status = Status::where('id', $id)->first();
            $status->oba = $request['mount']? true : ($request['guru']? true : ($request['prep']? true : ($request['banda']? true : false)));
            $status->save();
        }
        else 
        {
            $oba = OBA::where('id', $id)->first();
            $message = "Successfully updated OBA Details";
            $status = Status::where('id', $id)->first();
            $status->oba = $request['mount']? true : ($request['guru']? true : ($request['prep']? true : ($request['banda']? true : false)));
            $status->save();
        }
        $mount = ($request['mount'])? 10 : 0;
        $mount += ($request['fathergrandfather'] == "father"? 2 : ($request['fathergrandfather'] == "fatherfather"? 3 : 4));
        $oba->mount = $mount;
        $oba->guru = ($request['guru'])? true : false;
        $oba->banda = ($request['banda'])? true : false;
        $oba->prep = ($request['prep'])? true : false;
        $oba->oba_member = ($request['oba_member'])? true: false;
        $oba->mount_to = $data['mount_to'];
        $oba->mount_from = $data['mount_from'];
        $oba->house = $data['house'];
        $oba->admission = $data['admission'];
        $oba->guru_to = $data['guru_to'];
        $oba->guru_from = $data['guru_from'];
        $oba->banda_from = $data['banda_from'];
        $oba->banda_to = $data['banda_to'];
        $oba->prep_from = $data['prep_from'];
        $oba->prep_to = $data['prep_to'];
        $oba->oba_date = $data['oba_date'];
        $oba->oba_number = $data['oba_number'];
        $oba->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function staff(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $staff = Staff::where('id', $id)->first();
        if($staff !== null)
            return view('application.staff', [
                'id'=>$id,
                'staff'=>$staff,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.staff', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function staffSave(Request $request)
    {
        $data = $request->validate ([
            'mother_name'=>'required_with:mother_staff|max:255',
            'mother_joined'=>'required_with:mother_staff|max:255',
            'mother_section'=>'required_with:mother_staff|max:255',
            'mother_EPF'=>'required_with:mother_staff|max:255',
            'father_name'=>'required_with:father_staff|max:255',
            'father_joined'=>'required_with:father_staff|max:255',
            'father_section'=>'required_with:father_staff|max:255',
            'father_EPF'=>'required_with:father_staff|max:255',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $staff = new Staff();
            $staff->id = $id;
            $message = "Successfully saved Staff Details";
            $status = Status::where('id', $id)->first();
            $status->staff = true;
            $status->save();
        }
        else 
        {
            $staff = Staff::where('id', $id)->first();
            $message = "Successfully updated Staff Details";
        }
        if($request['mother_staff']) 
        {
            $staff->mother_staff = true;
            $staff->mother_name = $data['mother_name'];
            $staff->mother_joined = $data['mother_joined'];
            $staff->mother_section = $data['mother_section'];  
            $staff->mother_EPF = $data['mother_EPF'];    
        }
        else 
        {
            $staff->mother_staff = false;
        }
        if($request['father_staff']) 
        {
            $staff->father_staff = true;
            $staff->father_name = $data['father_name'];
            $staff->father_joined = $data['father_joined'];
            $staff->father_section = $data['father_section'];  
            $staff->father_EPF = $data['father_EPF'];    
        }
        else 
        {
            $staff->father_staff = false;
        }
        $staff->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function connections(Request $request)
    {
        $id = $request['id'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else 
            $picture = " ";
        $connections = Connections::where('id', $id)->first();
        if($connections !== null)
            return view('application.connections', [
                'id'=>$id,
                'connections'=>$connections,
                'picture' => $picture,
                'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
            ]);
        return view('application.connections', [
            'id'=>$id,
            'picture' => $picture,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }

    public function connectionsSave(Request $request)
    {
        $data = $request->validate ([
            'connection'=>'required|max:255',
        ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $connections = new Connections();
            $connections->id = $id;
            $message = "Successfully saved Connections Details";
            $status = Status::where('id', $id)->first();
            $status->connections = true;
            $status->save();
        }
        else 
        {
            $connections = Connections::where('id', $id)->first();
            $message = "Successfully updated Connections Details";
        }
        $connections->connection = $data['connection'];
        $connections->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function general(Request $request)
    {
        $id = $request['id'];
        $section = Applicant::where('id', $id)->first()['section'];
        $child = Child::where('id', $id)->first();
        if($child !== null){
            $picture = $child['picture'];
        }
        else {
            $picture = " ";
        }
        $general = General::where('id', $id)->first();
        if($general !== null)
            return view('application.general', [
                'id'=>$id,
                'general'=>$general,
                'picture' => $picture,
                'section'=>$section,
                'year'=>Setting::where('name', '=', $section)->first()['year'],
            ]);
        return view('application.general', [
            'id'=>$id,
            'picture' => $picture,
            'section'=>$section,
            'year'=>Setting::where('name', '=', $section)->first()['year'],
        ]);
    }

    public function generalSave(Request $request)
    {
        $section = Applicant::where('id', '=', $request['id'])->first()['section'];
        if($section == "Kindergarten (Grade 1)")
            $data = $request->validate([
                'boarding'=>'required',
            ]);
        else
            $data = $request->validate([
                'sports'=>'required|max:5000',
                'societies'=>'required|max:5000',
                'other'=>'required|max:5000',
                'boarding'=>'required',
            ]);
        $id = $request['id'];
        if($request['cmdSave'] == "Save Data") 
        {
            $general = new General();
            $general->id = $id;
            $message = "Successfully saved General Information";
            $status = Status::where('id', $id)->first();
            $status->general = true;
            $status->save();
        }
        else 
        {
            $general = General::where('id', $id)->first();
            $message = "Successfully updated General Information";
        }
        if($section == "Kindergarten (Grade 1)")
        {
            $general->sports = " ";
            $general->societies = " ";
            $general->other = " ";
        }
        else 
        {
            $general->sports = $data['sports'];
            $general->societies = $data['societies'];
            $general->other = $data['other'];    
        }
        $general->boarding = $data['boarding'];
        $general->save();
        return redirect('application/status')->with(['success'=>$message]);
    }

    public function submit(Request $request)
    {
        $id = $request['id'];
        $section = Applicant::where('id', $id)->first()['section'];
        if(!((new Common())->checkAccess($section)))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        $this->makeApplication($id);
        return view('application.submit', [
            'id'=>$id,
            'year'=>Setting::where('name', '=',$section)->first()['year'],
        ]);
    }

    public function submitForm(Request $request)
    {
        $data = $request->validate([
            'accept'=>'required',
        ]);
        $id = $request['id'];
        date_default_timezone_set("Asia/Colombo");
        $now = date("Y/m/d H:i:s");
        $message = "Successfully Submitted Form. An Email has already been sent with a printable version of the application form.";
        $status = Status::where('id', $id)->first();
        $status->submitted = true;
        $status->save();
        $applicant = Applicant::where('id', $id)->first();
        $applicant->submitted = true;
        $applicant->submitted_date = $now;
        $applicant->save();

        $fpdi = new FPDI;
        $count = $fpdi->setSourceFile($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $id . '_pdf.pdf');
        for($i = 1; $i <= $count; $i++) 
        {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            if($i == $count)
            {
                $fpdi->SetFont('Helvetica', '', 10);
                $fpdi->setTextColor(0,0,0);
                $fpdi->Text(20, 270, $now);
            }
        }
        $fpdi->Output($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $id . "_pdf.pdf", 'F');
        $confirmSubmission = new ConfirmSubmission($id, $applicant['email'], $applicant['name'], $applicant['section']);
        Mail::to($applicant['email'])->send($confirmSubmission);
        Session::flush();
        Auth::guard('user')->logout();
        return redirect('application/login')->with(['success'=>$message]);
    }

    public function finalised(Request $request)
    {
        $id = $request['id'];
        Session::flush();
        Auth::guard('user')->logout();
        return view('application.finalised', [
            'id'=>$id,
            'year'=>Setting::where('name', '=', Applicant::where('id', $id)->first()['section'])->first()['year'],
        ]);
    }
    
    public function make(Request $request)
    {
        $this->makeApplication2($request['id']);
        $section = Applicant::where('id', $request['id'])->first()['section'];
        return redirect('list?section=' . $section);
    }

    public function makeApplication($id)
    {
        $section = Applicant::where('id', $id)->first()['section'];
        if($section == "Branch Schools" || $section == "Grade 6" || $section == "ALevels" || $section == "International ALevels") {
            if(Result::where('id', $id)->first() !== null)
                $results = Result::where('id', $id)->first();
            else 
                $results = "";
        }
        else 
            $results = "";
        if($section == "Branch Schools" || $section == "ALevels" || $section == "International ALevels") {
            if(Subject::where('id', $id)->first() !== null)
                $subjects = Subject::where('id', $id)->first();
            else 
                $subjects = "";
        }
        else 
            $subjects = "";
        if(Church::where('id', $id)->first() !== null)
            $church = Church::where('id', $id)->first();
        else 
            $church = "";
        if(OBA::where('id', $id)->first() !== null)
            $oba = OBA::where('id', $id)->first();
        else 
            $oba = "";
        $opciones_ssl=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $img_path = 'images/crest2.jpg';
        $extension = pathinfo($img_path, PATHINFO_EXTENSION);
        $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
        $img_base_64 = base64_encode($data);
        $path_img = 'data:image/' . $extension . ';base64,' . $img_base_64;
        $child = Child::where('id', $id)->first();
        $img_path = 'uploads/' . $child['picture'];
        $extension = pathinfo($img_path, PATHINFO_EXTENSION);
        $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
        $img_base_64 = base64_encode($data);
        $child_img = 'data:image/' . $extension . ';base64,' . $img_base_64;
        $pdf = PDF::loadView('application.pdf', [
            'section'=>$section,
            'child'=>$child,
            'father'=>Father::where('id', $id)->first(),
            'mother'=>Mother::where('id', $id)->first(),
            'other'=>Other::where('id', $id)->first(),
            'results'=>$results,
            'subjects'=>$subjects,
            'church'=>$church,
            'oba'=>$oba,
            'staff'=>Staff::where('id', $id)->first(),
            'connections'=>Connections::where('id', $id)->first(),
            'general'=>General::where('id', $id)->first(),
            'path_img'=>$path_img,
            'child_img'=>$child_img,
            'year'=>Applicant::where('id', '=',$id)->first()['year'],
        ]);
        $pdf->render();
        $output = $pdf->output();
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $id . '_pdf.pdf', $output);        
    }
    
    /*public function makeApplication2($id)
    {
        $section = Applicant::where('id', $id)->first()['section'];
        if($section == "Branch Schools" || $section == "Grade 6" || $section == "ALevels" || $section == "International ALevels") {
            if(Result::where('id', $id)->first() !== null)
                $results = Result::where('id', $id)->first();
            else 
                $results = "";
        }
        else 
            $results = "";
        if($section == "Branch Schools" || $section == "ALevels" || $section == "International ALevels") {
            if(Subject::where('id', $id)->first() !== null)
                $subjects = Subject::where('id', $id)->first();
            else 
                $subjects = "";
        }
        else 
            $subjects = "";
        if(Church::where('id', $id)->first() !== null)
            $church = Church::where('id', $id)->first();
        else 
            $church = "";
        if(OBA::where('id', $id)->first() !== null)
            $oba = OBA::where('id', $id)->first();
        else 
            $oba = "";
        $opciones_ssl=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $img_path = 'images/crest2.jpg';
        $extension = pathinfo($img_path, PATHINFO_EXTENSION);
        $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
        $img_base_64 = base64_encode($data);
        $path_img = 'data:image/' . $extension . ';base64,' . $img_base_64;
        $child = Child::where('id', $id)->first();
        try 
        {
            $img_path = 'uploads/' . $child['picture'];
            $extension = pathinfo($img_path, PATHINFO_EXTENSION);
            $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
            $img_base_64 = base64_encode($data);
            $child_img = 'data:image/' . $extension . ';base64,' . $img_base_64;
        } 
        catch (\Exception $err)
        {
            $child_img = "";   
        }
        $pdf = PDF::loadView('application.pdf', [
            'section'=>$section,
            'child'=>$child,
            'father'=>Father::where('id', $id)->first(),
            'mother'=>Mother::where('id', $id)->first(),
            'other'=>Other::where('id', $id)->first(),
            'results'=>$results,
            'subjects'=>$subjects,
            'church'=>$church,
            'oba'=>$oba,
            'staff'=>Staff::where('id', $id)->first(),
            'connections'=>Connections::where('id', $id)->first(),
            'general'=>General::where('id', $id)->first(),
            'path_img'=>$path_img,
            'child_img'=>$child_img,
            'year'=>Applicant::where('id', '=',$id)->first()['year'],
        ]);
        $pdf->render();
        $output = $pdf->output();
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $id . '_pdf.pdf', $output);        
    }*/
}
