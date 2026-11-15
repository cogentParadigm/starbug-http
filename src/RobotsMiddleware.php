<?php
namespace Starbug\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Adds an X-Robots-Tag header so crawlers that do fetch the page are told
 * not to index it. Applications decide the flag; the package stays free of
 * any settings dependency.
 */
class RobotsMiddleware implements MiddlewareInterface {
  public function __construct(
    protected bool $noindex
  ) {
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $response = $handler->handle($request);
    if ($this->noindex) {
      $response = $response->withHeader("X-Robots-Tag", "noindex");
    }
    return $response;
  }
}
