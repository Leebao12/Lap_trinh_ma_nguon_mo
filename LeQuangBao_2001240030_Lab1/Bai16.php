<?php
if ($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['n'])){
    $n=(int)$_POST['n'];
    $sum=0;
    for ($i=1; $i<=$n;$i++)
        {
            $sum+=$i;
        }
    echo "<h3>Tổng các số từ 1 đến $n là: $sum</h3>";
}
?>
