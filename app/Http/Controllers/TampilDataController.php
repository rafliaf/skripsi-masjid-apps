<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use App\Models\DataKartuKeluarga;
use App\Models\DataKeahlian;
use App\Models\MdDataKeahlian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TampilDataController extends Controller
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
        
    // data kk
    public function indexDataKK(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataKartuKeluarga
        $query = DataKartuKeluarga::where('masjid_id', $masjidId);

        // Filter by RT if provided
        if ($request->has('rt') && !empty($request->rt)) {
            $query->where('no_rt', $request->rt);
        }

        // Filter by Jumlah Anggota Keluarga if provided
        if ($request->has('jumlah_anggota') && !empty($request->jumlah_anggota)) {
            if ($request->jumlah_anggota == '1-3') {
                $query->whereBetween('jumlah_anggota_keluarga', [1, 3]);
            } elseif ($request->jumlah_anggota == '4-6') {
                $query->whereBetween('jumlah_anggota_keluarga', [4, 6]);
            } elseif ($request->jumlah_anggota == '7+') {
                $query->where('jumlah_anggota_keluarga', '>=', 7);
            }
        }

        // Filter by Level Ekonomi if provided
        if ($request->has('level_ekonomi') && !empty($request->level_ekonomi)) {
            $query->where('level_ekonomi', $request->level_ekonomi);
        }

        // Execute the query and get the filtered data
        $dataKK = $query->get();

        // Fetch distinct RT values for the current masjid
        $rtValues = DataKartuKeluarga::where('masjid_id', $masjidId)
                    ->distinct()
                    ->pluck('no_rt');

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Pass the filtered data, RT values, and masjid data to the view
        return view('takmir_masjid.tampil_data.tampil_data_kk.tampil-kk', compact('dataKK', 'getData', 'rtValues'));
    }



    // detail data kk
    public function detailDataKK($id)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve the detail data for a specific KK record based on its ID and the masjid_id
        $detailDataKK = DataKartuKeluarga::where('masjid_id', $masjidId)->where('id', $id)->first();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.tampil_data.tampil_data_kk.detail-data-kk', compact('detailDataKK', 'getData'));
    }


    // Data jamaah
    public function indexDataJamaah(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataInduk data
        $query = DataInduk::where('masjid_id', $masjidId);

        // Filter by Status mukim if provided
        if ($request->has('status_mukim') && !empty($request->status_mukim)) {
            $query->where('is_status_mukim', $request->status_mukim);
        }

        // Filter by Remaja masjid if provided
        if ($request->has('remaja_masjid') && !empty($request->remaja_masjid)) {
            $query->where('is_remaja_masjid', $request->remaja_masjid);
        }

        // Filter by Jamaah pengajian if provided
        if ($request->has('jamaah_pengajian') && !empty($request->jamaah_pengajian)) {
            $query->where('is_pengajian_rutin', $request->jamaah_pengajian);
        }

        // Execute the query and get the filtered data
        $dataJamaah = $query->get();

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Return the filtered data to the view
        return view('takmir_masjid.tampil_data.tampil_data_jamaah.tampil-jamaah', compact('dataJamaah', 'getData'));
    }


    // detail data jamaah
    public function detailDataJamaah($id){
        // Retrieve the specific data based on the provided id
        $jamaahData = DataInduk::findOrFail($id);

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the data to the view
        return view('takmir_masjid.tampil_data.tampil_data_jamaah.detail-data-jamaah', compact('jamaahData', 'getData'));
    }

    // Data ibadah
    public function indexDataIbadah(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataInduk data
        $query = DataInduk::where('masjid_id', $masjidId);

        // Filter by Status mukim if provided
        if ($request->has('status_mukim') && !empty($request->status_mukim)) {
            $query->where('is_status_mukim', $request->status_mukim);
        }

        // Filter by Haji if provided
        if ($request->has('haji') && !empty($request->haji)) {
            $query->where('is_haji', $request->haji);
        }

        // Filter by Umrah if provided
        if ($request->has('umrah') && !empty($request->umrah)) {
            $query->where('is_umrah', $request->umrah);
        }

        // Execute the query and get the filtered data
        $dataIbadah = $query->get();

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Return the filtered data to the view
        return view('takmir_masjid.tampil_data.tampil_data_ibadah.tampil-ibadah', compact('dataIbadah', 'getData'));
    }


    // detail data ibadah
    public function detailDataIbadah($id){
        // Retrieve the specific data based on the provided id
        $ibadahData = DataInduk::findOrFail($id);

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.tampil_data.tampil_data_ibadah.detail-data-ibadah', compact('ibadahData', 'getData'));
    }

    // Data keahlian
    public function indexDataKeahlian(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataKeahlian data
        $query = DataKeahlian::where('masjid_id', $masjidId);

        // Filter by Status mukim if provided
        if ($request->has('status_mukim') && !empty($request->status_mukim)) {
            $query->whereHas('dataInduk', function ($q) use ($request) {
                $q->where('is_status_mukim', $request->status_mukim);
            });
        }

        // Filter by Keahlian if provided
        if ($request->has('keahlian') && !empty($request->keahlian)) {
            $query->whereHas('jenisKeahlian', function ($q) use ($request) {
                $q->where('jenis_keahlian', $request->keahlian);
            });
        }

        // Filter by Sertifikat if provided
        if ($request->has('sertifikat') && !empty($request->sertifikat)) {
            $query->where('is_sertifikat', $request->sertifikat);
        }

        // Execute the query and get the filtered data
        $dataKeahlian = $query->get();

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Master data keahlian
        $mdDataKeahlian = MdDataKeahlian::where('masjid_id', $masjidId)->get();

        // Return the filtered data to the view
        return view('takmir_masjid.tampil_data.tampil_data_keahlian.tampil-keahlian', compact('getData', 'dataKeahlian', 'mdDataKeahlian'));
    }


    // detail data keahlian
    public function detailDataKeahlian($id){
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Retrieve the specific DataKeahlian by ID
        $keahlian = DataKeahlian::where('id', $id)->where('masjid_id', $masjidId)->firstOrFail();

        // Pass the data to the view
        return view('takmir_masjid.tampil_data.tampil_data_keahlian.detail-data-keahlian', compact('getData', 'keahlian'));
    }

    // Data pekerjaan
    public function indexDataPekerjaan(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataInduk data
        $query = DataInduk::where('masjid_id', $masjidId);

        // Filter by RT if provided
        if ($request->has('rt') && !empty($request->rt)) {
            $query->whereHas('kartuKeluarga', function ($q) use ($request) {
                $q->where('no_rt', $request->rt);
            });
        }

        // Filter by Pekerjaan if provided
        if ($request->has('pekerjaan') && !empty($request->pekerjaan)) {
            $query->where('pekerjaan', $request->pekerjaan);
        }

        // Filter by Nama if provided
        if ($request->has('nama') && !empty($request->nama)) {
            $query->where('nama_lengkap', $request->nama);
        }

        // Execute the query and get the filtered data
        $dataPekerjaan = $query->get();

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Return the filtered data to the view
        return view('takmir_masjid.tampil_data.tampil_data_pekerjaan.tampil-pekerjaan', compact('getData', 'dataPekerjaan'));
    }



    // detail data pekerjaan
    public function detailDataPekerjaan($id){
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Retrieve the specific DataInduk by ID
        $pekerjaan = DataInduk::where('id', $id)->where('masjid_id', $masjidId)->firstOrFail();

        // Pass the data to the view
        return view('takmir_masjid.tampil_data.tampil_data_pekerjaan.detail-data-pekerjaan', compact('getData', 'pekerjaan'));
    }

    // DATA PENDIDIKAN
    public function indexDataPendidikan(Request $request){
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;
    
        // Start building the query
        $query = DataInduk::where('masjid_id', $masjidId);
    
        // Filter by RT if provided
        if ($request->has('rt') && !empty($request->rt)) {
            $query->whereHas('kartuKeluarga', function ($q) use ($request) {
                $q->where('no_rt', $request->rt);
            });
        }
    
        // Filter by Pendidikan if provided
        if ($request->has('pendidikan') && !empty($request->pendidikan)) {
            $query->where('pendidikan', $request->pendidikan);
        }
    
        // Filter by Nama if provided
        if ($request->has('nama') && !empty($request->nama)) {
            $query->where('nama_lengkap', $request->nama);
        }
    
        // Get the filtered data
        $dataPendidikan = $query->get();
    
        // Get the masjid data
        $getData = $this->getMasjidData($masjidId);
    
        return view('takmir_masjid.tampil_data.tampil_data_Pendidikan.tampil-Pendidikan', compact('getData', 'dataPendidikan'));
    }
    

    public function detailDataPendidikan($id){
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Retrieve the specific DataInduk by ID
        $detailPendidikan = DataInduk::where('id', $id)->where('masjid_id', $masjidId)->firstOrFail();

        return view('takmir_masjid.tampil_data.tampil_data_Pendidikan.detail-data-Pendidikan', compact('getData', 'detailPendidikan'));
    }

    // data kemampuan
    public function indexDataKemampuan(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Start building the query for DataInduk data
        $query = DataInduk::where('masjid_id', $masjidId);

        // Filter by Baca Al-Qur'an if provided
        if ($request->has('baca_quran') && !empty($request->baca_quran)) {
            $query->where('is_baca_quran', $request->baca_quran);
        }

        // Filter by Baca Iqro if provided
        if ($request->has('baca_iqro') && !empty($request->baca_iqro)) {
            $query->where('is_baca_iqro', $request->baca_iqro);
        }

        // Filter by Baca Hijaiyah if provided
        if ($request->has('baca_hijaiyah') && !empty($request->baca_hijaiyah)) {
            $query->where('is_baca_hijaiyah', $request->baca_hijaiyah);
        }

        // Execute the query and get the filtered data
        $dataKemampuan = $query->get();

        // Get the data_masjid using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Return the filtered data to the view
        return view('takmir_masjid.tampil_data.tampil_data_Kemampuan.tampil-Kemampuan', compact('getData', 'dataKemampuan'));
    }


    public function detailDataKemampuan($id){
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Retrieve the specific DataInduk by ID
        $detailDataKemampuan = DataInduk::where('id', $id)->where('masjid_id', $masjidId)->firstOrFail();

        return view('takmir_masjid.tampil_data.tampil_data_Kemampuan.detail-data-Kemampuan', compact('getData', 'detailDataKemampuan'));
    }
}
