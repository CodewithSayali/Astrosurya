<?php

namespace App\Controllers;

use App\Controllers\VedicRishiClient;
require 'vendor/autoload.php';
use Dompdf\Dompdf as Dompdf;

class AstrologyController extends BaseController {

    private $user;
    private $session;
    protected $helpers = [];

    public function __construct() {
        helper(['form', 'url', 'session', 'mail_helper']);
    }

    public function index() {
        $data['page_title'] = "Astrosurya";
        $data['current_page'] = "index";
        $data['load_page'] = "site/content/index";
        return view('site/content/kernel', $data);
    }
    
    public function astrology_api() {
        $userId = ASTRO_USER_ID;
        $apiKey = ASTRO_API_KEY;

        $data = array(
            'date' => 25,
            'month' => 12,
            'year' => 1988,
            'hour' => 4,
            'minute' => 0,
            'latitude' => 25.123,
            'longitude' => 82.34,
            'timezone' => 5.5,
            'prediction_timezone' => 5.5 // Optional. Only For Transit Prediction API
        );

//planet name will be used for the planet ashtakvarga
        $planetName = ["sun", "moon", "mars", "mercury", "jupiter", "venus", "saturn", "ascendant"];

//sign name
        $signName = ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];


//chart Id to calculate horoscope chart
        $chartId = ['chalit', 'SUN', 'MOON', 'D1', 'D2', 'D3', 'D4', 'D5', 'D7', 'D8', 'D9', 'D10', 'D12', 'D16', 'D20', 'D24', 'D27', 'D30', 'D40', 'D45', 'D60'];


// instantiate VedicRishiClient class
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $vedicRishi->setLanguage('hi');

// call horoscope functions of Vedic Rishi Client
//*****************Basic Astro****************//
        $responseData = $vedicRishi->getBirthDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData1 = $vedicRishi->getAstroDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData2 = $vedicRishi->getPlanetsDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData3 = $vedicRishi->getPlanetsExtendedDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData4 = $vedicRishi->getPlanetsTropicalDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData5 = $vedicRishi->getGeoDetails('pune', 5);

        $responseData6 = $vedicRishi->getTimezone('Asia/Kolkata', 'false');


//*****************Ashtakvarga****************//
        $responseData7 = $vedicRishi->getAshtakvargaDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[3]);

        $responseData8 = $vedicRishi->getSarvashtakDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Vimshottari Dasha****************//
        $responseData9 = $vedicRishi->getCurrentVimDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData10 = $vedicRishi->getCurrentVimDashaAll($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData11 = $vedicRishi->getMajorVimDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Yogini Dasha****************//
        $responseData12 = $vedicRishi->getCurrentYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData13 = $vedicRishi->getMajorYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData14 = $vedicRishi->getSubYoginiDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Char Dasha****************//
        $responseData15 = $vedicRishi->getCurrentCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData16 = $vedicRishi->getMajorCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData17 = $vedicRishi->getSubCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $signName[3]);

        $responseData18 = $vedicRishi->getSubSubCharDasha($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $signName[4], $signName[2]);


//*****************Kalsarpa Dasha****************//
        $responseData19 = $vedicRishi->getKalsarpaDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Pitri Dasha****************//
        $responseData20 = $vedicRishi->getPitriDoshaReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Sadhesati Dosha****************//
        $responseData201 = $vedicRishi->getSadhesatiLifeDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData202 = $vedicRishi->getSadhesatiCurrentStatus($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData203 = $vedicRishi->getSadhesatiRemedies($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Manglik Dosha****************//
        $responseData21 = $vedicRishi->getManglikDetails($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//*****************Horoscope Charts****************//
        $responseData22 = $vedicRishi->getHoroChartById($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $chartId[4]);

        $responseData23 = $vedicRishi->getExtendedHoroChartById($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $chartId[5]);


//*****************Suggestions and Remedies****************//
        $responseData24 = $vedicRishi->getBasicGemSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData25 = $vedicRishi->getRudrakshaSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData26 = $vedicRishi->getPujaSuggestion($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//***************************************** GENERAL REPORTS FUNCTIONS ****************************************************
        $responseData27 = $vedicRishi->getGeneralHouseReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[6]);

        $responseData28 = $vedicRishi->getGeneralRashiReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone'], $planetName[1]);

        $responseData29 = $vedicRishi->getAscendantReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

        $responseData30 = $vedicRishi->getNakshatraReport($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);

//****************************Nakshatra Prediction**********************//
        $responseData31 = $vedicRishi->getDailyNakshatraPrediction($data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);


//****************************Timezone Wth DST**********************//
//date formate -> mm-dd-yyyy
        $date = $data['month'] . '-' . $data['date'] . '-' . $data['year'];
        $timezoneData = $vedicRishi->timezoneWithDst($date, $data['latitude'], $data['longitude']);
// print response data
        echo $timezoneData;

        echo "\n";
    }

    public function birth_details() {

        $userId = ASTRO_USER_ID;
        $apiKey = ASTRO_API_KEY;

        $data = array(
            'date' => 25,
            'month' => 12,
            'year' => 1988,
            'hour' => 4,
            'minute' => 0,
            'latitude' => 25.123,
            'longitude' => 82.34,
            'timezone' => 5.5
        );
        $resourceName = "birth_details";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
        $data['page_title'] = "Astrology - Birth Details";
        $data['current_page'] = "birth_details";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
        return view('site/content/pdf_view', $data);
    }
    
    function htmlToPDF(){
        $dompdf = new DOMPDF(); 
        $dompdf->loadHtml(view('pdf_view'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    public function planets() {

        $userId = ASTRO_USER_ID;
        $apiKey = ASTRO_API_KEY;

        $data = array(
            'date' => 25,
            'month' => 12,
            'year' => 1988,
            'hour' => 4,
            'minute' => 0,
            'latitude' => 25.123,
            'longitude' => 82.34,
            'timezone' => 5.5
        );
        $resourceName = "birth_details";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
        echo "<pre>";
        print_r($responseData);
        echo "</pre>";
    }
}
