<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;

class SuratController extends Controller
{
    // =========================
    // JENIS SURAT
    // =========================
    public function indexJenisSurat()
    {
        return response()->json(JenisSurat::all(), 200);
    }

    public function showJenisSurat($id)
    {
        $data = JenisSurat::find($id);
        if (!$data) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($data, 200);
    }

    public function storeJenisSurat(Request $request)
    {
        $data = $request->validate([
            'kode_surat' => 'required|string|max:50|unique:jenis_surat,kode_surat',
            'nama_surat' => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
        ]);

        $jenis = JenisSurat::create($data);
        return response()->json($jenis, 201);
    }

    public function updateJenisSurat(Request $request, $id)
    {
        $jenis = JenisSurat::find($id);
        if (!$jenis) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $data = $request->validate([
            'kode_surat' => [
                'required',
                'string',
                'max:50',
                Rule::unique('jenis_surat', 'kode_surat')->ignore($jenis->id),
            ],
            'nama_surat' => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
        ]);

        $jenis->update($data);
        return response()->json($jenis, 200);
    }

    public function destroyJenisSurat($id)
    {
        $jenis = JenisSurat::find($id);
        if (!$jenis) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $jenis->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }

    // =========================
    // PENGAJUAN SURAT
    // =========================
    public function indexPengajuanSurat(Request $request)
    {
        $q = PengajuanSurat::with(['mahasiswa', 'jenisSurat']);

        if ($request->filled('mahasiswa_id')) {
            $q->where('mahasiswa_id', $request->mahasiswa_id);
        }

        return response()->json($q->get(), 200);
    }

    public function showPengajuanSurat($id)
    {
        $data = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])->find($id);
        if (!$data) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($data, 200);
    }

    public function storePengajuanSurat(Request $request)
    {
        $data = $request->validate([
           
            'mahasiswa_id'    => 'required|exists:mahasiswa,id',
            'jenis_surat_id'  => 'required|exists:jenis_surat,id',

            'tgl_pengajuan'   => 'required|date',
            'keterangan_mhs'  => 'nullable|string',
            'status'          => 'nullable|string|max:50',
            'tgl_disetujui'   => 'nullable|date',
            'catatan_admin'   => 'nullable|string',
            'file_surat_path' => 'nullable|string|max:255',
        ]);

        $data['status'] = $data['status'] ?? 'PENDING';
        $pengajuan = PengajuanSurat::create($data);

        $pengajuan = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])->find($pengajuan->id);

        return response()->json($pengajuan, 201);
    }

    public function updatePengajuanSurat(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::find($id);
        if (!$pengajuan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $data = $request->validate([
            'mahasiswa_id'    => 'sometimes|exists:mahasiswa,id',
            'jenis_surat_id'  => 'sometimes|exists:jenis_surat,id',
            'tgl_pengajuan'   => 'sometimes|date',

            'keterangan_mhs'  => 'nullable|string',
            'status'          => 'sometimes|string|max:50',
            'tgl_disetujui'   => 'nullable|date',
            'catatan_admin'   => 'nullable|string',
            'file_surat_path' => 'nullable|string|max:255',
        ]);

        $pengajuan->update($data);

        $pengajuan = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])->find($pengajuan->id);
        return response()->json($pengajuan, 200);
    }

    public function destroyPengajuanSurat($id)
    {
        $pengajuan = PengajuanSurat::find($id);
        if (!$pengajuan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $pengajuan->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }

    // =========================
    // DISETUJUI / DITOLAK
    // =========================
    public function approve(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::find($id);
        if (!$pengajuan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $data = $request->validate([
            'catatan_admin'   => 'nullable|string',
            'file_surat_path' => 'nullable|string|max:255',
        ]);

        $pengajuan->update([
            'status'         => 'DISETUJUI',
            'tgl_disetujui'  => now(),
            'catatan_admin'  => $data['catatan_admin'] ?? null,
            'file_surat_path'=> $data['file_surat_path'] ?? null,
        ]);

        $pengajuan = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])->find($pengajuan->id);
        return response()->json($pengajuan, 200);
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::find($id);
        if (!$pengajuan) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $data = $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        $pengajuan->update([
            'status'        => 'DITOLAK',
            'catatan_admin' => $data['catatan_admin'],
            'tgl_disetujui' => null,
        ]);

        $pengajuan = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])->find($pengajuan->id);
        return response()->json($pengajuan, 200);
    }
}
