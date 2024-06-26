<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    public function index()
{
    try {
            $client = new Client();
            $website = $client->request('GET', 'https://getbootstrap.com/docs/5.0/components/navbar/');
            
            $htmlContent = $website->html();

            // Pass the HTML content to the view
            return view('scraper', ['htmlContent' => $htmlContent]);
        } catch (\Exception $e) {
            // Handle errors, you might want to return an error view or redirect
            return response()->view('error', ['message' => $e->getMessage()], 500);
        }
}

}
