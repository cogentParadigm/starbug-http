<?php
namespace Starbug\Http;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestInjectionMiddleware implements MiddlewareInterface {
  protected $container;
  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
    $this->container->set("Psr\Http\Message\ServerRequestInterface", $request);
    return $handler->handle($request);
  }
}
