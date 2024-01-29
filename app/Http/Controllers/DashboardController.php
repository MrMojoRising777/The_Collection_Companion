<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAlbums = $this->getRecentAdditions();
        $valueAlbums = $this->getMostValued();

        $groupedAlbums = $this->getGroupedAlbums();
        $groupedObtainedAlbums = $this->getGroupedObtainedAlbums();
        $seriesPercentages = $this->calculateObtainedPercentage($groupedAlbums, $groupedObtainedAlbums);

        return view('dashboard', compact('recentAlbums', 'valueAlbums', 'seriesPercentages'));
    }

    private function getGroupedAlbums()
    {
        return $this->getGroupedAlbumsQuery()->get()->groupBy('serie.name');
    }

    private function getGroupedObtainedAlbums()
    {
        return $this->getGroupedAlbumsQuery()->where('obtained', 1)->get()->groupBy('serie.name');
    }

    private function getGroupedAlbumsQuery()
    {
        return Album::with('comics', 'serie')->orderBy('serie_id');
    }

    private function calculateObtainedPercentage($groupedAlbums, $groupedObtainedAlbums)
    {
        $percentageData = collect($groupedAlbums)->map(function ($albums, $seriesName) use ($groupedObtainedAlbums) {
            $totalAlbums = count($albums);
            $obtainedAlbums = $groupedObtainedAlbums->has($seriesName) ? count($groupedObtainedAlbums[$seriesName]) : 0;
            $percentage = ($totalAlbums > 0) ? round(($obtainedAlbums / $totalAlbums) * 100) : 0;

            return [
                'serie_name' => $seriesName,
                'total' => $totalAlbums,
                'obtained' => $obtainedAlbums,
                'percentage' => $percentage,
            ];
        });

        return $percentageData;
    }

    private function getRecentAdditions()
    {
        return $this->getGroupedAlbumsQuery()->orderBy('updated_at', 'desc')->take(10)->get();
    }

    private function getMostValued()
    {
        return $this->getGroupedAlbumsQuery()->where('obtained', 1)->orderBy('value', 'desc')->take(5)->get();
    }
}
