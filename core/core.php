<?php

// Functie om een database verbinding op te zetten. Hij geeft het database object terug
function openDatabaseConnection() 
{
	$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
	
	$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);

	return $db;
}


// De render functie ontvangt het gevraagde bestandsnaam en heeft een data array als niet verplichte variabele
// Allereerst wordt er door de data array heen gelopen en wordt elk item omgezet in een variabele. Bijvoorbeeld: $data["voornaam"] wordt in de view beschikbaar als $voornaam
// Daarna worden er 3 bestanden ingeladen. De templates/header.php, jouw gewenste pagina en de templates/footer.php. Merk op dat .php hier al staat en je die dus niet mee hoeft te geven.
function render($filename, $data = null)
{
	if ($data && is_array($data)) { //ik heb de core hier aangepast zodat als je render('', array($val1 /*is an array*/, $val2)) doet dat ie ook al the variables goed regeld
		foreach ($data as $key => $value){
			if(!is_object($value)){// we wilen niet dat de code dit bij een object uitvoerd (bvb een PDO object)
				foreach($value as $key => $val) {
					$$key = $val;
				}
			}else{
				$$key = $value;//zodat we wel kunnen zeggen $object_naam
			}
		}
	} 

	require(ROOT . 'view/templates/header.php');
	require(ROOT . 'view/' . $filename . '.php');
	require(ROOT . 'view/templates/footer.php');
}