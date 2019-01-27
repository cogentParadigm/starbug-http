<?php
namespace Starbug\Http;

/**
 * Default implementation of UrlInterface.
 */
class Url implements UrlInterface {

  protected $scheme;
  protected $host;
  protected $port;
  protected $user;
  protected $password;
  protected $dir = "/";
  protected $components = [];
  protected $path = "";
  protected $format;
  protected $parameters = [];
  protected $fragment;
  protected $absolute = false;

  /**
   * Initialize new Url properties.
   *
   * @param string $host An optional host. Necessary for absolute urls.
   * @param string $base_directory An optional base directory. The root directory ('/') is the default value.
   */
  public function __construct(string $host = "", string $base_directory = "/") {
    $this->host = $host;
    $this->dir = $base_directory;
  }

  /**
   * Set the scheme.
   *
   * @param string $scheme The name of the scheme such as 'http' or 'https'.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setScheme(string $scheme) {
    $this->scheme = $scheme;
    return $this;
  }

  /**
   * Get the scheme.
   *
   * @return string The scheme name, or an empty value when no scheme has been set.
   */
  public function getScheme() {
    return $this->scheme;
  }

  /**
   * Set the host.
   *
   * @param string $host The host address.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setHost(string $host) {
    $this->host = $host;
    return $this;
  }

  /**
   * Get the host.
   *
   * @return string The host address.
   */
  public function getHost() {
    return $this->host;
  }

  /**
   * Set the port.
   *
   * @param integer $port The port number.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPort(int $port) {
    $this->port = $port;
    $this->setAbsolute(true);
    return $this;
  }

  /**
   * Get the port.
   *
   * @return integer The port number.
   */
  public function getPort() {
    return $this->port;
  }

  /**
   * Set user.
   *
   * @param string $user The user name.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setUser(string $user) {
    $this->user = $user;
    $this->setAbsolute(true);
    return $this;
  }

  /**
   * Get user.
   *
   * @return string The user name.
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Get password.
   *
   * @param string $password The password.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPassword(string $password) {
    $this->password = $password;
    $this->setAbsolute(true);
    return $this;
  }

  /**
   * Get the password.
   *
   * @return string The password.
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Set a relative base directory.
   *
   * @param string $dir The directory - with leading and trailing slashes.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setDirectory(string $dir) {
    $this->dir = $dir;
    return $this;
  }

  /**
   * Get the relative base directory.
   *
   * @return string The root directory ('/') is assumed by default.
   */
  public function getDirectory() {
    return $this->dir;
  }

  /**
   * Get a path component by index.
   *
   * @param integer $index The zero-indexed position of the desired path component.
   *
   * @return string The component at the specified index.
   */
  public function getComponent(int $index = 0) {
    return $this->components[$index];
  }

  /**
   * Get all path components (slash separated segments).
   *
   * @return array The path components.
   */
  public function getComponents() {
    return $this->components;
  }

  /**
   * Set the path.
   *
   * @param string $path The path - without base directory or leading slash.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setPath(string $path) {
    // If the path contains a query string, split it off.
    if (false !== ($divider = strpos($path, "?"))) {
      $path = substr($path, 0, $divider);
    }

    // If the path includes a format (such as .html, .json, .xml etc..) split it off and set the format for this url.
    $file = basename($path);
    if (false !== strpos($file, ".")) {
      $parts = explode(".", $file);
      $this->format = end($parts);
      $path = substr($path, 0, -(strlen($this->format)+1));
    }
    $this->path = $path;
    $this->components = explode("/", $path);
    return $this;
  }

  /**
   * Get the path.
   *
   * @return string The path - without base directory or leading slash.
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * Set the format.
   *
   * @param string $format The format such as 'html' or 'json'.
   *
   * @return $this This instance so that setters are chainable.
   */
  public function setFormat(string $format) {
    $this->format = $format;
    return $this;
  }

  /**
   * Get the format.
   *
   * @return string The format name, or empty if there is no explicit format.
   */
  public function getFormat() {
    return $this->format;
  }

  /**
   * Set query parameter by name.
   *
   * @param string $name The parameter name.
   * @param mixed $value The parameter value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameter(string $name, $value) {
    $this->parameters[$name] = $value;
    return $this;
  }

  /**
   * Set query parameters.
   *
   * @param array $parameters The parameters to set.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setParameters(array $parameters = []) {
    foreach ($parameters as $key => $value) {
      $this->setParameter($key, $value);
    }
    return $this;
  }

  /**
   * Determine if a parameter is specified.
   *
   * @param string $name The parameter name.
   *
   * @return boolean True if the parameter is specified, false otherwise.
   */
  public function hasParameter(string $name) {
    return !empty($this->parameters[$name]);
  }

  /**
   * Get parameter by name.
   *
   * @param string $name The parameter name.
   *
   * @return mixed The parameter value.
   */
  public function getParameter(string $name) {
    return $this->parameters[$name];
  }

  /**
   * Get all parameters.
   *
   * @return array list of parameters keyed by name.
   */
  public function getParameters() {
    return $this->parameters;
  }

  /**
   * Remove a parameter by name.
   *
   * @param string $name The parameter name.
   *
   * @return $this This instance so setters are chainable.
   */
  public function removeParameter(string $name) {
    unset($this->parameters[$name]);
    return $this;
  }

  /**
   * Clear all parameters.
   *
   * @return $this This instance so setters are chainable.
   */
  public function clearParameters() {
    $this->parameters = [];
    return $this;
  }

  /**
   * Set the fragment.
   *
   * @param string $fragment The fragment value.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setFragment(string $fragment) {
    $this->fragment = $fragment;
    return $this;
  }

  /**
   * Get the fragment.
   *
   * @return string The fragment value.
   */
  public function getFragment() {
    return $this->fragment;
  }

  /**
   * Set the url as absolute or not.
   *
   * @param boolean $absolute True to set as absolute, false otherwise.
   *
   * @return $this This instance so setters are chainable.
   */
  public function setAbsolute(bool $absolute) {
    $this->absolute = $absolute;
    return $this;
  }

  /**
   * Build an output url.
   *
   * @param string|false $path A specific path to output.
   *   If false or not specified and a path has been set (using setPath), that path will be used.
   * @param boolean $absolute True to return an absolute path or false to return a relative one.
   *
   * @return string The output url.
   */
  public function build($path = false, bool $absolute = false) {
    $url = '';
    if (($absolute || $this->absolute) && isset($this->host)) {
      if (isset($this->scheme)) {
        $url .= $this->scheme . ':';
      }
      $url .= '//';
      if (isset($this->user)) {
        $url .= $this->user;
        if (isset($this->password)) {
          $url .= ':' . $this->password;
        }
        $url .= '@';
      }
      $url .= $this->host;
      if (isset($this->port)) {
        $url .= ':' . $this->port;
      }
    }
    $url .= $this->dir . ((false === $path) ? $this->path : $path);
    if (false === $path && isset($this->format)) {
      $url .= "." . $this->format;
    }
    if (false === $path && !empty($this->parameters)) {
      $params = [];
      foreach ($this->parameters as $key => $value) {
        $params[] = urlencode($key) . '=' . urlencode($value);
      }
      $url .= '?' . implode('&', $params);
    }
    if (false === $path && isset($this->fragment)) {
      $url .= '#' . $this->fragment;
    }
    return $url;
  }

  /**
   * Factory method to create an instance from PHP super globals.
   *
   * @param string $base_directory A base_directory parameter passed to the constructor, if other than root.
   *
   * @return Starbug\Core\URLInterface An instance of this class, matching the HTTP_HOST, REQUEST_URI, and HTTPS values from $_SERVER.
   *
   * @SuppressWarnings(PHPMD.Superglobals)
   */
  public static function createFromSuperGlobals(string $base_directory = "/") {
    $url = new static($_SERVER['HTTP_HOST'], $base_directory);
    $url->setPath(substr($_SERVER['REQUEST_URI'], strlen($base_directory)));
    $url->setParameters($_GET);
    if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) {
      $url->setScheme("https");
    } else {
      $url->setScheme("http");
    }
    return $url;
  }
}
