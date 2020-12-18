<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 * PHP version 7
 */

namespace App\Controller;

use App\Model\AbstractManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 *
 */
abstract class AbstractController
{
    /**
     * @var Environment
     */
    protected $twig;


    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addGlobal('session', $_SESSION);
// ============ API MAGIC STARTS HERE ==================================================================
//       Part 1: Get the user's IP

        $url = "https://api.ipify.org?format=json"; // URL containing our API call
        $arrContextOptions = array( // Skip certification verification
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $visitorIPJson = file_get_contents($url, false, stream_context_create($arrContextOptions)); //Get JSON from url
        $visitorIPTemp = json_decode($visitorIPJson, true); // Converts the JSON to an array ("ip" -> '127.0.0.1')
        $visitorIP = $visitorIPTemp["ip"]; // Take the value at "ip" in the array and put it in a string variable

//      ------------------------------------------------------------------------------------------------
//      Part 2: Get the user's location (thanks to their IP)

        $url = "http://ipinfo.io/" . $visitorIP . "?token=f4b5e1c2e1010b";
        $visitorCityNameJson = file_get_contents($url, false, stream_context_create($arrContextOptions));
        $visitCityNameTemp = json_decode($visitorCityNameJson, true);
        $visitorCityName = $visitCityNameTemp["city"];

//      ------------------------------------------------------------------------------------------------
//      Part 3: Get the weather in the user's location (thanks to their IP and geolocation)

        /* if (!(isset($visitorCityName))) {  // Failsafe in case previous 2 APIs are overloaded
            $visitorCityName = "Strasbourg";
        }

        $cityTemp = AbstractManager::callAPI($visitorCityName); //  Call API for city named $visitorCityName in FR

        if (isset($cityTemp['name'])) { // Checks if the API call passed
            $_SESSION['city_name'] = $cityTemp['name']; // Save city name in SESSION
            $_SESSION['city_temp'] = (int)ceil($cityTemp['main']['temp']); // Round up temperature and case to int
        } else {
            $_SESSION['city_name'] = "Strasbourg"; // Failsafe value
            $_SESSION['city_temp'] = 5; // Failsafe value
        } */
        $this->twig->addExtension(new DebugExtension());
    }
}
