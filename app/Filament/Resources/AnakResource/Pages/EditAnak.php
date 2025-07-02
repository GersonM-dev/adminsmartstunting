<?php

namespace App\Filament\Resources\AnakResource\Pages;

use Filament\Actions;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Http;
use App\Filament\Resources\AnakResource;
use Filament\Resources\Pages\EditRecord;

class EditAnak extends EditRecord
{
    protected static string $resource = AnakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $anak = $this->record;

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
    }
}
