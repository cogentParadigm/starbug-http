<?php
namespace Starbug\Http;

use Psr\Http\Message\UriInterface;

/**
 * Simple interface for building output URIs based on Psr\Http\Message\UriInterface.
 */
interface UriBuilderInterface {

  /**
   * Set the base URI which built URIs will be relative to.
   *
   * @param UriInterface $uri
   */
  public function setBaseUri(UriInterface $uri);

  /**
   * Get the base URI.
   *
   * @return UriInterface
   */
  public function getBaseUri() : UriInterface;

  /**
   * Set the uri as absolute or not.
   *
   * @param boolean $absolute True to set as absolute, false otherwise.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setAbsolute(bool $absolute);

  /**
   * Build an output url.
   *
   * @param string|false $path A specific path to output.
   *   If false or not specified and a path has been set (using setPath), that path will be used.
   * @param boolean $absolute True to return an absolute path or false to return a relative one.
   *
   * @return string The output url.
   */
  public function build($path = false, bool $absolute = false);
}
