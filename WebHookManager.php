<?php

class WebHookManager
{
    CONST JIRA_ISSUE_URL = 'https://jira.olx.com/browse/';

    private $hookResponse = array();

    public function __construct()
    {
        $bodyData = json_decode(file_get_contents('php://input'), true);

        if (!is_null($bodyData)) {
            $this->hookResponse = $bodyData;
        } else {
            $this->hookResponse = false;
        }
    }

    public function getResponse() 
    {
        return $this->hookResponse;
    }

    public function getId() 
    {
        return $this->hookResponse['id'];
    }

    public function getIssueKey() 
    {
        return $this->hookResponse['issue']['key'];
    }

    public function getIssueUrl() 
    {
        return self::JIRA_ISSUE_URL . $this->hookResponse['issue']['key'];
    }

    public function getIssueDate() 
    {
        return $this->hookResponse['issue']['fields']['created'];
    }

    public function getIssueDueDate() 
    {
        return $this->hookResponse['issue']['fields']['duedate'];
    }

    public function getIssueTitle() 
    {
        return $this->hookResponse['issue']['fields']['summary'];
    }

    public function getIssueDescription()
    {
        return $this->hookResponse['issue']['fields']['description'];
    }

    public function getIssuePriority() 
    {
        return $this->hookResponse['issue']['fields']['priority'];
    }

    public function getIssueEnvironment() {
        return $this->hookResponse['issue']['fields']['environment'];
    }

}
