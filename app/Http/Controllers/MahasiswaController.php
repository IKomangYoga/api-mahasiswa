<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class MahasiswaController extends Controller
{
    public function getMahasiswa(){
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa);
    }

    public function tambahData(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required','max:255'],
            'email' => ['required', 'email'],
            'jurusan' => ['required','max:255']
        ]);

        $mahasiswa = Mahasiswa::create($validated);

        return response()->json([
            'data' => $mahasiswa
        ],201);
    }

    public function updateData(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['sometimes','required', 'string', 'max:255'],
            'email' => ['sometimes','required', 'email', 'max:255', 'unique:users,email,'.$mahasiswa->email],
            'jurusan' => ['sometimes','required', 'string']
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            'data' => $mahasiswa],200);
    }
}
