<?php
$msie = strpos($_SERVER["HTTP_USER_AGENT"],'MSIE') > 0;
if (!$msie) {
header("Content-Type: application/xhtml+xml; charset=UTF-8");
}
else {
header("Content-Type: text/html; charset=UTF-8");
}

$mobile_browser = '0';

if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i',
    strtolower($_SERVER['HTTP_USER_AGENT']))){
    $mobile_browser++;
    }

if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or
    ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))){
    $mobile_browser++;
    }

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda','xda-');

    if(in_array($mobile_ua,$mobile_agents)){ $mobile_browser++;
}
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'OperaMini')>0) {
    $mobile_browser++;
}
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
    $mobile_browser++;
}
if($mobile_browser>0){
    // do something
  //  echo "mobile";
    header("location: phonegap/index.html");
    $output = "mobile";

} else {
// do something else
//echo "non mobile";
    header("location: desktop/threepageweb.xhtml");
    $output = "non mobile";
}
?>


<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Hello Mobile World</title> </head>
<body>
<p>Hello Mobile World!</p>
<?php
echo "$output";
//echo $mobile_ua;
//echo "$mobile_browser";
?>
</body>
</html>
