<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Kreait\Firebase\Contract\Database;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    //
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'data';
    }
    public function generatePDF($id)
    {
        $pageTitle = 'download';

        $tablename = $this->tablename;
        $itemKey = $id;
        $columnToRetrieve = 'id';


        $data = $this->database->getReference($tablename . '/' . $itemKey . '/' . $columnToRetrieve)->getValue();

        $data = QrCode::format('svg')->size(200)->errorCorrection('H')->generate($data);

        $pdf = PDF::loadview('firebase.show', ['code' => $data, 'key' => $id, 'pageTitle' => $pageTitle]);

        return $pdf->stream();
    }
}
