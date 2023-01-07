<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Http\Requests\StoresettingsRequest;
use App\Http\Requests\UpdatesettingsRequest;

class SettingsController extends Controller
{
    
    public function index()
    {
        return view('settings',['data' => settings::latest()->first()]);
    }



   
    public function update(UpdatesettingsRequest $request)
    {
        $setting = settings::latest()->first();
        $setting->return_days = $request->return_days;
        $setting->fine = $request->fine;
        $setting->save();
        return redirect()->route('settings');
    }
}
