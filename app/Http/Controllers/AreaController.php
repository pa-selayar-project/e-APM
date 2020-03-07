<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use Redirect, Response;

class AreaController extends Controller
{
    
    public function index()
    {
        $data = Area::paginate(10);
        return view('area.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $insert = Area::create($this->validasiRequest());
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Berhasil ditambahkan');
    }
    
    public function update(Request $request, Area $area)
    {
        $area->update($this->validasiRequest());
        Response::json($area);
        return Redirect::back()->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(Area $area)
    {
        $delete = Area::destroy($area->id);
        Response::json($delete);
        return Redirect::back()->with('message', 'Data Berhasil dihapus');
    }

    private function validasiRequest()
    {
        $message = ['required' => ':attribute harus diisi'];
        return request()->validate([
            'nama_area' => 'required'
        ], $message);
    }
}
