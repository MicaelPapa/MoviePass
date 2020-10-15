<?php 

namespace Util;

class Hash
{
    public static function Hashing($string)
    {
        return hash('sha1', $string, false);
    }
}

?>