<?php

namespace App\Controllers;

use App\Controllers\VedicRishiClient;
use App\Controllers\PdfClient;

require 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

class AstrologyController extends BaseController {

    private $user;
    private $session;
    protected $helpers = [];

    public function __construct() {
        helper(['form', 'url', 'session', 'mail_helper']);
    }

//
//    public function index() {
//        $data['page_title'] = "Astrosurya";
//        $data['current_page'] = "index";
//        $data['load_page'] = "site/content/index";
//        return view('site/content/kernel', $data);
//    }

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

    function htmlToPDF() {
        $dompdf = new DOMPDF();
        $dompdf->loadHtml(view('pdf_view'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
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

    public function astro_details() {

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
        $resourceName = "astro_details";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
        $data['page_title'] = "Astrology - Astro Details";
        $data['current_page'] = "astro_details";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
        return view('site/content/pdf_view', $data);
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
        $resourceName = "planets";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
        $data['page_title'] = "Astrology - Planets";
        $data['current_page'] = "planets";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
        return view('site/content/pdf_view', $data);
    }

    public function horochart() {
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
        $resourceName = "horo_chart/:chalit";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
//        exit;
        $data['page_title'] = "Astrology - Horochart";
        $data['current_page'] = "horochart";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
        //$fileName = "horochart_moon.pdf";
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
        return view('site/content/pdf_view', $data);
    }

    public function horochart_image() {
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
        $resourceName = "horo_chart_image/:chalit";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
//        exit;
        $data['page_title'] = "Astrology - Horochart - Image - Chalit";
        $data['current_page'] = "horochart_image";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
        //$fileName = "horochart_moon.pdf";
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
        return view('site/content/pdf_view', $data);
    }

    public function bhav_madhya() {
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
        $resourceName = "bhav_madhya";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
//        exit;
        $data['page_title'] = "Astrology - Bhavmadhya";
        $data['current_page'] = "bhav_madhya";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($responseData);
        //$fileName = "horochart_moon.pdf";
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
        return view('site/content/pdf_view', $data);
    }

    public function current_vdasha() {
        $data['pdf_content'] = json_decode(get_api_result('current_vdasha'));
        $data['page_title'] = "Astrology - current_vdasha";
        $data['current_page'] = "current_vdasha";
        $data['load_page'] = "site/content/pdf_view";
        return view('site/content/pdf_view', $data);
    }

    public function pro_horoscope_pdf() {
        $data = array(
            'name' => 'Manish',
            'gender' => 'Male',
            'day' => 25,
            'month' => 12,
            'year' => 1982,
            'hour' => 4,
            'min' => 0,
            'lat' => 25.123,
            'lon' => 82.34,
            'language' => 'en',
            'tzone' => 5.5,
            'place' => 'Mumbai,Maharashtra India',
            'chart_style' => 'EAST_INDIAN',
            'footer_link' => 'https://astrosurya.in/',
            'logo_url' => 'https://astrosurya.in/astro-surya-go-live/assets/image/menu-logo.png',
            'company_name' => 'Astro Surya',
            'company_info' => 'Astro Surya is an organization started in India, with main operations in Mumbai, Maharashtra. our mission is to enrich the life of every person we encounter by providing excellence in Vedic astrology and remedial rituals. We believe that ?spirituality is an important instrument for social change,? and untiring efforts have created diverse solutions in the form of astrology and remedy services such as Vedic Astrology, Nadi Astrology.',
            'domain_url' => 'https://astrosurya.in/',
            'company_email' => 'manish2400@gmail.com',
            'company_landline' => '1122334455',
            'company_mobile' => '1122334455'
        );
        //set the url
        $url = 'https://pdf.astrologyapi.com/v1/basic_horoscope_pdf';
        // Set the credentials
        $userId = '4545';
        $apiKey = 'ByVOIaODH57QRVi6CqswHXGlcpDvj7tZBRoorY';
        $rest_api_base_url = 'https://pdf.astrologyapi.com/v1/';
        $post_endpoint = 'basic_horoscope_pdf';
$pdfClient = new PdfClient($userId, $apiKey);
$pdfClient->setLanguage('en');
$pdfResponse = $pdfClient->call($data['name'], $data['gender'], $data['day'], $data['month'], 
                $data['year'], $data['hour'], $data['min'], $data['lat'],
                 $data['lon'], $data['language'], $data['tzone'], $data['place'],
                 $data['chart_style'], $data['footer_link'], $data['logo_url'], $data['company_name'],$data['company_info'],
                $data['domain_url'], $data['company_email'], $data['company_landline'], $data['company_mobile']);
echo $pdfResponse;
exit;
//        $vedicRishi = new VedicRishiClient($userId, $apiKey);
//        $resourceName = "basic_horoscope_pdf";
//        $responseData = $vedicRishi->call($resourceName, $data['name'], $data['gender'], $data['day'], $data['month'], 
//                $data['year'], $data['hour'], $data['min'], $data['lat'],
//                 $data['lon'], $data['language'], $data['tzone'], $data['place'],
//                 $data['chart_style'], $data['footer_link'], $data['logo_url'], $data['company_name'],
//                $data['domain_url'], $data['company_email'], $data['company_landline'], $data['company_mobile']
//                );


//
//// Encode the credentials in base64
//        $auth = base64_encode($username . ':' . $password);
//
//// Initialize a cURL session
//        $ch = curl_init();
//
//// Set the URL and other options
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//// Set the Authorization header
//        curl_setopt($ch, CURLOPT_HTTPHEADER, [
//            'Authorization: Basic ' . $auth
//        ]);
//
//// Execute the request
//        $response = curl_exec($ch);
//
//// Close the cURL session
//        curl_close($ch);
//
//// Print the response
//        echo $response;
        $data['page_title'] = "Astrology - Pro Horoscope PDF";
        $data['current_page'] = "Pro Horoscope PDF";
        $data['load_page'] = "site/content/pdf_view";
        $data['pdf_content'] = json_decode($pdfResponse);
        return view('site/content/pdf_view', $data);
    }

    public function get_api_result($api_name, $data) {
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
        $resourceName = "bhav_madhya";
        $vedicRishi = new VedicRishiClient($userId, $apiKey);
        $responseData = $vedicRishi->call($resourceName, $data['date'], $data['month'], $data['year'], $data['hour'], $data['minute'], $data['latitude'], $data['longitude'], $data['timezone']);
//        echo "<pre>";
//        print_r($responseData);
//        echo "</pre>";
//        exit;
        return $responseData;

        //$fileName = "horochart_moon.pdf";
//        $dompdf = new Dompdf(); 
//        $dompdf->loadHtml(view('site/content/pdf_view.php', $data));
//        $dompdf->setPaper('A4', 'landscape');
//        $dompdf->render();
//        $dompdf->stream();
    }

    function read_pdf() {
        $name = 'mini-pdf.pdf';
        $url = base_url() . '/public/pdf_report/';

        $files = ['mini-pdf.pdf', 'english.pdf'];
        $pdf = new Fpdi();

        foreach ($files as $file) {
            // set the source file and get the number of pages in the document
            $fileContent = file_get_contents(base_url() . '/public/pdf_report/' . $file, 'rb');
            // ...


            $pageCount = $pdf->setSourceFile(StreamReader::createByString($fileContent));
            for ($i = 0; $i < $pageCount; $i++) {
                //create a page
                $pdf->AddPage();
                //import a page then get the id and will be used in the template
                $tplId = $pdf->importPage($i + 1);
                //use the template of the imporated page
                $pdf->useTemplate($tplId);
            }
        }

        //display the generated PDF
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        readfile($pdf->Output());
    }

}
