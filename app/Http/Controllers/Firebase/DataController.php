<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $pageTitle = 'Data';
        return view('firebase.data.index', ['pageTitle' => $pageTitle]);
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
}
