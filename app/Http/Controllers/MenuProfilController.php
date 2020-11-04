<?php

namespace App\Http\Controllers;

use App\MenuProfil;
use Illuminate\Http\Request;
use Redirect, Response;

class MenuProfilController extends Controller
{
    public function index()
    {
        $data = MenuProfil::paginate(10);
        return view('admin.menu_profil.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate([
            'nama_menu' => 'required|unique:menu_profil',
            'icon' => 'required',
            'link' => 'required'
        ], $messages);
        $insert = MenuProfil::create($request->all());
        Response::json($insert);
        return redirect('menu_profil')->with('message', 'Data Berhasil ditambahkan');
    }

    public function update(Request $request, MenuProfil $menuProfil)
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => 'kolom :attribute sudah ada!'
        ];
        $request->validate([
            'nama_menu' => 'required',
            'icon' => 'required',
            'link' => 'required'
        ], $messages);

        $update = MenuProfil::where('id', $menuProfil->id)
            ->update([
                'nama_menu' => $request->nama_menu,
                'icon' => $request->icon,
                'link' => $request->link
            ]);
        Response::json($update);
        return Redirect::back()->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(MenuProfil $menuProfil)
    {
        $delete = MenuProfil::destroy($menuProfil->id);
        Response::json($delete);
        return redirect('menu_profil')->with('message', 'Data Berhasil dihapus');
    }
}
