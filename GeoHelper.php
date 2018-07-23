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
        
        for ($m = 0; $m < $countEl; $m++) {  //Обрезаем начало массива, который не может содержать воды 
            if ($A[$m] <= $A[$m + 1]) { 
                unset($A[$m]);
                $countEl--;
            }
            else break;
        }

        $result = 0;
        $startPoint = $A[$i];
        $endPoint = 0;
        $heigth = 0;
        $minimum = 0;

        for ($i = 0; $i < $countEl; $i++) {
            
            
            
            if ($A[$i] > $startPoint) {
                $endPoint = $A[$i];
                
                
                
                $startPoint = $A[$i];
            }

            /*
            if ($i + 1 < $countEl && $A[$i] > $A[$i+1]) {
                $k = 1;
                $startPoint = $A[$i];
                $minimum = $startPoint;

                while ($i + $k + 1 < $countEl && $A[$i + $k] < $startPoint ) {
                    //Если точка максимальная на оставшемся учаске, то используем её
                    if ($A[$i + $k] == max(array_slice($A, $i + $k, $countEl - 1))) break;
                    if ($A[$i + $k] < $minimum) $minimum = $A[$i + $k]; //минимальный элемент на данном участке
                    $k++;
                }

                $endPoint = $A[$i + $k];

                $heigth = min($startPoint, $endPoint); // Получаем верхнюю точку для рассчета глубины

                if ($k > 1) // Двух элементов недостаточно
                {
                    $diff = $heigth - $minimum;

                    if ($diff > $result)
                    {
                        $result = $diff;
                        $i += $k - 1; //смещаем итератор на величину просчитанного участка
                    }
                }
            }*/
        }

        return "Max depth: $result";
    }
}