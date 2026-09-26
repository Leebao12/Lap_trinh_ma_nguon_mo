<?php
namespace app\Students;
class Student extends Person{
    private $studentID;
    public function __construct($name, $age,$studentID)
    {
        parent::__construct($name, $age);
        $this->studentID=$studentID;
    }
    public function hienthi()
    {
        echo "Sinh viên: {$this->name} || tuổi: {$this->age} || MSSV: {$this->studentID}<br>";
    }
}
?>