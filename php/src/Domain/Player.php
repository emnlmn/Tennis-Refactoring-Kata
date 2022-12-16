<?php

namespace TennisGame\Domain;

final class Player
{
    private Point $point;

    private function __construct(private Name $name)
    {
        $this->point = new Point(0);
    }

    public static function withName(string $name): self
    {
        return new self(new Name($name));
    }

    public function point(): Point
    {
        return $this->point;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function wonPoint(): void
    {
        $this->point = $this->point->increment();
    }
}