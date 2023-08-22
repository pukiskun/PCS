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
        return view('firebase.index', ['pageTitle' => $pageTitle, 'fdata' => $fdata]);
    }

    public function show($id)
    {
        $pageTitle = 'detail';

        $tablename = $this->tablename;
        $itemKey = $id;
        $columnToRetrieve = 'id';


        $data = $this->database->getReference($tablename . '/' . $itemKey . '/' . $columnToRetrieve)->getValue();

        $code = QrCode::format('svg')->size(200)->errorCorrection('H')->generate($data);
        return view('firebase.show', ['pageTitle' => $pageTitle, 'code' => $code, 'key' => $id]);



    }

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.create', ['pageTitle' => $pageTitle]);
    }

    public function store(Request $request)
    {
        if ($request->keterangan == 'box') {
            $temp = 'box';
        } else {
            $temp = 'esa';
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


}
