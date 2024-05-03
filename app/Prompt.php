<?php

namespace App;

use Native\Laravel\Facades\Window;

class Prompt
{
    // https://github.com/NativePHP/laravel/pull/144
    // https://github.com/NativePHP/laravel/discussions/247
    public static function toggle()
    {
        Window::open()
            ->title('Thing')
            ->width(750)
            ->height(480)
            // ->resizable(false)
            ->frameless(true)
            ->transparent(true)
            ->showDevTools(false);
    }

    public static function settings($key)
    {
        return new Meta('settings', $key);
    }

    public static function storagePath($path)
    {
        if (app()->isProduction()) {
            // TODO: Support XDG
            return Storage::disk('user_home')->path('/.prompt/'.$path);
        }

        return storage_path($path);
    }
}
