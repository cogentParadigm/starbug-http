<?php
namespace Starbug\Http;

use Starbug\Bundle\Bundle;

/**
 * Request class. interprets the request (URI, $_GET, and $_POST) and serves the appropriate content
 */
class Request implements RequestInterface {
  protected $url;
  protected $language = "en";
  protected $post;
  protected $headers;
  protected $files;
  protected $cookies;

  public function __construct(UrlInterface $url) {
    $this->post = new Bundle();
    $this->headers = new Bundle();
    $this->files = new Bundle();
    $this->cookies = new Bundle();
    $this->setURL($url);
  }
  public function setUrl(UrlInterface $url) {
    $this->url = $url;
    $parts = explode(".", $url->getHost());
    if (count($parts) > 2 && strlen($parts[0]) == 2) $this->setLanguage($parts[0]);
    return $this;
  }
  public function getUrl() {
    return $this->url;
  }
  public function setPath(string $path) {
    $this->url->setPath($path);
    return $this;
  }
  public function getPath() {
    return $this->url->getPath();
  }
  public function setParameter(string $name, $value) {
    $this->url->setParameter($name, $value);
    return $this;
  }
  public function hasParameter(string $name) {
    return $this->url->hasParameter($name);
  }
  public function getParameter(string $name) {
    return $this->url->getParameter($name);
  }
  public function setParameters(array $parameters) {
    $this->url->setParameters($parameters);
    return $this;
  }
  public function getParameters() {
    return $this->url->getParameters();
  }
  public function getFormat() {
    return $this->url->getFormat();
  }
  public function getComponent(int $index = 0) {
    return $this->url->getComponent($index);
  }
  public function getComponents() {
    return $this->url->getComponents();
  }
  public function setLanguage(string $language) {
    $this->language = $language;
    return $this;
  }
  public function getLanguage() {
    return $this->language;
  }
  public function setPost($post) {
    $args = func_get_args();
    call_user_func_array([$this->post, 'set'], $args);
    return $this;
  }
  public function getPost() {
    $args = func_get_args();
    return call_user_func_array([$this->post, 'get'], $args);
  }
  public function hasPost($post) {
    $args = func_get_args();
    return call_user_func_array([$this->post, 'has'], $args);
  }
  public function setHeader(string $header, string $value) {
    $this->headers->set($header, $value);
    return $this;
  }
  public function setHeaders(array $headers = []) {
    $this->headers->set($headers);
    return $this;
  }
  public function getHeaders() {
    return $this->headers;
  }
  public function getHeader(string $name) {
    return $this->headers->get($name);
  }
  public function setFiles(array $files) {
    $this->files->set($files);
    return $this;
  }
  public function getFiles() {
    return $this->files;
  }
  public function setCookie(string $name, string $value) {
    $this->cookies->set($name, $value);
    return $this;
  }
  public function getCookie(string $name) {
    return $this->cookies->get($name);
  }
  public function setCookies(array $cookies = []) {
    $this->cookies->set($cookies);
    return $this;
  }
  public function getCookies() {
    return $this->cookies;
  }
}
