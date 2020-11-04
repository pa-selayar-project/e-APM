<?php

namespace App\Http\Controllers;

use App\Observasi;
use App\Lkeobservasi;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, Response;

class LkeobservasiController extends Controller
{
    public function index()
    {
        $data = Lkeobservasi::paginate(10);
        $kriteria = Observasi::all();
        return view('admin/observasi/penilaian/index', [
            'data' => $data,
            'kriteria' =>$kriteria    
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Lkeobservasi $lkeobservasi)
    {
        //
    }

    public function edit(Lkeobservasi $lkeobservasi)
    {
        //
    }

    public function update(Request $request, Lkeobservasi $lkeobservasi, $id)
    {
        $data = Lkeobservasi::where('id', $id)->update($this->validasiRequest());
        Response::json($data);
        return Rcedirect::bak()->with('message', 'Data Penilaian Observasi Berhasil dirubah');
    }

    public function destroy(Lkeobservasi $lkeobservasi, $id)
    {
        $delete = Lkeobservasi::where('id', $id)->first();    
        return $delete;
    }

    private function validasiRequest()
    {
        $message = [
            'required' => 'Kolom :attribute harus diisi!',
            'integer' => 'Kolom :attribute harus angka!',
        ];
        
        return request()->validate([
            'lke_observasi_id' => 'required|integer',
            'penilaian'=> 'required',
            'bobot' => 'integer'
        ], $message);
    }

    public function import(Request $request)
    {
        $request->validate(
            [
                'imported' => 'required|mimes:xls,xlsx'
            ],
            [
                'required' => ':attribute wajib diisi',
                'mimes' => 'File import harus format Excel'
            ]
        );
        Excel::import(new \App\Imports\observasiImport, $request->file('imported'));
        return redirect('admin/observasi/penilaian')->with('message', 'Data Observasi Berhasil diimport');
    }
}
