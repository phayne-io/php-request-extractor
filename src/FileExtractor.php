<?php
//phpcs:ignorefile

/**
 * This file is part of phayne-io/php-request-extractor package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see       https://github.com/phayne-io/php-request-extractor for the canonical source repository
 * @copyright Copyright (c) 2023 Phayne. (https://phayne.io)
 */

declare(strict_types=1);

namespace Phayne\Request\Extractor;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Class FileExtractor
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
readonly class FileExtractor implements DataExtractorInterface
{
    public function extractData(ServerRequestInterface $request): array
    {
        $files = [];
        $uploadedFiles = $request->getUploadedFiles();

        if (false === empty($uploadedFiles)) {
            foreach ($uploadedFiles as $key => $uploadedFile) {
                $files[$key] = $this->uploadedFileToArray($uploadedFile);
            }
        }

        return $files;
    }

    private function uploadedFileToArray(UploadedFileInterface $uploadedFile): array
    {
        if (! $uploadedFile->getError()) {
            $stream = $uploadedFile->getStream();

            return [
                'tmp_name' => $stream->getMetadata('uri'),
                'name' => $uploadedFile->getClientFilename(),
                'type' => $uploadedFile->getClientMediaType(),
                'size' => $uploadedFile->getSize(),
                'error' => $uploadedFile->getError()
            ];
        }

        return [];
    }
}
