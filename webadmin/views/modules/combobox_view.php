<?php
/**
 * Paging Combobox
 * @author Tran Viet Quoc
 * @since 28/02/2011
 */
?>

<script type="text/javascript">

var index_page = '';
var c={};
var dataCombobox=<?php echo $dataCombobox==''?"''":$dataCombobox;?>;
var dataComboboxLevel=<?php echo $dataComboboxLevel==''?"''":$dataComboboxLevel;?>;
var arr_querydef = <?php echo $arr_querydef; ?>;
$(document).ready(function(){
	if(dataCombobox!='' && dataCombobox!=null){
		$.each(dataCombobox,function(k, v){
			var lb_field=k;
			var lb_data_source =v['lb_data_source'];
			var lb_sp_select = v['lb_sp_select'];
			var config = {maxHeight:180};
			c[k]=new Combobox(config);
			c[k].lb_sp_select = lb_sp_select;
			c[k].isSetOptionFirst=false;
			c[k].numRow = 50;
			c[k].position = "offset";
			//c[k].allowAdd=true;

			$("#"+lb_field+"_combobox").append('<input id="'+lb_field+'" name="'+lb_field+'" type="hidden"/>');

			var valueC=(v['value']==null)?'':v['value'];
			var ob_value={};
			if(v['display']!=null) ob_value[valueC]=v['display'];
			c[k].add( ob_value );
			c[k].beforeSetValue=function(){
				$("#"+lb_field).val(c[k].value);
				$(c[k].input).removeClass("hint");
				if(valueC!=c[k].value){
					valueC=c[k].value;
				}
			}
			$(c[k].input).keyup(function(event){
				if(c[k].disabled!=true && event.keyCode != 13){
				   $("#"+lb_field).val('');
				   $(c[k].input).addClass("hint");
				}
			});


			c[k].absolute=false;
			c[k].setValue(valueC);
			if(v['width_min']>0){
				c[k].resize(v['width_min']);
			}else{
				c[k].resize(150);
			}

			if(typeof v['lb_format']!=null ){
				c[k].params["lb_format"]=v['lb_format'];
			}
			else{
				c[k].params["lb_format"]='';
			}
			c[k].funcURL = url_site+'grid/load_combobox/'+lb_data_source+'/';
			var lb_source=v['lb_source'];
			var lb_value=v['lb_value_field'];
			var lb_display=v['lb_display_field'];
			c[k].loadURL=c[k].funcURL+lb_source+'/'+lb_value+'/'+lb_display+'/';
			$("#"+lb_field+"_combobox").append(c[k].html);
			$(document.body).append(c[k].panelBorder);

			var span = $("#"+lb_field+"_combobox");
			$(span).append(c[k].combo);
			
			var disabled = $(span).attr("disabled");
			c[k].disable(disabled);

		});
	}
	var gmt={};
});
function resetCombobox(){
$.each(c,function(k,v){
    if(!v.disabled) v.clear();
     //Trong Quoc add permision to selectbox
     
	 //End trong Quoc
});
}

</script>
