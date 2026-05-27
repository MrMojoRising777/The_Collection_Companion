<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\GoogleBookData;
use Illuminate\Support\Facades\Http;
use Throwable;

class IsbnScraperService
{
    /**
     * @throws Throwable
     */
    public function fetch(string $isbn): ?GoogleBookData
    {
        try {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes", [
                'q' => "isbn:{$isbn}",
                'key' => config('services.google_books.key'),
            ]);

            if ($response->tooManyRequests()) {
                throw new \RuntimeException('RATE_LIMITED');
            }

            if (! $response->successful()) {
                return null;
            }

            return GoogleBookData::fromGoogleBooks(data: $response->json());
        } catch (Throwable $error) {
            if ($error->getMessage() === 'RATE_LIMITED') {
                throw $error;
            }

            logger()->error('ISBN scrape failed', [
                'isbn' => $isbn,
                'error' => $error->getMessage()
            ]);

            return null;
        }
    }
}
