<?php

namespace App\Http\Controllers\Firebase;

use BaconQrCode\Encoder\AlphaNumeric;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use BaconQrCode\Renderer\Image\Png;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Kreait\Firebase\Contract\Database;

class DataController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'data';
    }
    public function index()
    {
        $fdata = $this->database->getReference($this->tablename)->getValue();
        $pageTitle = 'data';
        return view('firebase.index', ['pageTitle' => $pageTitle, 'fdata' => $fdata]);
    }

    public function show($id)
    {
        $pageTitle = 'detail';

        // Replace 'Your QR code data here' with the actual data
        $data = 'Your QR code data here';

        // Create a QR code encoder
        $encoder = new QrCode($data);

        // Create a PNG renderer
        $renderer = new Png();
        $renderer->setWidth(200); // Adjust the width as needed
        $renderer->setHeight(200); // Adjust the height as needed

        // Render the QR code as a PNG image
        $png = $renderer->render($encoder);

        // Render the 'firebase.show' view and pass data to it
        return View::make('firebase.show', compact('pageTitle', 'png', 'id'));

    }

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.create', ['pageTitle' => $pageTitle]);
    }

    public function store(Request $request)
    {
        if ($request->keterangan == 'box') {
            $temp = 'box-';
        } else {
            $temp = 'esa-';
        }
        $postData = [
            'id' => $temp . $request->id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if ($postRef) {
            return redirect('data')->with('status', 'Data Berhasil Ditambahkan');
        } else {
            return redirect('firebase.index')->with('status', 'Data Tidak Berhasil Ditambahkan');
        }
    }

    public function destroy($id)
    {
        $key = $id;
        $deleted = $this->database->getReference($this->tablename . '/' . $key)->remove();
        if ($deleted) {
            return redirect('data');
        }
    }

    public function edit($id)
    {
        $pageTitle = 'edit';
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if ($editdata) {
            return view('firebase.edit', ['pageTitle' => $pageTitle, 'editdata' => $editdata, 'key' => $key]);
        } else {
            return view('data');
        }
    }

    public function update(Request $request, $id)
    {
        $key = $id;
        $updateData = [
            'id' => $request->id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ];
        $res_updated = $this->database->getReference($this->tablename . '/' . $key)->update($updateData);
        if ($res_updated) {
            return redirect('data')->with('status', 'Data Berhasil Diperbarui');
        } else {
            return redirect('data')->with('status', 'Data Tidak Berhasil Diperbarui');
        }
    }

    public function generatePDF($id)
    {
        $pageTitle = 'download';
        $data = QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string');

        $pdf = PDF::loadview('firebase.show', ['code' => $data, 'key' => $id, 'pageTitle' => $pageTitle]);

        return $pdf->stream();
    }
}