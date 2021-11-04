<?php


$id = htmlspecialchars(trim($_GET['id']));
$ip = trim($_SERVER['REMOTE_ADDR']);
$user_agent = trim($_SERVER['HTTP_USER_AGENT']);


$country = array(

'RU' => 'https://google.com/',
'ru' => 'https://google.com/',

'KZ' => 'https://google.com/',
'kz' => 'https://google.com/'

);

$zaglushka = 'https://youtube.com/';

include('SxGeo.php');

$SxGeo = new SxGeo('SxGeo.dat');
$code_country = $SxGeo->getCountry($ip);

unset($SxGeo);

$date = date('d.m.Y H:i:s', time());

$hour = date('H', time());

$show = 0;

if ($id == 'app') {

    if ($hour < 25 && $hour > -1) {
        if ($show == 1) {
            if ($country[$code_country] != null && $country[$code_country] != '') {
                if (strripos($user_agent, 'Nexus') === false && strripos($user_agent, 'Pixel') === false) {
                    $file = fopen('statistic_webview.txt', 'a+');
                    fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
                    fflush($file);
                    fclose($file);
                    header('Location: ' . $country[$code_country]);
                } else {
                    $file = fopen('statistic_app.txt', 'a+');
                    fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
                    fflush($file);
                    fclose($file);
                    header('Location: ' . $zaglushka);
                }
            } else {
				$file = fopen('statistic_app.txt', 'a+');
                fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
                fflush($file);
                fclose($file);
                header('Location: ' . $zaglushka);
            }
        } else {
            $file = fopen('statistic_app.txt', 'a+');
            fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
            fflush($file);
            fclose($file);
            header('Location: ' . $zaglushka);
        }
    } else {
        $file = fopen('statistic_app.txt', 'a+');
        fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
        fflush($file);
        fclose($file);
        header('Location: ' . $zaglushka);
    }
} else {
    $file = fopen('statistic_url.txt', 'a+');
    fwrite($file, 'DATE | ' . $date . ' | IP | ' . $ip . ' | USER_AGENT | ' . $user_agent . ' | COUNTRY | ' . $code_country . PHP_EOL);
    fflush($file);
    fclose($file);
    header('Location: ' . $zaglushka);
}

?>
