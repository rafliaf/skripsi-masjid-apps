<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use App\Models\RemajaMasjid;
use App\Models\DataKartuKeluarga;
use App\Models\MdProgramTakmir;
use App\Models\ProgramRemajaMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;


class RemajaMasjidController extends Controller
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

    public function index(Request $request)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Start building the query for RemajaMasjid data
        $query = RemajaMasjid::with('dataInduk', 'dataInduk.kartuKeluarga')
                            ->where('masjid_id', $masjidId);

        // Filter by RT if provided
        if ($request->has('rt') && !empty($request->rt)) {
            $query->whereHas('dataInduk.kartuKeluarga', function ($q) use ($request) {
                $q->where('no_rt', $request->rt);
            });
        }

        // Filter by Kemampuan Baca if provided
        if ($request->has('kemampuan_baca') && !empty($request->kemampuan_baca)) {
            if ($request->kemampuan_baca == 'iqra') {
                $query->whereHas('dataInduk', function ($q) {
                    $q->where('is_baca_iqro', 'ya');
                });
            } elseif ($request->kemampuan_baca == 'alquran') {
                $query->whereHas('dataInduk', function ($q) {
                    $q->where('is_baca_quran', 'ya');
                });
            } elseif ($request->kemampuan_baca == 'hijaiyah') {
                $query->whereHas('dataInduk', function ($q) {
                    $q->where('is_baca_hijaiyah', 'ya');
                });
            } elseif ($request->kemampuan_baca == 'latin') {
                $query->whereHas('dataInduk', function ($q) {
                    $q->where('is_baca_latin', 'ya');
                });
            }
        }

        // Filter by Remaja Masjid if provided
        if ($request->has('remaja_masjid') && !empty($request->remaja_masjid)) {
            $query->where('is_remaja_masjid', $request->remaja_masjid);
        }

        // Execute the query and get the filtered data
        $remajaMasjidData = $query->get();

        // Get the masjid data using the helper function
        $getData = $this->getMasjidData($masjidId);

        // Fetch unique RT values from DataKartuKeluarga table for this masjid
        $rtValues = DataKartuKeluarga::where('masjid_id', $masjidId)
                    ->distinct()
                    ->pluck('no_rt');  // Get distinct RT values

        // Pass the filtered data, RT values, and masjid data to the view
        return view('remaja_masjid.data_remaja.mosque-youth', compact('remajaMasjidData', 'getData', 'rtValues'));
    }

    public function indexAddData()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Fetch 'data_induk' entries for the logged-in user's mosque
        $dataInduk = DataInduk::where('masjid_id', $masjidId)->get();
    
        // Fetch 'data_kartu_keluarga' entries for the logged-in user's mosque
        $dataKartuKeluarga = DataKartuKeluarga::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Return the view with the fetched data
        return view('remaja_masjid.data_remaja.add-mosque-youth', [
            'dataInduk' => $dataInduk,
            'dataKartuKeluarga' => $dataKartuKeluarga,
            'getData' => $getData
        ]);
    }
    
    public function storeDataRemajaMasjid(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'data_induk_id' => 'required|exists:data_induk,id',
            'is_remaja_masjid' => 'required|in:ya,tidak',
        ]);
    
        // Retrieve the associated kartu_keluarga_id from the selected data_induk_id
        $dataInduk = DataInduk::findOrFail($validatedData['data_induk_id']);
        $validatedData['kartu_keluarga_id'] = $dataInduk->kartu_keluarga_id;
    
        // Add masjid_id from the authenticated user
        $validatedData['masjid_id'] = auth()->user()->masjid_id;
    
        // Store the new 'remaja masjid' data
        RemajaMasjid::create($validatedData);
    
        // Redirect with a success message
        return redirect()->route('remajaMasjidIndex')->with('success', 'Data remaja masjid berhasil ditambahkan!');
    }    

    // Edit Remaja Masjid data
    public function editDataRemajaMasjid(Request $request, $id)
    {
        // Find the existing record by ID
        $remaja = RemajaMasjid::findOrFail($id);
    
        // Validate the input data
        $validatedData = $request->validate([
            'is_remaja_masjid' => 'required|in:ya,tidak',
        ]);
    
        // Update the data
        $remaja->update($validatedData);
    
        // Redirect back with a success message
        return redirect()->route('remajaMasjidIndex')->with('success', 'Data remaja masjid berhasil diubah!');
    }
    

    
    public function deleteDataRemajaMasjid($id)
    {
        // Find the record by ID
        $remaja = RemajaMasjid::findOrFail($id);
        
        // Delete the record
        $remaja->delete();
        
        // Redirect with a success message
        return redirect()->route('remajaMasjidIndex')->with('success', 'Data berhasil dihapus!');
    }

    // PROGRAM REMAJA MASJID
    public function indexProgramRemaja()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Retrieve the list of programs for the specific masjid
        $programs = ProgramRemajaMasjid::where('masjid_id', $masjidId)->get();
    
        // Get the data_masjid using the new method (if needed)
        $getData = $this->getMasjidData($masjidId);
    
        // Pass the programs to the view along with the other data
        return view('remaja_masjid.program_masjid.program-remaja-masjid', compact('programs', 'getData'));
    }
    
    
    // PROGRAM REMAJA MASJID
    public function indexAddProgram()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
    
        // Retrieve the available program types from MdProgramTakmir
        $jenis_programs = MdProgramTakmir::where('masjid_id', $masjidId)->get();;
        
        // get penanggung jawab
        $penanggung_jawab = DataInduk::where('masjid_id', $masjidId)->get();
    
        return view('remaja_masjid.program_masjid.add-program-remaja-masjid', compact('getData', 'jenis_programs', 'penanggung_jawab'));
    }
    
    // Post data
    public function addProgram(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'jenis_program_id' => 'required|exists:md_program_takmir,id',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tgl_mulai' => 'required|date_format:Y-m-d H:i',
            'tgl_selesai' => 'required|date_format:Y-m-d H:i|after_or_equal:tgl_mulai',
            'data_induk_id' => 'required|exists:data_induk,id',
            'sasaran_kegiatan' => 'required|string|max:255',
            'catatan_pelaksanaan' => 'nullable|string',
        ]);

        // Use Carbon to format dates (if needed, but not necessary here as the format is already correct)
        $tgl_mulai = Carbon::createFromFormat('Y-m-d H:i', $validatedData['tgl_mulai']);
        $tgl_selesai = Carbon::createFromFormat('Y-m-d H:i', $validatedData['tgl_selesai']);

        // Store the data into the database
        ProgramRemajaMasjid::create([
            'masjid_id' => Auth::user()->masjid_id,
            'jenis_program_id' => $validatedData['jenis_program_id'],
            'data_induk_id' => $validatedData['data_induk_id'],
            'nama_kegiatan' => $validatedData['nama_kegiatan'],
            'lokasi_kegiatan' => $validatedData['lokasi_kegiatan'],
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'sasaran_kegiatan' => $validatedData['sasaran_kegiatan'],
            'catatan_pelaksanaan' => $validatedData['catatan_pelaksanaan'],
        ]);

        // Redirect back with success message
        return redirect()->route('indexProgramRemaja')->with('success', 'Program berhasil ditambahkan!');
    }


    // Edit data program remaja masjid
    public function indexEditProgram($id)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Get the data_masjid using the new method (if needed)
        $getData = $this->getMasjidData($masjidId);
    
        // Fetch the program data by its ID and ensure it belongs to the same masjid
        $program = ProgramRemajaMasjid::where('masjid_id', $masjidId)->where('id', $id)->firstOrFail();
    
        // Fetch all available jenis programs
        $jenis_programs = MdProgramTakmir::where('masjid_id', $masjidId)->get();
    
        // Fetch all available penanggung jawab
        $penanggung_jawabs = DataInduk::where('masjid_id', $masjidId)->get();
    
        // Pass the program and jenis_programs to the view for editing
        return view('remaja_masjid.program_masjid.edit-program-remaja-masjid', compact('program', 'getData', 'jenis_programs', 'penanggung_jawabs'));
    }

    public function updateProgram(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'jenis_program_id' => 'required',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'tgl_mulai' => 'required|date_format:Y-m-d H:i',
            'tgl_selesai' => 'required|date_format:Y-m-d H:i|after_or_equal:tgl_mulai',
            'data_induk_id' => 'required',
            'sasaran_kegiatan' => 'required|string|max:255',
            'catatan_pelaksanaan' => 'nullable|string',
        ]);

        // Find the program by ID and update it
        $program = ProgramRemajaMasjid::findOrFail($id);
        $program->update([
            'jenis_program_id' => $request->jenis_program_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'data_induk_id' => $request->data_induk_id,
            'sasaran_kegiatan' => $request->sasaran_kegiatan,
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
        ]);

        // Redirect with success message
        return redirect()->route('indexProgramRemaja')->with('success', 'Program berhasil diperbarui!');
    }


    // Detail data
    public function detailProgram($id)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;
    
        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
    
        // Fetch the program details by ID, and ensure it belongs to the same masjid
        $program = ProgramRemajaMasjid::where('masjid_id', $masjidId)->where('id', $id)->firstOrFail();
    
        // You might also want to get the penanggung jawab (responsible person)
        $dataInduk = $program->dataInduk; // Assuming a relation exists
    
        // Pass the program and penanggung jawab data to the view
        return view('remaja_masjid.program_masjid.detail-program-remaja-masjid', compact('program', 'dataInduk', 'getData'));
    }
    
    
    // DELETE program remaja masjid
    public function deleteDataProgram($id)
    {
        // Find the program by its ID and delete it
        $program = ProgramRemajaMasjid::findOrFail($id);
        $program->delete();
    
        // Redirect back with a success message
        return redirect()->route('indexProgramRemaja')->with('success', 'Program berhasil dihapus!');
    }

}
