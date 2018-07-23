<?php

class GeoHelper
{
    public static function solution($A)
    {
        if (empty($A)) {
            return 'Error: empty massive';
        }

        foreach ($A as $key => $value) {
            if (!is_integer($value)) return "Error: not integer element with key $key";
        }

        $result = 0;

        for ($m = count($A) - 1; $m >= 0; $m--) {  //Обрезаем конец массива, который не может содержать воды
            if ($A[$m] <= $A[$m - 1]) {
                unset($A[$m]);
            }
            else break;
        }

        $countEl = count($A);

        for ($i = 0; $i < $countEl; $i++) {
            $startPoint = 0;
            $endPoint = 0;

            if ($i + 1 < $countEl && $A[$i] > $A[$i+1]) {
                $k = 1;
                $startPoint = $A[$i];

                while ($i + $k + 1 < $countEl && $A[$i + $k] < $startPoint ) {
                    //Если точка максимальная на оставшемся учаске, то используем её
                    if ($A[$i + $k] == max(array_slice($A, $i + $k, $countEl - 1))) break;
                    $k++;
                }

                $endPoint = $A[$i + $k];

                $heigth = min($startPoint, $endPoint); // Получаем верхнюю точку для рассчета шлубины

                $masOfPoints = array_slice($A, $i,  $k + 1);

                if (count($masOfPoints) > 2) // Двух элементов недостаточно
                {
                    $minimum = min($masOfPoints);

                    $diff = $heigth - $minimum;

                    if ($diff > $result)
                    {
                        $result = $diff;
                        $i += $k - 1; //смещаем итератор на величину просчитанного участка
                    }
                }
            }
        }

        return "Max depth: $result";
    }
}