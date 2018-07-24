<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Sheets;
use Revolution\Google\Sheets\Sheets;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        dd('1') ;

        $client = new Google_Client();
        $client->setApplicationName(config('google.APPLICATION_NAME'));
        $client->setClientId(config('google.CLIENT_ID'));
        $client->setScopes([config('google.scopes')]);
//        $client->setAuthConfig(config('google.KEY_FILE'));

        // credentials - required
        putenv('GOOGLE_APPLICATION_CREDENTIALS=../service.json'); // service account json file
        $client->useApplicationDefaultCredentials();

        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        $service_token = $client->getAccessToken();

        $service = new Google_Service_Sheets($client);

        $sheets = new Sheets();
        $sheets->setService($service);

        $token = 'AIzaSyCbZlPRungrWExi4fE9pmfN25vHy9gaP5I';
        $prKey = '4d537d0cdf4638a78dbb44762cbbf347890a8d05';
        $prKey2 = '4e88410485c4a5ca65c988ff38a2c2bdb0c37598';
        $id = '1o3kjb_wX3GeUXP5HxdDUwunfFzMUf81fW83a16Na0oI';
        $sheet = 'sent offers';
        $data = array(array('abc', 'def', 'ghi'), array('jkl', 'mno', 'prs'));

        $rows = $sheets->spreadsheet($id)->sheet($sheet)->all(); //spreadsheetID is from URL of your google spreadsheet, sheet name is sheet inside it

//        $sheets->spreadsheet($id)->sheet($sheet)->append($data);

        /* Update sheet in Spreadsheet */
//        $sheets->sheet($sheet)->range('B1')->update([[90],[01.2]]);
        /* finish */

        $rows = $sheets->sheet($sheet)->all();

//        dd($rows);

        $array = [];

        foreach ($rows as $row)
        {
            if ($row[1] == auth()->user()->name) {
                $array[] = $row;
//                dd($row);
            }
        }

//        dd($array);

        return view('welcome', compact('array'));
    }
}
