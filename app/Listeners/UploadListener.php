<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Imagick;
use ImagickException;
use UniSharp\LaravelFilemanager\Events\ImageWasDeleted;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;

class UploadListener
{
    public function handle($event)
    {
        $method = 'on' . class_basename($event);
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $event);
        }
    }
}
