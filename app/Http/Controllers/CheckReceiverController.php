<?php

namespace App\Http\Controllers;

use App\Models\Population;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class CheckReceiverController extends Controller
{
    public function bantuan(Request $request)
    {
        try {
            // check if exist
            $check = Population::where([
                'card_id_number' => $request->no_ktp,
                'family_card_id' => $request->no_kk
            ])->first();

            if (!$check) {
                Flash::error('Data tidak ditemukan, pastikan nomor ktp dan nomor kk benar');
                return redirect()->back();
            }

            $checkUser = User::where('email', $request->no_ktp)->first();

            if (!$checkUser) {
                Flash::error('Data tidak ditemukan, pastikan nomor ktp dan nomor kk benar');
                return redirect()->back();
            }
            // attempt to login
            Auth::loginUsingId($checkUser->id, true);

            return redirect()->route('dashboards.index');
        } catch (\Throwable $th) {
            Flash::error('Terjadi kesalahan saat memproses data');
            Log::emergency("Message:" . $th->getMessage());
            return redirect()->back();
        }
    }
}
