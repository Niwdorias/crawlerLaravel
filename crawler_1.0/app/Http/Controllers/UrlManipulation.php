<?php

namespace App\Http\Controllers;

//use Sunra\PhpSimple\HtmlDomParser;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\CrawlerTable;
class UrlManipulation extends Controller
{
    public function getUrlList(){
        return response()->json(CrawlerTable::all(), 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        $students = addUrl::all();
        //return view ('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
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
           //$this->store($url);
            //$input = $request->all();
            //addUrl::create($input);
            //return redirect('student')->with('flash_message', 'Student Addedd!'); 
            //echo "DONE!!!!!!!!!";
        }
    }
    
    public function create()
    {
        return view('students.create');
    }
 
   
    public function store($request)
    {
        //dd($request);
       // $input = $request->all();
       // addUrl::create($input);
        //return redirect('student')->with('flash_message', 'Student Addedd!');  
    }
 
    
    public function show($id)
    {
        $student = addUrl::find($id);
        return view('students.show')->with('students', $student);
    }
 
    
    public function edit($id)
    {
        $student = addUrl::find($id);
        return view('students.edit')->with('students', $student);
    }
 
  
    public function update(Request $request, $id)
    {
        $student = addUrl::find($id);
        $input = $request->all();
        $student->update($input);
        return redirect('student')->with('flash_message', 'student Updated!');  
    }
 
   
    public function destroy($id)
    {
        addUrl::destroy($id);
        return redirect('student')->with('flash_message', 'Student deleted!');  
    }
    */
}
