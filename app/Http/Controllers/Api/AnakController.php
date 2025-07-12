<?php

namespace App\Http\Controllers\Api;

use App\Models\Anak;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AnakController extends Controller
{
    public function index()
    {
        return Anak::with('user', 'riwayats')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur_bulan' => 'required|integer',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'kecamatan' => 'nullable|string',
            'jumlah_vit_a' => 'nullable|integer',
            'pendidikan_ayah' => 'nullable|string',
            'pendidikan_ibu' => 'nullable|string',
            'status_gizi' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
        ]);

        $anak = Anak::create($validated);

        // 🔁 After Create Logic
        $payload = [
            'nama' => $anak->nama,
            'jenis_kelamin' => $anak->jenis_kelamin,
            'umur_bulan' => $anak->umur_bulan,
            'berat' => $anak->berat,
            'tinggi' => $anak->tinggi,
            'lingkar_lengan' => $anak->lingkar_lengan,
            'lingkar_kepala' => $anak->lingkar_kepala,
            'kecamatan' => $anak->kecamatan,
            'jumlah_vit_a' => $anak->jumlah_vit_a,
            'pendidikan_ibu' => $anak->pendidikan_ibu,
            'pendidikan_ayah' => $anak->pendidikan_ayah,
        ];

        $response = Http::post('https://n8n.dfxx.site/webhook/post-data', $payload);

        if ($response->ok()) {
            $data = $response->json();

            Riwayat::create([
                'anak_id' => $anak->id,
                'timestamp' => now(),
                'status_stunting' => $data['status_stunting'] ?? null,
                'status_underweight' => $data['status_underweight'] ?? null,
                'status_wasting' => $data['status_wasting'] ?? null,
                'rekomendasi' => $data['response'] ?? null,
            ]);
        }

        return response()->json($anak, 201);
    }
    public function show($id)
    {
        $anak = Anak::with('user', 'riwayats')->findOrFail($id);
        return response()->json($anak);
    }

    public function update(Request $request, $id)
    {
        $anak = Anak::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string',
            'jenis_kelamin' => 'sometimes|required|in:Laki-laki,Perempuan',
            'umur_bulan' => 'sometimes|required|integer',
            'berat' => 'sometimes|required|numeric',
            'tinggi' => 'sometimes|required|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'kecamatan' => 'nullable|string',
            'jumlah_vit_a' => 'nullable|integer',
            'pendidikan_ayah' => 'nullable|string',
            'pendidikan_ibu' => 'nullable|string',
            'status_gizi' => 'nullable|string',
            'tanggal_lahir' => 'sometimes|required|date',
        ]);

        $anak->update($validated);

        // 🔁 After Update Logic (same as afterCreate)
        $payload = [
            'nama' => $anak->nama,
            'jenis_kelamin' => $anak->jenis_kelamin,
            'umur_bulan' => $anak->umur_bulan,
            'berat' => $anak->berat,
            'tinggi' => $anak->tinggi,
            'lingkar_lengan' => $anak->lingkar_lengan,
            'lingkar_kepala' => $anak->lingkar_kepala,
            'kecamatan' => $anak->kecamatan,
            'jumlah_vit_a' => $anak->jumlah_vit_a,
            'pendidikan_ibu' => $anak->pendidikan_ibu,
            'pendidikan_ayah' => $anak->pendidikan_ayah,
        ];

        $response = Http::post('https://n8n.dfxx.site/webhook/post-data', $payload);

        if ($response->ok()) {
            $data = $response->json();

            Riwayat::create([
                'anak_id' => $anak->id,
                'timestamp' => now(),
                'status_stunting' => $data['status_stunting'] ?? null,
                'status_underweight' => $data['status_underweight'] ?? null,
                'status_wasting' => $data['status_wasting'] ?? null,
                'rekomendasi' => $data['response'] ?? null,
            ]);
        }

        return response()->json($anak);
    }
    public function destroy($id)
    {
        $anak = Anak::findOrFail($id);
        $anak->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}

