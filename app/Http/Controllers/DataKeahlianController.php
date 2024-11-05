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
        $masjidId = Auth::user()->masjid_id;

        // Retrieve DataKeahlian records with related models
        $dataKeahlian = DataKeahlian::where('masjid_id', $masjidId)
                            ->with('dataInduk', 'jenisKeahlian')
                            ->get();

        $jenisKeahlianExists = MdDataKeahlian::where('masjid_id', $masjidId)->exists();
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.data_keahlian.skills-data', [
            'jenisKeahlianExists' => $jenisKeahlianExists,
            'dataKeahlian' => $dataKeahlian,
            'getData' => $getData,
        ]);
    }
    
    public function indexAddJenisKeahlian()
    {
        $masjidId = auth()->user()->masjid_id;
        $jenisKeahlian = MdDataKeahlian::where('masjid_id', $masjidId)->get();
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.data_keahlian.add-type-skills-data', [
            'jenisKeahlian' => $jenisKeahlian,
            'getData'=> $getData,
        ]);
    }    
    
    public function storeJenisKeahlian(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_keahlian' => 'required|array',
            'jenis_keahlian.*' => 'required|string'
        ], [
            'jenis_keahlian.required' => 'Jenis keahlian is required.',
            'jenis_keahlian.*.required' => 'Each skill type is required.',
            'jenis_keahlian.*.string' => 'Each skill type must be a valid string.'
        ]);

        foreach ($validatedData['jenis_keahlian'] as $keahlian) {
            // Check if the skill type already exists for the masjid
            if (!MdDataKeahlian::where('masjid_id', auth()->user()->masjid_id)
                    ->where('jenis_keahlian', $keahlian)->exists()) {
                MdDataKeahlian::create([
                    'masjid_id' => auth()->user()->masjid_id,
                    'jenis_keahlian' => $keahlian,
                ]);
            }
        }

        return redirect()->route('dataKeahlianIndex')->with('success', 'Jenis keahlian berhasil disimpan!');
    }
    
    public function indexAddDataKeahlian()
    {
        $masjidId = Auth::user()->masjid_id;
        $jenisKeahlian = MdDataKeahlian::where('masjid_id', $masjidId)->get();
        $dataInduk = DataInduk::where('masjid_id', $masjidId)->get();
        $getData = $this->getMasjidData($masjidId);

        return view('takmir_masjid.data_keahlian.add-skills-data', [
            'jenis_keahlian' => $jenisKeahlian,
            'data_warga' => $dataInduk,
            'getData' => $getData,
        ]);
    }    

    public function storeDataKeahlian(Request $request)
    {
        $validatedData = $request->validate([
            'data_induk_id' => 'required|exists:data_induk,id',
            'jenis_keahlian_id' => 'required|exists:md_data_keahlian,id',
            'keahlian_lain' => 'nullable|string',
            'deskripsi_keahlian' => 'nullable|string',
            'is_sertifikat' => 'required|in:ya,tidak',
            'deskripsi_sertifikat' => 'nullable|string',
        ]);

        DataKeahlian::create([
            'masjid_id' => auth()->user()->masjid_id,
            'data_induk_id' => $validatedData['data_induk_id'],
            'jenis_keahlian_id' => $validatedData['jenis_keahlian_id'],
            'keahlian_lain' => $validatedData['keahlian_lain'] ?? '',
            'deskripsi_keahlian' => $validatedData['deskripsi_keahlian'] ?? '',
            'is_sertifikat' => $validatedData['is_sertifikat'],
            'deskripsi_sertifikat' => $validatedData['deskripsi_sertifikat'] ?? '',
        ]);

        return redirect()->route('dataKeahlianIndex')->with('success', 'Data keahlian berhasil disimpan!');
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
