<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Contract\Database;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        return view('firebase.data.index', ['pageTitle' => $pageTitle, 'fdata' => $fdata]);
    }

    public function show($id)
    {
        $pageTitle = 'detail';
        $code = QrCode::generate($id);
        return view('firebase.data.show', ['pageTitle' => $pageTitle, 'code' => $code]);


    }

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.data.create', ['pageTitle' => $pageTitle]);
    }

    public function store(Request $request)
    {
        $postData = [
            'id' => $request->id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if ($postRef) {
            return redirect('data')->with('status', 'Data Berhasil Ditambahkan');
        } else {
            return redirect('firebase.data.index')->with('status', 'Data Tidak Berhasil Ditambahkan');
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
}