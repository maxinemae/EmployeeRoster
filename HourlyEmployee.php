<?php
require_once 'Employee.php';

class HourlyEmployee extends Employee {
    private $hoursWorked;
    private $rate;

    public function __construct($name, $address, $companyName, $age, $hoursWorked, $rate) {
        parent::__construct($name, $address, $companyName, $age, 'Hourly Employee');
        $this->hoursWorked = $hoursWorked;
        $this->rate = $rate;
    }

    public function earnings() {
        // If hours worked exceeds 40, apply 150% of the rate
        if ($this->hoursWorked > 40) {
            $overtimeHours = $this->hoursWorked - 40;
            $overtimeRate = $this->rate * 1.5;
            $regularPay = 40 * $this->rate;
            $overtimePay = $overtimeHours * $overtimeRate;
            return $regularPay + $overtimePay;
        } else {
            return $this->hoursWorked * $this->rate;
        }
    }
    public function getHoursWorked() {
        return $this->hoursWorked;
    }

    public function getRate() {
        return $this->rate;
    }
}
?>
