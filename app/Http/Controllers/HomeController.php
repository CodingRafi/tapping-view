<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){
        $asset = [
            'card' => asset('assets/card.png')
        ];

        return Inertia::render('Home.vue', compact('asset'));
    }

    public function absen(Request $request){
        $response = Http::post(config('services.url') . '/api/absen', [
            'rfid' => $request->rfid,
        ])->json();

        return $response;
    }
}
