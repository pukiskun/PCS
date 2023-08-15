<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Contract\Database;

class DataController extends Controller
{
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
}
