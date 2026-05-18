<?php

namespace TwigDemo;

class Attribute {
  protected array $attributes = [];

  public function addClass(string|array ...$classes): static {
    foreach ($classes as $class) {
      foreach ((array) $class as $c) {
        $this->attributes['class'][] = $c;
      }
    }
    return $this;
  }

  public function removeClass(string|array ...$classes): static {
    foreach ($classes as $class) {
      foreach ((array) $class as $c) {
        $this->attributes['class'] = array_filter(
          $this->attributes['class'] ?? [],
          fn($existing) => $existing !== $c
        );
      }
    }
    return $this;
  }

  public function setAttribute(string $name, mixed $value): static {
    $this->attributes[$name] = $value;
    return $this;
  }

  public function removeAttribute(string ...$names): static {
    foreach ($names as $name) {
      unset($this->attributes[$name]);
    }
    return $this;
  }

  public function hasClass(string $class): bool {
    return in_array($class, $this->attributes['class'] ?? []);
  }

  public function __toString(): string {
    $output = [];
    foreach ($this->attributes as $name => $value) {
      $output[] = $name . '="' . implode(' ', (array) $value) . '"';
    }
    return implode(' ', $output);
  }
}
