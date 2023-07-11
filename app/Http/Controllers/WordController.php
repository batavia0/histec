<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class WordController extends Controller
{
    public function index(Request $request)
    {
        // Script PHPOffice
        // Creating the new document...
        $phpWord = new TemplateProcessor();

        /* Note: any element you append to a document must reside inside of a Section. */

        // Adding an empty Section to the document...
        $section = $phpWord->addSection('BeritaAcaraPenyelesaianPekerjaan(GedungAgroLantai2).docx');
        $phpWord->setValues([
            'nama' => $request->input('tahun'),
        ]);

        /*
        * Note: it's possible to customize font style of the Text element you add in three ways:
        * - inline;
        * - using named font style (new font style object will be implicitly created);
        * - using explicitly created font style object.
        */

        // Adding Text element with font customized inline...
        
        $objWriter->saveAs("Berita Acara Penyelesaian Pekerjaan '.$x'.docx");

        /* Note: we skip RTF, because it's not XML-based and requires a different example. */
        /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    }
}
