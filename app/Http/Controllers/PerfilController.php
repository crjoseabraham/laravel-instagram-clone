<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:16', 'not_in:editar-perfil']
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagePath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagePath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
