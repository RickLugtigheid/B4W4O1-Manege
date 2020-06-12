<?php require(ROOT . 'model/php_conn.php');
function account(){
    session_start();
    if($_SESSION["ruiter"]){
        $db = new CRUD('resevations');
        
        render('ruiter/account', $db->Read(null, 'renter_name', $_SESSION["ruiter"]));
    }else{
        render('ruiter/account');
    }
}

function login(){
    render('ruiter/login');
}
function start_session(){
    //sanitzie the post variables
    SanitizeArray($_POST);
    //get the user with the same email and check if the pass is correct
    $db = new CRUD('ruiters');
    $db->Read(function($info){
        if(password_verify($_POST['pass'], $info['pass'])){
            //the user loggin info is correct!
            session_start();
            $_SESSION["ruiter"] = Sanitize($info['name']);
            $_SESSION["ruiter_id"] = $info['id'];
            //go back to the account page
            header("location: ".URL."ruiter/account");
        }else{
            die('Wachtwoord of email incorrect');
        }
    }, 'gmail', $_POST['email']);
}

function loguit(){
    session_start();
    unset($_SESSION["ruiter"]);
    unset($_SESSION["ruiter_id"]);
    //go back to the account page
    header("location: ".URL."ruiter/account");
}

function create(){
    render('ruiter/create');
}
function store(){
    $db = new CRUD('ruiters');

    //sanitize all variables
    SanitizeArray($_POST);
    
    //error handling
    if(empty($_POST['name']) || empty($_POST['address']) || empty($_POST['tell']) || empty($_POST['email']) || empty($_POST['pass'])){
        die('Niet alles is ingevuld');
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        die('Uw email bestaat niet!');
    }
    
    $db->Read(function(){
        // if this callback runs we have found a row with the current email
        die("Er bestaat al een account met deze email");
    }, 'gmail', $_POST['email']);

    //hash the password
    $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    //add to the database
    $db->Create(
        array('name', 'adres', 'tell', 'gmail', 'pass'), 
        array($_POST['name'], $_POST['address'], $_POST['tell'], $_POST['email'], $hash)
    );

    header("location: ".URL."ruiter/account");
}

function delete(){
    render("ruiter/delete");
}
function remove(){
    session_start();
    $db = new CRUD('ruiters');
    $db->Delete('id', $_SESSION['ruiter_id']);

    //also delete the session variables by loggingout
    loguit();
}