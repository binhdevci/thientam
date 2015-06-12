var makelist = {
	listid : '' ,
	listname : '',
	
	init:function(id, name)
	{
		this.listid = listid ;
		this.listname = listname ;
	},
	
	add : function (id)
	{
		//list proid
		var listid = document.getElementById("proid").value ;
		if(listid=='')
			listid = id ;
		else
			listid = listid + "," + id ;
		document.getElementById("proid").value = listid;
	},
	
	remove:function (items)
	{
		var listid = document.getElementById("proid").value ;
		var arrID = listid.split(",") ;
		arrID.splice(items,1);
		listid = arrID.toString(); 
		document.getElementById("proid").value = listid;
	},
	
	chkid : function (id)
	{
		var listid = document.getElementById("proid").value ;
		var arrID = listid.split(",") ;
		for(var i =0; i<arrID.length;i++)
		{
			if(arrID[i]==id) return true;
		}
		return false ;
	},
	
	render:function ()
	{
		var lsid = document.getElementById('proid').value;
		if(lsid=='') return ;
		document.getElementById('proid').value = '';
		
		var xmlhttp = ajax.isdom("get_product.php?mode=proname&lsid="+lsid);
		var proname = xmlhttp.responseText ;
		var arr = proname.split("~");
		for(var i=0;i<arr.length;i++)
		{
			var pro = arr[i].split("|");
			appendOptionLast(pro[1], pro[0]);
			add_proid(pro[0]) ;
		}
	} ,
	
	add_product:function (url)
	{
		var obj = showpopup(url) ;
		if (obj == null) return ;
		if(ckhexist(obj.orgid))
			alert("Product is exist") ;
		else
		{
			add_proid(obj.orgid) ;
			appendOptionLast(obj.orgname, obj.orgid) ;
		}
	},
	
	remove_product:function ()
	{
		var items = removeOptionSelected();
		remove_proid(items) ;
	}

};

var count1 = 0;
var count2 = 0;

var opts = {} ;

var insertOptionBefore = function (num)
{
	var elSel = document.getElementById('product_name');
	if (elSel.selectedIndex >= 0) {
		var elOptNew = document.createElement('option');
		elOptNew.text = 'Insert' + num;
		elOptNew.value = 'insert' + num;
		var elOptOld = elSel.options[elSel.selectedIndex];  
		try {
			elSel.add(elOptNew, elOptOld); // standards compliant; doesn't work in IE
		}
		catch(ex) {
			elSel.add(elOptNew, elSel.selectedIndex); // IE only
		}
	}
}

var removeOptionSelected = function ()
{
	var elSel = document.getElementById('product_name');
	for (var i = elSel.length - 1; i>=0; i--) {
		if (elSel.options[i].selected) {
			elSel.remove(i); 
			return i ;
		}
	}
	return;
}

var appendOptionLast = function (text, value)
{
	var elOptNew = document.createElement('option');
	elOptNew.text = text ;
	elOptNew.value = value ;
	
	var elSel = document.getElementById('product_name');
	try {
		elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
	}
	catch(ex) {
		elSel.add(elOptNew); // IE only
	}
}

var removeOptionLast = function ()
{
	var elSel = document.getElementById('product_name');
	if (elSel.length > 0)
	{
		elSel.remove(elSel.length - 1);
	}
}