<?php

namespace App\Helpers;

class TextFormatterHelper
{
    public static function formatForTelegram(string $text): string
    {
        // Заменяем &nbsp; на перенос строки
        $text = str_replace('&nbsp;', "\n", $text);

        // Удаляем все HTML-теги
        $text = strip_tags($text);

        // Приводим переносы строк в порядок: удаляем лишние пустые строки
        $text = preg_replace('/\s*[\r\n]+\s*/', "\n\n", $text);

        // Убираем пробелы в начале и конце текста
        return trim($text);
    }
}