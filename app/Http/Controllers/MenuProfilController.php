<?php

namespace App\Http\Controllers;

use App\MenuProfil;
use Illuminate\Http\Request;
use Redirect, Response;

class MenuProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MenuProfil::paginate(10);
        return view('menu_profil.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuProfil  $menuProfil
     * @return \Illuminate\Http\Response
     */
    public function show(MenuProfil $menuProfil)
    {
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuProfil  $menuProfil
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuProfil $menuProfil)
    {
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuProfil  $menuProfil
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuProfil  $menuProfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuProfil $menuProfil)
    {
        $delete = MenuProfil::destroy($menuProfil->id);
        Response::json($delete);
        return redirect('menu_profil')->with('message', 'Data Berhasil dihapus');
    }
}
