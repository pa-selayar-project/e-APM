<?php

namespace App\Http\Controllers;

use Auth;
use App\Users;
use App\Profil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Redirect, Response;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('profil.index', ['data' => $data]);
    }

    public function update(Request $request, Profil $profil)
    {
        if($profil->image != 'no_user_avatar.png'){
            Storage::delete('images/' . $profil->image);
        }

        $profil->update($this->validasiRequest());
        $this->storeFile($request, $profil);
        Response::json($profil);
        return Redirect::back()->with('message', 'File Berhasil diupload');
    }

    private function validasiRequest()
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => ':attribute sudah ada dalam database'
        ];

        return tap(
            request()->validate([
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email'
            ], $messages),
            function () {
                $messages2 = ['file' => 'Harus berbentuk file image', 'mimes' => 'Tipe file harus JPG/JPEG/PNG'];
                if (request()->hasFile('image')) {
                    request()->validate([
                        'image' => 'file|max:1000|mimes:jpg,png,jpeg,bmp'
                    ], $messages2);
                }
            }
        );
    }

    private function storeFile($request, $profil)
    {
        if (request()->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $destination = 'assets/images';
            $filename = 'avatar_' . uniqid() . '.' . $ext;
            $file->move($destination, $filename);

            $profil->update([
                'image' => $filename
            ]);
        }
    }
}
