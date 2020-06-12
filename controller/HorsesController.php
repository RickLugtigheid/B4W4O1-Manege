<?php
require(ROOT . 'model/php_conn.php');

function index(){
	render("horses/index");
}
function show(){
	$db = new CRUD('horses');
	render("horses/show", array(
		'horses' => $db->Read(null)
	));
}

function create(){
	render("horses/create");
}
function store(){
	$db = new CRUD('horses');

	//foreach($_POST as $post){echo Sanitize($post)."<br>";}
	SanitizeArray($_POST);
	var_dump(toBool($_POST['sport']));
	$db->Create(array('name', 'race', 'age', 'height', 'canSport'), array(Sanitize($_POST['name']), Sanitize($_POST['race']), Sanitize($_POST['age']), Sanitize($_POST['height']), toBool($_POST['sport'])));
	header("location: ".URL."horses/show");
}

function delete($id){
	render("horses/delete", $id);
}
function remove(){
	$db = new CRUD('horses');
	$db->Delete('id', Sanitize($_POST['id']));

	// also delete all the resevations where this horse belongs to
	$db->table = 'resevations';// change the table
	$db->Delete('horse_id', $_POST['id']);

	header("location: ".URL."horses/show");
}

function update($id){
	$db = new CRUD('horses');
	$db->Read(function($row){
		render("horses/update", array($row));
	}, 'id', $id);
}
function edit(){
	$db = new CRUD('horses');
	SanitizeArray($_POST);
	foreach($_POST as $key => $value) {
		$$key = $value;
	}
	$db->Update(
		array('name', 'race', 'age', 'height', 'canSport'),
		array($name, $race, $age, $height, toBool($canSport)),
		'id', $id
	);
	header("location: ".URL."horses/show");
}


function toBool($item){
	if($_POST['sport'] == null) return 0;
	return 1;
}