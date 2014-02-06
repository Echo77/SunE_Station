<?php 

    $connection = new MongoClient();
    $collection = $connection->sune;

	$action = isset($_POST['action']) ?  $_POST['action'] : false;
	$noeud = isset($_POST['noeud']) ?  $_POST['noeud'] : false;


	//$value_site = isset($_POST['value_site']) ?  $_POST['value_site'] : false;
	$value_noeud = isset($_POST['value_noeud']) ?  $_POST['value_noeud'] : false;
	$value_capteur = isset($_POST['value_capteur']) ?  $_POST['value_capteur'] : false;

		
		


	if($action=="change_site"){
		// Requete pour obtenir la liste des noeuds en fonction du site

	    $list = $collection->getCollectionNames();
	    $res = array();
	    foreach ($list as $key => $value) {
	    	$ex = explode('.', $value);
	    	$res[] = $ex[1];
	    }
	    echo json_encode($res);

	}

	else if($action=="change_noeud")
	{	
		// Requete pour obtenir la liste des capteurs en fonction du site
		$col = $collection->selectCollection('paris.'.$noeud);
		$cursor = $col->distinct("capteur");

		echo json_encode($cursor);
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
		$col = $collection->paris->$value_noeud->find();

		$params = array('capteur' => "TEMP1");
		//$result = $col->find();

	 	$cursor = $collection->selectCollection('paris.'.$value_noeud)->find();
	 	$res = array();
	    foreach ($cursor as $document) {
	        $res['data'][] = $document['temperature'];
	    }
	    echo json_encode($res);
	}



    /*
    $cursor = $collection->paris->find();

  // traverse les résultats
    $paris = array();
    $paris['name'] = 'Paris';
    foreach ($cursor as $document) {
        $paris['data'][] = array((int)$document['temperature']);
        //$stat_age[]=array('name'=>"Mai", 'data' =>array((int)$result['05']));
    }

    $cursor = $collection->newport->find();

  // traverse les résultats
    $newport = array();
    $newport['name'] = 'Newport Beach';
    foreach ($cursor as $document) {
        $newport['data'][] = array((int)$document['temperature']);
        //$stat_age[]=array('name'=>"Mai", 'data' =>array((int)$result['05']));
    }
*/
?>

