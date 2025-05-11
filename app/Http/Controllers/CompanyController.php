<?php

namespace App\Http\Controllers;

use App\Models\CertificateImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController extends Controller
{
    public function deleteCertificate($locale, $id): \Illuminate\Http\JsonResponse
    {
        $certificate = CertificateImage::findOrFail($id);

        $filePath = public_path('storage/' . $certificate->image_path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $certificate->delete();

        return response()->json(['success' => true, 'message' => 'Сертификат удален']);
    }
}
