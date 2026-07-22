<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\GoogleBookData;
use App\Exceptions\RateLimitException;
use App\Exceptions\UnavailableException;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Google Books API integration.
 *
 * Rate limits:
 * - 1,000 requests per day per Google Cloud project (default quota).
 * - 100 requests per minute per user.
 *
 * Response codes:
 * - 429: quota exceeded
 * - 503: service unavailable
 */
class GoogleApiService
{
    /**
     * @throws RateLimitException
     * @throws Throwable
     */
    public function fetch(string $isbn): ?GoogleBookData
    {
        try {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes", [
                'q' => "isbn:$isbn",
                'key' => config('services.google_books.key'),
            ]);

            if ($response->tooManyRequests()) {
                throw new RateLimitException(message: 'Google Books API rate limit exceeded.');
            }

            if ($response->status() === 503) {
                throw new UnavailableException(message: 'Google Books API is temporarily unavailable.');
            }

            if (! $response->successful()) {
                return null;
            }

            return GoogleBookData::fromGoogleBooks(data: $response->json());
        } catch (RateLimitException|UnavailableException $error) {
            throw $error;
        } catch (Throwable $error) {
            logger()->error('ISBN scrape failed', [
                'isbn' => $isbn,
                'error' => $error->getMessage()
            ]);

            return null;
        }
    }
}
