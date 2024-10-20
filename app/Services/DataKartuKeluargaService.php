<?php 

namespace App\Services;
use App\Models\DataKartuKeluarga;
use Illuminate\Support\Facades\Auth;

class DataKartuKeluargaService
{
    public function getDataKartuKeluargaByMasjidId()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve only the DataKartuKeluarga that belong to the same masjid_id
        return DataKartuKeluarga::where('masjid_id', $masjidId)->get();
    }
}