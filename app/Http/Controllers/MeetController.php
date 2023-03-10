<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use App\Models\TokenGoogle;
use App\Models\Appointment;
use Illuminate\Support\Facades\Crypt;

class MeetController extends Controller
{
    

    private function credentials(){
      return [
          "web"=> [
            "client_id"=> "751933602051-gbb5s7r0lrbbqe8cpcie5htsvgmpn111.apps.googleusercontent.com",
            "project_id"=> "ayuda-medica-379115",
            "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
            "token_uri"=> "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
            "client_secret"=> "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",
            "redirect_uris"=> [
              "https://medical.proyectosproefex.com/token"
            ]
        ]
      ];

    }



    public function showCalendar($token){
  
            //$query = Crypt::decryptString($query);

      $token =  json_decode(Crypt::decryptString($token),true);      

      $client = new Google_Client();

      $client->setAuthConfig($this->credentials());
      
      $client->addScope(Google_Service_Calendar::CALENDAR);
      
      $guzzleClient = new \GuzzleHttp\Client(array('curl'=>array(CURLOPT_SSL_VERIFYPEER => false)));
      $client->setHttpClient($guzzleClient);

      //$tokenGoogle = TokenGoogle::find(1);

      //$tokenGoogle->token = $client->fetchAccessTokenWithAuthCode($tokenGoogle->token);


      $client->setAccessToken($token);


      $service = new Google_Service_Calendar($client);
      $calendarId = 'primary';
      $optParam = array(
        //'pageSize' => 5,
        'orderBy' => 'startTime',
        'singleEvents' => true,
        'timeMin' => date('c')
      );
      $result = $service->events->listEvents($calendarId,$optParam);

      return view('webview', ['data' =>$result->getItems()]);


      //return view('webview', ['data' =>$result]);
  
    }

    public function index()
    {
 

      $client = new Google_Client();
      //$client->setAuthConfig('oauth-credentials.json');

      $client->setAuthConfig($this->credentials());
      

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
      if(!is_null(json_decode(Crypt::decryptString($tokenGoogle->token),true))){
   
        $client->setAccessToken(json_decode(Crypt::decryptString($tokenGoogle->token),true));
        //$service = new Google_Service_Calendar($client);
        //$calendarId = 'primary';
        //$optParam = array(
          //'pageSize' => 5,
        //  'orderBy' => 'startTime',
        //  'singleEvents' => true,
        //  'timeMin' => date('c')
        //);
        //$result = $service->events->listEvents($calendarId,$optParam);

        //Route::apiResource('appointment',AppointmentController::class,['except' => ['destroy']]);

        //$this->store(); 

        return redirect("https://medical.proyectosproefex.com/showCalendar/".$tokenGoogle->token);

        //return view('index', ['data' =>$result->getItems()]);

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


    public function index2()
    {
 

      $client = new Google_Client();
      //$client->setAuthConfig('oauth-credentials.json');

      $client->setAuthConfig([
        'client_id' => '751933602051-gbb5s7r0lrbbqe8cpcie5htsvgmpn111.apps.googleusercontent.com',
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

        //$this->store();   
      
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



    public function showview(){

      //$data = $request->all();

   
        return $this->index(); 

        $rurl = action('App\Http\Controllers\MeetController@showview');
        $client = new Google_Client();
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri($rurl);
        $client->setAuthConfig($this->credentials());
        //$client->setAuthConfigFile('oauth-credentials.json');
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

    
     
          $tokenGoogle->token = Crypt::encryptString(json_encode($client->fetchAccessTokenWithAuthCode($_GET['code'])));


   
          $tokenGoogle->save();


 
          

   //       dd($data);
  
          return $this->index(); 
          
          //redirect('/cal');
        }
  
      }


      public function showview2(){
  
          $rurl = action('App\Http\Controllers\MeetController@showview2');
          $client = new Google_Client();
          $client->addScope(Google_Service_Calendar::CALENDAR);
          $client->setRedirectUri($rurl);
          $client->setAuthConfig('mail-376617-c832d31184ea.json');
          $client->setSubject('registromedico@mail-376617.iam.gserviceaccount.com');
          
          //$client->setAuthConfigFile('oauth-credentials.json');
          $guzzleClient = new \GuzzleHttp\Client(array('curl'=>array(CURLOPT_SSL_VERIFYPEER => false)));
          $client->setHttpClient($guzzleClient);
          $service = new Google_Service_Calendar($client);
          $calendarId = 'primary';


          $event = new Google_Service_Calendar_Event(array(
            'summary' => ' Meet',
            'location' => 'AV Ejercito',
            'description' => 'Testin.',
            'start' => array(
              'dateTime' => '2023-02-24T08:30:00-07:00',
              'timeZone' => 'America/Lima',
            ),
            'end' => array(
              'dateTime' => '2023-02-24T10:30:00-07:00',
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
              array('email' => 'apalli%proefexperu.com@gtempaccount.com'),
              //array('email' => 'jpauccara@proefexperu.com'),
            
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

          $optParams = ['conferenceDataVersion' => 1];

          $res = $service->events->insert($calendarId, $event );
  
          return view('index', ['data' =>$res]);
        
 
    
        }
}
