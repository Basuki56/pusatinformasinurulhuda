<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;
use App\Traits\ApiResponse;

class DokumenController extends Controller
{
    use ApiResponse;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_dokumen' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'required|file',
        ]);

        $filePath = $request->file('file')->store('dokumen', 'public');

        $dokumen = Dokumen::create([
            'judul_dokumen' => $validated['judul_dokumen'],
            'deskripsi' => $validated['deskripsi'],
            'file_url' => $filePath,
            'tanggal_upload' => now()->toDateString(),
            'id_user' => auth()->user()->id_user,
        ]);

        return $this->successResponse($dokumen, 'Dokumen uploaded');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);
        if (!$dokumen) {
            return $this->errorResponse('Dokumen not found', 404);
        }

        // Optional: delete file from storage
        if ($dokumen->file_url && Storage::disk('public')->exists($dokumen->file_url)) {
            Storage::disk('public')->delete($dokumen->file_url);
        }

        $dokumen->delete();
        return $this->successResponse(null, 'Dokumen deleted');
    }
}
