<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Http\Request;
use App\Exports\LangsExport;
use App\Imports\LangsImport;
use Maatwebsite\Excel\Facades\Excel;


class LangAdminController extends Controller
{

    public function index()
    {
        return view('admin.langs.lang');
    }

    public function export()
    {

        $data = Lang::select('langs.key')
            ->selectRaw('MAX(lr.value) as ru')
            ->selectRaw('MAX(lu.value) as uz')
            ->selectRaw('MAX(le.value) as en')
            ->leftJoin('langs as lr', function ($join) {
                $join->on('lr.key', '=', 'langs.key')->where('lr.code', '=', 'ru');
            })
            ->leftJoin('langs as lu', function ($join) {
                $join->on('lu.key', '=', 'langs.key')->where('lu.code', '=', 'uz');
            })
            ->leftJoin('langs as le', function ($join) {
                $join->on('le.key', '=', 'langs.key')->where('le.code', '=', 'en');
            })
            ->groupBy('langs.key')
            ->orderBy('langs.key', 'asc')
            ->get()->toArray();

        $cats = [];
        foreach($data as $key => $item) {
            $cats[$key]['column1'] = $item['key'];
            $cats[$key]['column2'] = $item['ru'];
            $cats[$key]['column3'] = $item['uz'];
            $cats[$key]['column4'] = $item['en'];
        }

        $data = collect($cats);
        return Excel::download(new LangsExport($data), 'euca_language.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        $extension = $file?->getClientOriginalExtension();

        if ($extension == 'xlsx') {

            Excel::import(new LangsImport, $file);

            return redirect(route('lang_admin'))->with('success', 'Данные успешно импортированы.');
        }

        return redirect(route('lang_admin'))->with('error', 'Неверный формат файла. Ожидался файл с расширением .xlsx.');
    }


}
