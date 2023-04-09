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

use Mezzio\Router\RouterInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ParamsExtractor
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
readonly class ParamsExtractor implements DataExtractorInterface
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function extractData(ServerRequestInterface $request): array
    {
        return $this->router->match($request)->getMatchedParams();
    }
}
