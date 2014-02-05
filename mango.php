<?php 
$action = isset($_POST['action']) ?  $_POST['action'] : false;
	if($action=="change_site"){
		// Requete pour obtenir la liste des noeuds en fonction du site
		echo json_encode("coucou");

	}
	else if($action=="change_noeud")
	{	
		// Requete pour obtenir la liste des capteurs en fonction du site
		echo json_encode("coucou");
	}
	else if($action=="change_time")
	{	
		// Requete pour obtenir la liste du temps en fonction du site
		echo json_encode("caca");
	}
	else if($action=="change")
	{	
		// Useless
		echo json_encode("caca");
	}
	else if($action=="send_data")
	{	
		// Useless
		echo json_encode("caca");
	}

