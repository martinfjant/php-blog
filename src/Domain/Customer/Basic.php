<?php

namespace Bookstore\Domain\Customer;

use Bookstore\Domain\Customer;
use Bookstore\Domain\Person;

class Basic extends Person implements Customer {
    public function getMonthlyFee() {
        return 5.0;
    }

    public function getAmountToBorrow() {
        return 3;
    }

    public function getType() {
        return 'Basic';
    }

    public function pay($amount) {
        echo "Paying $amount.";
    }

    public function isExtentOfTaxes() {
        return false;
    }
}