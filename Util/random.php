<?php 

namespace Util;

class Random
{
    public static function CreateRandomNumber($lenght)
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $lenght; $i++) $key .= $pattern{
            mt_rand(0, $max)};
        return $key;
    }
}

?>