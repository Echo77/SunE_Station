<!DOCTYPE html>
<html lang="en">
    <title>Sun-e Station</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
label {
    display: block;
    margin-bottom: 5px;
}
label, input, button, select, textarea {
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
}
select {
    background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    width: 220px;
}
select, input[type="file"] {
    height: 30px;
    line-height: 30px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" /> 
  </head>
  <body>
 <div class="container">

      <div class="page-header">

        
      
 <div class="row">
        <div class="col-md-8">
          <h1>Sun-e Station</h1>
          <div class="row">
            <a id="populate" class="lead col-md-6">Ajouter des données aléatoires</a>
            <a id="delete" class="lead col-md-6">Supprimer des données</a>
          </div>
        </div>
        <div class="col-md-4"><img src="logo.jpg" width=50%></div>
      </div>
</div>
<h3>Choisissez vos options : </h3>
<div class="row">
        <div class="col-md-4">
      	
 			<div class="input select required">
 			<label for="Site">Site : </label>
			 <select id="site">
				<option value="">(choisissez)</option>
				<option value="site_1">Site 1</option>
			 </select>
			</div>
		    <div id="noeud"></div>
		    <div id="capteur"></div>
		 </div>
		 <div class="col-md-4">
		 	<div id="time_start"></div>
		 </div>

  		<div class="col-md-4">
  			<div id="time_end"></div>
  			</br>
  			<div id="send"><button type="button" class="btn btn-danger" id="request_grap">Envoyer</button></div>
  		</div>

 </div>
 <div class="row">
 	<div id="graph"></div>
 </div>
 </div> <!-- /container -->

  </body>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

</html>
