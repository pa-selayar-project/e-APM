<?php

namespace App\Http\Controllers;

use App\Assesmen;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class AssesmenController extends Controller
{
    public function index()
    {
        $data = Assesmen::paginate(10);
        return view('assesmen.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $insert = Assesmen::create($this->validasiRequest('create'));
        Response::json($insert);
        return redirect('assesmen')->with('messages', 'Data Assesmen Berhasil ditambahkan');
    }

    public function update(Request $request, Assesmen $assesmen)
    {
        $assesmen->update($this->validasiRequest('update'));
        Response::json($assesmen);
        return Redirect::back()->with('message', 'Data Assesmen Berhasil dirubah');
    }

    public function destroy(Assesmen $assesmen)
    {
        $delete = Assesmen::destroy($assesmen->id);
        Response::json($delete);
        return Redirect::back()->with('message', 'Data Assesmen Berhasil dihapus');
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
        Excel::import(new \App\Imports\assesmenImport, $request->file('imported'));
        return redirect('assesmen')->with('message', 'Data Assesmen Berhasil diimport');
    }

    private function validasiRequest($tipe)
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => ':attribute sudah ada dalam database'
        ];

        if ($tipe == 'create') {
            $rule = 'required|unique:assesmens';
        } else {
            $rule = 'required';
        }

        return request()->validate([
            'nomor' => $rule,
            'area' => 'required',
            'kriteria' => 'required',
        ], $messages);
    }
}
