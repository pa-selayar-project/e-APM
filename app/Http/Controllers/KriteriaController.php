<?php

namespace App\Http\Controllers;

use App\Kriteria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, Response;

class KriteriaController extends Controller
{
    public function index()
    {
        $data = Kriteria::paginate(10);
        return view('admin/apm/kriteria/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $kriteria = Kriteria::create($this->validasiRequest('create'));
        Response::json($kriteria);
        return redirect('kriteria')->with('message', 'Data Berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::where('id', $id)->update($this->validasiRequest('update'));
        Response::json($kriteria);
        return redirect('admin/apm/kriteria')->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(Request $request, $id)
    {
        $delete = Kriteria::destroy($id);
        Response::json($delete);
        return redirect('kriteria')->with('message', 'Data Kriteria Berhasil dihapus');
    }

    private function validasiRequest($tipe)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute Sudah ada dalam database'
        ];
        if ($tipe == 'create') {
            $rule = 'required|unique:kriterias';
        } else {
            $rule = 'required';
        }
        return request()->validate(['nama_kriteria' => $rule], $message);
    }
}
