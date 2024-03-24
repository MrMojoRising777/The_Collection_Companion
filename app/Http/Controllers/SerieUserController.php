<?php

namespace App\Http\Controllers;

use App\Models\SerieUser;
use Illuminate\Http\Request;

class SerieUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $series = SerieUser::with(['serie' => function ($query) {
            $query->withCount('albums');
        }])
        ->where('user_id', $user->id)
        ->get();

        return view('collection.series.index', compact('series', 'user'));
    }
}
