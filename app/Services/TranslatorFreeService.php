<?php

namespace App\Services;
use Statickidz\GoogleTranslate;

class TranslatorFreeService
{
    public function translateAuto(string $text): string
    {
        $to = app()->getLocale();
        $from = $this->detectLanguage($text);

        // если языки совпадают — не переводим
        if ($from === $to) {
            return $text;
        }

        $translator = new GoogleTranslate();

        try {
            return $translator->translate($from, $to, $text);
        } catch (\Throwable $e) {
            return $text;
        }
    }

    protected function detectLanguage(string $text): string
    {
        // Простая Heuristika: кириллица = 'ru', иначе 'en'
        return preg_match('/[А-Яа-яЁё]/u', $text) ? 'ru' : 'en';
    }
}