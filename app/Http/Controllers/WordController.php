<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use NumberFormatter;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;


class WordController extends Controller
{
    // Membuat objek NumberFormatter untuk bahasa Indonesia
    private $formatter;
    public function __construct() {
        $this->formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
    }
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
        
        /* Note: any element you append to a document must reside inside of a Section. */

        // Adding an empty Section to the document...
        
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
        
            $htmlFilePath = "Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.html";
            $pdfFilePath = "Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.pdf";

            // $phpWord = new PhpWord();
        
            // $phpWord = IOFactory::createWriter($phpWord, 'HTML');
            $tempWordFilePath = "BeritaAcaraPenyelesaianPekerjaan(GedungAgroLantai2)_temp.docx";
            $phpWord->saveAs($tempWordFilePath);

            // Load the filled template as HTML content
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempWordFilePath, 'Word2007');
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlWriter->save($htmlFilePath);
        
          

// Instantiate Dompdf
$dompdf = new Dompdf();

 // Load HTML content
 $html = file_get_contents($htmlFilePath);

// Load HTML into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Save PDF file
file_put_contents($pdfFilePath, $dompdf->output());

// Output the generated PDF to Browser
$dompdf->stream();
        
            // file_put_contents(public_path($pdfFilePath), $output);
        
            // Remove the intermediate HTML file
            // if (file_exists($htmlFilePath)) {
            //     unlink($htmlFilePath);
            // }
        
            return response()->json([
                'status' => 'success',
                'file' => $pdfFilePath,
                'url' => route('berita_penyelesaian.index')
            ], 200);
        }
        
        // if fail
        // return response()->json([
        //     'status' => 'fail',
        // ]);

        /*
        * Note: it's possible to customize font style of the Text element you add in three ways:
        * - inline;
        * - using named font style (new font style object will be implicitly created);
        * - using explicitly created font style object.
        */

        // Adding Text element with font customized inline...

        // $phpWord->saveAs("Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.docx");
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Success',
        //     'url' => route('berita_penyelesaian.index')
        // ],200);
        /* Note: we skip RTF, because it's not XML-based and requires a different example. */
        /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }

    public function convertPDF(Request $request)
    {
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
            $phpWord->saveAs($docxFilePath);
        }
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($docxFilePath);
        $sections = $phpWord->getSections();
        foreach($sections as $section) 
        {
            $html = \PhpOffice\PhpWord\Shared\Html::getContent($section);
            /**
            *$html: The HTML content to be written to the PDF document.
            *true: A boolean value that indicates whether to use TCPDF's internal CSS parser to parse the HTML content. If set to true, TCPDF will parse the CSS styles and apply them to the PDF document. If set to false, TCPDF will ignore the CSS styles.
            *false: A boolean value that indicates whether to use TCPDF's internal HTML parser to parse the HTML content. If set to true, TCPDF will parse the HTML tags and convert them to PDF elements. If set to false, TCPDF will treat the HTML content as plain text.
            *true: A boolean value that indicates whether to enable the automatic page break feature. If set to true, TCPDF will automatically break the page when the content exceeds the page height.
            *false: A boolean value that indicates whether to enable the background color feature. If set to true, TCPDF will fill the background of the PDF document with the specified color.
            *'': An optional parameter that specifies the character set encoding of the HTML content. If not specified, TCPDF will use the default encoding.
             */
            $pdfFilePath = "Berita Acara Penyelesaian Pekerjaan '" . $request->input('gedung') . "'.pdf";
            $pdf->writeHTML($html, true, false, true, false, ''); //preserving the formatting and layout of the original HTML content
            $pdf->Output($pdfFilePath, 'I');
        }
    }
}
