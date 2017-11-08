<?php

namespace Blogg\Domain;

class Sale {
    private $id;
    private $customer_id;
    private $books;
    private $date;

    public function setCustomerId(int $customerId) {
        $this->customer_id = $customerId;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCustomerId(): int {
        return $this->customer_id;
    }

    public function getBooks(): array {
        return $this->books;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function addBook(int $bookId, int $amount = 1) {
        if (!isset($this->books[$bookId])) {
            $this->books[$bookId] = 0;
        }
        $this->books[$bookId] += $amount;
    }

    public function setBooks(array $books) {
        $this->books = $books;
    }
}
