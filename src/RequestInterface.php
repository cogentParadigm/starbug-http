<?php
namespace Starbug\Http;

/**
 * A simple interface to represent an HTTP request.
 */
interface RequestInterface {

  /**
   * Set request url.
   *
   * @param UrlInterface $url The request url.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setUrl(UrlInterface $url);

  /**
   * Get the request url.
   *
   * @return UrlInterface The request url.
   */
  public function getUrl();

  /**
   * Set the path.
   *
   * @param string $path The new path.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPath(string $path);

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getPath();

  /**
   * Undocumented function
   *
   * @param string $name
   * @param [type] $value
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameter(string $name, $value);

  /**
   * Check if a parameter value is present.
   *
   * @param string $name The parameter name.
   *
   * @return boolean
   */
  public function hasParameter(string $name);

  /**
   * Get a parameter value.
   *
   * @param string $name The parameter name.
   *
   * @return void
   */
  public function getParameter(string $name);

  /**
   * Set a list of parameters.
   *
   * @param array $parameters An associative array mapping parameter names to values.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameters(array $parameters);

  /**
   * Get all parameters.
   *
   * @return void
   */
  public function getParameters();

  /**
   * Get the request format.
   *
   * @return void
   */
  public function getFormat();

  /**
   * Get a component of the URL path by position.
   *
   * @param integer $index The index position of the component.
   *
   * @return void
   */
  public function getComponent(int $index = 0);

  /**
   * Undocumented function
   *
   * @param string $language
   *
   * @return $this This instance so setters are chainable.
   */
  public function setLanguage(string $language);

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getLanguage();

  /**
   * Undocumented function
   *
   * @param string $post
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPost($post);

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getPost();

  /**
   * Undocumented function
   *
   * @param mixed $post
   *
   * @return boolean
   */
  public function hasPost($post);

  /**
   * Undocumented function
   *
   * @param string $header
   * @param string $value
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHeader(string $header, string $value);

  /**
   * Undocumented function
   *
   * @param array $headers
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHeaders(array $headers);

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getHeaders();

  /**
   * Undocumented function
   *
   * @param string $name
   *
   * @return void
   */
  public function getHeader(string $name);

  /**
   * Undocumented function
   *
   * @param array $files
   *
   * @return $this This instance so setters are chainable.
   */
  public function setFiles(array $files);

  /**
   * Get files.
   *
   * @return array The files.
   */
  public function getFiles();

  /**
   * Set cookie by name.
   *
   * @param string $name The name of the cookie.
   * @param string $value The cookie properties.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCookie(string $name, string $value);

  /**
   * Get cookie by name.
   *
   * @param string $name The name of the cookie.
   *
   * @return array The cookie.
   */
  public function getCookie(string $name);

  /**
   * Set cookies.
   *
   * @param array $cookies The array of cookies.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCookies(array $cookies);

  /**
   * Get cookies.
   *
   * @return array List of cookies.
   */
  public function getCookies();
}
