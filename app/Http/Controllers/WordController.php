<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use NumberFormatter;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\PDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;


class WordController extends Controller
{
    // Membuat objek NumberFormatter untuk bahasa Indonesia
    private $formatter;
    public function __construct() {
        $this->formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
    }
    /**
     * Menghasilkan dokumen DOCX atau PDF berdasarkan permintaan pengguna.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(Request $request)
    {
        // Script PHPOffice
        // Creating the new document...
        $phpWord = new TemplateProcessor('BeritaAcaraPenyelesaianPekerjaan(GedungAgroLantai2).docx');
        // Variabel untuk menampilkan nama bulan dalam bahasa Indonesia
        $monthLabels = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Variabel untuk menampilkan nama hari dalam bahasa Indonesia
        $dayLabels = [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        ];
        $date = Carbon::parse($request->input('date'));
        $intDay = $date->day;
        $intMonth = $date->month;
        $year = $date->year; // Mengambil tahun (misalnya, 2023)
        $month = $monthLabels[$date->month];// Mengambil bulan (misalnya, Juli)
        $day = $dayLabels[$date->dayOfWeek];// Mengambil hari (misalnya, Selasa)
        $tahun = $this->formatter->format($year);
        $tahunProper = mb_convert_case($tahun, MB_CASE_TITLE, 'UTF-8');
        
        if ($request->input('format') === 'docx') {
            $phpWord->setValues([
            'tahun' => $year,
            'nama_hari' => $day,
            'tanggal' => $intDay,
            'nama_bulan' => $month,
            'ejaan_tahun' => $tahunProper,
            'dd' => $intDay,
            'mm' => $intMonth,
            'yyyy' => $year,
            'kegiatan' => $request->input('kegiatan'),
            'gedung' => $request->input('gedung'),
            'institut' => $request->input('institut'),
            'nomor_surat' => $request->input('nomor_surat'),
            'perihal' => $request->input('perihal'),
            'keterangan' => $request->input('keterangan'),
            'keterangan_tambahan' => $request->input('keterangan_tambahan'),
            'jabatan1' => $request->input('jabatan1'),
            'jabatan2' => $request->input('jabatan2'),
            'ruangan' => $request->input('ruangan'),
            'kota' => $request->input('kota'),
            'dd-MM-yyyy' => $intDay. ' ' .$month. ' ' .$year,
            'namadangelar1' => $request->input('nama_gelar1'),
            'namadangelar2' => $request->input('nama_gelar2'),
            'nip1' => $request->input('nip1'),
            'nip2' => $request->input('nip2'),
        ]);
        $docxFilePath = "Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.docx";
        $phpWord->saveAs($docxFilePath);
        return response()->json([
            'status' => 'success',
            'file' => $docxFilePath,
            'url' => route('berita_penyelesaian.index')
        ],200);
        }elseif ($request->input('format') === 'pdf') {
            $phpWord = new TemplateProcessor('BeritaAcaraPenyelesaianPekerjaan(GedungAgroLantai2).docx');
            $phpWord->setValues([
                'tahun' => $year,
                'nama_hari' => $day,
                'tanggal' => $intDay,
                'nama_bulan' => $month,
                'ejaan_tahun' => $tahunProper,
                'dd' => $intDay,
                'mm' => $intMonth,
                'yyyy' => $year,
                'kegiatan' => $request->input('kegiatan'),
                'gedung' => $request->input('gedung'),
                'institut' => $request->input('institut'),
                'nomor_surat' => $request->input('nomor_surat'),
                'perihal' => $request->input('perihal'),
                'keterangan' => $request->input('keterangan'),
                'keterangan_tambahan' => $request->input('keterangan_tambahan'),
                'jabatan1' => $request->input('jabatan1'),
                'jabatan2' => $request->input('jabatan2'),
                'ruangan' => $request->input('ruangan'),
                'kota' => $request->input('kota'),
                'dd-MM-yyyy' => $intDay. ' ' .$month. ' ' .$year,
                'namadangelar1' => $request->input('nama_gelar1'),
                'namadangelar2' => $request->input('nama_gelar2'),
                'nip1' => $request->input('nip1'),
                'nip2' => $request->input('nip2'),
            ]);

            $tempWordFilePath = "Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung_temp') . "'.docx";
            $phpWord->saveAs($tempWordFilePath);
            $document = IOFactory::load($tempWordFilePath);

            $pdfWriter = IOFactory::createWriter($document, 'PDF');
            $pdfWriter->save("Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung_temp') . "'.pdf");

            // Load the filled template as HTML content
            // $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempWordFilePath, 'Word2007');
            // $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            // $htmlWriter->save($htmlFilePath);


        // $phpWord->saveAs("Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.docx");
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Success',
        //     'url' => route('berita_penyelesaian.index')
        // ],200);
        /* Note: we skip RTF, because it's not XML-based and requires a different example. */
        /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }

    }
}
