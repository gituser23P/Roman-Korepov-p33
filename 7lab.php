<?php

abstract class Employee {
    protected string $name;
    protected string $position;

    public function __construct(string $name, string $position) {
        $this->name = $name;
        $this->position = $position;
    }

    abstract public function calculateSalary(): float;

    public function getDetails(): string {
        return "Имя: " . $this->name . ", Должность: " . $this->position;
    }
}

class FullTimeEmployee extends Employee {
    private float $fixedSalary;

    public function __construct(string $name, string $position, float $fixedSalary) {
        parent::__construct($name, $position);
        $this->fixedSalary = $fixedSalary;
    }

    public function calculateSalary(): float {
        return $this->fixedSalary;
    }
}

class PartTimeEmployee extends Employee {
    private float $hourlyRate;
    private int $hoursWorked;

    public function __construct(string $name, string $position, float $hourlyRate, int $hoursWorked) {
        parent::__construct($name, $position);
        $this->hourlyRate = $hourlyRate;
        $this->hoursWorked = $hoursWorked;
    }

    public function calculateSalary(): float {
        return $this->hourlyRate * $this->hoursWorked;
    }
}


$employees = [
    new FullTimeEmployee("Егор Матвеевич", "Учитель", 28000.0),
    new FullTimeEmployee("Мария Ивановна", "Директор", 80000.0),
    new PartTimeEmployee("Василий Петрович", "Разнорабочий", 400.0, 25 ),
    new PartTimeEmployee("Максим Селезнев", "Повар", 700.0, 20)
];


foreach ($employees as $employee) {
    echo $employee->getDetails() . ", Зарплата: " . $employee->calculateSalary() . " руб." . PHP_EOL;
}

?>