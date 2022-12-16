<?php

namespace TennisGame\Domain;

final class Name
{
    public function __construct(private string $value)
    {
    }

    public function equals(self $name): bool
    {
        return $name->value === $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }
}