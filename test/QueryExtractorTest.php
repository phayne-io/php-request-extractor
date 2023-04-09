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

namespace PhayneTest\Request\Extractor;

use Phayne\Request\Extractor\QueryExtractor;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class QueryExtractorTest
 *
 * @package PhayneTest\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
class QueryExtractorTest extends TestCase
{
    use ProphecyTrait;

    public function testReturnsRequestQuery(): void
    {
        $data = ['foo' => 'bar'];
        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getQueryParams()->willReturn($data);
        $extractor = new QueryExtractor();
        $this->assertEquals($data, $extractor->extractData($request->reveal()));
    }
}
