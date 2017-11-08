<?php

namespace Blogg\Domain;

class Book
{
    private $id;
    private $isbn;
    private $title;
    private $author;
    private $stock;
    private $price;
    private $start;
    private $end;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getStartDate()
    {
        return $this->start;
    }

    public function getEndDate()
    {
        return $this->end;
    }

    public function getCopy(): bool
    {
        if ($this->stock < 1) {
            return false;
        } else {
            $this->stock--;
            return true;
        }
    }

    public function addCopy()
    {
        $this->stock++;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
