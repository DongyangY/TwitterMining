<?php

//To find the correlation of the two arrays, simply call the  
//function Correlation that takes two arrays:

/*$correlation = Correlation($array1, $array2);

//Displaying the calculated Correlation:
print $correlation;

//The functions that work behind the scene to calculate the
//correlation*/

function stats_stat_correlation($arr1, $arr2)
{        
    $correlation = 0;
    
    $k = SumProductMeanDeviation($arr1, $arr2);
    $ssmd1 = SumSquareMeanDeviation($arr1);
    $ssmd2 = SumSquareMeanDeviation($arr2);
    
    $product = $ssmd1 * $ssmd2;
    
    $res = sqrt($product);
    
    $correlation = $k / $res;
    
    return $correlation;
}

function SumProductMeanDeviation($arr1, $arr2)
{
    $sum = 0;
    
    $num = count($arr1);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + ProductMeanDeviation($arr1, $arr2, $i);
    }
    
    return $sum;
}

function ProductMeanDeviation($arr1, $arr2, $item)
{
    return (MeanDeviation($arr1, $item) * MeanDeviation($arr2, $item));
}

function SumSquareMeanDeviation($arr)
{
    $sum = 0;
    
    $num = count($arr);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + SquareMeanDeviation($arr, $i);
    }
    
    return $sum;
}

function SquareMeanDeviation($arr, $item)
{
    return MeanDeviation($arr, $item) * MeanDeviation($arr, $item);
}
/*function SumMeanDeviation($arr)
{
    $sum = 0;
    
    $num = count($arr);
    
    for($i=0; $i<$num; $i++)
    {
        $sum = $sum + MeanDeviation($arr, $i);
    }
    
    return $sum;
}*/

function MeanDeviation($arr, $item)
{
    $average = Average($arr);
    
    return $arr[$item] - $average;
}    

function Average($arr)
{
    $sum = Sum($arr);
    $num = count($arr);
    
    return $sum/$num;
}

function Sum($arr)
{
    return array_sum($arr);
}

$array_x = array(5,3,6,7,4,2,9,5);
$array_y = array(4,3,4,8,3,2,10,5);
$pearson = stats_stat_correlation($array_x,$array_y);
echo $pearson;
?>