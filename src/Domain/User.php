<?php

namespace Blogg\Domain;

interface User {
    public function getMonthlyFee();
    public function getAmountToBorrow();
    public function getType();
}