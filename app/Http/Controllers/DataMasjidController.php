<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DataMasjidController extends Controller
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
    
    public function index(){
        // Ambil user yang sedang login
        $user = Auth::user(); 

        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
        
        // query table ke data_masjid
        $getMasjidData = DB::table('users')
            ->join('data_masjid', 'users.masjid_id', '=', 'data_masjid.id')
            ->where('users.masjid_id', $user->masjid_id)
            ->select('data_masjid.*')
            ->first();

        return view('admin_masjid/mosque-data', compact('getData'), [
            "nama_masjid" => $getMasjidData->nama_masjid, // ambil data nama_masjid dari tabel data_masjid
            "alamat" => $getMasjidData->alamat_masjid,
            "ketua_masjid" => $getMasjidData->ketua_masjid, 
            "ketua_takmir" => $getMasjidData->ketua_takmir, 
            "ketua_remaja_masjid" => $getMasjidData->ketua_remaja_masjid,
            "total_jamaah" => $getMasjidData->total_jamaah,
            "total_remaja_masjid" => $getMasjidData->total_remaja_masjid,
            "luas_tanah" => $getMasjidData->luas_tanah_masjid,
            "deskripsi_masjid" => $getMasjidData->deskripsi_masjid,
        ]);  
    }

    public function getViewEditDataMasjid()
    {
        // Get the currently authenticated user
        $user = Auth::user(); 

        // Get the masjid_id of the currently logged-in user
        $masjidId = auth()->user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);

        // Query the data_masjid table based on the user's masjid_id
        $getData = DB::table('users')
            ->join('data_masjid', 'users.masjid_id', '=', 'data_masjid.id')
            ->where('users.masjid_id', $user->masjid_id)
            ->select('data_masjid.*')
            ->first();

        // Pass the data to the view
        return view('admin_masjid/edit-mosque-data', compact('getData'),[
            "nama_masjid" => $getData->nama_masjid, // ambil data nama_masjid dari tabel data_masjid
            "alamat" => $getData->alamat_masjid,
            "ketua_masjid" => $getData->ketua_masjid, 
            "ketua_takmir" => $getData->ketua_takmir, 
            "ketua_remaja_masjid" => $getData->ketua_remaja_masjid,
            "total_jamaah" => $getData->total_jamaah,
            "total_remaja_masjid" => $getData->total_remaja_masjid,
            "luas_tanah" => $getData->luas_tanah_masjid,
            "deskripsi_masjid" => $getData->deskripsi_masjid,
        ]);  
    }

    public function updateDataMasjid(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Validate the request data (you can add more validation rules as needed)
        $request->validate([
            'alamat_masjid' => 'required|string|max:255',
            'ketua_masjid' => 'nullable|string|max:255',
            'ketua_takmir' => 'nullable|string|max:255',
            'ketua_remaja_masjid' => 'nullable|string|max:255',
            'total_jamaah' => 'nullable|numeric',
            'total_remaja_masjid' => 'nullable|numeric',
            'luas_tanah_masjid' => 'nullable|string',
            'deskripsi_masjid' => 'nullable|string',
        ]);

        // Find the mosque associated with the logged-in user's masjid_id
        $masjid = DB::table('data_masjid')->where('id', $user->masjid_id)->first();

        if ($masjid) {
            // Update the mosque data, excluding 'nama_masjid'
            DB::table('data_masjid')->where('id', $user->masjid_id)->update([
                'alamat_masjid' => $request->input('alamat_masjid'),
                'ketua_masjid' => $request->input('ketua_masjid'),
                'ketua_takmir' => $request->input('ketua_takmir'),
                'ketua_remaja_masjid' => $request->input('ketua_remaja_masjid'),
                'total_jamaah' => $request->input('total_jamaah'),
                'total_remaja_masjid' => $request->input('total_remaja_masjid'),
                'luas_tanah_masjid' => $request->input('luas_tanah_masjid'),
                'deskripsi_masjid' => $request->input('deskripsi_masjid'),
                'updated_at' => now(), // Update the timestamp
            ]);

            // Redirect back to the dashboard or any desired route with a success message
            return redirect()->route('data_masjid.index')->with('success', 'Data masjid berhasil diperbarui');
        }

        return redirect()->back()->with('error', 'Data masjid tidak ditemukan.');
    }
    
    

}
