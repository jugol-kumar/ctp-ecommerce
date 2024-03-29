<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Country;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class BusinessSettingController extends Controller
{
    public function index()
    {

        return inertia('Setting', [
            'main_url' => URL::route('admin.businessSave'),
            'categories' => Category::with('childrens')->get(),
            'bSettings' =>[
                'name'        => get_setting('name'),
                'details'     => get_setting('app_details'),
                'header_logo' => global_asset(get_setting('header_logo')),
                'footer_logo' => global_asset(get_setting('footer_logo')),
                'fevicon_logo'=> global_asset(get_setting('fevicon_logo')),
                'timezone'    => json_decode(get_setting('timezone')),
                'country'     => json_decode(get_setting('country')),

                'address'     => get_setting('address'),
                'phone'       => get_setting('phone'),
                'email'       => get_setting('email'),

                'api_user_pass'  => get_setting('api_user_pass'),
                'api_user_name'  => get_setting('api_user_name'),
                'api_url'        => get_setting('api_url'),

                'instagram_profile'       => get_setting('instagram_profile'),
                'facebook_profile'        => get_setting('facebook_profile'),
                'google_drive'            => get_setting('google_drive'),
                'linkedin_profile'        => get_setting('linkedin_profile'),
                'twitter_profile'         => get_setting('twitter_profile'),

            ]
        ]);
    }

    public function updateSetting()
    {

            foreach (Request::all() as $type => $value){
                $business_settings = BusinessSetting::where('type', $type)->first();

                if ($type == 'name' && $value != null){
                    overWriteEnvFile("APP_NAME", $value);
                }

                if ($type == 'timezone' && gettype($value) == 'array'){
                        overWriteEnvFile("APP_TIMEZONE", $value['tz']);
                }

                if ($type == 'country' && $value != null && gettype($value) != 'array'){
                    $value = $business_settings->country;
                }

                if ($type == 'timezone' && gettype($value) == 'array'){
                    overWriteEnvFile("TEXT_COLOR", $value['tz']);
                }

                if ($type == 'header_logo' && Request::hasFile('header_logo')){
                    $value = Request::file('header_logo')->store('settings', 'public');
                    if ($business_settings != null){
                        Gallery::updateOrCreate([
                           'imageable_id' => $business_settings->id,
                            'imageable_type' => 'App\\Models\\BusinessSetting',
                            'filename' => $value
                        ]);
                    }
                }

                if ($type == 'footer_logo' && Request::hasFile('footer_logo')) {
                    $value = Request::file('footer_logo')->store('settings', 'public');
                    if ($business_settings != null){
                        Gallery::updateOrCreate([
                            'imageable_id' => $business_settings->id,
                            'imageable_type' => 'App\\Models\\BusinessSetting',
                            'filename' => $value
                        ]);
                    }
                }

                if($business_settings != null) {
                    if ($value != null){
                        if ($type == 'timezone' && gettype($value) != 'array'){
                            $value = $business_settings->value;
                        }
                        if(gettype($value) == 'array'){
                            $business_settings->value = json_encode($value);
                        }
                        else {
                            $business_settings->value = $value;
                        }
                        $business_settings->save();
                    }
                } else{
                    if ($value != null){
                        $business_settings = new BusinessSetting;
                        $business_settings->type = $type;
                        if(gettype($value) == 'array'){
                            $business_settings->value = json_encode($value);
                        }
                        else {
                            $business_settings->value = $value;
                        }
                        $business_settings->save();
                    }
                }
            }

            Log::info('Update Business Settings', [
                'message' => 'Update Successfully Done...!',
                'time' => now()
            ]);

            return back();
    }

    public function logoUpdate(){

        if (Request::hasFile('header_logo')){
            $business_settings = BusinessSetting::where('type', 'header_logo')->first();
            if ($business_settings?->value != null){
                Storage::disk('public')->delete($business_settings->value);
            }
            $value = Request::file('header_logo')->store('settings', 'public');
            $business_settings->value = $value;
            $business_settings->save();
        }
        if (Request::hasFile('footer_logo')){
            $business_settings = BusinessSetting::where('type', 'footer_logo')->first();
            if ($business_settings?->value != null){
                Storage::disk('public')->delete($business_settings->value);
            }
            $value = Request::file('footer_logo')->store('settings', 'public');
            $business_settings->value = $value;
            $business_settings->save();
        }
        if (Request::hasFile('fevicon_logo')){
            $business_settings = BusinessSetting::where('type', 'fevicon_logo')->first();
            if ($business_settings?->value != null){
                Storage::disk('public')->delete($business_settings->value);
            }
            $value = Request::file('fevicon_logo')->store('settings', 'public');
            $business_settings->value = $value;
            $business_settings->save();
        }

        Log::info('Update Business Settings', [
            'message' => 'Update Successfully Done...!',
            'time' => now()
        ]);

        return redirect()->route('setting.index');
    }
}
