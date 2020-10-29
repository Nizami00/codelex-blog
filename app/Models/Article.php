<?php

namespace App\Models;

class Article
{
    private int $id;
    private string $title;
    private string $content;
    private string $createdAt;
    private int $likes;
    private int $dislikes;

    public function __construct(
        int $id,
        string $title,
        string $content,
        string $createdAt,
        int $likes,
        int $dislikes
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function likes(): int
    {
        return $this->likes;
    }

    public function dislikes(): int
    {
        return $this->dislikes;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}