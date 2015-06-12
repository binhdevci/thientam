//dinh dang price khi nhap gia
/*$(function() {
	$('#PriceHN').blur(function() {
		$(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: 0 });
	})
	.keyup(function(e){
		var e = window.event || e;
		var keyUnicode = e.charCode || e.keyCode;
		if (e !== undefined) {
			switch (keyUnicode){
				case 16: break; // Shift
				case 27: this.value = ''; break; // Esc: clear entry
				case 35: break; // End
				case 36: break; // Home
				case 37: break; // cursor left
				case 38: break; // cursor up
				case 39: break; // cursor right
				case 40: break; // cursor down
				case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
				case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
				case 190: break; // .
				default: $(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
			}
		}
	});
	$('#Price').blur(function() {
		$(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: 0 });
	})
	.keyup(function(e){
		var e = window.event || e;
		var keyUnicode = e.charCode || e.keyCode;
		if (e !== undefined) {
			switch (keyUnicode){
				case 16: break; // Shift
				case 27: this.value = ''; break; // Esc: clear entry
				case 35: break; // End
				case 36: break; // Home
				case 37: break; // cursor left
				case 38: break; // cursor up
				case 39: break; // cursor right
				case 40: break; // cursor down
				case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
				case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
				case 190: break; // .
				default: $(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
			}
		}
	});
	$('#PriceCty').blur(function() {
		$(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: 0 });
	})
	.keyup(function(e){
		var e = window.event || e;
		var keyUnicode = e.charCode || e.keyCode;
		if (e !== undefined) {
			switch (keyUnicode){
				case 16: break; // Shift
				case 27: this.value = ''; break; // Esc: clear entry
				case 35: break; // End
				case 36: break; // Home
				case 37: break; // cursor left
				case 38: break; // cursor up
				case 39: break; // cursor right
				case 40: break; // cursor down
				case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
				case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
				case 190: break; // .
				default: $(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
			}
		}
	});
	$('#PriceHNPromo').blur(function() {
		$(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: 0 });
	})
	.keyup(function(e){
		var e = window.event || e;
		var keyUnicode = e.charCode || e.keyCode;
		if (e !== undefined) {
			switch (keyUnicode){
				case 16: break; // Shift
				case 27: this.value = ''; break; // Esc: clear entry
				case 35: break; // End
				case 36: break; // Home
				case 37: break; // cursor left
				case 38: break; // cursor up
				case 39: break; // cursor right
				case 40: break; // cursor down
				case 78: break; // N (Opera 9.63+ maps the "." from the number key section to the "N" key too!) (See: http://unixpapa.com/js/key.html search for ". Del")
				case 110: break; // . number block (Opera 9.63+ maps the "." from the number block to the "N" key (78) !!!)
				case 190: break; // .
				default: $(this).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
			}
		}
	});
});*/

var FPrice =  new function(){

	// Private stuff
	var private_variable = '';
 
 	function str2num(str)
	{
		var a = str.replace(/\.| |,|'/g,"");
		return parseInt(a) ;
	};
	
	function formatCurrency(num) 
	{
		num = num.toString().replace(/\$|\,/g,'');
		
		if(isNaN(num)) num = "0";
		
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		num = Math.floor(num/100).toString();
		
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++) num = num.substring(0,num.length-(4*i+3))+','+ num.substring(num.length-(4*i+3));
			
		return (((sign)?'':'-') + num);
	}
	
	return {
		
		getDiscount : function ()
		{ 
			$("#Discount").val($("#DiscountNumber").val()) ;
			$("#DiscountHN").val($("#DiscountNumberHN").val()) ;
			//clear date time
			if(($("#Discount").val()==0) && (($("#DiscountHN").val()==0)))
			{
				$("#DiscountStartDate").val("") ;
				$("#DiscountEndDate").val("") ;
			}
		},
	
		set_priceHCM : function() 
		{ 
			// dung khi gia thi truoc blur 
			// set gia khuyen mai = gia thi truong => discount=0
			var price = $("#Price").val() ;
			var price_km = $("#PriceCty").val() ;
			var discount = $("#Discount").val() ;
			
			if((price_km=="0") || (price_km=="") || (price_km == null))
			{
				$("#PriceCty").val(price) ;
				$("#Discount").val(0); 
				$("#DiscountNumber").val(0) ;
				return ;	
			}
			else
			{
				discount = str2num(price) - str2num(price_km) ; 
				$("#Discount").val(formatCurrency(discount)); 
				$("#DiscountNumber").val(formatCurrency(discount)) ;
				
				if(check_price(price, price_km, discount))
				{
					$("#lbdate").text("") ;
				}
			}
		},
		
		set_discountHCM : function() 
		{ 
			// dung khi gia khuyen mai blue
			// dinh gia discount tu gia thi truong va gia khuyen mai
			var price = $("#Price").val() ;
			var price_km = $("#PriceCty").val() ;
			var discount = $("#Discount").val() ;
			
			if((price_km=="0") || (price_km=="") || (price_km == null))
			{
				$("#Discount").val(0); 
				$("#DiscountNumber").val(0) ;
				// Xoa ngay thang khuyen mai giam gia
				if((($("#Discount").val()== null)||($("#Discount").val()== '')) && (($("#DiscountHN").val()== null)||(($("#DiscountHN").val()== ''))))
				{
					$("#DiscountStartDate").val() ;
					$("#DiscountEndDate").val() ;
				}
				return ;	
			}
			else
			{
				discount = str2num(price) - str2num(price_km) ; 
				$("#Discount").val(formatCurrency(discount)); 
				$("#DiscountNumber").val(formatCurrency(discount)) ;
				
				if(check_price(price, price_km, discount))
				{
					$("#lbdate").text("") ;
				}
			}
		},
		
		// dung cho Ha noi
		set_priceHN: function() 
		{ 
			var price = $("#PriceHN").val() ;
			var price_km = $("#PriceHNPromo").val() ;
			var discount = $("#DiscountHN").val() ;
			
			if((price_km==0) || (price_km=="") || (price_km == null))
			{
				$("#PriceHNPromo").val(price) ;
				$("#DiscountHN").val(0);
				$("#DiscountNumberHN").val(0) ;
				return ;	
			}
			else
			{
				discount = str2num(price) - str2num(price_km) ; 
				$("#DiscountHN").val(formatCurrency(discount)); 
				$("#DiscountNumberHN").val(formatCurrency(discount)) ;
				
				if(check_price(price, price_km, discount))
				{
					$("#lbdate").text("") ;
				}
			}
		},
		
		set_discountHN : function() 
		{ 
			var price = $("#PriceHN").val() ;
			var price_km = $("#PriceHNPromo").val() ;
			var discount = $("#DiscountHN").val() ;
			
			if((price_km==0) || (price_km=="") || (price_km == null))
			{
				$("#DiscountHN").val(0);
				$("#DiscountNumberHN").val(0) ;
				// Xoa ngay thang khuyen mai giam gia
				/*if((($("#Discount").val()== null)||($("#Discount").val()== '')) && (($("#DiscountHN").val()== null)||(($("#DiscountHN").val()== ''))))
				{
					$("#DiscountStartDate").val() ;
					$("#DiscountEndDate").val() ;
				}
				return ;*/	
			}
			else
			{
				discount = str2num(price) - str2num(price_km) ; 
				$("#DiscountHN").val(formatCurrency(discount)); 
				$("#DiscountNumberHN").val(formatCurrency(discount)) ;
				
				if(check_price(price, price_km, discount))
				{
					$("#lbdate").text("") ;
				}
			}
		},
		
		text:function()
		{
			$("#lbdate").text("") ;
		}
		
	};
};
/*function check_price(price, promo, discount)
{
	if(discount > promo)
	{
		$("#lbdate").text("Giảm giá lớn hơn giá khuyến mãi.") ;
		return false ;
	}
	if(promo > price)
	{
		$("#lbdate").text("Giá khuyến mãi lớn hơn giá thị trường.") ;
		return false ;
	}
	return true ;
}
*/
$().ready(function(){
	$("#PriceCty").focus(function(){ this.select(); });
	$("#PriceHNPromo").focus(function(){ this.select(); });
	
	$("#adminformproduct").submit(function(){
		// Check loi ve gia
		/*if(!check_price($("#Price").val(), $("#PriceCty").val(), $("#DiscountNumber").val()))
		{
			return false;
		}
		if(!check_price($("#PriceHN").val(), $("#PriceHNPromo").val(), $("#DiscountNumberHN").val()))
		{
			return false;
		}
		return true;*/
	});
});