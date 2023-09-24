<?php

namespace App\Http\Controllers;

use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\CrawlerTable;
class MainController extends Controller
{
    
    public function getUrlList(){
        //$newRes = CrawlerTable::all();
        //return response()->json([$newRes], 201);
        return response()->json([CrawlerTable::all()], 201);
       // echo $newRes;
        //echo 'here';
    }
  
    public function addUrlItem(Request $request) {
        $url = $request->get('url');
        $findUrl = CrawlerTable::where('url', $url)->get();
    
        if (!$findUrl->isEmpty()) {
            // There is a matching record
            // You can access the records using $findUrl
            echo 'There is one matching record';
            // Handle the case of an existing record here, if needed.
        } else {
            // No matching records
            echo 'There is no record; we will create a new one';
    
            $post = new CrawlerTable;
            $post->url = $url; // Corrected line
            $post->dep0 = $request->get('dep0'); // Assuming 'dep0' is a field in your database
            $post->dep1 = $request->get('dep1'); // Assuming 'dep1' is a field in your database
    
            $post->save();
    
            return response()->json([$post], 201);
        }
    }
    public function newView(Request $request)
{
    
    // Get URL parameter for scraping
    $url = $request->get('url');

    // Get depth parameter from the query, default to 1 if not provided
    $depth = $request->get('depth', 1);

    // Initialize Guzzle
    $client = new Client();

    try {
        // Get request
        $response = $client->request('GET', $url);

        $response_status_code = $response->getStatusCode();
        $html = $response->getBody()->getContents();

        if ($response_status_code == 200) {
            $dom = HtmlDomParser::str_get_html($html);

            $url_items = $dom->find('a');
            $filtered_urls = [];

            foreach ($url_items as $element) {
                $href = $element->href;

                // Check if the href attribute starts with "http"
                if (strpos($href, 'http') === 0) {
                    // Calculate the depth of the URL
                    $urlDepth = $this->calculateDepth($url, $href);

                    // Define depth categories based on your criteria
                    if ($urlDepth === 0) {
                        $depthCategory = 0;
                    } elseif (strpos($href, $url) !== false) {
                        $depthCategory = 1;
                    } elseif ($urlDepth === 2 && $this->countMatchingLetters($url, $href) >= 5) {
                        $depthCategory = 2;
                    } else {
                        $depthCategory = 3;
                    }

                    // Add URL information to the array
                    $filtered_urls[] = [
                        'url' => $href,
                        'depth' => $depthCategory,
                    ];
                }
            }

            // Sort filtered URLs by depth in ascending order
            usort($filtered_urls, function ($a, $b) {
                return $a['depth'] - $b['depth'];
            });

            // Now you have an array of URL information
            // You can use or display it as needed.
            foreach ($filtered_urls as $filtered_url) {
                echo $filtered_url['url'] . ' (Depth: ' . $filtered_url['depth'] . ')<br>';
            }
            $findUrl = CrawlerTable::where('url', $url)->get();
    
        if (!$findUrl->isEmpty()) {
            // There is a matching record
            // You can access the records using $findUrl
            echo 'There is one matching record';
            // Handle the case of an existing record here, if needed.
        } else {
            // No matching records
            echo 'There is no record; we will create a new one';
    /*
            $post = new CrawlerTable;
            $post->url = $url; // Corrected line
            $post->depth = $urlDepth; // Assuming 'dep' is a field in your database
            $post->urlobj = $filtered_url; // filling $filtered_url in db
    
            $post->save();
*/
           
                // ... (previous code)
            
                // Inside the loop, create a new CrawlerRecord and save it to the databas
                $crawlerRecord = new CrawlerTable;
                $crawlerRecord->url = $url;
                $crawlerRecord->depth = $filtered_url['depth'];

                // Collect the filtered URLs in an array
                $urlobjArray = [];
                foreach ($filtered_urls as $filtered_url) {
                    $urlobjArray[] = $filtered_url;
                }

                // Serialize the array and save it to the urlobj field
                $crawlerRecord->urlobj = json_encode($urlobjArray);

                $crawlerRecord->save();
    
            return response()->json([$crawlerRecord], 201);
            
        }
        } else {
            echo 'Failed to fetch the URL. Status code: ' . $response_status_code;
        }
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Calculate the number of matching letters in two URLs
private function countMatchingLetters($url1, $url2)
{
    // Compare the two URLs character by character
    $count = 0;
    $minLen = min(strlen($url1), strlen($url2));

    for ($i = 0; $i < $minLen; $i++) {
        if ($url1[$i] === $url2[$i]) {
            $count++;
        } else {
            break;
        }
    }

    return $count;
}

// Calculate crawl depth (you may need to adjust this logic)
private function calculateDepth($baseUrl, $currentUrl)
{
    $baseUrlParts = parse_url($baseUrl);
    $currentUrlParts = parse_url($currentUrl);

    // Extract the paths from the URLs
    $baseUrlPath = isset($baseUrlParts['path']) ? $baseUrlParts['path'] : '';
    $currentUrlPath = isset($currentUrlParts['path']) ? $currentUrlParts['path'] : '';

    // Split the paths into segments
    $baseUrlPathSegments = explode('/', trim($baseUrlPath, '/'));
    $currentUrlPathSegments = explode('/', trim($currentUrlPath, '/'));

    // Calculate the number of matching segments
    $matchCount = 0;
    foreach ($baseUrlPathSegments as $index => $segment) {
        if (isset($currentUrlPathSegments[$index]) && $currentUrlPathSegments[$index] === $segment) {
            $matchCount++;
        } else {
            break; // Stop counting if there is a mismatch
        }
    }

    // Determine the crawl depth based on the match count
    if ($matchCount >= 6) {
        return 1; // Depth 1 for at least 6 matching segments
    } else {
        return 3; // Depth 3 for the rest
    }
}

}
