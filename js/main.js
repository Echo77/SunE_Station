
$(document).ready(function(){ 
	
	$('#send').hide();

	$('#site').change(function () {
		var params = {
	   		action: 'change_site',
	   		value: $("#site").val()
							 };
				$.ajax({
		        url: 'mango.php',
		        type: 'POST', 
		        data: params,
		        cache: false,
		       dataType: 'json',

		        success: function(res) {
		        	var str = "<label>Noeud : </label>\
											 <select id='change_noeud'>\
												<option value=''>(choisissez)</option>\ ";
					$.each(res, function( index, value ) {
					  str+= "<option value='"+value+"'>"+value+"</option>\ ";
					});
					str+="</select>";

		        	$("#noeud").empty().append(str);
	    									}
					 });
	});
	$('#noeud').on("change", "#change_noeud", function () {
		var params = {
	       		action: 'change_noeud',
	       		noeud: $("#change_noeud").val()
	   						 };
	   			$.ajax({
			        url: 'mango.php',
			        type: 'POST', 
			        data: params,
			        cache: false,
			       dataType: 'json',

			        success: function(res) {
			        	var str = " <label>Capteur : </label>\
												 <select id='change_capteur'>\
													<option value=>(choisissez)</option>\ ";
						$.each(res, function( index, value ) {
						  str+= "<option value='"+value+"'>"+value+"</option>\ ";
						});
						str+="</select></div>";

			        	$("#capteur").empty().append(str);
	        									}
	   				 });
	});

	$('#capteur').on("change", "#change_capteur", function () {
		var params = {
	       		action: 'change_time',
	       		value: $("#site").val()
	   						 };
	   			$.ajax({
			        url: 'mango.php',
			        type: 'POST', 
			        data: params,
			        cache: false,
			       dataType: 'json',

			        success: function(res) {

			        	$("#time_start").empty().append("<br><label>Date de début : </label>\
			        							<input type='text' class='date' id='date_start'>\
			        							<br><br>\
			        							<label> Heure de début : </label>\
			        							<select id='hour_start'>\
													<option value=>(choisissez)</option>\
													<option value='00'>00h</option>\
													<option value='01'>01h</option>\
													<option value='02'>02h</option>\
													<option value='03'>03h</option>\
													<option value='04'>04h</option>\
													<option value='05'>05h</option>\
													<option value='06'>06h</option>\
													<option value='07'>07h</option>\
													<option value='08'>08h</option>\
													<option value='09'>09h</option>\
													<option value='10'>10h</option>\
													<option value='11'>11h</option>\
													<option value='12'>12h</option>\
													<option value='13'>13h</option>\
													<option value='14'>14h</option>\
													<option value='15'>15h</option>\
													<option value='16'>16h</option>\
													<option value='17'>17h</option>\
													<option value='18'>18h</option>\
													<option value='19'>19h</option>\
													<option value='20'>20h</option>\
													<option value='21'>21h</option>\
													<option value='22'>22h</option>\
													<option value='23'>23h</option>\
												 </select></div>" );

						$("#time_end").empty().append("<br><label>Date de fin : </label>\
			        							<input type='text' class='date' id='date_end'>\
			        							<br><br>\
			        							<label> Heure de fin : </label>\
			        							<select id='hour_end'>\
													<option value=>(choisissez)</option>\
													<option value='0'>00h</option>\
													<option value='1'>01h</option>\
													<option value='2'>02h</option>\
													<option value='3'>03h</option>\
													<option value='4'>04h</option>\
													<option value='5'>05h</option>\
													<option value='6'>06h</option>\
													<option value='7'>07h</option>\
													<option value='8'>08h</option>\
													<option value='9'>09h</option>\
													<option value='10'>10h</option>\
													<option value='11'>11h</option>\
													<option value='12'>12h</option>\
													<option value='13'>13h</option>\
													<option value='14'>14h</option>\
													<option value='15'>15h</option>\
													<option value='16'>16h</option>\
													<option value='17'>17h</option>\
													<option value='18'>18h</option>\
													<option value='19'>19h</option>\
													<option value='20'>20h</option>\
													<option value='21'>21h</option>\
													<option value='22'>22h</option>\
													<option value='23'>23h</option>\
												 </select></div>" );
			        	$( ".date" ).datepicker();

			        	$('#send').show();

	        									}
	   				 });
	});
	
	$('#send').click(function () {
		requestData();
	});

	function requestData() {

	    var options = {
	        chart: {
	            renderTo: 'graph',
	            defaultSeriesType: 'spline'
	        },
	        credits: {
	            enabled: false
	        },
	        title: {
	            text: 'Graphique du capteur \''+$("#change_capteur").val()+'\' du noeud \''+$("#change_noeud").val()+'\' en fonction du temps',
	            style: {
	                color: '#57A000'
	            }
	        },
	        legend: {
	            enabled: false
	        },
	        xAxis: {    
		        type: 'datetime'
		    },
	        yAxis: {
	            minPadding: 0.2,
	            maxPadding: 0.2,
	            title: {
	                text:'',
	                margin: 40,
	                style: {
	                    color: '#57A000'
	                }
	            },
	            //min : 0,
	            minTickInterval: 1
	        },
	        series: [{
	            color: '#57A000'
	        }]
	    };


	      var params = {
		       		action: 'send_data',
		       		//value_site: $("#site").val(), ne sert à rien vu qu'un seul site 	
		       		value_noeud:$("#change_noeud").val(),
		       		//value_time: $("#change_time").val(),
		       		value_capteur: $("#change_capteur").val(),
		       		value_hour_start: $("#hour_start").val(),
		       		value_hour_end: $("#hour_end").val(),
		       		date_start: $("#date_start").val(),
		       		date_end: $("#date_end").val()
		   						 };

	    $.ajax({
	        url: 'mango.php',
	        type: 'POST',
	        data: params,
	        cache: false,
	        dataType: 'json',
	        success: function(res) {
	            options.series[0] = res['d'];
	            options.yAxis.title.text = res['l'][0];
	            chart = new Highcharts.Chart(options);
	            
	        }
	    });
	}
	$("#populate").click(function() {
		$.get( "populate.php?action=populate", function(data) {
			alert(data);
		});
	});
	$("#delete").click(function() {
		$.get( "populate.php?action=delete", function(data) {
			alert(data);
		});
	});
	
	
});
	    
