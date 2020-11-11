<?php 

namespace Util;

class Validate
{
    public static function ValidateData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function Logged()
	{
		return (isset($_SESSION["isLogged"]));
    }
    
	public static function Adminlog()
	{
		if(isset($_SESSION["isAdmin"])) {
           return true;
        }
        else 
        {
            return false;
        }
		
    }
}

?>