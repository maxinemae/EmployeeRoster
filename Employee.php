<?php
abstract class Employee {
    private $name;
    private $address;
    private $companyName;
    private $age;
    private $employeeType;
    private $id;

    public function __construct($name, $address, $companyName, $age, $employeeType) {
        $this->name = $name;
        $this->address = $address;
        $this->companyName = $companyName;
        $this->age = $age;
        $this->employeeType = $employeeType;
    }

    public function getDetails() {
        return "Name: $this->name, Address: $this->address, Company: $this->companyName, Age: $this->age, Type: $this->employeeType";
    }

    // Abstract earnings method
    abstract public function earnings();

    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
    }
}
?>
