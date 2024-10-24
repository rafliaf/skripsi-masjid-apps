<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use App\Models\DataKartuKeluarga;
use App\Models\DataKeahlian;
use App\Models\MdDataKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DataKeahlianController extends Controller
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

    public function index()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Retrieve DataKeahlian records that belong to the logged-in user's masjid_id
        $dataKeahlian = DataKeahlian::where('masjid_id', $masjidId)
                            ->with('dataInduk', 'jenisKeahlian')
                            ->get();

        // Check if any 'jenis_keahlian' exists in the database for the masjid
        $jenisKeahlianExists = MdDataKeahlian::where('masjid_id', $masjidId)->exists();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass this information to the view
        return view('takmir_masjid.data_keahlian.skills-data', [
            'jenisKeahlianExists' => $jenisKeahlianExists,
            'dataKeahlian' => $dataKeahlian,
            'getData' => $getData,
        ]);
    }
    
    public function indexAddJenisKeahlian()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Retrieve jenis_keahlian data for the logged-in user's masjid
        $jenisKeahlian = MdDataKeahlian::where('masjid_id', $masjidId)->get();
    
        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
        
        // Pass the retrieved data to the view
        return view('takmir_masjid.data_keahlian.add-type-skills-data', [
            'jenisKeahlian' => $jenisKeahlian,
            'getData'=> $getData,
        ]);
    }    
    
    public function storeJenisKeahlian(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_keahlian' => 'required|array|unique:md_data_keahlian,jenis_keahlian',
            'jenis_keahlian.*' => 'required|string'
        ], [
            'jenis_keahlian.required' => 'Jenis keahlian is required.',
            'jenis_keahlian.*.required' => 'Each skill type is required.',
            'jenis_keahlian.*.string' => 'Each skill type must be a valid string.'
        ]);
        
    
        foreach ($validatedData['jenis_keahlian'] as $keahlian) {
            MdDataKeahlian::create([
                'masjid_id' => auth()->user()->masjid_id, // Ensure masjid_id is retrieved correctly from the authenticated user
                'jenis_keahlian' => $keahlian,
            ]);
        }
    
        return redirect()->route('dataKeahlianIndex')->with('success', 'Jenis keahlian berhasil disimpan!');
    }
       


    public function indexAddDataKeahlian()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;
    
        // Retrieve all available `jenis_keahlian` data for the logged-in mosque
        $jenisKeahlian = MdDataKeahlian::where('masjid_id', $masjidId)->get();
    
        // Get all data for the jamaah (DataInduk) belonging to the logged-in mosque
        $dataInduk = DataInduk::where('masjid_id', $masjidId)->get();
    
        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Pass the data to the view
        return view('takmir_masjid.data_keahlian.add-skills-data', [
            'jenis_keahlian' => $jenisKeahlian,
            'data_warga' => $dataInduk,
            'getData' => $getData,
        ]);
    }    

    public function storeDataKeahlian(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'data_induk_id' => 'required|exists:data_induk,id',
            'jenis_keahlian_id' => 'required|exists:md_data_keahlian,id',
            'keahlian_lain' => 'nullable|string',
            'deskripsi_keahlian' => 'nullable|string',
            'is_sertifikat' => 'required|in:ya,tidak',
            'deskripsi_sertifikat' => 'nullable|string',
        ]);

        // Store the data in the `data_keahlian` table, linking to the masjid_id of the logged-in user
        DataKeahlian::create([
            'masjid_id' => auth()->user()->masjid_id, // Add masjid_id from the logged-in user
            'data_induk_id' => $validatedData['data_induk_id'],
            'jenis_keahlian_id' => $validatedData['jenis_keahlian_id'],
            'keahlian_lain' => $validatedData['keahlian_lain'],
            'deskripsi_keahlian' => $validatedData['deskripsi_keahlian'],
            'is_sertifikat' => $validatedData['is_sertifikat'],
            'deskripsi_sertifikat' => $validatedData['deskripsi_sertifikat'],
        ]);

        // Redirect back with a success message
        return redirect()->route('dataKeahlianIndex')->with('success', 'Data Keahlian berhasil disimpan!');
    }

    

    public function indexEditDataKeahlian($id)
    {
        // Fetch the specific data keahlian entry by its ID, including related 'person' and 'jenisKeahlian'
        $dataKeahlian = DataKeahlian::with('dataInduk', 'jenisKeahlian')->findOrFail($id);
    
        // Fetch all available people (data_warga) to populate the Nama Lengkap dropdown
        $data_warga = DataInduk::all();  // Assuming DataInduk is the model for the people

    
        // Fetch all available skills (jenis_keahlian) to populate the Jenis Keahlian dropdown
        $jenis_keahlian = MdDataKeahlian::all();  // Assuming MdDataKeahlian is the model for skills

        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
    
        // Pass all required data to the view for editing
        return view('takmir_masjid.data_keahlian.edit-skills-data', [
            'dataKeahlian' => $dataKeahlian,
            'data_warga' => $data_warga,
            'jenis_keahlian' => $jenis_keahlian,
            'getData' => $getData,
        ]);
    }
    

    public function updateDataKeahlian(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'jenis_keahlian_id' => 'required|exists:md_data_keahlian,id', // Ensure the selected skill exists
            'keahlian_lain' => 'nullable|string',
            'deskripsi_keahlian' => 'nullable|string',
            'is_sertifikat' => 'required|in:ya,tidak',
            'deskripsi_sertifikat' => 'nullable|string',
        ]);
    
        // Find the data keahlian entry by its ID
        $dataKeahlian = DataKeahlian::findOrFail($id);
    
        // Update the data keahlian entry with new data
        $dataKeahlian->update($validatedData);
    
        // Redirect back with success message
        return redirect()->route('dataKeahlianIndex')->with('success', 'Data keahlian berhasil diperbarui!');
    }
    
    public function deleteDataKeahlian($id)
    {
        // Find the data_keahlian entry by its ID
        $dataKeahlian = DataKeahlian::findOrFail($id);
    
        // Delete the entry
        $dataKeahlian->delete();
    
        // Redirect back with a success message
        return redirect()->route('dataKeahlianIndex')->with('success', 'Data berhasil dihapus!');
    }
    

}
