<?php

/**
 * This file is part of phayne-io/php-request-extractor package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see       https://github.com/phayne-io/php-request-extractor for the canonical source repository
 * @copyright Copyright (c) 2023 Phayne. (https://phayne.io)
 */

declare(strict_types=1);

namespace Phayne\Request\Extractor\Container\Middleware;

use Phayne\Request\Extractor\DataExtractorChain;
use Phayne\Request\Extractor\Middleware\ExtractorMiddleware;
use Psr\Container\ContainerInterface;

/**
 * Class ExtractorMiddlewareFactory
 *
 * @package Phayne\Request\Extractor\Container\Middleware
 * @author Julien Guittard <julien@phayne.com>
 */
final class ExtractorMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ExtractorMiddleware
    {
        return new ExtractorMiddleware(
            $container->get(DataExtractorChain::class)
        );
    }
}
