<?php
define('ga_email','labs@networks.co.id');
define('ga_password','');

require 'gapi.class.php';

$ga = new gapi('labs@networks.co.id','cicakkurus');

$ga->requestAccountData();
var_dump($ga);
foreach($ga->getResults() as $result)
{
  echo $result . ' (' . $result->getProfileId() . ")<br />";
}