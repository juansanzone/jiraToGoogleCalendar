<?php

session_start();

require_once realpath(dirname(__FILE__) . '/autoload.php');

class CalendarEventManager 
{
  private $summary;
  private $description;
  private $location;
  private $startDate;
  private $endDate;
  private $googleEmail;
  private $eventService = false;
  private $calendarService = false;

  public function __construct($credentialsFile, $serviceAccount, $gEmail) 
  {
    $client = new Google_Client();

    if (isset($_SESSION['service_token'])) {
      $client->setAccessToken($_SESSION['service_token']);
    }

    $accessKey = file_get_contents(realpath(dirname(__FILE__)  . '/config/'. $credentialsFile));

    $credentials = new Google_Auth_AssertionCredentials(
        $serviceAccount,
        array('https://www.googleapis.com/auth/calendar'),
        $accessKey
    );

    $client->setAssertionCredentials($credentials);

    if ($client->getAuth()->isAccessTokenExpired()) {
      $client->getAuth()->refreshTokenWithAssertion($credentials);
    }

    $_SESSION['service_token'] = $client->getAccessToken();

    $scalendar = new Google_Service_Calendar($client);

    $this->googleEmail = $gEmail;
    $this->calendarService = $scalendar;
    $this->eventService = $scalendar->events;
  }

  public function insertEvent($calendarId = 'primary') 
  {
    $eventObj = new Google_Service_Calendar_Event();  
    $eventObj->setSummary($this->summary);
    $eventObj->setDescription($this->description);
    $eventObj->setLocation($this->location);

    $eventObj->setStart($this->startDate);
    $eventObj->setEnd($this->endDate);

    $result = $this->eventService->insert($calendarId, $eventObj);

    return $result;
  }

  public function shareCalendar($calendarId = 'primary') 
  {
    /* -- Share calendar with myself to view Events -- */
    
    $scope = new Google_Service_Calendar_AclRuleScope();
    $scope->setType('user');
    $scope->setValue($this->googleEmail);

    $rule = new Google_Service_Calendar_AclRule();
    $rule->setRole('owner');
    $rule->setScope($scope);

    $result = $this->calendarService->acl->insert($calendarId, $rule);

    return $result;
  }

  public function setSummary($title) 
  {
    $this->summary = $title;
  }

  public function setDescription($description) 
  {
    $this->description = $description;
  }

  public function setLocation($location) 
  {
    $this->location = $location;
  }

  public function setStartDate($dateStr) 
  {
    $dateTime = new Google_Service_Calendar_EventDateTime();
    $dateTime->setDateTime($dateStr);
    $this->startDate = $dateTime;
  }

  public function setEndDate($dateStr) 
  {
    $dateTime = new Google_Service_Calendar_EventDateTime();
    $dateTime->setDateTime($dateStr);
    $this->endDate = $dateTime;
  }

}
