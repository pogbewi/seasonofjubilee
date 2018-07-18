<?php
/**
 * Created by PhpStorm.
 * User: Esther
 * Date: 1/22/2018
 * Time: 12:58 PM
 */

namespace Seasonofjubilee\Http;


use Seasonofjubilee\Models\Setting;

class SettingsHelper
{
    public function settings($key, $default){
        $setting = Setting::where('key', $key)->first();
        if($setting != null){
            return $setting->value;
        };
        return $default;
    }
}