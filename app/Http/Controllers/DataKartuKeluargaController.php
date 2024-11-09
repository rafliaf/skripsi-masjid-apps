<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKartuKeluarga;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Services\DataKartuKeluargaService;



class DataKartuKeluargaController extends Controller
{

    // Method to get the data_masjid based on the logged-in user's masjid_id
    private function getMasjidData($masjidId)
    {
        return DB::table('users')
            ->join('data_masjid', 'users.masjid_id', '=', 'data_masjid.id')
            ->where('users.masjid_id', $masjidId)
            ->select('data_masjid.nama_masjid')
            ->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDataKK()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve only the DataKartuKeluarga that belong to the same masjid_id
        $dataKartuKeluarga = DataKartuKeluarga::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the filtered data to the view
        return view('takmir_masjid.data_kartu_keluarga.family-card', compact('dataKartuKeluarga', 'getData'));
    }


    public function indexAddDataKK()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.data_kartu_keluarga.add-family-card', compact('getData'));
    }

    public function addDataKK(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nomor_kk' => 'required|unique:data_kartu_keluarga,nomor_kk|max:255|min:3',
            'no_rt' => 'required|max:255',
            'nama_kepala_keluarga' => 'required|max:255',
            'kode_rumah' => 'required|unique:data_kartu_keluarga,kode_rumah|max:255',
            'level_ekonomi' => 'required',
            'jumlah_anggota_keluarga' => 'required|integer',
            'no_wa' => 'required|max:15',
            'keterangan' => 'nullable|max:255'
        ]);

        // Add the authenticated user's masjid_id
        $validatedData['masjid_id'] = Auth::user()->masjid_id;

        // Create the new DataKartuKeluarga record
        DataKartuKeluarga::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('data_kk.index')->with('success', 'Data Kartu Keluarga berhasil disimpan!');
    }


    public function indexEditDataKK($id)
    {
        // Fetch the specific kartu keluarga record by ID
        $dataKartuKeluarga = DataKartuKeluarga::findOrFail($id);

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the data to the view
        return view('takmir_masjid.data_kartu_keluarga.edit-family-card', compact('dataKartuKeluarga', 'getData'));
    }


    public function editDataKK(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nomor_kk' => 'required|max:255|min:3',
            'no_rt' => 'required|max:255',
            'nama_kepala_keluarga' => 'required|max:255',
            'kode_rumah' => 'required|max:255',
            'level_ekonomi' => 'required',
            'jumlah_anggota_keluarga' => 'required|integer',
            'no_wa' => 'required|max:15',
            'keterangan' => 'nullable|max:255'
        ]);

        // Find the specific kartu keluarga record and update it
        $data = DataKartuKeluarga::findOrFail($id);
        $data->update($validatedData);

        // Redirect to a success page or the list of data
        return redirect()->route('data_kk.index')->with('success', 'Data Kartu Keluarga berhasil diperbarui!');
    }

    public function deleteData($id)
    {
        // Find the record by ID and delete it
        $data = DataKartuKeluarga::findOrFail($id);
        $data->delete();

        // Redirect with a success message
        return redirect()->route('data_kk.index')->with('success', 'Data Kartu Keluarga berhasil dihapus.');
    }
}
