<?php

namespace App\Models;

class Comment
{
    private int $id;
    private string $name;
    private string $comment;
    private string $createdAt;
    private int $articleID;


    public function __construct(
        int $id,
        string $name,
        string $comment,
        string $createdAt,
        int $articleID

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->comment = $comment;
        $this->createdAt = $createdAt;
        $this->articleID = $articleID;
    }

    public function id(): int
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function articleID(): int
    {
        return $this->articleID;
    }
}