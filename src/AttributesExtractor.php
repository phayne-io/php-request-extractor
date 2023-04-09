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
use function array_intersect_key;
use function array_key_exists;
use function is_array;

/**
 * Class AttributesExtractor
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
readonly class AttributesExtractor implements DataExtractorInterface
{
    public function __construct(private array $config, private RouterInterface $router)
    {
    }

    public function extractData(ServerRequestInterface $request): array
    {
        $matchedRoute = $this->router->match($request)->getMatchedRoute();

        if (false === $matchedRoute) {
            return [];
        }

        if (empty($this->config)) {
            return $request->getAttributes();
        }

        foreach ($this->config as $routeName => $options) {
            if (
                $routeName === $matchedRoute->getName()
                && array_key_exists('attributes', $options)
                && is_array($options['attributes'])
            ) {
                $return = [];
                $attributes = array_intersect_key($options['attributes'], $request->getAttributes());

                foreach ($attributes as $key => $attribute) {
                    $return[$attribute] = $request->getAttribute($key);
                }

                return $return;
            }
        }

        return [];
    }
}
