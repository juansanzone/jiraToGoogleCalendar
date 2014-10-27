jiraToGoogleCalendar
====================
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/juansanzone/jiraToGoogleCalendar?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
PHP Jira Web Hook Manager to create a Google Calendar Event for Jira-Issues /
(This version Use the Google API V3 OAuth)


We need...
====================
- Create and Configure your Jira Web Hook -> https://developer.atlassian.com/display/JIRADEV/JIRA+Webhooks+Overview
- Create a Google API Server-Side app -> https://developers.google.com/drive/web/auth/web-server
- Enable and set Google Calendar Scope -> https://developers.google.com/drive/web/scopes
- Generate a OAuth2 Certificated Key (.p12) file -> https://developers.google.com/accounts/docs/OAuth2ServiceAccount
- Get your Service Account Name for your Project from Developer Console https://console.developers.google.com/project

How to Install ?
====================
- Clone this repository
- Copy your .p12 Certificated Key file in /config directory
- Open /config/config.php and complete the value of "$config[credentials]" with your .p12 file-name
- Complete the value of "$config[serviceAccount]" with your Service Acccount Name
- Complete the value of "$config[gEmail]" with your Google Email
- Save changes and rocks!

Server Requeriments
====================
- Apache & PHP 5.3 or +
- CURL Extension Enabled & Session
