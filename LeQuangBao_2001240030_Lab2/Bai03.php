<?php
class MathHelper{
    public static function add($a,$b)
    {
        return $a+$b;
    }
}
class AdvancedMath extends MathHelper{
    public static function pow($a,$b)
    {
        return $a**$b;
    }
}
echo "8 + 4 = " . MathHelper::add(8,4)."<br>";
echo "2 ^4 = " . AdvancedMath::pow(2,4)."<br>";
?>