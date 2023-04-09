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

use Phayne\Exception\UnexpectedValueException;
use Psr\Http\Message\ServerRequestInterface;
use Traversable;
use function array_map;
use function array_merge;
use function get_class;
use function gettype;
use function is_array;
use function is_object;
use function iterator_to_array;
use function sprintf;

/**
 * Class DataExtractorChain
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
readonly class DataExtractorChain
{
    public function __construct(private array $extractors)
    {
    }

    public function getDataFromRequest(ServerRequestInterface $request): array
    {
        $result = [];

        $dataSets = array_map(
            function (DataExtractorInterface $extractor) use ($request) {
                $data = $extractor->extractData($request);

                if ($data instanceof Traversable) {
                    $data = iterator_to_array($data);
                }

                if (! is_array($data)) {
                    throw new UnexpectedValueException(
                        sprintf(
                            'Data Extractor `%s` returned a `%s` instead of an `array`',
                            get_class($extractor),
                            is_object($data) ? get_class($data) : gettype($data)
                        )
                    );
                }

                return $data;
            },
            $this->extractors
        );

        foreach ($dataSets as $data) {
            $result = array_merge($result, $data);
        }

        return $result;
    }
}
