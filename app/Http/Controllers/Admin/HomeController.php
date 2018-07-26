<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Google_Client;
use Google_Service_Sheets;
use Revolution\Google\Sheets\Sheets;

class HomeController extends Controller
{
    public function index()
    {
        $client = new Google_Client();
        $client->setApplicationName(config('google.APPLICATION_NAME'));
        $client->setClientId(config('google.CLIENT_ID'));
        $client->setScopes([config('google.scopes')]);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=../service.json'); // service account json file
        $client->useApplicationDefaultCredentials();

        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        $service = new Google_Service_Sheets($client);

        $sheets = new Sheets();
        $sheets->setService($service);

        $id = '1o3kjb_wX3GeUXP5HxdDUwunfFzMUf81fW83a16Na0oI';
        $sheet = 'sent offers';

        $rows = $sheets->spreadsheet($id)->sheet($sheet)->all();

        $rows = array_reverse($rows);

        return view('admin.index', compact('rows'));
    }

    public function show()
    {
        $client = new Google_Client();
        $client->setApplicationName(config('google.APPLICATION_NAME'));
        $client->setClientId(config('google.CLIENT_ID'));
        $client->setScopes([config('google.scopes')]);

        putenv('GOOGLE_APPLICATION_CREDENTIALS=../service.json'); // service account json file
        $client->useApplicationDefaultCredentials();

        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        $service = new Google_Service_Sheets($client);

        $sheets = new Sheets();
        $sheets->setService($service);

        $id = '1o3kjb_wX3GeUXP5HxdDUwunfFzMUf81fW83a16Na0oI';
        $sheet = 'sent offers';

        $rows = $sheets->spreadsheet($id)->sheet($sheet)->all();


        return array_reverse($rows);
    }
}
