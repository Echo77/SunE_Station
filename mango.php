<?php 

    $connection = new MongoClient();
    $collection = $connection->sune;

	$action = isset($_POST['action']) ?  $_POST['action'] : false;
	$noeud = isset($_POST['noeud']) ?  $_POST['noeud'] : false;


	//$value_site = isset($_POST['value_site']) ?  $_POST['value_site'] : false;
	$value_noeud = isset($_POST['value_noeud']) ?  $_POST['value_noeud'] : false;
	$value_capteur = isset($_POST['value_capteur']) ?  $_POST['value_capteur'] : false;
	$value_hour_start = isset($_POST['value_hour_start']) ?  $_POST['value_hour_start'] : '00';
	$value_hour_end = isset($_POST['value_hour_end']) ?  $_POST['value_hour_end'] : '00';
	$date_start = isset($_POST['date_start']) ?  $_POST['date_start'] : false;
	$date_end = isset($_POST['date_end']) ?  $_POST['date_end'] : false;

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
		echo json_encode("");
	}
	else if($action=="change")
	{	
		// Useless
		echo json_encode("");
	}



	else if($action=="send_data")
	{	
		if($date_start == false) {
			$start = '0000-00-00 01:00:00';
		} else {
			$date_start = explode('/', $date_start);
			$start = $date_start[2].'-'.$date_start[0].'-'.$date_start[1].' '.$value_hour_start.':00:00';
		}

		if(!$date_end) {
			$end = date("Y-m-d H:i:s");
		} else {
			$date_end = explode('/', $date_end);
			$end = $date_end[2].'-'.$date_end[0].'-'.$date_end[1].' '.$value_hour_end.':00:00';			
		}


		$params = array('date' => array( '$gt' => $start, '$lt' => $end), 'capteur' => $value_capteur);

	 	$cursor = $collection->selectCollection('paris.'.$value_noeud)->find($params);
	 	$cursor->sort(array('date' => 1));
	 	$res = array();


	    foreach ($cursor as $document) {
	        $res['d']['data'][] = array(1000*strtotime($document['date']), $document['temperature']); //strtotime

	    }

	    $res['l'][0] = 'Température °C';

	    echo json_encode($res);
	}

	if(isset($_GET['test']) && $_GET['test'] == 'true') {
		for ( $i = 0; $i < 250; $i++ )
	    {
			//[Date.UTC(1971,  0,  1), 0.81],
			//AAAA-MM-JJ HH:MM:SS
			$an = rand(2010,2015);
			$mo = rand(1,12);
			$jo = rand(1,27);
			$he = rand(0,23);
			$mi = rand(0,59);
			$se = rand(0,59);
			if($mo<10) {
				$mo = '0'.$mo;
			}
			if($jo<10) {
				$jo = '0'.$jo;
			}
			if($he<10) {
				$he = '0'.$he;
			}
			if($mi<10) {
				$mi = '0'.$mi;
			}
			if($se<10) {
				$se = '0'.$se;
			}
			$str = $an.'-'.$mo.'-'.$jo.' '.$he.':'.$mi.':'.$se;
			$collection->paris->noeud1->insert( array(
			  "capteur" => "TEMP1",
			  "type" => "exterieur",
			  "date" => $str,
			  "location" => "paris",
			  "temperature" => rand(-10,20)) 
			);
		}
		echo "done";
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

