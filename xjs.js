

	function show_query_filters(look){

	    var json_data = {
	       "function" : look
	    };

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xshow_query_filters.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   	event.preventDefault();
	}

	function search_anywhere_info(link, filters){

		if (filters == "yes") {

			var array   = $( "#query_filters_form" ).serializeArray();
			var filters = JSON.stringify(array);
			var what    = "filters";

			var json_data = {
		       "filters"    : filters,
		       "what"       : what
		    };

		   	$.ajax({
			    type    : 'POST',
			    url     : link,
			    data    : json_data,
			    dataType: 'json'
			})
			.done( function( data ) {
			    console.log('done');
			    console.log(data);
			    $( "#dynamics_load" ).empty();
			    $( "#dynamics_load" ).append( data.answer );
			})
			.fail( function( data ) {
			    console.log('fail');
			    console.log(data);
			    $( "#dynamics_load" ).empty();
			    $( "#dynamics_load" ).append( data.answer );
			});

		} else {
			var what    = "all";
			var filters = "";

			$( "#dynamics_load" ).load(link, {"what" : what, "filters" : filters});
		}

		event.preventDefault();
	}

	function register_new_building() {

	    var building_name =  $( '#building_fields #building_name' ).val();
	    var description   =  $( '#building_fields #description' ).val();

	    var json_data = {
	       "building_name"	: building_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'register_new_building.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();
	}

	function update_building() {

		var building_id   =  $( '#building_fieldsx #building_id' ).val();
	    var building_name =  $( '#building_fieldsx #building_name' ).val();
	    var description   =  $( '#building_fieldsx #description' ).val();

	    var json_data = {
	       "building_id"	: building_id,
	       "building_name"	: building_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'update_building.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	    event.preventDefault();
	}

	default_map_timer = 10000;
	init_old          = 1;

	function set_initial_values() {
		default_map_timer = 15000;
	}

	setInterval(function () {
		if (init_old == 0) {
			draw_users_locations();
		}
	}, default_map_timer);


	function draw_users_locations(init) {


		var user_id    =  $( '#user_id' ).val();
		var floor_id   =  $( '#floor_id' ).val();
		var timev 	   =  $( '#timev').val();

		if (init == 0) { //Rastrear
			init_old = 0;
			if (timev != "") {
				default_map_timer = timev * 1000;
			}
		} else {
			if (init == undefined) {
				init_old = 0;	
			} else {
				init_old = 1;		
			}
		}

	    var json_data = {
	       "user_id"	: user_id,
	       "floor_id"	: floor_id
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xget_last_location_per_user.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);

		    var array = $.map(data.answer, function(value, index) {
			    
			    var img  = document.getElementById("map_id");
		      	var cnvs = document.getElementById("my_canvas");

		      	var mp     = 3779.5275591;
		      	var width  = 811 / (9 * mp); 
		      	var heigth = 473 / (7 * mp); 

		      	var cx    = value.xp * mp * width; 
		      	var cy    = value.yp * mp * heigth;
		      	var radio = 20;

		      	//811px = 0.2145770833 meter
		      	//473px = 0.1251479167 meter
		      	//1 m   = 3779.5275591 pixels
		      
		      	cnvs.style.position = "absolute";
		      	cnvs.style.left 	= img.offsetLeft + "px";
		      	cnvs.style.top 		= img.offsetTop + "px";
		      
		      	var ctx = cnvs.getContext("2d");
		      	    ctx.beginPath();
		      	//ctx.arc(cx, cy, radio, 0=show full circle, 2 * Math.PI, false);

		      	ctx.arc(cx, cy, radio, 0, 2 * Math.PI, true);

		      	ctx.lineWidth   = 3;
		      	ctx.fillStyle   = value.color;
		      	ctx.strokeStyle = value.color;
		      	ctx.fill();
		      	ctx.stroke();
	 		
	 		});

		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	    //event.preventDefault();
    }


    function draw_users_locations_record() {

		var user_id    =  $( '#user_id' ).val();
		var floor_id   =  $( '#floor_id' ).val();

		init_old = 1; //Evitar rastrear...

	    var json_data = {
	       "user_id"	: user_id,
	       "floor_id"	: floor_id
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xdraw_users_locations_record.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);

		    var array = $.map(data.answer, function(value, index) {
			    
			    var img  = document.getElementById("map_id");
		      	var cnvs = document.getElementById("my_canvas");

		      	var mp     = 3779.5275591;
		      	var width  = 811 / (9 * mp); 
		      	var heigth = 473 / (7 * mp); 

		      	var cx    = value.xp * mp * width; 
		      	var cy    = value.yp * mp * heigth;
		      	var radio = 20;

		      	//811px = 0.2145770833 meter
		      	//473px = 0.1251479167 meter
		      	//1 m   = 3779.5275591 pixels
		      
		      	cnvs.style.position = "absolute";
		      	cnvs.style.left 	= img.offsetLeft + "px";
		      	cnvs.style.top 		= img.offsetTop + "px";
		      
		      	var ctx = cnvs.getContext("2d");
		      	    ctx.beginPath();
		      	//ctx.arc(cx, cy, radio, 0=show full circle, 2 * Math.PI, false);

		      	ctx.arc(cx, cy, radio, 0, 2 * Math.PI, true);

		      	ctx.lineWidth   = 3;
		      	ctx.fillStyle   = value.color;
		      	ctx.strokeStyle = value.color;
		      	ctx.fill();
		      	ctx.stroke();
	 		
	 		});

		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	    //event.preventDefault();
    }

    function get_map(floor_id) {

	    var json_data = {
	       "floor_id"	: floor_id
	    };

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xget_map.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#dynamics_load" ).empty();
		    $( "#dynamics_load" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#dynamics_load" ).empty();
		    $( "#dynamics_load" ).append( data.answer );
		});

	    event.preventDefault();
	}

	//Pisos
	function register_new_floor() {

	    var floor_name =  $( '#floor_fields #floor_name' ).val();
	    var description   =  $( '#floor_fields #description' ).val();

	    var json_data = {
	       "floor_name"	: floor_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'register_new_floor.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}

	function update_floor() {

		var floor_id   =  $( '#floor_fieldsx #floor_id' ).val();
	    var floor_name =  $( '#floor_fieldsx #floor_name' ).val();
	    var description   =  $( '#floor_fieldsx #description' ).val();

	    var json_data = {
	       "floor_id"	: floor_id,
	       "floor_name"	: floor_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'update_floor.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}

	//Pasillos
	function register_new_hall() {

	    var hall_name =  $( '#hall_fields #hall_name' ).val();
	    var description   =  $( '#hall_fields #description' ).val();

	    var json_data = {
	       "hall_name"	: hall_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'register_new_hall.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}

	function update_hall() {

		var hall_id   =  $( '#hall_fieldsx #hall_id' ).val();
	    var hall_name =  $( '#hall_fieldsx #hall_name' ).val();
	    var description   =  $( '#hall_fieldsx #description' ).val();

	    var json_data = {
	       "hall_id"	: hall_id,
	       "hall_name"	: hall_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'update_hall.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}

	//Sentido
	function register_new_hand() {

	    var hand_name =  $( '#hand_fields #hand_name' ).val();
	    var description   =  $( '#hand_fields #description' ).val();

	    var json_data = {
	       "hand_name"	: hand_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'register_new_hand.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}

	function update_hand() {

		var hand_id   =  $( '#hand_fieldsx #hand_id' ).val();
	    var hand_name =  $( '#hand_fieldsx #hand_name' ).val();
	    var description   =  $( '#hand_fieldsx #description' ).val();

	    var json_data = {
	       "hand_id"	: hand_id,
	       "hand_name"	: hand_name,
	       "description" 	: description
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'update_hand.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	   event.preventDefault();

	}



//Deprecated...
	function draw_locations() {

		//var building_id   =  $( '#building_fieldsx #building_id' ).val();
		var level_id = 1;

	    var json_data = {
	       "level_id"	: level_id
	    };

	    //Sanity 
	    json_data = JSON.stringify(json_data);
	    json_data = json_data.replace(/'/g,"''");
	    json_data = JSON.parse(json_data);
	    //Sanity

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xdraw_locations.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);

		    //alert(data.answer[1].color);

		    var array = $.map(data.answer, function(value, index) {
			    
			    var img  = document.getElementById("map_id");
		      	var cnvs = document.getElementById("my_canvas");

		      	var mp     = 3779.5275591;
		      	var width  = 811 / (9 * mp); 
		      	var heigth = 473 / (7 * mp); 

		      	var cx    = value.xp * mp * width; 
		      	var cy    = value.yp * mp * heigth;
		      	var radio = 20;

		      	//811px = 0.2145770833 meter
		      	//473px = 0.1251479167 meter
		      	//1 m   = 3779.5275591 pixels
		      
		      	cnvs.style.position = "absolute";
		      	cnvs.style.left 	= img.offsetLeft + "px";
		      	cnvs.style.top 		= img.offsetTop + "px";
		      
		      	var ctx = cnvs.getContext("2d");
		      	    ctx.beginPath();
		      	//ctx.arc(cx, cy, radio, 0=show full circle, 2 * Math.PI, false);

		      	ctx.arc(cx, cy, radio, 0, 2 * Math.PI, false);

		      	ctx.lineWidth = 3;
		      	ctx.strokeStyle = value.color;
		      	ctx.stroke();
	 		
	 		});

		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#entry_result" ).empty();
		    $( "#entry_result" ).append( data.answer );
		});

	    event.preventDefault();
    }