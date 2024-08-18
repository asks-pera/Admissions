<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Asia/Colombo");
        $now = strtotime(date("Y/m/d H:i:s"));
        $settings = array();
        $states = array();
        foreach(Setting::all() as $record) {
            array_push($settings, $record);
            if((strtotime($record['open']) < $now) & (strtotime($record['close']) > $now))
                array_push($states, ['name'=>$record['name'], 'link'=>$record['link']]);
        }
        return view('index', [
            'settings' => $settings, 
            'states' => $states
        ]);
    }

    public function login(Request $request) 
    {
        if(isset($request['Admin']))
            return redirect('admin/login');
        elseif (isset($request['Application']))
            return redirect('application/login');
    }
}
