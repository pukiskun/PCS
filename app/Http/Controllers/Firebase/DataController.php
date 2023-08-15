<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.create', ['pageTitle' => $pageTitle]);
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

    public function edit(Request $id)
    {
        $pageTitle = 'Edit';
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getchild($key)->getValue();
        if($editdata)
        {
            return view('firebase.edit', ['pageTitle' => $pageTitle]);
        }
        else
        {
            return redirect('data')->with('status', 'ID Data Tidak Ditemukan');
        }
    }
}
