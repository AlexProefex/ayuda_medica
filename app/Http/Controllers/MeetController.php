<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use App\Models\TokenGoogle;
use App\Models\Appointment;

class MeetController extends Controller
{
    public function index($data)
    {
 

      $client = new Google_Client();
      //$client->setAuthConfig('oauth-credentials.json');

      $client->setAuthConfig([
        'client_id' => '218977633048-6tqaughio2m4e78hi7rkftml416ccgmj.apps.googleusercontent.com',
        'client_secret' => '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',
      ]);
      

      $client->addScope(Google_Service_Calendar::CALENDAR);
      $guzzleClient = new \GuzzleHttp\Client(array('curl'=>array(CURLOPT_SSL_VERIFYPEER => false)));
      $client->setHttpClient($guzzleClient);


      $tokenGoogle = TokenGoogle::find(1);
      //dd($tokenGoogle);

      if(is_null($tokenGoogle))
      {
        $tokenGoogle = new  TokenGoogle();

        $tokenGoogle->idUser = 1;
        $tokenGoogle->save();
      }

      ///dd($tokenGoogle->token);

      //if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
      if(!is_null($tokenGoogle->token)){
   
        $client->setAccessToken($tokenGoogle->token);
        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';
        $optParam = array(
          //'pageSize' => 5,
          'orderBy' => 'startTime',
          'singleEvents' => true,
          'timeMin' => date('c')
        );
        $result = $service->events->listEvents($calendarId,$optParam);

        //Route::apiResource('appointment',AppointmentController::class,['except' => ['destroy']]);

        $this->store($data);   
      
        return view('index', ['data' =>$result->getItems()]);

        //Crear Eventos
        /*
        $event = new Google_Service_Calendar_Event(array(
          'summary' => 'Google Larvel Meet',
          'location' => 'AV Ejercito',
          'description' => 'Testin.',
          'start' => array(
            'dateTime' => '2023-02-11T12:30:00-07:00',
            'timeZone' => 'America/Lima',
          ),
          'end' => array(
            'dateTime' => '2023-02-11T13:30:00-07:00',
            'timeZone' => 'America/Lima',
          ),
          'recurrence' => array(
            'RRULE:FREQ=DAILY;COUNT=2'
          ),
          'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
              array('method' => 'email', 'minutes' => 24 * 60),
              array('method' => 'popup', 'minutes' => 10),
            ),
          ),

          'attendees' => array(
            array('email' => 'apalli@proefexperu.com'),
            array('email' => 'jpauccara@proefexperu.com'),
          ),
          //
          'conferenceData' => [
            'createRequest' => [
                'requestId' => 'sample123',
                'conferenceSolutionKey' => ['type' => 'hangoutsMeet']
            ]
          ],
          //
        ));
        
        $calendarId = 'primary';
        $res = $service->events->insert($calendarId, $event,  array('conferenceDataVersion' => 1));

        return view('index', ['data' =>$res]);
        */

        //return $result->getItems();
      }
      else{
        return redirect('/');
      }

    }


    public function store($input)
    {
          //$input = $request->all();

          $appointment = new Appointment;
          $appointment->idCategory = $input['idCategory'];
          $appointment->location = $input['location'];
          $appointment->idDoctor = $input['idDoctor'];
          $appointment->idPatient = $input['idPatient'];
          $appointment->idSpecialty = $input['idSpecialty'];
          $appointment->date = $input['date'];
          $appointment->time = $input['time'];
          $appointment->observation = $input['observation'];
          $appointment->status = 'reservado';
          $appointment->save(); 
        
    }



    public function showview(Request $request){

      $data = $request->all();

   

        $rurl = action('App\Http\Controllers\MeetController@showview');
        $client = new Google_Client();
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri($rurl);
        $client->setAuthConfig([
          'client_id' => '218977633048-6tqaughio2m4e78hi7rkftml416ccgmj.apps.googleusercontent.com',
          'client_secret' => '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',
        ]);
        $client->setAuthConfigFile('oauth-credentials.json');
        $guzzleClient = new \GuzzleHttp\Client(array('curl'=>array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
  
        if(!isset($_GET['code'])){
          $auth_url = $client->createAuthUrl();
          $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
          
  
          return redirect($filtered_url);
        }
        else{

          $tokenGoogle = TokenGoogle::find(1); 
          if(is_null($tokenGoogle))
          {
            $tokenGoogle = new  TokenGoogle();
    
            $tokenGoogle->idUser = 1;
            $tokenGoogle->save();
          }
     
          $tokenGoogle->token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
          $tokenGoogle->save();

   //       dd($data);
  
          return $this->index($data); 
          
          //redirect('/cal');
        }
  
      }
}
