<?php

declare(strict_types=1);

namespace App\Dtos;

class BookData
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $author,
        public readonly ?string $publishedDate,
        public readonly ?string $isbn10,
        public readonly ?string $isbn13,
        public readonly ?string $language,
        public readonly ?string $thumbnail,
    ) {}

    public static function fromGoogleBooks(array $data): ?self
    {
        if (empty($data['items'][0]['volumeInfo'])) {
            return null;
        }

        $info = $data['items'][0]['volumeInfo'];

        $isbn10 = null;
        $isbn13 = null;

        foreach ($info['industryIdentifiers'] ?? [] as $identifier) {
            if ($identifier['type'] === 'ISBN_10') {
                $isbn10 = $identifier['identifier'];
            }

            if ($identifier['type'] === 'ISBN_13') {
                $isbn13 = $identifier['identifier'];
            }
        }

        return new self(
            title: $info['title'] ?? null,
            author: $info['authors'][0] ?? null,
            publishedDate: $info['publishedDate'] ?? null,
            isbn10: $isbn10,
            isbn13: $isbn13,
            language: $info['language'] ?? null,
            thumbnail: $info['imageLinks']['thumbnail'] ?? null,
        );
    }
}
