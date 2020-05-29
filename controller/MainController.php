<?php
require(ROOT . 'model/php_conn.php');

function index()
{
	render("main/index");
}
function show(){
	$db = new CRUD('horses');
	render("main/show", array(
		'horses' => $db->Read(null)
	));
	$db->Drop();
}
function create(){
	render("main/create");
}
function store(){
	index();
}