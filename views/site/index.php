<?php

$this->jsFiles = ['ajax/organizer/autocomplete-reg-fact.js'];

use app\base\App;
use app\Models\organizer\Contact;
use app\Models\tour\TourPublishedLog;
use app\services\Auth;
use app\services\Db;
use app\services\DbGeo;
use app\Models\tour\Tour;
use app\Models\program\Program;
use app\services\Currency;
use app\Models\Partner;

/** @var Auth $auth */
$auth = App::get()->auth;
/** @var Db $db */
$db = App::get()->db;
/** @var DbGeo $db_geo */
$db_geo = App::get()->db_geo;
/** @var Partner $partner */
$partner = $auth->getPartner();
/** @var int $partnerId */
$partnerId =$partner->id;
/** @var null|string $error */
$error = null;

/** @var int $programId Получаем Id программы */
$programId = $_POST['program_id'];

//----------------------------------------------------------------------------------

//$date = new DateTime('2000-01-01');
//$date->add(new DateInterval('P10D'));
//echo $date->format('Y-m-d') . "\n";

$date111 = '2020-03-12';

$day = 3;
$date = new DateTime($date111);
$date->add(new DateInterval('P'.$day.'D'));
$dateStartAtString = $date->format('Y-m-d');

var_dump($dateStartAtString);
?>

Lorem ipsum dolor sit amet, consectetur adipisicing.
<img src="images/test/big/DSC_0334_720.JPG" alt="">
<img src="images/test/big/DSC_0334_300.JPG" alt="">
<img src="images/test/big/DSC_0334_200.JPG" alt="">
<img src="images/test/big/DSC_0334_100.JPG" alt="">
