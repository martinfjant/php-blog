<?php

namespace Bookstore\Domain;

interface Customer {
    public function getMonthlyFee();
    public function getAmountToBorrow();
    public function getType();
}