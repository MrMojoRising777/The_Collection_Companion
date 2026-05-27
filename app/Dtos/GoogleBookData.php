<?php

declare(strict_types=1);

namespace App\Dtos;

/**
 * @phpstan-type GoogleBooksApiResponse array{
 *      kind: string,
 *      totalItems: int,
 *      items: array<int, array{
 *          kind: string,
 *          id: string,
 *          etag: string,
 *          selfLink: string,
 *          volumeInfo: array{
 *              title: string,
 *              authors?: array<int, string>,
 *              publisher?: string,
 *              publishedDate?: string,
 *              description?: string,
 *              industryIdentifiers?: array<int, array{
 *                  type: string,
 *                  identifier: string
 *              }>,
 *              readingModes?: array{
 *                  text: bool,
 *                  image: bool
 *              },
 *              pageCount?: int,
 *              printType?: string,
 *              categories?: array<int, string>,
 *              maturityRating?: string,
 *              allowAnonLogging?: bool,
 *              contentVersion?: string,
 *              panelizationSummary?: array{
 *                  containsEpubBubbles: bool,
 *                  containsImageBubbles: bool,
 *                  epubBubbleVersion?: string,
 *                  imageBubbleVersion?: string
 *              },
 *              imageLinks?: array{
 *                  smallThumbnail: string,
 *                  thumbnail: string
 *              },
 *              language?: string,
 *              previewLink?: string,
 *              infoLink?: string,
 *              canonicalVolumeLink?: string
 *          },
 *          saleInfo?: array{
 *              country: string,
 *              saleability: string,
 *              isEbook: bool
 *          },
 *          accessInfo?: array{
 *              country: string,
 *              viewability: string,
 *              embeddable: bool,
 *              publicDomain: bool,
 *              textToSpeechPermission: string,
 *              epub?: array{
 *                  isAvailable: bool,
 *                  acsTokenLink?: string
 *              },
 *              pdf?: array{
 *                  isAvailable: bool,
 *                  acsTokenLink?: string
 *              },
 *              webReaderLink?: string,
 *              accessViewStatus?: string,
 *              quoteSharingAllowed?: bool
 *          },
 *          searchInfo?: array{
 *              textSnippet: string
 *          }
 *      }>
 *  }
 */
readonly class GoogleBookData
{
    public function __construct(
        public ?string $title,
        public ?string $author,
        public ?string $publishedDate,
        public ?string $isbn10,
        public ?string $isbn13,
        public ?string $language,
        public ?string $thumbnail,
    ) {}

    /**
     * @param GoogleBooksApiResponse $data
     */
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
