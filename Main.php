<?php
require_once 'EmployeeRoster.php';
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';

class Main {
    private $roster;
    private $size;
    private $nextEmployeeID = 1;

    public function start() {
        echo "Enter the size of the roster: ";
        $this->size = readline();

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            $this->start(); 
        } else {
            $this->roster = new EmployeeRoster($this->size);
            $this->entrance(); 
        }
    }

    public function entrance() {
        while (true) {
            $this->showRosterInfo();
            echo "\n* EMPLOYEE ROSTER MENU ***\n";
            echo "[1] Add Employee\n";
            echo "[2] Delete Employee\n";
            echo "[3] Other Menu\n";
            echo "[0] Exit\n";
            $choice = readline("Pick from Menu: ");

            switch ($choice) {
                case 1:
                    $this->addEmployee();
                    break;
                case 2:
                    $this->deleteEmployee();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    echo "Process terminated.\n";
                    exit;
                default:
                    echo "Invalid input. Press Enter to continue...\n";
                    readline();
                    break;
            }
        }
    }

    public function addEmployee() {
        if ($this->roster->countEmployees() >= $this->size) {
            echo "Roster is full.\n";
            readline("Press \"Enter\" to continue...");
            return;
        }

        echo "Add Employee\n";
        echo "===EMPLOYEE DETAILS===\n";
        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $companyName = readline("Enter company name: ");
        $age = readline("Enter age: ");

        echo "[1] Commission Employee\n";
        echo "[2] Hourly Employee\n";
        echo "[3] Piece Worker\n";
        $type = readline("Select type of Employee: ");

        switch ($type) {
            case 1:
                $this->addCommissionEmployee($name, $address, $companyName, $age);
                break;
            case 2:
                $this->addHourlyEmployee($name, $address, $companyName, $age);
                break;
            case 3:
                $this->addPieceWorker($name, $address, $companyName, $age);
                break;
            default:
                echo "Invalid input. Press Enter to continue...\n";
                readline(); 
                return; 
        }

        $this->repeat(); 
    }

    public function addCommissionEmployee($name, $address, $companyName, $age) {
        $salary = readline("Enter Regular Salary: ");
        $items = readline("Enter # of Items: ");
        $commission = readline("Enter Commission (%): ");
        $employee = new CommissionEmployee($name, $address, $companyName, $age, $salary, $items, $commission);
        $employee->setID($this->nextEmployeeID++);
        $this->roster->addEmployee($employee);
        echo "Employee Added!\n";
    }

    public function addHourlyEmployee($name, $address, $companyName, $age) {
        $hoursWorked = readline("Enter hours worked: ");
        $rate = readline("Enter rate: ");
        $employee = new HourlyEmployee($name, $address, $companyName, $age, $hoursWorked, $rate);
        $employee->setID($this->nextEmployeeID++);
        $this->roster->addEmployee($employee);
        echo "Employee Added!\n";
    }

    public function addPieceWorker($name, $address, $companyName, $age) {
        $items = readline("Enter # of items: ");
        $wage = readline("Enter wage per item: ");
        $employee = new PieceWorker($name, $address, $companyName, $age, $items, $wage);
        $employee->setID($this->nextEmployeeID++);
        $this->roster->addEmployee($employee);
        echo "Employee Added!\n";
    }

    public function deleteEmployee() {
        $index = readline("Enter employee number to remove: ");
        $this->roster->removeEmployee($index - 1);
        readline("Press \"Enter\" to continue...");
    }

    public function displayEmployees() {
        $employees = $this->roster->getEmployees(); 
        if (empty($employees)) {
            echo "No employees found.\n";
        } else {
            echo "\n** ALL EMPLOYEES **\n";
            foreach ($employees as $index => $employee) {
                echo "Employee #" . ($index + 1) . "\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: " . get_class($employee) . "\n";
                echo "Earnings: " . $employee->earnings() . "\n"; // Display earnings
                echo "----------------------------------\n";
            }
        }
        readline();
    }
    
    
    public function displayEmployeesByType($type) {
        $employees = $this->roster->getEmployees();
        $filteredEmployees = [];
    
        foreach ($employees as $employee) {
            if (get_class($employee) === $type) {
                $filteredEmployees[] = $employee;
            }
        }
        if (empty($filteredEmployees)) {
            echo "No employees of type $type found.\n";
        } else {
            echo "\n** $type EMPLOYEES **\n";
            foreach ($filteredEmployees as $index => $employee) {
                echo "Employee #" . ($index + 1) . "\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: " . get_class($employee) . "\n";
                echo "----------------------------------\n";
            }
            echo "\nPress Enter to continue...\n";
            readline();
        }
    }
    
    public function otherMenu() {
        while (true) {
            echo "\nOther Menu\n";
            echo "[1] Display Employees\n";
            echo "[2] Count Employees\n";
            echo "[3] Payroll\n";
            echo "[0] Return to Select Menu\n";
            $choice = readline("Select Menu: ");
            
            switch ($choice) {
                case 1:
                    $this->displayMenu(); 
                case 2:
                    $this->countEmployees();
                    break;
                case 3:
                    echo "Payroll feature not implemented yet.\n";
                    readline("Press Enter to continue...");
                    break;
                case 0:
                    return; 
                default:
                    echo "Invalid input. Press Enter to continue...\n";
                    readline(); 
                    break;
            }
        }
    }

    public function displayMenu() {
        while (true) {
            echo "\n* DISPLAY EMPLOYEES MENU ***\n";
            echo "[1] Display All Employees\n";
            echo "[2] Display Commission Employees\n";
            echo "[3] Display Hourly Employees\n";
            echo "[4] Display Piece Worker Employees\n";
            echo "[0] Return to Other Menu\n";
            $choice = readline("Select Menu: ");
            
            switch ($choice) {
                case 1:
                    $this->displayAllEmployees(); 
                    break;
                case 2:
                    $this->displayCommissionEmployees(); 
                    break;
                case 3:
                    $this->displayHourlyEmployees();
                    break;
                case 4:
                    $this->displayPieceWorkerEmployees();
                    break;
                case 0:
                    return; 
                default:
                    echo "Invalid input. Press Enter to continue...\n";
                    readline();
                    break;
            }
        }
    }
    
    public function displayAllEmployees() {
        $employees = $this->roster->getEmployees(); 
    
        if (empty($employees)) {
            echo "No employees found.\n";
        } else {
            echo "\n** ALL EMPLOYEES **\n";
            foreach ($employees as $employee) {
                echo "Employee #" . $employee->getID() . "\n"; 
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: " . get_class($employee) . "\n";
                echo "----------------------------------\n";
            }
        }
    
        echo "\nPress Enter to continue viewing employees, or enter '0' to return.\n";
        $choice = readline("Select option: ");
        
        if ($choice == '0') {
            return; 
        }
    }

    public function displayCommissionEmployees() {
        $employees = $this->roster->getEmployees();
        $commissionEmployees = array_filter($employees, function($employee) {
            return $employee instanceof CommissionEmployee;
        });
    
        if (empty($commissionEmployees)) {
            echo "No commission employees found.\n";
        } else {
            echo "\n** COMMISSION EMPLOYEES **\n";
            foreach ($commissionEmployees as $index => $employee) {
                echo "Employee #" . $employee->getID() . "\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: Commission Employee\n";
                echo "----------------------------------\n";
            }
        }
    
        echo "\nPress Enter to continue viewing commission employees, or enter '0' to return.\n";
        $choice = readline("Select option: ");
        
        if ($choice == '0') {
            return; // Exit and return to the other menu
        }
    }
    

    public function displayHourlyEmployees() {
        $employees = $this->roster->getEmployees(); // Get all employees from the roster
        $hourlyEmployees = array_filter($employees, function($employee) {
            return $employee instanceof HourlyEmployee;
        });
    
        if (empty($hourlyEmployees)) {
            echo "No hourly employees found.\n";
        } else {
            echo "\n** HOURLY EMPLOYEES **\n";
            foreach ($hourlyEmployees as $index => $employee) {
                echo "Employee #" . $employee->getID() . "\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: Hourly Employee\n";
                echo "----------------------------------\n";
            }
        }
    
        echo "\nPress Enter to continue viewing hourly employees, or enter '0' to return.\n";
        $choice = readline("Select option: ");
        
        if ($choice == '0') {
            return; // Exit and return to the other menu
        }
    }
    

    public function displayPieceWorkerEmployees() {
        $employees = $this->roster->getEmployees(); // Get all employees from the roster
        $pieceWorkerEmployees = array_filter($employees, function($employee) {
            return $employee instanceof PieceWorker;
        });
    
        if (empty($pieceWorkerEmployees)) {
            echo "No piece worker employees found.\n";
        } else {
            echo "\n** PIECE WORKER EMPLOYEES **\n";
            foreach ($pieceWorkerEmployees as $index => $employee) {
                echo "Employee #" . $employee->getID() . "\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Address: " . $employee->getAddress() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompanyName() . "\n";
                echo "Type: Piece Worker Employee\n";
                echo "----------------------------------\n";
            }
        }
    
        echo "\nPress Enter to continue viewing piece worker employees, or enter '0' to return.\n";
        $choice = readline("Select option: ");
        
        if ($choice == '0') {
            return; 
        }
    }

    public function countEmployees() {
        while (true) {
            echo "\n[1] Count All Employees\n";
            echo "[2] Count Commission Employees\n";
            echo "[3] Count Hourly Employees\n";
            echo "[4] Count Piece Worker Employees\n";
            echo "[0] Return to Select Menu\n";
            $choice = readline("Select Count Option: ");

            switch ($choice) {
                case 1:
                    echo "TOTAL EMPLOYEES IN THE ROSTER: " . $this->roster->countEmployees() . "\n";
                    readline("Press Enter to continue...");
                    break;
                case 2:
                    echo "TOTAL COMMISSION EMPLOYEES: " . $this->roster->countByType('CommissionEmployee') . "\n";
                    readline("Press Enter to continue...");
                    break;
                case 3:
                    echo "TOTAL HOURLY EMPLOYEES: " . $this->roster->countByType('HourlyEmployee') . "\n";
                    readline("Press Enter to continue...");
                    break;
                case 4:
                    echo "TOTAL PIECE WORKER EMPLOYEES: " . $this->roster->countByType('PieceWorker') . "\n";
                    readline("Press Enter to continue...");
                    break;
                case 0:
                    return; 
                default:
                    echo "Invalid input. Press Enter to continue...\n";
                    readline(); 
                    break;
            }
        }
    }

    public function showRosterInfo() {
        echo "Enter the size of the roster: $this->size\n";
        echo "Available space in the roster: " . ($this->size - $this->roster->countEmployees()) . "\n";
    }

    public function repeat() {
        $addMore = readline("Add more? (y to continue): ");
        if (strtolower($addMore) === 'y') {
            $this->entrance(); 
        }
    }
}

$main = new Main();
$main->start(); // Start the program