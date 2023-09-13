<?php
/**
 * Vedic Rishi Client for consuming Vedic Rishi Astro Web APIs
 * http://www.vedicrishiastro.com/astro-api/
 * Author: Chandan Tiwari
 * Date: 06/12/14
 * Time: 5:42 PM
 */
namespace App\Controllers;
require_once FCPATH.'src/sdk.php';


class PdfClient extends BaseController 
{
    private $userId = null;
    private $apiKey = null;
    private $language = null;   

    //TODO: MUST enable this on production- MUST
    //private $apiEndPoint = "https://api.vedicrishiastro.com/v1";

    //TODO: MUST- comment this and uncomment https url above on production for added security

    /**
     * @param $uid string userId for Vedic Rishi Astro API
     * @param $key string api key for Vedic Rishi Astro API access
     */
    public function __construct($uid, $key)
    {
        $this->userId = $uid;
        $this->apiKey = $key;
    }


    /*
    A Function to set the Language of Response.
    Just call this function and you can change the language.
    This function should be passed either 'en' for English or 'hi' for Hindi.
*/
    public function setLanguage( $language )
    {
        $this->language = $language;
    }

    private function packageHoroData($name, $gender, $day, $month, $year, $hour, $min, $lat, $lon, $language, 
            $tzone, $place, $chart_style, $footer_link, $logo_url, $company_name, $company_info, $domain_url, 
            $company_email, $company_landline, $company_mobile)
    {
        return array(
            'name' => $name,
            'gender' => $gender,
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'hour' => $hour,
            'min' => $min,
            'lat' => $lat,
            'lon' => $lon,
            'language' => $language,
            'tzone' => $tzone,
            'place' => $place,
            'chart_style' => $chart_style,
            'footer_link' => $footer_link,
            'logo_url' => $logo_url,
            'company_name' => $company_name,
            'company_info' => $company_info,
            'domain_url' => $domain_url,
            'company_email' => $company_email,
            'company_landline' => $company_landline,
            'company_mobile' => $company_mobile
        );
    }
    
    public function call($name, $gender, $day, $month, $year, $hour, $min, $lat, $lon, $language, 
            $tzone, $place, $chart_style, $footer_link, $logo_url, $company_name, $company_info, $domain_url, 
            $company_email, $company_landline, $company_mobile)
    {
        $data = $this->packageHoroData($name, $gender, $day, $month, $year, $hour, $min, $lat, $lon, $language, 
            $tzone, $place, $chart_style, $footer_link, $logo_url, $company_name, $company_info, $domain_url, 
            $company_email, $company_landline, $company_mobile);
        $response = getCurlReponsePdf($this->userId, $this->apiKey, $data, $this->language);
        return $response;
    }


}
