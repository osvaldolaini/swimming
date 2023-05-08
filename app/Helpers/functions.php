<?php

if (! function_exists('converTime')) {
    function converTime(string $string)
    {
        $time = explode('.',$string);
        if($time[0] > 0){
            $seconds = intval($time[0]); //Converte para inteiro

            $mins = floor($seconds / 60);
            $secs = floor($seconds % 60);

            if(isset($time[1])){
                $sign = sprintf('%02d:%02d', $mins, $secs).','.$time[1];
            }else{
                $sign = sprintf('%02d:%02d', $mins, $secs).',00';
            }

        }else{
            $sign = '00:00,'.$time[1];
        }

        return $sign;
    }
}
