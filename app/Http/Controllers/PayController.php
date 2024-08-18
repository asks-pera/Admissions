<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Applicant;
use App\Models\Status;

use App\Mail\Paid;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    protected $id;

    public function purchase(Request $request)
    {
        session(['id' => $request['id']]);
        return view('banking.payment', ['clientRef'=> $request['id']]);
    }

    public function response(Request $request)
    {
        //$id = session('id');
        $id = substr($request["clientRef"], 0, 4);
        if(strcmp(substr($request["clientRef"], 0, 4), strval($id)) != 0)
            return redirect('application/status')->with(['error'=>'Something went wrong with the transaction. No money has been taken. Please retry.']);
        $clientRef = $request["clientRef"];
        $csrfToken = $request['reqid'];
        $auth_Token = ''; // Bank Code
        $response = Http::post('https://sampath.paycorp.lk/webinterface/qw/confirm?csrfToken=' . $csrfToken . '&authToken=' . $auth_Token . '&clientRef=' . $clientRef);
        date_default_timezone_set("Asia/Colombo");
        $transactiondatetime = date("Y/m/d H:i:s");
        $responses = [];
        $params = explode('&', $response);
        if(isset($params[1])) {
            foreach ($params as $element) {
                list($key, $value) = explode('=', $element);
                $responses[$key] = $value;
            }
        } else {
            return redirect('application/status')->with(['error'=>'Payment error. Please email admissions@stcmount.lk. Do not pay again.']);
        }
        if(strcmp($responses['responseCode'], "00") != 0) {
            return redirect('application/status')->with(['error'=>"\"Payment unsuccessful. - " . $responses['responseText'] . ". Please email admissions@stcmount.lk for assistance.\""]);
        }
        $applicant = Applicant::where('id', $id)->first();
        $mail = new Paid($id);
        Mail::to($applicant['email'])->send($mail);
        $applicant->purchased = true;
        $applicant->purchased_date = $transactiondatetime;
        $applicant->save();
        
        $status = Status::where('id', $id)->first();
        $status->purchased = true;
        $status->save();

        return redirect('application/status')->with(['success'=>'Transaction Successful. The receipt has been emailed to you.']);
    }
}
