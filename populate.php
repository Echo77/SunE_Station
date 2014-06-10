<?php

  $mongo_url = parse_url(getenv("MONGO_URL"));
  $dbname = str_replace("/", "", $mongo_url["path"]);
  $connection = new Mongo(getenv("MONGO_URL"));

  if(isset($_GET['action']) && $_GET['action'] == 'populate')
    populate($connection);
  if(isset($_GET['action']) && $_GET['action'] == 'delete') 
    del($connection);
  function del($connection) {
    $collection = $connection->sune;

    $cursor = $collection->paris->noeud1->remove();
    $cursor = $collection->paris->noeud2->remove();
    echo "Données supprimées";
  }
  //function to populate the database with random values.
  function populate($connection) {
    $collection = $connection->sune;
    for ( $i = 0; $i < 500; $i++ )
      {
      //[Date.UTC(1971,  0,  1), 0.81],
      //AAAA-MM-JJ HH:MM:SS
      $an = rand(2012,2015);
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
      $collection->paris->noeud2->insert( array(
        "capteur" => "TEMP1",
        "type" => "exterieur",
        "date" => $str,
        "location" => "paris",
        "temperature" => rand(0,40)) 
      );
    }
    echo "Données ajoutées";
  }

?>

