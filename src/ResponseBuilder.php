<?php
namespace Starbug\Http;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;
use Starbug\Core\TemplateInterface;

class ResponseBuilder implements ResponseBuilderInterface {
  protected $response;
  protected $format = "html";
  protected $template = "html.html";
  protected $content;
  protected $scripts;
  public function __construct(TemplateInterface $templates, UriBuilderInterface $uri) {
    $this->templates = $templates;
    $this->uri = $uri;
    $this->templates->assign("response", $this);
    $this->create(200);
  }
  public function getResponse() : ResponseInterface {
    return $this->response;
  }
  public function setResponse(ResponseInterface $response) {
    $this->response = $response;
  }
  public function getContent() {
    return $this->content;
  }
  public function setContent($content) {
    $this->content = $content;
    $bodyStream = Utils::streamFor($this->templates->capture($this->template, ["content" => $this->content]));
    $this->response = $this->response->withBody($bodyStream);
    return $this;
  }
  public function getFormat() {
    return $this->format;
  }
  public function setFormat($format) {
    $this->format = $format;
    $this->setTemplate($this->format.".".$this->format);
    return $this;
  }
  public function getTemplate() {
    return $this->template;
  }
  public function setTemplate($template) {
    $this->template = $template;
    return $this;
  }
  public function assign($key, $value = null) {
    $this->templates->assign($key, $value);
  }
  public function render($path = "", $params = [], $options = []) {
    $options = $options + ["scope" => "views"];
    $this->setContent($this->templates->capture($path, $params, $options));
    return $this;
  }
  public function create($status = 200, $headers = []) {
    if (!isset($headers["Cache-Control"])) {
      $headers["Cache-Control"] = "no-cache, must-revalidate, post-check=0, pre-check=0, max-age=0";
    }
    $this->response = new Response($status, $headers);
    return $this;
  }
  public function redirect($path, $status = 302): ResponseInterface {
    $url = (string) $this->uri->build($path, true);
    $this->create($status, ["Location" => $url]);
    return $this->getResponse();
  }
}
