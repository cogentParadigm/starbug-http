<?php

namespace spec\Starbug\Http;

use Starbug\Http\Url;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec test for Starbug\Http\Url.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */
class UrlSpec extends ObjectBehavior {
  public function let() {
    $this->beConstructedWith("example.com");
  }
  public function it_is_initializable() {
    $this->shouldHaveType(Url::class);
  }
  public function it_can_build_relative_urls() {
    $this->build()->shouldReturn("/");
    $this->build("path")->shouldReturn("/path");
  }
  public function it_can_build_an_absolute_urls() {
    $this->build(false, true)->shouldReturn("//example.com/");
    $this->build("path", true)->shouldReturn("//example.com/path");
  }
  public function it_can_be_constructed_with_a_base_directory() {
    $this->beConstructedWith("example.com", "/directory/");
    $this->build("path")->shouldReturn("/directory/path");
    $this->build("path", true)->shouldReturn("//example.com/directory/path");
  }
  public function it_change_the_base_directory() {
    $this->setDirectory("/directory/");
    $this->build("path")->shouldReturn("/directory/path");
    $this->build("path", true)->shouldReturn("//example.com/directory/path");
  }
  public function it_can_set_a_scheme() {
    $this->setScheme("http");
    $this->build("path", true)->shouldReturn("http://example.com/path");
  }
  public function it_can_change_the_host() {
    $this->setHost("notanexample.com");
    $this->build("path", true)->shouldReturn("//notanexample.com/path");
  }
  public function it_can_be_absolute_by_default() {
    $this->setAbsolute(true);
    $this->build("path")->shouldReturn("//example.com/path");
  }
  public function it_can_set_a_port() {
    $this->setPort(8000);
    $this->build("path")->shouldReturn("//example.com:8000/path");
  }
  public function it_can_set_a_username() {
    $this->setUser("username");
    $this->build("path")->shouldReturn("//username@example.com/path");
  }
  public function it_can_set_a_password() {
    $this->setUser("username");
    $this->setPassword("password");
    $this->build("path")->shouldReturn("//username:password@example.com/path");
  }
  public function it_can_set_a_path() {
    $this->setPath("path");
    $this->build()->shouldReturn("/path");
  }
  public function it_can_set_a_path_with_a_format() {
    $this->setPath("path.html");
    $this->build()->shouldReturn("/path.html");
  }
  public function it_can_set_a_format() {
    $this->setPath("path");
    $this->setFormat("html");
    $this->build()->shouldReturn("/path.html");
  }
  public function it_can_set_a_query_string_parameter() {
    $this->setPath("path");
    $this->setParameter("key", "value");
    $this->build()->shouldReturn("/path?key=value");
  }
  public function it_can_set_multiple_query_string_parameters() {
    $this->setPath("path");
    $this->setParameter("key", "value");
    $this->setParameter("key2", "value2");
    $this->build()->shouldReturn("/path?key=value&key2=value2");
  }
  public function it_can_set_multiple_query_string_parameters_simultaneously() {
    $this->setPath("path");
    $this->setParameters(["key" => "value", "key2" => "value2"]);
    $this->build()->shouldReturn("/path?key=value&key2=value2");
  }
  public function it_can_set_a_fragment() {
    $this->setPath("path");
    $this->setFragment("fragment");
    $this->build()->shouldReturn("/path#fragment");
  }
}
