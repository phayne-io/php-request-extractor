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

namespace Phayne\Request\Extractor\Container;

use Mezzio\Router\RouterInterface;
use Phayne\Request\Extractor\ParamsExtractor;
use Psr\Container\ContainerInterface;

/**
 * Class ParamsExtractorFactory
 *
 * @package Phayne\Request\Extractor\Request
 * @author Julien Guittard <julien@phayne.com>
 */
final class ParamsExtractorFactory
{
    public function __invoke(ContainerInterface $container): ParamsExtractor
    {
        return new ParamsExtractor(
            $container->get(RouterInterface::class)
        );
    }
}
