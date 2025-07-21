<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class KaryawanController extends Controller
{
    public function index()
    {
        $currentLevel = session('level');

        return view('karyawan.index', [
            'currentLevel' => $currentLevel,
            'pageTitle' => 'Karyawan',
        ]);
    }

    public function create()
    {
        return view('karyawan.create', [
            'pageTitle' => 'Tambah Karyawan',
            'listAgama' => Karyawan::getListAgama(),
            'listPendidikan' => Karyawan::getListLevelPendidikan(),
            'listStatus' => Karyawan::getListStatus(),
            'listProvinsi' => Karyawan::getProvinsi(),
        ]);
    }

    public function getKabKota($idProvinsi)
    {
        return response()->json(Karyawan::getKabKotaByProvinsi($idProvinsi));
    }

    public function getKecamatan($idKabKota)
    {
        return response()->json(Karyawan::getKecamatanByKabKota($idKabKota));
    }

    public function getKelurahan($idKecamatan)
    {
        return response()->json(Karyawan::getKelurahanByKecamatan($idKecamatan));
    }

}
