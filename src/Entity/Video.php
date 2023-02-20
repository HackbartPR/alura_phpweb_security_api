<?php

namespace HackbartPR\Entity;

use InvalidArgumentException;

class Video
{
    private ?int $id;
    public readonly string $title;
    public readonly string $url;

    public function __construct(?int $id, string $title, string $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->setUrl($url);
    }

    private function setUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    
}