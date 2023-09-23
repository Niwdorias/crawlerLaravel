<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
//use Sunra\PhpSimple\HtmlDomParser;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
/*
$dom = HtmlDomParser::str_get_html( $str );
or 
$dom = HtmlDomParser::file_get_html( $file_name );

$elems = $dom->find($elem_name);
*/

class MainController extends Controller
{
    public function scrape(Request $request){

        //Get url param for scraping
        $url = $request->get('url');

        //Init Guzzle
        $client = new Client();

        //Get request
        $response = $client->request(
            'GET',
            $url
        );

        $response_status_code = $response->getStatusCode();
        //$html = $response->getBody()->getContents();
        $html = $response->getBody()->getContents();

        if($response_status_code==200){
           $dom = HtmlDomParser::str_get_html( $html );
           
           //$dom = HtmlDomParser::file_get_html( $html );
           


           // echo "GodDamnPHPihateYou";
           dd($dom);
            
        }
    }
}