<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use App\Models\MdProgramTakmir;
use App\Models\ProgramTakmir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProgramTakmirController extends Controller
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
        $masjidId = auth()->user()->masjid_id;

        // Mengecek apakah ada data di database
        $type_program_exists = MdProgramTakmir::where('masjid_id', $masjidId)->exists();

        // Ambil semua data program dari tabel yang sesuai dengan masjid_id
        $programs = ProgramTakmir::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
    
        // Kirim flag $type_program_exists ke view
        return view('takmir_masjid.program_masjid.program-takmir-masjid', compact('type_program_exists', 'programs', 'getData'));
    }
    

    public function indexAddJenisProgram()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Ambil data jenis_program dari database
        $jenis_programs = MdProgramTakmir::where('masjid_id', $masjidId)->get();

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
    
        // Kirim data ke view
        return view('takmir_masjid.program_masjid.add-program-type-takmir-masjid', compact('jenis_programs', 'getData'));
    }
    

    public function storeJenisProgram(Request $request)
    {
        // Validate the input
        $request->validate([
            'jenis_program' => 'required|array|unique:md_program_takmir,jenis_program',
            'jenis_program.*' => 'required|string|max:255',
        ]);

         // Get the masjid_id of the currently logged-in user
         $masjidId = auth()->user()->masjid_id;

        // Loop through each input to store in the database
        foreach ($request->jenis_program as $jenisProgram) {
            MdProgramTakmir::create([
                'masjid_id' => $masjidId,  // Assuming masjid_id is fixed, change it as needed
                'jenis_program' => $jenisProgram,
            ]);
        }

        // Redirect to another page after successful submission
        return redirect()->route('index_program_takmir.index')->with('success', 'Jenis program masjid berhasil ditambahkan.');
    }


    public function indexAddData()
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Ambil data jenis program dari tabel MdProgramTakmir
        $jenis_programs = MdProgramTakmir::where('masjid_id', $masjidId)->get();

        // Ambil data penanggung jawab dari tabel data_induk
        $penanggung_jawab = DataInduk::where('masjid_id', $masjidId)->get();

        // Kirim data ke view
        return view('takmir_masjid.program_masjid.add-program-takmir-masjid', compact('jenis_programs', 'penanggung_jawab', 'getData'));
    }

    public function storeDataProgram(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_program' => 'required|exists:md_program_takmir,id',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|exists:data_induk,id',
            'tgl_mulai' => 'required|date_format:"Y-m-d H:i"',
            'tgl_selesai' => 'required|date_format:"Y-m-d H:i"|after_or_equal:tgl_mulai',
            'sasaran_kegiatan' => 'required|string|max:255',
            'catatan_pelaksanaan' => 'nullable|string|max:500',
        ]);

        // Konversi format tanggal menggunakan Carbon (jika diperlukan)
        $tgl_mulai = Carbon::createFromFormat('Y-m-d H:i', $request->tgl_mulai);
        $tgl_selesai = Carbon::createFromFormat('Y-m-d H:i', $request->tgl_selesai);

        // Simpan data program ke database
        ProgramTakmir::create([
            'masjid_id' => Auth::user()->masjid_id,
            'jenis_program_id' => $request->jenis_program,
            'data_induk_id' => $request->penanggung_jawab,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'sasaran_kegiatan' => $request->sasaran_kegiatan,
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index_program_takmir.index')->with('success', 'Program masjid berhasil ditambahkan.');
    }


    public function indexEditData($id)
    {

        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Ambil data program berdasarkan id
        $program = ProgramTakmir::where('masjid_id', $masjidId)->where('id', $id)->firstOrFail();

        // Ambil jenis program dan penanggung jawab dari database
        $jenis_programs = MdProgramTakmir::where('masjid_id', $masjidId)->get();
        $penanggung_jawabs = DataInduk::where('masjid_id', $masjidId)->get();

        // Kirim data program dan dropdown ke view
        return view('takmir_masjid.program_masjid.edit-program-takmir-masjid', compact('program', 'jenis_programs', 'penanggung_jawabs', 'getData'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'jenis_program_id' => 'required|exists:md_program_takmir,id',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi_kegiatan' => 'required|string|max:255',
            'data_induk_id' => 'required|exists:data_induk,id',
            'tgl_mulai' => 'required|date_format:"Y-m-d H:i"',
            'tgl_selesai' => 'required|date_format:"Y-m-d H:i"|after_or_equal:tgl_mulai',
            'sasaran_kegiatan' => 'required|string|max:255',
            'catatan_pelaksanaan' => 'nullable|string|max:500',
        ]);

        // Konversi format tanggal menggunakan Carbon
        $tgl_mulai = Carbon::createFromFormat('Y-m-d H:i', $request->tgl_mulai);
        $tgl_selesai = Carbon::createFromFormat('Y-m-d H:i', $request->tgl_selesai);

        // Update data program
        $program = ProgramTakmir::findOrFail($id);
        $program->update([
            'masjid_id' => Auth::user()->masjid_id,
            'jenis_program_id' => $request->jenis_program_id, // Corrected field name
            'data_induk_id' => $request->data_induk_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'sasaran_kegiatan' => $request->sasaran_kegiatan,
            'catatan_pelaksanaan' => $request->catatan_pelaksanaan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index_program_takmir.index')->with('success', 'Program masjid berhasil diperbarui.');
    }


    public function detail($id)
    {
        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Ambil data program berdasarkan id
        $program = ProgramTakmir::findOrFail($id);
    
        // Kirim data program ke view
        return view('takmir_masjid.program_masjid.detail-program-takmir-masjid', compact('program', 'getData'));
    }

    public function deleteDataProgram($id)
    {
        // Temukan program berdasarkan id dan hapus
        $program = ProgramTakmir::findOrFail($id);
        $program->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('index_program_takmir.index')->with('success', 'Program berhasil dihapus.');
    }

    
}
