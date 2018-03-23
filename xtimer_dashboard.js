	
	//var pathname = window.location.pathname; // Returns path only
	//var url  	 = window.location.href;       // Returns full URL

	setInterval(function () {
		xcount_users();
	}, 15000);


	function xcount_users() {

		var init = 0;

	    var json_data = {
	       "init"	: init
	    };

	   	$.ajax({
		    type    : 'POST',
		    url     : 'xcount_users.php',
		    data    : json_data,
		    dataType: 'json'
		})
		.done( function( data ) {
		    console.log('done');
		    console.log(data);
		    $( "#nusers_id" ).empty();
		    $( "#nusers_id" ).append( data.answer );
		})
		.fail( function( data ) {
		    console.log('fail');
		    console.log(data);
		    $( "#nusers_id" ).empty();
		    $( "#nusers_id" ).append( data.answer );
		});

	}