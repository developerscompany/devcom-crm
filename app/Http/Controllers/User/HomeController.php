<?php

namespace App\Http\Controllers\User;

use App\Source;
use App\Status;
use App\Timing;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Sheets;
use Revolution\Google\Sheets\Sheets;
use App\Http\Controllers\Controller;

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

        if (auth()->user()->role == 'admin')
        {
            return redirect('/admin/bids');
        }


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

        $id = '1o3kjb_wX3GeUXP5HxdDUwunfFzMUf81fW83a16Na0oI';
        $sheet = 'sent offers';
        $data = array(array('abc', 'def', 'ghi'), array('jkl', 'mno', 'prs'));



//        $test = $sheets->spreadsheet($id)->sheetById($id);
//        $test->addEditor('zelloooo1997@gmail.com');
//        $edit = $test->getEditors();
//        dd($edit);

        $rows = $sheets->spreadsheet($id)->sheet($sheet)->all(); //spreadsheetID is from URL of your google spreadsheet, sheet name is sheet inside it

//        $sheets->spreadsheet($id)->sheet($sheet)->append($data);

        /* Update sheet in Spreadsheet */
//        $sheets->sheet($sheet)->range('B1')->update([[90],[01.2]]);
        /* finish */

        $rows = $sheets->sheet($sheet)->all();

        $array = [];

        foreach ($rows as $row)
        {
            if ($row[1] == auth()->user()->name) {
                $array[] = $row;
//                dd($row);
            }
        }

        $sourses = Source::all();
        $statuses = Status::all();
        $timings = Timing::all();

        return view('welcome', compact('array', 'sourses', 'statuses', 'timings'));
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

        $array = [];

        foreach ($rows as $row)
        {
            if ($row[1] == auth()->user()->name) {
                $array[] = $row;
//                dd($row);
            }
        }

        return array_reverse($array);
    }

    public function getAgent()
    {
        $agents = User::where('role','!=','admin')->get();
        return $agents;
    }

    public function getSource()
    {
        $sources = Source::all();
        return $sources;
    }

    public function getStatus()
    {
        $statuss = Status::all();
        return $statuss;
    }

    public function store(Request $request)
    {
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

        $service = new \Google_Service_Sheets($client);

        $sheets = new Sheets();
        $sheets->setService($service);

        $id = '1o3kjb_wX3GeUXP5HxdDUwunfFzMUf81fW83a16Na0oI';
        $sheet = 'sent offers';

        $arr = [
            date("d.m.Y"),
            auth()->user()->name,
            request('source'),
            request('link'),
            request('niche'),
            request('site'),
            request('desc'),
            request('timing'),
            request('budget'),
            request('resp'),
            request('status'),
            request('comment')
        ];

        $data = array($arr);

        $sheets->spreadsheet($id)->sheet($sheet)->range('')->append($data);



//        $rows = $sheets->spreadsheet($id)->sheet($sheet)->all();
//        $array = [];
//
//        foreach ($rows as $row)
//        {
//            if ($row[1] == auth()->user()->name) {
//                $array[] = $row;
//            }
//        }

        return $data;
    }
}
