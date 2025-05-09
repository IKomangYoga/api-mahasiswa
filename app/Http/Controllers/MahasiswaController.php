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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$mahasiswa->email],
            'jurusan' => ['required', 'string']
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            'data' => $mahasiswa],200);
    }

    public function patchData(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,'.$mahasiswa->email],
            'jurusan' => ['sometimes', 'string']
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            'data' => $mahasiswa],200);
    }


    public function deleteData(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->json([
            'data' => ''
      ],203);
    }
}
