<?php

if (! function_exists('converTime')) {
    function converTime(string $string)
    {
        $time = explode('.',$string);
        if($time[0] > 0){
            $seconds = intval($time[0]); //Converte para inteiro

            $hours = floor($seconds / 3600);
            $mins = floor(($seconds - ($hours * 3600)) / 60);
            $secs = floor($seconds % 60);

            $sign = sprintf('%02d:%02d', $hours, $mins, $secs).','.$time[1];
        }else{
            $sign = '00:00,'.$time[1];
        }

        return $sign;
    }
}
