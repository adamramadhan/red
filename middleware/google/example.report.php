<?php
define('ga_email','youremail@email.com');
define('ga_password','your password');
define('ga_profile_id','your profile id');

require 'gapi.class.php';

$ga = new gapi('labs@networks.co.id','cicakkurus');

#$ga->requestReportData(44030755,array('browser','browserVersion'),array('pageviews','visits'));
$filter = 'pagePath==/LVUstore';
$ga->requestReportData(44030755,array('pagePath','date'),array('pageviews','uniquePageviews','avgTimeOnPage'),NULL,$filter);
?>
<table>
<tr>
  <th>Browser &amp; Browser Version</th>
  <th>Pageviews</th>
  <th>Uniq</th>
</tr>
<?php
foreach($ga->getResults() as $result){
var_dump($result);
echo $result->getPageviews();
}
?>
