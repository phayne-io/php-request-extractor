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
use Phayne\Request\Extractor\AttributesExtractor;
use Psr\Container\ContainerInterface;

/**
 * Class AttributesExtractorFactory
 *
 * @package Phayne\Request\Extractor\Request
 * @author Julien Guittard <julien@phayne.com>
 */
final class AttributesExtractorFactory
{
    public function __invoke(ContainerInterface $container): AttributesExtractor
    {
        return new AttributesExtractor(
            [],
            $container->get(RouterInterface::class)
        );
    }
}
