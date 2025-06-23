<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Traits\ApiResponse;

class KegiatanController extends Controller
{
    use ApiResponse;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tanggal' => $validated['tanggal'],
            'lokasi' => $validated['lokasi'],
            'deskripsi' => $validated['deskripsi'],
            'id_user' => auth()->user()->id_user,
        ]);

        return $this->successResponse($kegiatan, 'Kegiatan created');
    }
}
