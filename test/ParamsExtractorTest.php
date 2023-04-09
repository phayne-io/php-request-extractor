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

use Mezzio\Router\RouteResult;
use Mezzio\Router\RouterInterface;
use Phayne\Request\Extractor\ParamsExtractor;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ParamsExtractorTest
 *
 * @package PhayneTest\Request\Extractor
 * @author Julien Guittard <julien@phayne.com>
 */
class ParamsExtractorTest extends TestCase
{
    use ProphecyTrait;

    public function testReturnsRequestParams(): void
    {
        $data = ['foo' => 'bar'];
        $request = $this->prophesize(ServerRequestInterface::class);
        $router = $this->prophesize(RouterInterface::class);
        $routeResult = $this->prophesize(RouteResult::class);
        $routeResult->getMatchedParams()->willReturn($data);
        $router->match($request)->willReturn($routeResult);
        $extractor = new ParamsExtractor($router->reveal());
        $this->assertEquals($data, $extractor->extractData($request->reveal()));
    }
}
