<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\contactMessage;
use App\Models\Policy;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSettings()
    {
        $settings =Settings::first();
        return view('backend.settings.show-settings',compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = Settings::first();
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->instagram = $request->instagram;
        $settings->youtube = $request->youtube;
        $settings->free_shipping_amount = $request->free_shipping_amount;

         if(isset($request->logo)){
            if($settings->logo && file_exists('backend/image/settings/'.$settings->logo))
        {
            unlink('backend/image/settings/'.$settings->logo);
        }

            $imageName = rand().'-logo-'.'.'.$request->logo->extension();
            $request->logo->move('backend/image/settings/',$imageName);
            $settings->logo = $imageName;
        }
        if(isset($request->hero_image)){
            if($settings->hero_image && file_exists('backend/image/settings/'.$settings->hero_image))
        {
            unlink('backend/image/settings/'.$settings->hero_image);
        }

            $sliderName = rand().'-slider-'.'.'.$request->hero_image->extension();
            $request->hero_image->move('backend/image/settings/',$sliderName);
            $settings->hero_image = $sliderName;
        }

        

        $settings->save();
        toastr()->success('Setting updated successfully');
        return redirect()->back();
        
    }

    public function showPolicies()
    {  
         $policiesAboutus = Policy::first();
        return view('backend.settings.show-policies',compact('policiesAboutus'));       
    }

    public function updatePolicies(Request $request)
    {
        $policiesAboutus = Policy::first();

        $policiesAboutus->privacy_policy = $request->privacy_policy;
        $policiesAboutus->terms_conditions = $request->terms_conditions;
        $policiesAboutus->refund_policy = $request->refund_policy;
        $policiesAboutus->payment_policy = $request->payment_policy;
        $policiesAboutus->return_policy = $request->return_policy;
        $policiesAboutus->about_us = $request->about_us;

        $policiesAboutus->save();
        toastr()->success('Setting updated successfully');
        return redirect()->back();
    }

    public function showBanners()
    {   $banners = Banner::get();
        return view('backend.settings.show-banners',compact('banners'));
    }

    public function editBanners($id)
        {
            $banners = Banner::find($id);
            return view('backend.settings.edit-banners',compact('banners'));
        }

    public function updateBanners(Request $request,$id)
    {
        $banners = Banner::find($id);
        if(isset($request->image)){
            if($banners->image && file_exists('backend/image/banners/'.$banners->image))
        {
            unlink('backend/image/banners/'.$banners->image);
        }

            $bannerName = rand().'-banner-'.'.'.$request->image->extension();
            $request->image->move('backend/image/banners/',$bannerName);
            $banners->image = $bannerName;
        }

        $banners->save();
        toastr()->success('Setting updated successfully');
        return redirect('admin/show-banners');
    }

    //contact message...

    public function showContactMessage()
    {   
        $messages = contactMessage::paginate(20);
        return view('backend.settings.show-contact',compact('messages'));
    }

    public function deleteContactMessage($id)
    {
        $messages = contactMessage::find($id);
        $messages->delete();

        toastr()->success('Deleted successfully');
        return redirect()->back();

    }

    public function showCredentials()
    {
        $user = User::select('name','email')->first();
        return view('backend.settings.show-credentials',compact('user'));
    }

    public function updateCredentials(Request $request)
    {
        $user = User::first();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        toastr()->success('Credentials upload successfully');
        return redirect()->back();
    }

}
