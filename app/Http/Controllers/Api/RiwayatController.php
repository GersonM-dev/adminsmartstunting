<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        return Riwayat::with('anak')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'timestamp' => 'required|date',
            'status_stunting' => 'nullable|string',
            'status_underweight' => 'nullable|string',
            'status_wasting' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
        ]);

        $riwayat = Riwayat::create($validated);
        return response()->json($riwayat, 201);
    }

    public function show($id)
    {
        $riwayat = Riwayat::with('anak')->findOrFail($id);
        return response()->json($riwayat);
    }

    public function update(Request $request, $id)
    {
        $riwayat = Riwayat::findOrFail($id);

        $validated = $request->validate([
            'timestamp' => 'sometimes|required|date',
            'status_stunting' => 'nullable|string',
            'status_underweight' => 'nullable|string',
            'status_wasting' => 'nullable|string',
            'rekomendasi' => 'nullable|string',
        ]);

        $riwayat->update($validated);
        return response()->json($riwayat);
    }

    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $riwayat->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
