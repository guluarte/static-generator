
		$(document).keyup(function(e) 
		{
        	if (e.keyCode == 39 || e.keyCode == 75) 
        	{  
            	window.location.href = $("#next").attr('href');
        	}
        	if(e.keyCode==37 || e.keyCode == 74)
        	{
            	window.location.href = $("#prev").attr('href');
        	}
			if(e.keyCode==82)
        	{
            	window.location.href = $("#rand").attr('href');
        	}

		});
	