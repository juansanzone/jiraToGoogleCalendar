<?php

require_once 'config/config.php';
require_once 'WebHookManager.php';
require_once 'CalendarEventManager.php';

$webHook = new WebHookManager();

if ($webHook->getResponse()) 
{
    $gCalendar = new CalendarEventManager($config['credentials'], $config['serviceAccount'], $config['gEmail']);

    $gCalendar->setSummary($webHook->getIssueTitle() . " - " . $webHook->getIssueKey());

    $gCalendar->setDescription($webHook->getIssueUrl() . " - " . $webHook->getIssueDescription());

    $gCalendar->setLocation($webHook->getIssueEnvironment());

    $gCalendar->setStartDate($webHook->getIssueDate());

    $gCalendar->setEndDate($webHook->getIssueDueDate());
 
    $googleResponse = $gCalendar->insertEvent();

    if($config['debug_mode']) 
    {
        var_dump($webHook->getResponse());
        var_dump($googleResponse);
    }
}
