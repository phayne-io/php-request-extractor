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

namespace Phayne\Request\Extractor\Middleware;

use Phayne\Request\Extractor\DataExtractorChain;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class ExtractorMiddleware
 *
 * @package Phayne\Request\Extractor\Middleware
 * @author Julien Guittard <julien@phayne.com>
 */
final readonly class ExtractorMiddleware implements MiddlewareInterface
{
    public const REQUEST_DATA = 'requestData';

    public function __construct(private DataExtractorChain $extractorChain)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle(
            $request->withAttribute(self::REQUEST_DATA, $this->extractorChain->getDataFromRequest($request))
        );
    }
}
