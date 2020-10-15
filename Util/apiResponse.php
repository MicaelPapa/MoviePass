<?php 

namespace Util;

use Api\ApiController as APIController;

class ApiResponse
{
    public static function HomologatesApiResponse($ApiRequest)
    {
        $arrayReque = array("api_key" => API_KEY, "language" => LANGUAGE_ES);
        $get_data = APIController::callAPI('GET', API_MAIN_LINK . $ApiRequest, $arrayReque);
        return json_decode($get_data, true);
    }
}

?>