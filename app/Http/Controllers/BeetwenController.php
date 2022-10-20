<?php

namespace App\Http\Controllers;

use App\Models\Beetwen;
use Illuminate\Http\Request;

class BeetwenController extends Controller
{
    public function index(Request $request)
    {
        $beetwen = Beetwen::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
        return response()->json([
            'data' => $beetwen
        ]);
    }

    public function wherebulantahun(Request $request)
    {
        if (empty($request->year) && empty($request->month)) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', \Carbon\Carbon::now()->format('Y'))->whereMonth('tanggal', '=', \Carbon\Carbon::now()->format('m'))->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }

        if(empty($request->month)){
            if($request->year){
                $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->get();
                return response()->json([
                    'total' => $tahunbulan->count(),
                    'data' => $tahunbulan
                ]);
            }
        }
        
        if(empty($request->year)){
            $tahunbulan = Beetwen::whereMonth('tanggal', '=', $request->month)->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }


        if ($request->year && $request->month) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->whereMonth('tanggal', '=', $request->month)->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }




    }
}
