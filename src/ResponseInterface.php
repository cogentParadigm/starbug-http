<?php
namespace Starbug\Http;

/**
 * A simple interface to represent an HTTP response.
 */
interface ResponseInterface {

  /**
   * Get headers.
   *
   * @return array List of headers.
   */
  public function getHeaders();

  /**
   * Set headers.
   *
   * @param array $headers A list of headers, keyed by name.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHeaders(array $headers = []);

  /**
   * Get a header value by name.
   *
   * @param string $name The header name.
   *
   * @return string The header value.
   */
  public function getHeader(string $name);

  /**
   * Set a header value by name.
   *
   * @param string $name The header name.
   * @param string|null $value The header value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHeader(string $name, $value = null);

  /**
   * Get cookies.
   *
   * @return array List of cookies.
   */
  public function getCookies();

  /**
   * Set cookies.
   *
   * @param array $cookies The cookies to set.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCookies(array $cookies = []);

  /**
   * Get cookies.
   *
   * @param string $name The cookie name.
   *
   * @return array The cookie value.
   */
  public function getCookie(string $name);

  /**
   * Set cookies.
   *
   * @param string $name The cookie name.
   * @param array|null $value The cookie properties.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCookie(string $name, $value = null);

  /**
   * Get the response code.
   *
   * @return integer The response code number.
   */
  public function getCode();

  /**
   * Set the response code.
   *
   * @param integer $code The response code number.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCode(int $code);

  /**
   * Get the content type.
   *
   * @return string The content type.
   */
  public function getContentType();

  /**
   * Set the content type.
   *
   * @param string $type The content type to set.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setContentType(string $type);

  /**
   * Get the character set.
   *
   * @return string The charset header value.
   */
  public function getCharset();

  /**
   * Set the charset.
   *
   * @param string $charset The charset value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCharset(string $charset);

  /**
   * Get the content data.
   *
   * @return mixed Content data.
   */
  public function getContent();

  /**
   * Set the content data.
   *
   * @param mixed $content The content data.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setContent($content);

  /**
   * Get callable, which can be set to produce the content data.
   *
   * @return callable The output callable.
   */
  public function getCallable();

  /**
   * Set callable to be triggered for content output.
   *
   * @param callable $callable A callable which produces content output.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setCallable(callable $callable);

  /**
   * Set response parameter.
   *
   * @param string $name The parameter name.
   * @param mixed $value The parameter value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameter(string $name, $value);

  /**
   * Set response parameters.
   *
   * @param array $parameters The parameters to set.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameters(array $parameters = []);

  /**
   * Determine if a parameter is specified.
   *
   * @param string $name The parameter name.
   *
   * @return boolean True if the parameter is specified, false otherwise.
   */
  public function hasParameter(string $name);

  /**
   * Get response parameter.
   *
   * @param string $name The parameter name.
   *
   * @return mixed The parameter value.
   */
  public function getParameter(string $name);

  /**
   * Get all parameters.
   *
   * @return array list of parameters keyed by name.
   */
  public function getParameters();

  /**
   * Remove a parameter by name.
   *
   * @param string $name The parameter name.
   *
   * @return $this This instance so setters are chainable.
   */
  public function removeParameter(string $name);

  /**
   * Clear all parameters.
   *
   * @return $this This instance so setters are chainable.
   */
  public function clearParameters();

  public function getTemplate();
  public function setTemplate($template);
  public function getScripts();
  public function setScripts($scripts = []);
  public function getScript($name);
  public function setScript($name, $value = null);

  /**
   * Send the response.
   *
   * @return void
   */
  public function send();

  /**
   * Set the responsing to a not found (404) status.
   *
   * @return $this This instance so setters are chainable.
   */
  public function missing();

  /**
   * Set the response to a forbidden (403) status.
   *
   * @return $this This instance so setters are chainable.
   */
  public function forbidden();
}
