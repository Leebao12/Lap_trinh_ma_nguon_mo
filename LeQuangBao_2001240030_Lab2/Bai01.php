<?php
class Car
{
    public string $brand;
    public string $color;
    public function showInfo()
    {
        echo "Branch: {$this->brand}, Color: {$this->color} <br>"; 
    }
}
$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->showInfo();
$car2 = new Car();
$car2->brand = "Honda";
$car2->color = "Blue";
$car2->showInfo();
?>