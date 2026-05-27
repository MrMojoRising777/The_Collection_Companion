<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Data\ComicData;
use App\Dtos\GoogleBookData;
use App\Services\ComicResolverService;
use App\Services\IsbnScraperService;
use Database\Factories\AlbumFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class ComicResolverServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_resolve_from_isbn_returns_comic_data(): void
    {
        $book = new GoogleBookData(
            title: 'De Hellegathonden',
            author: 'Willy Vandersteen',
            publishedDate: null,
            isbn10: null,
            isbn13: null,
            language: null,
            thumbnail: null,
        );

        $mock = Mockery::mock(IsbnScraperService::class);
        $mock->shouldReceive('fetch')
            ->once()
            ->with('9789002153624')
            ->andReturn($book);

        $this->app->instance(IsbnScraperService::class, $mock);

        $service = app(ComicResolverService::class);

        $result = $service->resolveFromIsbn(isbn: '9789002153624');

        $this->assertInstanceOf(ComicData::class, $result);
        $this->assertEquals('De Hellegathonden', $result->title);
        $this->assertEquals('9789002153624', $result->isbn);
    }

    public function test_resolve_from_search_returns_comic_data(): void
    {
        AlbumFactory::new()->create([
            'name' => 'De hellegathonden',
        ]);

        $service = app(ComicResolverService::class);

        $result = $service->resolveFromSearch(query: 'de helle');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertNotEmpty($result);

        $comic = $result->first();

        $this->assertInstanceOf(ComicData::class, $comic);
        $this->assertEquals('de hellegathonden', strtolower($comic->title));
    }
}
