<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/");
define("VIEWS_PATH", "Views/");
define("FACEBOOK_PATH", "FacebookLogIn/");
define("DAO_PATH", "DAO/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

define("API_KEY","8980266afb2653bd7558658ca2459816");
define("LANGUAGE_ES","es");
define("API_MAIN_LINK","https://api.themoviedb.org/3");
define("IMG_LINK","https://image.tmdb.org/t/p/w185");

define("DB_HOST", "localhost"); //remotemysql.com
define("DB_NAME", "MoviePassDB"); //VhBTZDPMnR
define("DB_USER", "root"); //VhBTZDPMnR
define("DB_PASS", ""); //aSj8PpLNfh

//MAIL INFO

define("MAIL_MP", "InfoMoviePass@gmail.com" );
define("MAIL_PASS", "MoviePassThe1");
?>




