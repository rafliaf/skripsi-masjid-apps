<?php

namespace App\Http\Controllers;

use App\Models\DataInduk;
use App\Models\DataKartuKeluarga;
use App\Models\RemajaMasjid;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 



class AdminMasjidController extends Controller
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
        // Get the masjid_id of the currently logged-in user
        $masjidId = Auth::user()->masjid_id;

        // Get the data_masjid using the new method
        $getData = $this->getMasjidData($masjidId);
        
        // Count the number of jamaah (people) from the DataInduk table
        $totalJamaah = DataInduk::where('masjid_id', $masjidId)->count();

        // count data kk
        $totalDataKK = DataKartuKeluarga::where('masjid_id', $masjidId)->count();

        // CHART PERBANDINGAN USIA //
            // Retrieve the data based on masjid_id
            $dataJamaah = DataInduk::where('masjid_id', $masjidId)->get();
            // Group data by age ranges
            $ageRanges = [
                '5-9' => 0,
                '10-19' => 0,
                '20-55' => 0,
                '>55' => 0,
            ];

            $maleData = [
                '5-9' => 0,
                '10-19' => 0,
                '20-55' => 0,
                '>55' => 0,
            ];

            $femaleData = [
                '5-9' => 0,
                '10-19' => 0,
                '20-55' => 0,
                '>55' => 0,
            ];

            foreach ($dataJamaah as $jamaah) {
                // Calculate the age of each jamaah based on tgl_lahir
                $age = Carbon::parse($jamaah->tgl_lahir)->age;

                // Group the data into the respective age ranges
                if ($age >= 5 && $age <= 9) {
                    $ageRanges['5-9']++;
                    if ($jamaah->jenis_kelamin === 'laki_laki') {
                        $maleData['5-9']++;
                    } else {
                        $femaleData['5-9']++;
                    }
                } elseif ($age >= 10 && $age <= 19) {
                    $ageRanges['10-19']++;
                    if ($jamaah->jenis_kelamin === 'laki_laki') {
                        $maleData['10-19']++;
                    } else {
                        $femaleData['10-19']++;
                    }
                } elseif ($age >= 20 && $age <= 55) {
                    $ageRanges['20-55']++;
                    if ($jamaah->jenis_kelamin === 'laki_laki') {
                        $maleData['20-55']++;
                    } else {
                        $femaleData['20-55']++;
                    }
                } elseif ($age > 55) {
                    $ageRanges['>55']++;
                    if ($jamaah->jenis_kelamin === 'laki_laki') {
                        $maleData['>55']++;
                    } else {
                        $femaleData['>55']++;
                    }
                }
            }
        /// END CHART PERBANDINGAN USIA //

        // CHART IBADAH //
        $sholat5Waktu = DataInduk::where('masjid_id', $masjidId)->where('is_sholat_5_waktu', 'ya')->count();
        $sholatBerjamaah = DataInduk::where('masjid_id', $masjidId)->where('is_sholat_berjamaah', 'ya')->count();
        $zakatFitrah = DataInduk::where('masjid_id', $masjidId)->where('is_zakat_fitrah', 'ya')->count();
        $zakatMal = DataInduk::where('masjid_id', $masjidId)->where('is_zakat_mal', 'ya')->count();
        $kurban = DataInduk::where('masjid_id', $masjidId)->where('is_kurban', 'ya')->count();
        $haji = DataInduk::where('masjid_id', $masjidId)->where('is_haji', 'ya')->count();
        $pengajian = DataInduk::where('masjid_id', $masjidId)->where('is_pengajian_rutin', 'ya')->count();
        
        // END CHART IBADAH //

        // CHART MENGAJI //
        $bacaQuran = DataInduk::where('masjid_id', $masjidId)->where('is_baca_quran', 'ya')->count();
        $bacaIqro = DataInduk::where('masjid_id', $masjidId)->where('is_baca_iqro', 'ya')->count();
        $bacaHijaiyah = DataInduk::where('masjid_id', $masjidId)->where('is_baca_hijaiyah', 'ya')->count();
        $bacaLatin = DataInduk::where('masjid_id', $masjidId)->where('is_baca_latin', 'ya')->count();
        // END CHART

        // LEVEL EKONOMI //
        $menengahKeAtas = DataKartuKeluarga::where('masjid_id', $masjidId)->where('level_ekonomi', 'menengah_ke_atas')->count();
        $menengah = DataKartuKeluarga::where('masjid_id', $masjidId)->where('level_ekonomi', 'menengah')->count();
        $menengahKeBawah = DataKartuKeluarga::where('masjid_id', $masjidId)->where('level_ekonomi', 'menengah_ke_bawah')->count();

        // PENDIDIKAN //
        $pendidikanCounts = [
            'belum_sekolah' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'belum_sekolah')->count(),
            'paud' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'paud')->count(),
            'tk' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'tk')->count(),
            'sd' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'sd')->count(),
            'smp' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'smp')->count(),
            'smk' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'smk')->count(),
            'sma' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'sma')->count(),
            'd1' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'd1')->count(),
            'd2' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'd2')->count(),
            'd3' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'd3')->count(),
            'd4' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 'd4')->count(),
            's1' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 's1')->count(),
            's2' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 's2')->count(),
            's3' => DataInduk::where('masjid_id', $masjidId)->where('pendidikan', 's3')->count(),
        ];

        // PEKERJAAN //
        // Count the number of people for each 'pekerjaan'
        $pekerjaanCounts = DataInduk::where('masjid_id', $masjidId)
        ->select('pekerjaan', DB::raw('count(*) as total'))
        ->groupBy('pekerjaan')
        ->get();

        // Convert the results into two arrays for Highcharts
        $categoriesPekerjaan = $pekerjaanCounts->pluck('pekerjaan')->toArray();  // List of job categories
        $dataPekerjaan = $pekerjaanCounts->pluck('total')->toArray(); // Corresponding number of people per job

        // REMAJA MASJID //
        $jumlahRemaja = RemajaMasjid::where('masjid_id', $masjidId)->count();
        // Count the number of 'is_remaja_masjid' where value is 'ya'
        $jumlahAnggotaRemajaMasjid = DB::table('data_remaja_masjid')
        ->where('masjid_id', $masjidId)
        ->where('is_remaja_masjid', 'ya')
        ->count();
        
        // Count the number of 'laki_laki' from the data_induk table through data_remaja_masjid
        $jumlahRemajaLakiLaki = RemajaMasjid::where('masjid_id', $masjidId)
        ->whereHas('dataInduk', function ($query) {
            $query->where('jenis_kelamin', 'laki_laki');
        })->count();

        // Count the number of 'perempuan' from the data_induk table through data_remaja_masjid
        $jumlahRemajaPerempuan = RemajaMasjid::where('masjid_id', $masjidId)->whereHas('dataInduk', function ($query) {
            $query->where('jenis_kelamin', 'perempuan');
        })->count();

        // Count the number of people who answered "ya" for each reading skill
        $countBacaLatin = DataInduk::where('masjid_id', $masjidId)->where('is_baca_latin', 'ya')->count();
        $countBacaHijaiyah = DataInduk::where('masjid_id', $masjidId)->where('is_baca_hijaiyah', 'ya')->count();
        $countBacaIqro = DataInduk::where('masjid_id', $masjidId)->where('is_baca_iqro', 'ya')->count();
        $countBacaQuran = DataInduk::where('masjid_id', $masjidId)->where('is_baca_quran', 'ya')->count();

        // Ambil user yang sedang login
        $user = Auth::user(); 
    
        if($user->role === 'admin_masjid'){
            return view('index', compact('getData'), [
                "role" => "admin masjid", // Ambil role user yang login
                "total_jamaah" => $totalJamaah,
                "total_data_kk" => $totalDataKK,
                "total_rumah" => $totalDataKK,
                "range_usia" => $ageRanges,
                "data_perempuan" => $femaleData,
                "data_laki_laki" => $maleData,
                "sholat_5_waktu" => $sholat5Waktu,
                "sholat_berjamaah" => $sholatBerjamaah,
                "zakat_fitrah" => $zakatFitrah,
                "zakat_mal" => $zakatMal,
                "kurban" => $kurban,
                "haji" => $haji,
                "pengajian" => $pengajian,
                "baca_quran" => $bacaQuran,
                "baca_iqro" => $bacaIqro,
                "baca_hijaiyah" => $bacaHijaiyah,
                "baca_latin" => $bacaLatin,
                "menengah_atas" => $menengahKeAtas,
                "menengah" => $menengah,
                "menengah_bawah" => $menengahKeBawah,
                "pendidikan_counts" => $pendidikanCounts, // Pass the pendidikan counts
                "categories_pekerjaan" => $categoriesPekerjaan,
                "data_pekerjaan" => $dataPekerjaan,
            ]);  
        }
        else if($user->role === 'takmir')
        {
            return view('index', compact('getData'), [
                "role" => "takmir masjid", // Ambil role user yang login
                "total_jamaah" => $totalJamaah,
                "total_data_kk" => $totalDataKK,
                "total_rumah" => $totalDataKK,
                "range_usia" => $ageRanges,
                "data_perempuan" => $femaleData,
                "data_laki_laki" => $maleData,
                "sholat_5_waktu" => $sholat5Waktu,
                "sholat_berjamaah" => $sholatBerjamaah,
                "zakat_fitrah" => $zakatFitrah,
                "zakat_mal" => $zakatMal,
                "kurban" => $kurban,
                "haji" => $haji,
                "pengajian" => $pengajian,
                "baca_quran" => $bacaQuran,
                "baca_iqro" => $bacaIqro,
                "baca_hijaiyah" => $bacaHijaiyah,
                "baca_latin" => $bacaLatin,
                "menengah_atas" => $menengahKeAtas,
                "menengah" => $menengah,
                "menengah_bawah" => $menengahKeBawah,
                "pendidikan_counts" => $pendidikanCounts, // Pass the pendidikan counts
                "categories_pekerjaan" => $categoriesPekerjaan,
                "data_pekerjaan" => $dataPekerjaan,
            ]);  
        }
        else if($user->role === 'remaja_masjid')
        {
            return view('remaja_masjid.index', compact('getData', 'countBacaLatin', 'countBacaHijaiyah', 'countBacaIqro', 'countBacaQuran'), [
                "role" => "remaja masjid", // Ambil role user yang login
                "jumlah_remaja" => $jumlahRemaja,
                "jumlah_anggota_remaja_masjid" => $jumlahAnggotaRemajaMasjid,
                "jumlah_remaja_laki_laki" => $jumlahRemajaLakiLaki,
                "jumlah_remaja_perempuan" => $jumlahRemajaPerempuan,
            ]);
        };
    }

}
