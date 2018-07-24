<?php

class GeoHelper
{
    public static function solution($A)
    {
        if (empty($A)) {
            return 'Error: empty massive';
        }
        
        $countEl = count($A);
        
        if (count($countEl) > 100000) {
            return 'Error: max count of elements 100000';
        }
        
        foreach ($A as $key => $value) {
            if (!is_integer($value)) return "Error: not integer element with key $key";
            if (0 > $value || $value > 100000000) return "Error: element with key $key out of range 1 - 100000000";
        }

        for ($m = $countEl - 1; $m >= 0; $m--) {  //Обрезаем конец массива, который не может содержать воды
            if ($A[$m] <= $A[$m - 1]) {
                unset($A[$m]);
                $countEl--;
            }
            else break;
        }

        $result = 0;
        $startPoint = $A[0];
        $endPoint = $A[0];
        $heigth = 0;
        $minimum = $A[0];
        $maximum = $A[0];
        $prevMaximum = $A[0];

        for ($i = 1; $i < $countEl; $i++) {
            
            $currentVal = $A[$i];
            
            $endPoint = $currentVal;

            if($startPoint - $currentVal > $startPoint - $minimum) {
                $minimum = $currentVal;
            }
            
            if($startPoint >= $currentVal && $prevMaximum > $maximum) {
                $maximum = $currentVal;
            }

            $heigth = min($startPoint, $endPoint); // Получаем верхнюю точку для рассчета глубины

            $diff = $heigth - $minimum;

            if ($diff > $result) $result = $diff;
            
            // если перевалили за границу текущей стратовой точки, то назначаем конечную
            // или если точка максимальная на оставшемся учаске, то используем её
            if ($currentVal >= $startPoint || $currentVal >= $maximum) {
                $startPoint = $currentVal;
                $endPoint = $currentVal;
                $minimum = $currentVal;
                $prevMaximum = $maximum;
                $maximum = $currentVal;
            }
        }

        return "Max depth: $result";
    }
}