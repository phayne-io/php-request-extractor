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

use Phayne\Request\Extractor;
use Psr\Container\ContainerInterface;

/**
 * Class DataExtractorChainFactory
 *
 * @package Phayne\Request\Extractor\Request
 * @author Julien Guittard <julien@phayne.com>
 */
final class DataExtractorChainFactory
{
    public function __invoke(ContainerInterface $container): Extractor\DataExtractorChain
    {
        return new Extractor\DataExtractorChain([
            $container->get(Extractor\QueryExtractor::class),
            $container->get(Extractor\BodyExtractor::class),
            $container->get(Extractor\FileExtractor::class),
            $container->get(Extractor\ParamsExtractor::class),
            $container->get(Extractor\AttributesExtractor::class),
        ]);
    }
}
