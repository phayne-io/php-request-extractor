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

namespace Phayne\Request\Extractor;

/**
 * Class ConfigProvider
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->dependencies(),
        ];
    }

    public function dependencies(): array
    {
        return [
            'invokables' => [
                BodyExtractor::class => BodyExtractor::class,
                FileExtractor::class => FileExtractor::class,
                QueryExtractor::class => QueryExtractor::class,

            ],
            'factories' => [
                AttributesExtractor::class => Container\AttributesExtractorFactory::class,
                DataExtractorChain::class => Container\DataExtractorChainFactory::class,
                ParamsExtractor::class => Container\ParamsExtractorFactory::class,
                Middleware\ExtractorMiddleware::class => Container\Middleware\ExtractorMiddlewareFactory::class,
            ],
        ];
    }
}
