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
        return view('firebase.data.index', ['pageTitle' => $pageTitle, 'fdata' => $fdata]);
    }

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.data.create', ['pageTitle' => $pageTitle]);
    }

    public function store()
    {
        $postData = [
            id => $request->input('ID'),
            name => $request->input('Nama'),
            detail => $request->input('Keterangan'),
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if($postRef)
        {
            return redirect('index')->with('status', 'Data Berhasil Ditambahkan');
        }
        else
        {
            return redirect('index')->with('status', 'Data Tidak Berhasil Ditambahkan');
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
