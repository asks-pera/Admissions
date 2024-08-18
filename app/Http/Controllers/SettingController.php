<?php

namespace App\Http\Controllers;

use App\Classes\Common;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Hidden;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Hidden::where('name', '=', 'overrideApplication')->first()['value'];
        return view('admin.settings.view', [
            'setting' => Setting::all(), 
            'override'=> $result,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = array();
        if(!Setting::where('name', '=', 'Nursery')->exists())
            array_push($list, 'Nursery');
        if(!Setting::where('name', '=', 'Kindergarten (Grade 1)')->exists())
            array_push($list, 'Kindergarten (Grade 1)');
        if(!Setting::where('name', '=', 'Other Grades')->exists())
            array_push($list, 'Other Grades');
        if(!Setting::where('name', '=', 'Grade 6')->exists())
            array_push($list, 'Grade 6');
        if(!Setting::where('name', '=', 'Branch Schools')->exists())
            array_push($list, 'Branch Schools');
        if(!Setting::where('name', '=', 'ALevels')->exists())
            array_push($list, 'ALevels');
        if(!Setting::where('name', '=', 'International ALevels')->exists())
            array_push($list, 'International ALevels');
        return view('admin.settings.create', ['list' => $list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->name = $request->input('txtSettingSection');
        $setting->link = (new Common())->getLink($request->input('txtSettingSection'));
        $setting->year = $request->input('txtYear');
        $setting->open = $request->input('txtOpen');
        $setting->close = $request->input('txtClose');
        $setting->save();
        if($setting['id'] > 0)
            return redirect('admin/settings')->with(['success'=>'Successfully created item']);
        return redirect('admin/settings')->with(['error'=>'Could not create item']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.settings.edit', ['setting'=> Setting::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $setting->name = $request->input('txtSettingSection');
        $setting->link = (new Common())->getLink($request->input('txtSettingSection'));
        $setting->year = $request->input('txtYear');
        $setting->open = $request->input('txtOpen');
        $setting->close = $request->input('txtClose');
        $setting->save();
        if($setting['id'] > 0)
            return redirect('admin/settings')->with(['success'=>'Successfully edited item']);
        return redirect('admin/settings')->with(['error'=>'Could not edit item']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::find($id)->delete();
        return redirect('admin/settings')->with(['success'=>'Successfully deleted item']);
    }

    public function overrideClicked(Request $request)
    {
        $overrideApplication = Hidden::where('name', '=', 'overrideApplication')->first();
        $overrideApplication->value= $request['value'] == "true"? 1 : 0;
        $overrideApplication->save();
        return response()->json(['success'=>'Successfully Update - ' . $request['value']]);
    }
}
