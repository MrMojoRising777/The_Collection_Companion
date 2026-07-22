<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\ComicData;
use App\Models\Album;
use App\Models\Edition;
use Illuminate\Support\Collection;
use Throwable;

class ComicResolverService
{
    /**
     * @throws Throwable
     */
    public function resolveFromIsbn(string $isbn): ?ComicData
    {
        $book = app(GoogleApiService::class)->fetch(isbn: $isbn);

        if (! $book) {
            return null;
        }

        return new ComicData(
            isbn: $isbn,
            title: $book->title,
            year: $book->publishedDate,
        );
    }

    /**
     * @return Collection<int, ComicData>
     */
    public function resolveFromSearch(string $query): Collection
    {
        // later: DB / IGDB / fuzzy match
        $results = Album::query()
            ->with('editions.serie')
            ->where('name', 'like', "%{$query}%")
            ->get();

        return $results->map(fn (Album $album): ComicData => new ComicData(
            title: $album->name,
            series: $album->editions
                ->map(fn (Edition $edition): array => $edition->serie
                    ? [
                        ...$edition->serie->toArray(),
                        'volume' => $edition->volume,
                        'editionId' => $edition->id,
                    ]
                    : null
                )
                ->filter()
                ->unique('id')
                ->values()
                ->all(),
        ));
    }
}
