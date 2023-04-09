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

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface DataExtractorInterface
 *
 * @package Phayne\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
interface DataExtractorInterface
{
    public function extractData(ServerRequestInterface $request): mixed;
}
