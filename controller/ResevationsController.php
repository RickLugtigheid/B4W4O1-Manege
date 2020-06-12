<?php
require(ROOT . 'model/php_conn.php');
session_start();//needed to check if the cur user is logedin

function details($id){
    $db = new CRUD('horses');
    $db->Read(function($row) use ($id){
        render("resevations/details", array(
            $row,
            'resevations' => getResevations($id)
        ));
    }, 'id', $id);
}
function create($id){
    if($_SESSION['ruiter'] != null){
        $db = new CRUD('horses');
        render("resevations/create", array(
            'horse' => $db->Read(null, 'id', $id)
        ));
    }else{
        die('U moet inloggen om een paard of pony te reseveren');
    }
}
function store(){
    SanitizeArray($_POST);
    $id = $_POST['id'];

    $db = new CRUD('resevations');
    #region [error checking]
    if(empty($id) || empty($_POST['time'])){
        die('Niet alles is ingevuld');
    }
    //check for time overlapping
    $resTime = strtotime($_POST['time'].":00");

    //use is to be able to use these variables in this callback function
    $db->Read(function($value) use ($resTime){
        $startTime = strtotime($value['start_time']);
        $endTime = strtotime('+'. RIT_LENGTE .' minutes', $startTime);

        echo "<br>" . $resTime . " => " . $startTime . " <br>";
        echo $endTime;
        if($startTime <= $resTime && $endTime >= $resTime ){
            echo "paard is al gereseveerd rond deze tijd!";
            die();//stop the code from running
        }
    }, 'horse_id', $id);
    #endregion
    //add to database
    $db->Create(array('horse_id', 'start_time', 'renter_name'), array($id, Sanitize($_POST['time']), Sanitize($_SESSION['ruiter'])));
    header("location: ".URL."resevations/details/".$id);
}
//misc
function getResevations($horseId){
    $db = new CRUD('resevations');
    return $db->Read(null, 'horse_id', $horseId);
}