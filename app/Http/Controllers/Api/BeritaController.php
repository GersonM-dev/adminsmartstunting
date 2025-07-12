<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        return Berita::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'url' => 'nullable|url',
            'image' => 'nullable|string', // adjust if uploading files
        ]);

        $berita = Berita::create($validated);
        return response()->json($berita, 201);
    }

    public function show($id)
    {
        return Berita::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'url' => 'nullable|url',
            'image' => 'nullable|string',
        ]);

        $berita->update($validated);
        return response()->json($berita);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
