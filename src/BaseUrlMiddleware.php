<?php
namespace Starbug\Http;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BaseUrlMiddleware implements MiddlewareInterface {
  protected $baseUrl;
  public function __construct($baseUrl = "/") {
    $this->baseUrl = $baseUrl;
  }
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {

    // Remove the base URL before handling the request.
    $request = $this->withoutBaseUrl($request);

    // Handle the request and obtain the response.
    $response = $handler->handle($request);

    // Add the base URL to the Location header if needed.
    return $this->redirectWithBaseUrl($response);
  }
  /**
   * Removes the base URL from a request.
   *
   * @param ServerRequestInterface $request
   *
   * @return ServerRequestInterface
   */
  protected function withoutBaseUrl(ServerRequestInterface $request): ServerRequestInterface {
    if ($this->baseUrl != "/") {
      $path = $request->getUri()->getPath();
      $uri = $request->getUri()->withPath("/" . substr($path, strlen($this->baseUrl)));
      return $request->withUri($uri);
    }
    return $request;
  }
  /**
   * Adds the base URL to the response Location header.
   *
   * @param ResponseInterface $response
   *
   * @return ResponseInterface
   */
  protected function redirectWithBaseUrl(ResponseInterface $response): ResponseInterface {
    $location = $response->getHeaderLine("Location");
    if ($location !== "" && Uri::isRelativePathReference(new Uri($location))) {
      return $response->withHeader("Location", $this->baseUrl . $location);
    }
    return $response;
  }
}
