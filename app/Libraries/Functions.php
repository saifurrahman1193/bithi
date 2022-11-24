<?php

    function numberFormat($number, $decimals=0)
    {
        if ($number<0) {
            return $number;
        }

        // $number = 555;
        // $decimals=0;
        // $number = 555.000;
        // $number = 555.123456;

        if (strpos($number,'.')!=null) 
        {
            $decimalNumbers = substr($number, strpos($number,'.'));
            $decimalNumbers = substr($decimalNumbers, 1, $decimals);
        }
        else 
        {
            $decimalNumbers = 0;
            for ($i = 2; $i <=$decimals ; $i++) 
            {
                $decimalNumbers = $decimalNumbers.'0';
            }
        }
        // return $decimalNumbers;



        $number = (int) $number;
        // reverse
        $number = strrev($number);

        $n = '';
        $stringlength = strlen($number);

        for ($i = 0; $i < $stringlength; $i++)
        {
            if ($i%2==0 && $i!=$stringlength-1 && $i>1)
            {
                $n = $n.$number[$i].',';
            }
            else
            {
                $n = $n.$number[$i];
            }
        }

        $number = $n;
        // reverse
        $number = strrev($number);

        ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;

        return $number;
    }


    function dmyToYmd($date)
    {
        if ($date) {
            $date = substr($date, 6,4).'-'.substr($date, 3,2).'-'.substr($date, 0,2);
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmY($date)
    {
        if ($date) {
            $date = \Carbon\Carbon::parse($date)->format('d-m-Y');
            return $date;
        } else {
            return '';
        }
    }

    function YmdTodmYPm($date)
    {
        if ($date) {
            $date = \Carbon\Carbon::parse($date)->format('d-m-Y  g:i A');
            return $date;
        } else {
            return '';
        }
    }
    function todayDate(){
        $date = \Carbon\Carbon::now();
        $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
        return $date;        
    }



?>