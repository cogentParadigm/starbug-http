<?php
namespace Starbug\Http;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
use Psr\Http\Message\UriInterface;

class UriBuilder implements UriBuilderInterface {

  /**
   * Base URI.
   *
   * @var UriInterface
   */
  protected $uri;

  /**
   * Build absolute URIs by default.
   *
   * @var boolean
   */
  protected $absolute = false;

  public function __construct(UriInterface $uri = null) {
    $this->uri = $uri;
  }

  /**
   * Set the base URI which built URIs will be relative to.
   *
   * @param UriInterface $uri
   */
  public function setBaseUri(UriInterface $uri) {
    $this->uri = $uri;
  }

  /**
   * Get the base URI.
   *
   * @return UriInterface
   */
  public function getBaseUri() : UriInterface {
    return $this->uri;
  }

  /**
   * Set the uri as absolute or not.
   *
   * @param boolean $absolute True to set as absolute, false otherwise.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setAbsolute(bool $absolute) {
    $this->absolute = $absolute;
  }

  /**
   * Build an output url.
   *
   * @param string|UriInterface $uri A specific path to output.
   *   If false or not specified and a path has been set (using setPath), that path will be used.
   * @param boolean $absolute True to return an absolute path or false to return a relative one.
   *
   * @return string The output url.
   */
  public function build($uri = "", bool $absolute = false) : UriInterface {
    $base = $this->uri;
    if (is_string($uri)) {
      $uri = new Uri($uri);
    }
    if (!($absolute || $this->absolute)) {
      $base = $base->withScheme('')->withHost('');
      $uri = $uri->withScheme('')->withHost('');
    }
    return UriResolver::resolve($base, $uri);
  }

  public function relativize($uri = "") {
    $base = $this->uri;
    if (is_string($uri)) {
      $uri = new Uri($uri);
    }
    return UriResolver::relativize($base, $uri);
  }
}
