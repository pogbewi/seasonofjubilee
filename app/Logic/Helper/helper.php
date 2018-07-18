<?php
if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        $s = app('Seasonofjubilee\Http\SettingsHelper');

        if (func_num_args() == 0) {
            return $s;
        }
        return $s->settings($key, $default);
    }
}

if (!function_exists('menu')) {
    function menu($menuName, $type = null, array $options = [])
    {
        return \Seasonofjubilee\Models\Menu::display($menuName, $type, $options);
    }
}

function flash($title = null, $message = null) {
// Set variable $flash to fetch the Flash Class
// in Flash.php
    $flash = app('Seasonofjubilee\Http\Flash');

// If 0 parameters are passed in ($title, $message)
// then just return the flash instance.
    if (func_num_args() == 0) {
        return $flash;
    }

// Just return a regular flash->info message
    return $flash->info($title, $message);
}

/**
 * @param $date
 * @return bool|string
 * Format the time to this
 */
function prettyDate($date) {
    return date("M d, Y @h:i:s", strtotime($date));
}

function getThumbs($path,$width, $height, $type="fit"){
    return app('Seasonofjubilee\Http\CustomImage')->generateImageThumb($path,$width,$height,$type);
}