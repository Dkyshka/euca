<?php

$lang = Illuminate\Support\Facades\Cache::remember('lang_uz', 3600, function () {
    return \App\Models\Lang::whereCode('uz')->pluck('value', 'key')->toArray();
});

return $lang;
