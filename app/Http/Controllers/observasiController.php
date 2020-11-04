<?php

namespace App\Http\Controllers;

use App\Observasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, Response;

class observasiController extends Controller
{
    public function index()
    {
        $data = Observasi::paginate(10);
        return view('admin/observasi/kriteria/index', ['data' => $data]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $insert = Observasi::create($this->validasiRequest());
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $data = Observasi::where('id', $id)->update($this->validasiRequest());
        Response::json($data);
        return Redirect::back()->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(Observasi $observasi, $id)
    {
        $delete = Observasi::where('id', $id)->first();
        $delete = Observasi::destroy($delete->id);
        Response::json($delete);
        return Redirect::back()->with('message', 'Data Observasi Berhasil dihapus');
    }

    private function validasiRequest()
    {
        $message = [
            'required' => 'Kolom ini harus diisi!',
        ];
        
        return request()->validate([
            'kriteria' => 'required',
            'skor' => 'integer'
        ], $message);
    }
}
