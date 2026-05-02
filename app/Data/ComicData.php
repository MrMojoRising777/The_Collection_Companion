<?php

declare(strict_types=1);

namespace App\Data;

class ComicData
{
    /**
     * @param array<int, array{
     *     id: int,
     *     name: string,
     *     abbreviation: string|null,
     *     period: string|null
     * }>|null $series
     */
    public function __construct(
        public ?string $isbn = null,
        public ?string $title = null,
        public ?array $series = null,
        public ?int $number = null,
        public ?string $year = null,
    ) {}

    public function toArray(): array
    {
        return [
            'isbn' => $this->isbn,
            'title' => $this->title,
            'series' => $this->series,
            'number' => $this->number,
            'year' => $this->year,
        ];
    }
}
