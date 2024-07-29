<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class SuratController extends Controller
{
    public function exportPDF(Request $request)
    {
        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set dokumen
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Ambil HTML dari permintaan
        $html = $request->input('html');

        // Tambahkan HTML ke dokumen PDF
        $pdf->writeHTML($html);

        // Mengirimkan PDF sebagai respons
        return response($pdf->Output('exported-content.pdf', 'S'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
