<?php
require_once 'Employee.php';

class PieceWorker extends Employee {
    private $itemsFinished;
    private $wagePerItem;

    public function __construct($name, $address, $companyName, $age, $itemsFinished, $wagePerItem) {
        parent::__construct($name, $address, $companyName, $age, 'Piece Worker');
        $this->itemsFinished = $itemsFinished;
        $this->wagePerItem = $wagePerItem;
    }

    public function earnings() {
        return $this->itemsFinished * $this->wagePerItem;
    }
}
?>
