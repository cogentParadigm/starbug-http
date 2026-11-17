<?php
namespace Starbug\Http\Helper;

use Psr\Http\Message\ServerRequestInterface;

class RequestHelper {
  public function __construct(
    protected ServerRequestInterface $target
  ) {
  }
  public function helper() {
    return $this->target;
  }
}
