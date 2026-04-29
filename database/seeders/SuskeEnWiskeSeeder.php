<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Comic;
use App\Models\Serie;
use App\Models\Album;

class SuskeEnWiskeSeeder extends Seeder
{
    public function run()
    {
        // 1. Create comic
        $comic = Comic::firstOrCreate([
            'name' => 'Suske en Wiske'
        ]);

        // 2. Create series
        $seriesData = [
            ['name' => 'Vlaamse ongekleurde reeks',      'abbreviation' => 'VO', 'period' => '1946-1959'],
            ['name' => 'Blauwe reeks',                   'abbreviation' => 'BR', 'period' => '1952-1957'],
            ['name' => 'Hollandse ongekleurde reeks',    'abbreviation' => 'HO', 'period' => '1953-1959'],
            ['name' => 'Vlaamse tweekleurenreeks',       'abbreviation' => 'VT', 'period' => '1959-1964'],
            ['name' => 'Hollandse tweekleurenreeks',     'abbreviation' => 'HT', 'period' => '1959-1964'],
            ['name' => 'Gezamenlijke tweekleurenreeks',  'abbreviation' => 'GT', 'period' => '1964-1966'],
            ['name' => 'Vierkleurenreeks',               'abbreviation' => 'VK', 'period' => '1967-heden'],
            ['name' => 'Strip Klassiek reeks',           'abbreviation' => 'SK', 'period' => '1981-1984'],
            ['name' => 'Dubbelstrips',                   'abbreviation' => 'DS', 'period' => '1985-1987'],
            ['name' => 'Rode Klassiek reeks',            'abbreviation' => 'RK', 'period' => '1993-1999'],
            ['name' => 'Blauwe Klassiek reeks',          'abbreviation' => 'BK', 'period' => '1993-1997'],
            ['name' => 'Pocket Reeks',                   'abbreviation' => 'PR', 'period' => '2007-2014'],
            ['name' => 'Suske en Wiske Classics',        'abbreviation' => 'CL', 'period' => '2017-2019'],
            ['name' => 'Hommagereeks',                   'abbreviation' => 'HR', 'period' => '2017-heden'],
            ['name' => 'Suske en Wiske in het kort',     'abbreviation' => 'KV', 'period' => '2019-2025'],
            ['name' => 'Lecturama Originele Verhalen',   'abbreviation' => 'LO', 'period' => null],
            ['name' => 'Lecturama Collectie',            'abbreviation' => 'LC', 'period' => '1986-heden'],
        ];

        foreach ($seriesData as $serie) {
            Serie::updateOrCreate(
                ['abbreviation' => $serie['abbreviation']],
                [
                    'comic_id' => $comic->id,
                    'name'     => $serie['name'],
                    'period'   => $serie['period'],
                ]
            );
        }

        $seriesMap = Serie::pluck('id', 'abbreviation')->toArray();

        // 3. Scrape Wikipedia
        $url = 'https://nl.wikipedia.org/wiki/Lijst_van_verhalen_van_Suske_en_Wiske';

        $response = Http::withHeaders([
            'User-Agent'      => 'Mozilla/5.0 (Laravel Scraper)',
            'Accept-Language' => 'nl-NL,nl;q=0.9,en;q=0.8',
        ])->get($url);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch Wikipedia page');
        }

        $crawler = new Crawler($response->body());

        $crawler->filter('table.wikitable tbody tr')->each(function ($row, $rowIndex) use ($seriesMap) {

            if ($rowIndex === 0) return;

            $cells = $row->filter('td');
            if ($cells->count() < 3) return;

            $titleNode = $cells->eq(2)->filter('a');
            $title = $titleNode->count()
                ? trim($titleNode->text())
                : trim($cells->eq(2)->text());

            if (! $title) return;

            // No more comic_id on albums
            $album = Album::firstOrCreate(['name' => $title]);

            // Series columns → creates/updates rows in the editions table
            for ($i = 3; $i < $cells->count(); $i++) {

                $value = trim($cells->eq($i)->text());

                if ($value === '' || $value === '0') continue;

                $abbr = $this->getSeriesAbbreviationByIndex($i);

                if (!$abbr || !isset($seriesMap[$abbr])) continue;

                $serieId = $seriesMap[$abbr];

                // syncWithoutDetaching handles both insert and update
                $album->series()->syncWithoutDetaching([
                    $serieId => ['volume' => $value],
                ]);
            }
        });
    }

    private function getSeriesAbbreviationByIndex(int $index): ?string
    {
        return [
            3 => 'VO',
            4 => 'BR',
            5 => 'HO',
            6 => 'VT',
            7 => 'HT',
            8 => 'GT',
            9 => 'VK',
            10 => 'SK',
            11 => 'DS',
            12 => 'RK',
            13 => 'BK',
            14 => 'PR',
            15 => 'CL',
            16 => 'HR',
            17 => 'KV',
            18 => 'LO',
            19 => 'LC',
        ][$index] ?? null;
    }
}
