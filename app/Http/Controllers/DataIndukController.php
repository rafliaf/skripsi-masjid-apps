<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\DataKartuKeluargaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DataIndukController extends Controller
{

    protected $dataKKService;

    // get semua data kartu keluarga
    public function __construct(DataKartuKeluargaService $dataKKService)
    {
        $this->dataKKService = $dataKKService;
    }

    // Method to get the data_masjid based on the logged-in user's masjid_id
    private function getMasjidData($masjidId)
    {
        return DB::table('users')
            ->join('data_masjid', 'users.masjid_id', '=', 'data_masjid.id')
            ->where('users.masjid_id', $masjidId)
            ->select('data_masjid.nama_masjid')
            ->first();
    }

    public function index()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve only the DataInduk that belong to the same masjid_id
        $dataInduk = DataInduk::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the data to the view
        return view('takmir_masjid.data_induk.parent-data', compact('dataInduk', 'getData'));
    }

    // POST DATA
    public function indexAddDataInduk()
    {
        // Get the same data using the service
        $dataKartuKeluarga = $this->dataKKService->getDataKartuKeluargaByMasjidId();

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the data to the view
        return view('takmir_masjid.data_induk.add-parent-data', compact('dataKartuKeluarga', 'getData'));
    }

    public function addDataInduk(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'kartu_keluarga_id' => 'required|exists:data_kartu_keluarga,id',
            'nik' => 'required|string|unique:data_induk,nik|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'status_hubungan_keluarga' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki_laki,perempuan',
            'pendidikan' => 'required|in:belum_sekolah,paud,tk,sd,smp,smk,sma,d1,d2,d3,d4,s1,s2,s3',
            'pekerjaan' => 'required|string',
            'no_wa' => 'required|string',
            'status_kawin' => 'required|in:menikah,belum_menikah,duda,janda',
            'is_remaja_masjid' => 'required|in:ya,tidak',
            'is_status_mukim' => 'required|in:ya,tidak',
            'is_baca_latin' => 'required|in:ya,tidak',
            'is_baca_hijaiyah' => 'required|in:ya,tidak',
            'is_baca_iqro' => 'required|in:ya,tidak',
            'is_baca_quran' => 'required|in:ya,tidak',
            'is_sholat_5_waktu' => 'required|in:ya,tidak',
            'is_sholat_berjamaah' => 'required|in:ya,tidak',
            'is_zakat_fitrah' => 'required|in:ya,tidak',
            'is_zakat_mal' => 'required|in:ya,tidak',
            'is_kurban' => 'required|in:ya,tidak',
            'is_haji' => 'required|in:ya,tidak',
            'is_umrah' => 'required|in:ya,tidak',
            'is_pengajian_rutin' => 'required|in:ya,tidak',
        ]);

        // Add masjid_id from the logged-in user
        $validatedData['masjid_id'] = Auth::user()->masjid_id;

        // Store the data in the database
        DataInduk::create($validatedData);

        // Redirect back with success message
        return redirect()->route('data_induk.index')->with('success', 'Data induk berhasil ditambahkan!');
    }

    //EDIT DATA
    public function indexEditDataInduk($id)
    {
        // Fetch the specific data you want to edit
        $dataInduk = DataInduk::findOrFail($id);

        // Fetch data for Kartu Keluarga for the select options
        $dataKartuKeluarga = $this->dataKKService->getDataKartuKeluargaByMasjidId();

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass both the specific data and the Kartu Keluarga data to the view
        return view('takmir_masjid.data_induk.edit-parent-data', compact('dataInduk', 'dataKartuKeluarga', 'getData'));
    }


    public function editDataInduk(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'kartu_keluarga_id' => 'required|exists:data_kartu_keluarga,id',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'status_hubungan_keluarga' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki_laki,perempuan',
            'pendidikan' => 'required|in:belum_sekolah,paud,tk,sd,smp,smk,sma,d1,d2,d3,d4,s1,s2,s3',
            'pekerjaan' => 'required|string',
            'no_wa' => 'required|string',
            'status_kawin' => 'required|in:menikah,belum_menikah,duda,janda',
            'is_remaja_masjid' => 'required|in:ya,tidak',
            'is_status_mukim' => 'required|in:ya,tidak',
            'is_baca_latin' => 'required|in:ya,tidak',
            'is_baca_hijaiyah' => 'required|in:ya,tidak',
            'is_baca_iqro' => 'required|in:ya,tidak',
            'is_baca_quran' => 'required|in:ya,tidak',
            'is_sholat_5_waktu' => 'required|in:ya,tidak',
            'is_sholat_berjamaah' => 'required|in:ya,tidak',
            'is_zakat_fitrah' => 'required|in:ya,tidak',
            'is_zakat_mal' => 'required|in:ya,tidak',
            'is_kurban' => 'required|in:ya,tidak',
            'is_haji' => 'required|in:ya,tidak',
            'is_umrah' => 'required|in:ya,tidak',
            'is_pengajian_rutin' => 'required|in:ya,tidak',
        ]);

        // Find the specific record to update
        $dataInduk = DataInduk::findOrFail($id);

        // Update the record
        $dataInduk->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('data_induk.index')->with('success', 'Data induk berhasil diperbarui!');
    }

    //DELETE
    public function deleteDataInduk($id)
    {
        // Find the data by ID and delete it
        $dataInduk = DataInduk::findOrFail($id);
        $dataInduk->delete();

        // Redirect back with success message
        return redirect()->route('data_induk.index')->with('success', 'Data berhasil dihapus!');
    }
}
