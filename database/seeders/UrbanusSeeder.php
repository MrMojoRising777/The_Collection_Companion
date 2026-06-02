<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comic;
use App\Models\Serie;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Album;
use Throwable;

class UrbanusSeeder extends Seeder
{
    /**
     * @throws Exception when page fetch fails
     */
    public function run(): void
    {
        // 1. Comic
        /** @var Comic $comic */
        $comic = Comic::query()->firstOrCreate([
            'name' => 'Urbanus',
        ]);

        // 2. Serie (single main series)
        /** @var Serie $serie */
        $serie = Serie::query()->updateOrCreate(
            ['abbreviation' => 'URB'],
            [
                'comic_id' => $comic->id,
                'name' => 'Urbanus reeks',
                'period' => '1983-heden',
            ]
        );

        // 3. Fetch page
        $url = 'https://www.urbanus.be/urbanusstrip/urbanusstriplijst.php';

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Laravel Scraper)',
            'Accept-Language' => 'nl-NL,nl;q=0.9,en;q=0.8',
        ])->get($url);

        if (! $response->successful()) {
            throw new Exception('Failed to fetch page');
        }

        $crawler = new Crawler($response->body());

        // Select SECOND table (index 1)
        $table = $crawler->filter('table')->eq(1);

        $table->filter('tr')->each(function (
            Crawler $row,
        ) use ($serie): void {
            $cells = $row->filter('td');

            if ($cells->count() < 3) {
                return;
            }

            // 1. Volume number
            $number = trim($cells->eq(0)->text());
            $number = rtrim($number, '.');

            // 2. Title
            $titleNode = $cells->eq(1)->filter('a');
            $title = $titleNode->count()
                ? trim($titleNode->text())
                : trim($cells->eq(1)->text());

            // 3. Release date
            $releaseDate = trim($cells->eq(2)->text());

            if (! $title) {
                return;
            }

            // 4. Album
            /** @var Album $album */
            $album = Album::query()
                ->firstOrCreate([
                    'name' => $title,
                ]);

            // 5. Attach to serie
            $album->series()->syncWithoutDetaching([
                $serie->id => [
                    'volume' => $number,
                    'release_date' => $this->parseDate(date: $releaseDate),
                ],
            ]);
        });
    }

    private function parseDate(string $date): ?string
    {
        try {
            return Carbon::parseFromLocale($date, 'nl')
                ->format('Y-m-d');
        } catch (Throwable) {
            return null;
        }
    }
}
