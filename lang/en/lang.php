<?php

$lang = Illuminate\Support\Facades\Cache::remember('lang_en', 3600, function () {
    return \App\Models\Lang::whereCode('en')->pluck('value', 'key')->toArray();
});

return $lang;
