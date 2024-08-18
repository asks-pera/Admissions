<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ConfirmEmail;
use App\Mail\RegisterApplicant;
use Illuminate\Support\Facades\Mail;

use App\Models\Setting;
use App\Models\Applicant;
use App\Models\Status;
use Hash;
use App\Classes\Common;

class RegisterController extends Controller
{

    public function branch()
    {
        if(!(new Common())->checkAccess("Branch Schools"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('branch.index')->with([
            'year' => Setting::where('link', '=', 'branch')->first()['year'],
        ]);
    }

    public function branchConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "branch");
        try {
            Mail::to($to)->send($mail);
        } catch (Exception $err) {
            return redirect('branch')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function kindergarten()
    {
        if(!(new Common())->checkAccess("Kindergarten (Grade 1)"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('kindergarten.index')->with([
            'year' => Setting::where('link', '=', 'kindergarten')->first()['year'],
        ]);
    }

    public function kindergartenConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "kindergarten");
        try {
            Mail::to($to)->send($mail);    
        } catch (\Exception $err) {
            return redirect('kindergarten')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function other()
    {
        if(!(new Common())->checkAccess("Other Grades"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('other.index')->with([
            'year' => Setting::where('link', '=', 'other')->first()['year'],
        ]);
    }
    
    public function otherConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "other");
        try {
            Mail::to($to)->send($mail);    
        } catch (\Exception $err) {
            return redirect('other')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function nursery()
    {
        if(!(new Common())->checkAccess("Nursery"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('nursery.index')->with([
            'year' => Setting::where('link', '=', 'nursery')->first()['year'],
        ]);
    }

    public function nurseryConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "nursery");
        try {
            Mail::to($to)->send($mail);    
        } catch (\Exception $err) {
            return redirect('nursery')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check your emails and verify email address to continue"]);
    }

    public function alevels()
    {
        if(!(new Common())->checkAccess("ALevels"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('alevels.index')->with([
            'year' => Setting::where('link', '=', 'alevels')->first()['year'],
        ]);
    }

    public function alevelsConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "alevels");
        try {
            Mail::to($to)->send($mail);
        } catch (Exception $err) {
            return redirect('alevels')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function london()
    {
        if(!(new Common())->checkAccess("International ALevels"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('london.index')->with([
            'year' => Setting::where('link', '=', 'london')->first()['year'],
        ]);
    }

    public function londonConfirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "london");
        try {
            Mail::to($to)->send($mail);
        } catch (Exception $err) {
            return redirect('london')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function grade6()
    {
        if(!(new Common())->checkAccess("Grade 6"))
            return redirect('/')->with(['error'=>"Sorry. The application is now closed."]);
        return view('grade6.index')->with([
            'year' => Setting::where('link', '=', 'grade6')->first()['year'],
        ]);
    }

    public function grade6Confirm(Request $request)
    {
        $email = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $to = $email['email'];
        $mail = new ConfirmEmail($to, "grade6");
        try {
            Mail::to($to)->send($mail);
        } catch (Exception $err) {
            return redirect('grade6')->with(['error'=>'Error sending email! Please contact the school - ' . $err->getMessage()]);
        }
        return redirect('/')->with(['success'=>"Email sent successfully. Please check  your emails and verify email address to continue"]);
    }

    public function verify(Request $request)
    {
       if(!(isset($request['email'])) || !(isset($request['section'])))
            return "<h2 style='color:red'>Something is not right. Are you sure you clicked the link in your email?</h2>";
        return view('application.register')->with([
            'email'=>$request['email'],
            'section'=>(new Common())->getName($request['section']),
            'year'=>Setting::where('link', '=', $request['section'])->first()['year'],
            ]);
    }

    public function register(Request $request)
    {
        $inputs = $request->validate([
            'section'=>'required',
            'name'=>'required|max:255',
            'nic'=>'required|max:15',
            'mobile'=>'required|max:15',
            'email' => 'required|email|unique:applicants,email|max:255',
            'branch'=>'required_if:section,Branch Schools',
            'confirm'=>'required'
        ]);
        $password = mt_rand(100000, 999999);
        $applicant = new Applicant();
        $applicant->year = Setting::where('link', '=', (new Common())->getLink($inputs['section']))->first()['year'];
        $applicant->section = $inputs['section'];
        $applicant->name = $inputs['name'];
        $applicant->nic = $inputs['nic'];
        $applicant->mobile = $inputs['mobile'];
        $applicant->email = $inputs['email'];
        if($inputs['section'] == "Branch Schools")
            $applicant->branch = $inputs['branch'];
        else
            $applicant->branch="";
        $applicant->password = Hash::make($password);
        $applicant->save();
        $status = new Status();
        $status->id = $applicant['id'];
        $status->save();
        $registerEmail = new RegisterApplicant($applicant['id'], $password, $inputs['section']);
        try {
            Mail::to($applicant['email'])->send($registerEmail);
        }
        catch (\Exception $err) {
            return "<script type='text/javascript'>alert(\"There was an unknown error sending email! Please send an email to admissions@stcmount.lk - " . $err->getMessage() . "\");</script>";
        }
        return redirect('application/login')->with(['success'=>"Email sent successfully. Please check  your email for login details."]);
    }
    
    function newRegistration(Request $request){
        $data = $request->validate([
            'email'=>'required', 
            'section'=>'required']);
        $applicant = Applicant::where('email', '=', $data['email'])->first();
        $applicant->email=$applicant['email'] . "1";
        $applicant->save();
        return redirect(url("register?email=" . $data['email'] . "&section=" . (new Common())->getLink($data['section'])))->withSuccess('You can now register for a new application.');
    }
}
