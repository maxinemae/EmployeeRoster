<?php

// Check if the class Employee has already been declared to prevent re-declaration errors
if (!class_exists('Employee')) {
    class Employee {
        protected $name;
        protected $address;
        protected $companyName;
        protected $age;
        protected $employeeType;

        public function __construct($name, $address, $companyName, $age,$employeeType ) {
            $this->name = $name;
            $this->address = $address;
            $this->companyName = $companyName;
            $this->age = $age;
            $this->employeeType = $employeeType;
        }

        // Basic details for Employee
        public function getDetails() {
            return "Name: $this->name, Address: $this->address, Company: $this->companyName, Age: $this->age";
        }
    }
}

// Check if the CommissionEmployee class exists to prevent re-declaration
if (!class_exists('CommissionEmployee')) {
    class CommissionEmployee extends Employee {
        private $salary;
        private $items;
        private $commission;

        public function __construct($name, $address, $companyName, $age, $salary, $items, $commission) {
            parent::__construct($name, $address, $companyName, $age);
            $this->salary = $salary;
            $this->items = $items;
            $this->commission = $commission;
        }

        public function getDetails() {
            return parent::getDetails() . ", Type: Commission, Salary: $this->salary, Items: $this->items, Commission: $this->commission%";
        }
    }
}

// Check if the HourlyEmployee class exists to prevent re-declaration
if (!class_exists('HourlyEmployee')) {
    class HourlyEmployee extends Employee {
        private $hoursWorked;
        private $rate;

        public function __construct($name, $address, $companyName, $age, $hoursWorked, $rate) {
            parent::__construct($name, $address, $companyName, $age);
            $this->hoursWorked = $hoursWorked;
            $this->rate = $rate;
        }

        public function getDetails() {
            return parent::getDetails() . ", Type: Hourly, Hours Worked: $this->hoursWorked, Rate: $this->rate";
        }
    }
}

// Check if the PieceWorker class exists to prevent re-declaration
if (!class_exists('PieceWorker')) {
    class PieceWorker extends Employee {
        private $items;
        private $wage;

        public function __construct($name, $address, $companyName, $age, $items, $wage) {
            parent::__construct($name, $address, $companyName, $age);
            $this->items = $items;
            $this->wage = $wage;
        }

        public function getDetails() {
            return parent::getDetails() . ", Type: Piece Worker, Items: $this->items, Wage per Item: $this->wage";
        }
    }
}

// EmployeeRoster class
class EmployeeRoster {
    private $employees = [];
    private $maxSize;

    public function __construct($maxSize) {
        $this->maxSize = $maxSize;
    }

    // Add an employee to the roster
    public function addEmployee($employee) {
        if (count($this->employees) < $this->maxSize) {
            $this->employees[] = $employee;
            echo "Employee added successfully.\n";
        } else {
            echo "Roster is full, cannot add more employees.\n";
        }
    }

    public function getEmployees() {
        return $this->employees;
    }

    // Remove an employee from the roster by index
    public function removeEmployee($index) {
        if (isset($this->employees[$index])) {
            unset($this->employees[$index]);
            $this->employees = array_values($this->employees); // Re-index the array after removal
            echo "Employee removed successfully.\n";
        } else {
            echo "Employee not found.\n";
        }
    }

    // Count all employees in the roster
    public function countEmployees() {
        return count($this->employees);
    }

    // Display all employees in the roster
    public function displayEmployees() {
        if (empty($this->employees)) {
            echo "No employees to display.\n";
        } else {
            foreach ($this->employees as $employee) {
                echo $employee->getDetails() . "\n";
            }
        }
    }

    // Count employees by specific type
    public function countByType($type) {
        $count = 0;
        foreach ($this->employees as $employee) {
            if (get_class($employee) === $type) {
                $count++;
            }
        }
        return $count;
    }
}

?>
