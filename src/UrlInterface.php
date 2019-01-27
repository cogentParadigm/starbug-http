<?php
namespace Starbug\Http;

/**
 * Simple interface for Url value representation.
 *
 * This implementation is designed for abstracting urls in a server application.
 * It is used to encapsulate request urls and generate output urls within the Starbug PHP framework.
 *
 * The representation can be described as follows:
 *
 * [{scheme}://][{user}[:{password}]@]{host}[:{port}]{directory}{path}[.{format}][?{parameters}][#{fragment}]
 *
 * Comparing to RFC 3986 syntax components:
 * - authority is split into user and password.
 * - path is split into directory, path, and format.
 * - query is called parameters and is an associative array rather than a string.
 *
 * The directory segment is where relative paths are relative to - by default the root directory ('/').
 */
interface UrlInterface {

  /**
   * Set the scheme.
   *
   * @param string $scheme The name of the scheme such as 'http' or 'https'.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setScheme(string $scheme);

  /**
   * Get the scheme.
   *
   * @return string The scheme name, or an empty value when no scheme has been set.
   */
  public function getScheme();

  /**
   * Set the host.
   *
   * @param string $host The host address.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHost(string $host);

  /**
   * Get the host.
   *
   * @return string The host address.
   */
  public function getHost();

  /**
   * Set the port.
   *
   * @param integer $port The port number.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPort(int $port);

  /**
   * Get the port.
   *
   * @return integer The port number.
   */
  public function getPort();

  /**
   * Set user.
   *
   * @param string $user The user name.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setUser(string $user);

  /**
   * Get user.
   *
   * @return string The user name.
   */
  public function getUser();

  /**
   * Get password.
   *
   * @param string $password The password.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPassword(string $password);

  /**
   * Get the password.
   *
   * @return string The password.
   */
  public function getPassword();

  /**
   * Set a relative base directory.
   *
   * @param string $dir The directory - with leading and trailing slashes.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setDirectory(string $dir);

  /**
   * Get the relative base directory.
   *
   * @return string The root directory ('/') is assumed by default.
   */
  public function getDirectory();

  /**
   * Get a path component by index.
   *
   * @param integer $index The zero-indexed position of the desired path component.
   *
   * @return string The component at the specified index.
   */
  public function getComponent(int $index = 0);

  /**
   * Get all path components (slash separated segments).
   *
   * @return array The path components.
   */
  public function getComponents();

  /**
   * Set the path.
   *
   * @param string $path The path - without base directory or leading slash.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPath(string $path);

  /**
   * Get the path.
   *
   * @return string The path - without base directory or leading slash.
   */
  public function getPath();

  /**
   * Set the format.
   *
   * @param string $format The format such as 'html' or 'json'.
   *
   * @return $this This instance so that setters are chainable.
   */
  public function setFormat(string $format);

  /**
   * Get the format.
   *
   * @return string The format name, or empty if there is no explicit format.
   */
  public function getFormat();

  /**
   * Set query parameter by name.
   *
   * @param string $name The parameter name.
   * @param mixed $value The parameter value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameter(string $name, $value);

  /**
   * Set query parameters.
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
   * Get parameter by name.
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

  /**
   * Set the fragment.
   *
   * @param string $fragment The fragment value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setFragment(string $fragment);

  /**
   * Get the fragment.
   *
   * @return string The fragment value.
   */
  public function getFragment();

  /**
   * Set the url as absolute or not.
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
