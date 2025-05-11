<?php

namespace App\Services;

class DateLangService
{
    public static function getMonth($month): string
    {
        $months = match (app()->getLocale() ?? 'ru') {
            'ru' =>  [
                1 => 'Январь', 2 => 'Февраль', 3 => 'Март',
                4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
                7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь',
                10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
            ],
            'uz' => [
                1 => 'Yanvar', 2 => 'Fevral', 3 => 'Mart',
                4 => 'Aprel', 5 => 'May', 6 => 'Iyun',
                7 => 'Iyul', 8 => 'Avgust', 9 => 'Sentyabr',
                10 => 'Oktyabr', 11 => 'Noyabr', 12 => 'Dekabr'
            ],
            'en' => [
                1 => 'January', 2 => 'February', 3 => 'March',
                4 => 'April',    5 => 'May', 6 => 'June',
                7 => 'July', 8 => 'August', 9 => 'September',
                10 => 'October', 11 => 'November', 12 => 'December'
            ]
        };

        return $months[$month];
    }
}