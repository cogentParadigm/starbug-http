<?php
namespace Starbug\Http;

use Psr\Http\Message\ResponseInterface;

interface ResponseBuilderInterface {
  public function getResponse() : ResponseInterface;
  public function setResponse(ResponseInterface $response);
  public function getContent();
  public function setContent($content);
  public function getFormat();
  public function setFormat($format);
  public function getTemplate();
  public function setTemplate($template);
  public function assign($key, $value = null);
  public function render($path = "", $params = [], $options = []);
  public function create($status = 200, $headers = []);
  public function redirect($path, $status = 302);
}
