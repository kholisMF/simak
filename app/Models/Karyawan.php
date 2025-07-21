<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Karyawan extends Model
{
    // protected $table = 'mt_agama';
    public $timestamps = false;

    public static function getListAgama()
    {
        return DB::table('mt_agama')
            ->orderBy('agama')
            ->pluck('agama', 'id');
    }

    public static function getListLevelPendidikan()
    {
        return DB::table('mt_level_pendidikan')
            ->orderBy('id')
            ->pluck('level_pendidikan', 'id');
    }

    public static function getListStatus()
    {
        return DB::table('mt_status_kawin')
            ->orderBy('id')
            ->pluck('status_kawin', 'kode');
    }

    // =========================================== GET WILAYAH ============================================== \\
    public static function getProvinsi()
    {
        return DB::table('mt_provinsi')->orderBy('nama_provinsi')->pluck('nama_provinsi', 'id_provinsi');
    }
    public static function getKabKotaByProvinsi($idProvinsi)
    {
        return DB::table('mt_kab_kota')
            ->where('id_provinsi', $idProvinsi)
            ->orderBy('nama_kab_kota')
            ->pluck('nama_kab_kota', 'id_kab_kota');
    }

    public static function getKecamatanByKabKota($idKabKota)
    {
        return DB::table('mt_kecamatan')
            ->where('id_kab_kota', $idKabKota)
            ->orderBy('nama_kecamatan')
            ->pluck('nama_kecamatan', 'id_kecamatan');
    }

    public static function getKelurahanByKecamatan($idKecamatan)
    {
        return DB::table('mt_kelurahan')
            ->where('id_kecamatan', $idKecamatan)
            ->orderBy('nama_kelurahan')
            ->pluck('nama_kelurahan', 'id_kelurahan');
    }
    // =========================================== GET WILAYAH ============================================== \\
}
