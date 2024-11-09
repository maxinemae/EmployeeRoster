<?php
require_once 'Employee.php';

class CommissionEmployee extends Employee {
    private $salary;
    private $itemsSold;
    private $commissionRate;

    public function __construct($name, $address, $companyName, $age, $salary, $itemsSold, $commissionRate) {
        parent::__construct($name, $address, $companyName, $age, 'Commission Employee');
        $this->salary = $salary;
        $this->itemsSold = $itemsSold;
        $this->commissionRate = $commissionRate;
    }

    public function earnings() {
        $commission = $this->itemsSold * $this->commissionRate;
        return $this->salary + $commission;
    }
}
?>
