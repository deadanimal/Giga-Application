<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FgvPmps\Rosak;
use App\Models\FgvPmps\Tugasan;
use App\Models\User;

class FgvPmpsController extends Controller
{
    public function senarai_tugasan()
    {
        $tugasans = Tugasan::all();
        return $tugasans->toJson(JSON_PRETTY_PRINT);
    }

    public function cipta_tugasan(Request $request)
    {
        $user = $request->user();

        $tugasan = new Tugasan;
        $tugasan->pokok_id = $request->pokok_id;
        $tugasan->tandan_id = $request->tandan_id;
        $tugasan->pekerja_id = $request->pekerja_id;
        $tugasan->jenis = $request->jenis;
        $tugasan->status = 'mula';
        $tugasan->supervisor_id = $user->id;
        $tugasan->save();

        return $tugasan->toJson(JSON_PRETTY_PRINT);
    }

    public function siap_tugas(Request $request)
    {
        $id = (int)$request->route('id');
        $tugasan = Tugasan::find($id);

        $tugasan->gambar = $request->file('gambar')->store('giga/fgv-pmps/gambars');

        if ($tugasan->jenis == 'balut') {
            $tugasan->catatan_pekerja_balut = $request->catatan_pekerja_balut;
            $tugasan->status = 'balut-berjaya';
 

        } else if ($tugasan->jenis == 'debung') {
            $tugasan->catatan_pekerja_debung = $request->catatan_pekerja_debung;
            
            if ($tugasan->berjaya == 'ya') {
                $tugasan->status = 'debung-berjaya';
                $tugasan->no_debung = $request->no_debung;
                $tugasan->peratus_debung = $request->peratus_debung;
            } else {
                $tugasan->status = 'debung-tidak-berjaya';
            }

        } else if ($tugasan->jenis == 'kawalan') {
            $tugasan->catatan_pekerja_kawalan = $request->catatan_pekerja_kawalan;

            $tugasan->jenis_rosak = $request->jenis_rosak;
            $tugasan->catatan_rosak = $request->catatan_rosak;
            $tugasan->status = 'kawalan-berjaya';

        } else if ($tugasan->jenis == 'tuai') {
            $tugasan->catatan_pekerja_tuai = $request->catatan_pekerja_tuai;

            $tugasan->berat_tandan = $request->berat_tandan;
            $tugasan->status = 'tuai-berjaya';

        }

        $tugasan->tarikhmasa = $request->tarikhmasa;
        $tugasan->latitude = $request->latitude;
        $tugasan->longitude = $request->longitude;

        $tugasan->save();
        return $tugasan->toJson();
    }

    public function sah_tugas(Request $request)
    {
        $id = (int)$request->route('id');
        $tugasan = Tugasan::find($id);

        if ($tugasan->jenis == 'balut') {
            $tugasan->catatan_supervisor_balut = $request->catatan_supervisor_balut;
            $tugasan->status = 'balut-sah';
        } else if ($tugasan->jenis == 'debung') {
            $tugasan->catatan_supervisor_debung = $request->catatan_supervisor_debung;
            $tugasan->status = 'debung-sah';
        } else if ($tugasan->jenis == 'kawalan') {
            $tugasan->catatan_supervisor_kawalan = $request->catatan_supervisor_kawalan;
            $tugasan->status = 'kawalan-sah';
        } else if ($tugasan->jenis == 'tuai') {
            $tugasan->catatan_supervisor_tuai = $request->catatan_supervisor_tuai;
            $tugasan->status = 'tuai-sah';
        }
        $tugasan->save();
        return $tugasan->toJson();
    }

    public function lapor_rosak(Request $request)
    {
        $user = $request->user();
        $rosak = new Rosak;
        $rosak->gambar = $request->file('gambar')->store('giga/fgv-pmps/gambars');
        $rosak->catatan = $request->catatan;
        $rosak->user_id = $user->id;
        $rosak->save();
        return $rosak->toJson(JSON_PRETTY_PRINT);
    }

    public function profil(Request $request)
    {
        $user = $request->user();
        return $user->toJson(JSON_PRETTY_PRINT);
    }
}
