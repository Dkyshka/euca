<?php

namespace App\Traits;

trait Filesaver
{
    public function storeFiles(array $filePaths, Object $model)
    {
        foreach ($filePaths as $filePath) {
            $this->storeFile($filePath, $model);
        }
    }

    public function storeFile(string $filePath, Object $model)
    {
        // Сохраняем оригинальный путь и информацию о файле
        $model->pictures()->updateOrCreate(
            ['orig' => $filePath],   // Условие поиска
            ['orig' => $filePath, 'avif' => $filePath] // Данные для обновления/создания
        );
    }

}