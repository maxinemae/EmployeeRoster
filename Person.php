<?php
class Person {
    protected $name;
    protected $address;
    protected $age;
    protected $companyName;

    public function __construct($name, $address, $age, $companyName) {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
        $this->companyName = $companyName;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getAge() {
        return $this->age;
    }

    public function getCompanyName() {
        return $this->companyName;
    }
}
?>