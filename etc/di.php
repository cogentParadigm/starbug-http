<?php
namespace Starbug\Http;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

use function DI\autowire;
use function DI\factory;
use function DI\get;

return [
  "Starbug\Http\*Interface" => autowire("Starbug\Http\*"),
  "Starbug\Http\UriBuilderInterface" => factory(function (ContainerInterface $container, $siteUrl) {
    $request = $container->get(ServerRequestInterface::class);
    $baseUri = $request->getUri()
      ->withPath($siteUrl)
      ->withQuery("")
      ->withFragment("");
    return new UriBuilder($baseUri);
  })->parameter("siteUrl", get("website_url")),
  "Psr\Http\Message\UriInterface" => factory(function (ContainerInterface $container, ServerRequestInterface $request) {
    return $request->getUri();
  }),
  "Psr\Http\Message\ResponseFactoryInterface" => autowire("Http\Factory\Guzzle\ResponseFactory"),
  "Psr\Http\Message\ServerRequestInterface" => function (ContainerInterface $container) {
    return new ServerRequest("GET", $container->get("website_host").$container->get("website_url"));
  },
  "Middlewares\Https" => autowire()
    ->constructorParameter("responseFactory", get("Http\Factory\Guzzle\ResponseFactory"))
    ->method("includeSubdomains")
];
