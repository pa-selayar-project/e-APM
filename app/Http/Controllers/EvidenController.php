<?php

namespace App\Http\Controllers;

use Auth;
use App\Eviden;
use App\Area;
use App\Kriteria;
use App\Assesmen;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class EvidenController extends Controller
{
    public function index()
    {
        $data = Eviden::paginate(10);
        $area = Area::all();
        $kriteria = Kriteria::all();
        return view('admin/apm/eviden/index', [
            'data' => $data,
            'area' => $area,
            'kriteria' => $kriteria
        ]);
    }

    public function store(Request $request)
    {
        $insert = Eviden::create($this->validasiRequest('create'));
        $this->storeFile($request, $insert);
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Eviden Berhasil ditambahkan');
    }

    public function update(Request $request, Eviden $eviden)
    {
        Storage::delete($eviden->file_upload);
        $eviden->update($this->validasiRequest('update'));
        $this->storeFile($request, $eviden);
        Response::json($eviden);
        return Redirect::back()->with('message', 'Data Eviden Berhasil dirubah');
    }

    public function destroy(Eviden $eviden)
    {
        $delete = Eviden::destroy($eviden->id);
        Response::json($delete);
        return Redirect::back()->with('message', 'Data Eviden Berhasil dihapus');
    }

    public function apm()
    {
        $data = Kriteria::paginate(10);
        if(Auth::user()->level_user == 1){
            return view('admin/apm/lke/apm', ['data'=>$data]);
        }elseif (Auth::user()->level_user == 3) {
            return view('assesor/apm/kriteria', ['data'=>$data]);
        }
    }
    
    public function kriteria_apm($id)
    {
        $kriteria = [];
        $kriteria = Kriteria::where('id', $id)->first();
        
        $data = Assesmen::where('kriteria', $kriteria->nama_kriteria)->paginate(10);
        if(Auth::user()->level_user == 1){
            return view('admin/apm/lke/kriteria_apm', ['data'=>$data]);
        }elseif (Auth::user()->level_user == 3) {
            return view('assesor/apm/kriteria_apm', ['data'=>$data]);
        }
    }

    public function get_data($id)
    {
        $data = Eviden::where('id', $id)->first();
        return url('assets/pdf/'.$data->file_upload);        
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
        Excel::import(new \App\Imports\evidenImport, $request->file('imported'));
        return redirect('admin/apm/eviden')->with('message', 'Data Eviden Berhasil diimport');
    }

    private function validasiRequest($tipe)
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => ':attribute sudah ada dalam database'
        ];

        if ($tipe == 'create') {
            $rule = 'required|unique:evidens';
        } else {
            $rule = 'required';
        }

        return tap(
            request()->validate([
                'nama_eviden' => $rule,
                'area_id' => 'required',
                'kriteria_id' => 'required',
                'nomor_urut' => 'required'
            ], $messages),
            function () {
                $messages2 = [
                    'file' => ':attribute harus berbentuk file PDF',
                    'max' => ':attribute tidak boleh lebih dari 30 MB',
                    'mimes' => ':attribute harus berbentuk pdf'
                ];
                if (request()->hasFile('file_upload')) {
                    request()->validate([
                        'file_upload' => 'file|max:30000|mimes:pdf'
                    ], $messages2);
                }
            }
        );
    }

    private function storeFile($request, $update)
    {
        if (request()->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $ext = $file->getClientOriginalExtension();
            $destination = 'assets/pdf';
            $filename = 'Eviden_' . uniqid() . '.' . $ext;
            $file->move($destination, $filename);

            $update->update([
                'file_upload' => $filename
            ]);
        }
    }
}
