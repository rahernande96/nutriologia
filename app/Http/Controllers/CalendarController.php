<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use App\Patient;
use DateTime;
use Spatie\GoogleCalendar\Event;

class CalendarController extends Controller
{
	protected $client;

	public function __construct()
	{
		$client = new Google_Client();
		$client->setAuthConfig('client_secret.json');
		$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
		$guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
		$client->setHttpClient($guzzleClient);
		$this->client = $client;
	}

	public function index()
	{
		session_start();
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$this->client->setAccessToken($_SESSION['access_token']);
			$service = new Google_Service_Calendar($this->client);
			$calendarId = 'ibddnpn2fj5221lheg75c2dlgs@group.calendar.google.com';
			$results = $service->events->listEvents($calendarId);
			return $results->getItems();
		} else {
			return redirect()->route('oauthCallback');
		}
	}

	public function oauth()
	{
		session_start();
		$rurl = action('CalendarController@oauth');
		$this->client->setRedirectUri($rurl);
		if (!isset($_GET['code'])) {
			$auth_url = $this->client->createAuthUrl();
			$filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
			return redirect($filtered_url);
		} else {
			$this->client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $this->client->getAccessToken();
			return back()->with('info', 'No se que pasa');
		}
	}

	public function store(Request $request, $slug)
	{
		
		$patient = Patient::where('slug', $slug)->first();

		$date = Carbon::parse($request->birthdate);

		
		//$request->birthdate = DateTime::createFromFormat('Y-m-d\TH:i:s.uP', '2014-01-22T10:36:00.222Z');
		//var_dump($request->birthdate);

		// if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		// $this->client->setAccessToken($_SESSION['access_token']);

		// session_start();

		// $calendarId = 'ibddnpn2fj5221lheg75c2dlgs@group.calendar.google.com';

		// $startDateTime = $date->toRfc3339String();
		// $endDateTime = Carbon::parse($startDateTime)->addHour();

		// $event = new Event;

		// $event->name = 'Cita con paciente';
		// $event->startDateTime = Carbon::parse($request->birthdate);
		// $event->endDateTime = Carbon::parse($request->birthdate)->addHour();

		// $event->save();

		// 	$event = new Google_Service_Calendar_Event([
		// 		'summary' => 'Cita con paciente:' .$patient->name,
		// 		'description' => 'Cita con un paciente.',
		// 		'start' => ['dateTime' => $startDateTime],
		// 		'end' => ['dateTime' => $endDateTime],
		// 		'reminders' => ['useDefault' => true],
		// 	]);

		// $results = $service->events->insert($calendarId, $event);

		// 	if (!$results) {
		// 		return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
		// 	}
		// 	return response()->json(['status' => 'success', 'message' => 'Event Created']);
		// } else {
		// 	return redirect()->route('oauthCallback');
		// }
	}
}
