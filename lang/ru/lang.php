<?php

$lang = Illuminate\Support\Facades\Cache::remember('lang_ru', 3600, function () {
    return \App\Models\Lang::whereCode('ru')->pluck('value', 'key')->toArray();
});

return $lang;
