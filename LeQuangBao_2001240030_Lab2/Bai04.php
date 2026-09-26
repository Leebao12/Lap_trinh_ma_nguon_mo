<?php
abstract class Animal{
    abstract public function makeSound();
}
class Dog extends Animal implements CanRun{
    public function makeSound()
    {
        echo "Gâu Gâu";
    }
    public function run()
    {
        echo "Dog is running...<br>";
    }
}
class Cat extends Animal{
    public function makeSound()
    {
        echo "Meo Meo";
    }
}
interface CanRun{
    public function run();
}
$dog = new Dog();
$dog->makeSound();
$dog->run();

$cat = new Cat();
$cat->makeSound();
?>