<?php

namespace App\Imports;

use App\Models\Lang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class LangsImport implements ToCollection, WithHeadingRow
{

    /**
     * @throws \Throwable
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->updateTranslation($row['key'], $row['ru'], $row['uz'], $row['en']);
        }

    }

    /**
     * @throws \Throwable
     */
    public function updateTranslation(string $key, string $ru, string $uz, string $en)
    {
        try {
            DB::beginTransaction();

            Lang::updateOrCreate(
                ['key' => $key, 'code' => 'ru'],
                ['value' => $ru]
            );

            Lang::updateOrCreate(
                ['key' => $key, 'code' => 'uz'],
                ['value' => $uz]
            );

            Lang::updateOrCreate(
                ['key' => $key, 'code' => 'en'],
                ['value' => $en]
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
