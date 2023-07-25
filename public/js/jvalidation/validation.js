jQuery(document).ready(function()
{
	var isAllow = ["q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","ñ","z","x","c","v","b","n","m"," ","á","é","í","ó","ú","'"];
        var isAllowLetterNumber = ["q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","ñ","z","x","c","v","b","n","m","á","é","í","ó","ú","1","2","3","4","5","6","7","8","9","0"];
        
	validateNumber = function(event)
	{
		var key = window.event ? event.keyCode : event.which;
		if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9
		 || event.keyCode == 37 || event.keyCode == 39)
		 {
			return true;
		}
		else if ( key < 48 || key > 57 ){
			return false;
		}
		else{
			return true;
		}
	}
	
	validateDecimal = function(event)
	{
		var key = window.event ? event.keyCode : event.which;
		if (
		(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9
		 || event.keyCode == 37 || event.keyCode == 39) && (event.target.value).indexOf(".") == -1
		)
		 {
			return true;
		}			
		else if ( key < 48 || key > 57 ){
			return false;
		}
		else{
			return true;
		}
	}

	remove_space_doble = function(val){
			return val.replace(/\s+/g,' ').replace(/^\s+|\s+$/,'');
	}

	ismyInteger = function(s,event){
		var i;
		value = s;
		if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 36 || event.keyCode == 35
		 )
		{
			return false;
		}

		for(i = 0; i < s.length; i++)
		{
			var c = parseInt(s.charAt(i));
			if (isNaN(c))
			{
				value = value.replace(s.charAt(i),'');
			}
		}
		return value;
	}
        // Permitir solo numeros
	jQuery('body').on("keypress",".only_number",validateNumber);
	jQuery('body').on("keypress",".only_decimal",validateDecimal);
	
	jQuery('body').on("keyup",".only_number",function(e)
	{
		if(!ismyInteger(jQuery(this).val(),e)){
		}
		else
		{
			jQuery(this).val(ismyInteger(jQuery(this).val(),e));
		}
	});
	jQuery('body').on("blur",".only_number",function(e)
	{
		jQuery(this).val(ismyInteger(jQuery(this).val(),e));
	});

        // Permitir solo letras
	jQuery('body').on("keyup",'.only_letters',function(e)
	{
		if(e.keyCode != 36 && e.keyCode != 16 && e.keyCode != 46 && e.keyCode != 9 && e.keyCode != 39 && e.keyCode != 37)
		{
			var s = jQuery(this).val();
			value = s;
			for(i = 0; i < s.length; i++)
			{
				c = s.charAt(i);
				c = c.toLowerCase();
				if(jQuery.inArray(c,isAllow) == -1)
				{
					value = value.replace(s.charAt(i),'');
					jQuery(this).val(value);
				}
			}
		}
	});

	jQuery('body').on("keypress",".only_letters",function()
	{
		var s = jQuery(this).val();
		value = s;
		for(i = 0; i < s.length; i++)
		{
			c = s.charAt(i);
			c = c.toLowerCase();
			if(jQuery.inArray(c,isAllow) == -1)
			{
				value = value.replace(s.charAt(i),'');
				jQuery(this).val(value);
			}
		}
	});

	jQuery('body').on("blur",".only_letters",function()
	{
		var s = jQuery(this).val();
		value = s;
		for(i = 0; i < s.length; i++)
		{
			c = s.charAt(i);
			c = c.toLowerCase();
			if(jQuery.inArray(c,isAllow) == -1)
			{
				value = value.replace(s.charAt(i),'');
				jQuery(this).val(value);
			}
		}
	});

	jQuery(".only_letters").bind("blur",function()
	{
		jQuery(this).val(remove_space_doble(jQuery(this).val()));
	});

	is_email = function(val)
	{
		var filter = /^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
		if(filter.test(val))
		{
			if(val.indexOf("..") != -1)
			{
				return false;
			}
			return true;
		}
		return false;
	}
        
        // Permitir solo letras y numeros sin espacio
        
        remove_space_all = function(val){
			return val.replace(/\s+/g,'');
	}
        
        jQuery('body').on("keyup",'.only_letters_and_number',function(e)
	{
		if(e.keyCode != 36 && e.keyCode != 16 && e.keyCode != 46 && e.keyCode != 9 && e.keyCode != 39 && e.keyCode != 37)
		{
			var s = jQuery(this).val();
			value = s;
			for(i = 0; i < s.length; i++)
			{
				c = s.charAt(i);
				c = c.toLowerCase();
				if(jQuery.inArray(c,isAllowLetterNumber) == -1)
				{
					value = value.replace(s.charAt(i),'');
					jQuery(this).val(value);
				}
			}
		}
	});

	jQuery('body').on("keypress",".only_letters_and_number",function()
	{
		var s = jQuery(this).val();
		value = s;
		for(i = 0; i < s.length; i++)
		{
			c = s.charAt(i);
			c = c.toLowerCase();
			if(jQuery.inArray(c,isAllowLetterNumber) == -1)
			{
				value = value.replace(s.charAt(i),'');
				jQuery(this).val(value);
			}
		}
	});

	jQuery('body').on("blur",".only_letters_and_number",function()
	{
		var s = jQuery(this).val();
		value = s;
		for(i = 0; i < s.length; i++)
		{
			c = s.charAt(i);
			c = c.toLowerCase();
			if(jQuery.inArray(c,isAllowLetterNumber) == -1)
			{
				value = value.replace(s.charAt(i),'');
				jQuery(this).val(value);
			}
		}
	});

	jQuery(".only_letters_and_number").bind("blur",function()
	{
		jQuery(this).val(remove_space_all(jQuery(this).val()));
	});
});