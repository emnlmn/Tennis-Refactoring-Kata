<?php

namespace TennisGame\Domain;

final class Point
{
    public function __construct(private int $value)
    {
    }

    public function equals(self $point): bool
    {
        return $point->value === $this->value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function increment(): self
    {
        return new self($this->value + 1);
    }
}