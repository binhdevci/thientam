
<script type="text/javascript">
    /*
     * @author: Tran Viet Quoc
     * @description: Advaced search and Quick search
     */
    var items={};
 var  rs_search = new Array();
 var  global = new Array();
	rs_search['strselect'] = '';
    global['strSearch'] = '';
  var   searchOptions='';
    advSearch={
        parameters:{},
        id : 0,
      //  gridSearch : null,
        loadURL : '',
        searchURL : '',
        search : function(){
            if(advSearch.id>0){
				advSearch.makeSearch();
            }
        },

        makeSearch : function(){
        	///Source Viet Quoc
             rs_search = getStrSearch();
            
            if(rs_search=='false'){
                return;
            }
            $("#div_rs_adv_search_id").html('<div style="float:left;" id="div_title_adv_search_id2">Advanced search:</div>\n\
                <div style="padding: 2px 2px 2px 175px;">'+rs_search['strselect']+'</div>' );
			var pInfo ={};
			var tn ={};
            pInfo.totalRowNum = tn>0?tn:0;
            pInfo.endRowNum=0;
            pInfo.pageNum=1;
            pInfo.startRowNum=1;
            pInfo.totalPageNum=0;
            pInfo.totalRowNum=0;

            global['search']=true;
            global['quickSearch']=false;
            global['strSearchForExport'] ='Advanced search: '+ rs_search['strselect'];
            $("#f_value_quick").val('');
            var valueAdvSearch=$("#val_1").val();
			//console.log(rs_search['strwhere']);
           $.post(
                advSearch.searchURL,
                {
                    strwhere: rs_search['strwhere'],
                    dataService : rs_search['dataService'],
                    pageInfo: pInfo,
                    parameters:advSearch.parameters,
					type:"ajax"
                },
                function(data){
                   $(".box-content").html(data);
                }, "html"
            );
            ///End source Viet Quoc
        },
    
        show : function(){
            if(document.getElementById(id_div_container_adv_search)==null){
                if(typeof advSearch.id_container=='undefined'){
                     $("#view_port").prepend('<div id='+id_div_container_adv_search+'>');
                }else{
                    $("#"+advSearch.id_container).prepend('<div id='+id_div_container_adv_search+'>');
                }
                createAdvSearch();
                createResultAdvSearch();
            }
        },

        refresh : function(){
            if(global['search'] && this.id>0){
                var sortInfo=advSearch.gridSearch.getSortInfo();
                this.gridSearch.loadURL=this.searchURL+'/reload';
                var rs_search = getStrSearch(this.gridSearch);
                this.gridSearch.parameters['strwhere']=rs_search['strwhere'];
                this.gridSearch.parameters['dataService']=rs_search['dataService'];
                this.gridSearch.parameters['sortInfo']=sortInfo;
                this.gridSearch.parameters['parameters']=advSearch.parameters;
            }
        }
    }
    
    var index_page='<?php //echo $index_page; ?>';
    var lb_sp_select='<?php //echo $lb_sp_select; ?>';
    var colsOptionSearch='';
    var colsOptionSearchF={};
	
	colsOptionSearch=<?php echo $colsOptionSearch; ?>;
	
	$.each(colsOptionSearch, function(k,v){
			   if(v.id!='chk' && v.hidden!=true && v.id!='bl_deactivated'){
				   colsOptionSearchF[k]=v;
			   }
	});
        
	colsOptionSearch=colsOptionSearchF;
    var arr_edit_mask=<?php echo $arr_edit_mask; ?>;
    var arr_display_format=[]<?php //echo $arr_display_format ?>;

    var id_div_container_adv_search="id_div_container_adv_search";
    var id_div_adv_search="id_div_adv_search";
    var div_itm_adv_search_num=0;

    
    var logicStr={
        "like" : "Contains",
        "notlike":"Does not contain",
        "=" : "Equals",
        "<>" : "Does not equal",
        "startWith" : "Begins with",
        "endWith" : "Ends with"
    };
    var logicNum={
        "=" : "Equals",
        "<>" : "Does not equal",
        "<" : "Less than",
        ">" : "Great than",
        "<=" : "Less or equal",
        ">=" : "Great or equal"
    };

    var logicDeactivated={
        "=" : "Equals"
    };

    var condition={
        "" : "",
        "and" : "And",
        "or" : "Or",
        "not" : "Not"
    };

    function refreshAdvSearch(){
        for(var i=2; i <= (div_itm_adv_search_num+1); i++){
            $('#'+i).remove();
            delete items[i];
        }
        items[1]['operator'].setValue('');
        $("#val_1").val('');
        global['strSearch']='';
        searchOptions='';
        div_itm_adv_search_num=1;
        $('#div_rs_adv_search_id').html('');
        $('#div_rs_adv_search_id').hide();
    }
    /**
     * @author: Tran Viet Quoc
     */
    function createAdvSearch(){
        // advSearch.gridSearch.sortDB=advSearch.search; //*****//
        items={};
        div_itm_adv_search_num=0;
        if(document.getElementById(id_div_adv_search)==null){
            var html='<div id="'+id_div_adv_search+'" class="search_border1">';
            html+='<div id="div_title_adv_search_id" style="float: left; height:20px; padding-top:6px;" >Advanced search:</div>';
            html+='</div>';
            $("#"+id_div_container_adv_search).append(html);
            createItmAdvSearch();
        }

    }
    
    /**
     * @author: Tran Viet Quoc
     */
    function createCmb(id_select, colsOption, div_id, classCSS){
        //Combobox.href=site_url+"js/combobox/";
        //Combobox.init();
        var config = {
            hasEmptyRow : false
        };
        var c = new Combobox(config);
        c.addClass(classCSS);
        c.add(colsOption);
        $(c.input).attr("id", id_select);
        $("#"+div_id+"").append(c.html);
        //Combobox.reBuild();
        return c;
    }
    /**
     * @author: Tran Viet Quoc
     */
    function createItmAdvSearch(){
        div_itm_adv_search_num++;
        var i=div_itm_adv_search_num;
        var html='<div id='+i+' style="padding: 2px 2px 2px 150px;"></div>';
        $("#"+id_div_adv_search+"").append(html);

        items[i]={};
        //################ Field ####################
        items[i]['field']=createCmb('lb_field_'+i,colsOptionSearch, i, 'search_select');
        items[i]['field'].onChange=function(val){
            onChangeField(val,i);
        }
        $(items[i]['field'].input).attr("readonly","true");
        //################ Logic ####################
        items[i]['logic']=createCmb('logic_'+i,logicStr, i,'search_select_short');
        items[i]['logic'].resize(110);
        $(items[i]['logic'].input).attr("readonly","true");
        //################ Value ####################
        if(i==1){
            items[i]['value']=createCombobox('val_'+i,i, "onkeyupVal(this);", "search_input_long");
        }
        else {
            items[i]['value']=createCombobox('val_'+i,i, "", "search_input_long");
        }
        items[i]['value'].resize(300);
        items[i]['value'].isSetOptionFirst=false;
        $(items[i]['value'].input).keyup(function(event){
            if(event.keyCode==13){
                //$(advSearch.gridSearch.tools.filterTool).click();
                items[i]['value'].hidePanel();
            }
        });
        //################ Operator #################
        items[i]['operator']=createCmb('',condition, i, "search_select_shortest");
        items[i]['operator'].onChange=function(val){
            changeSelect(val,i);
        }
        items[i]['operator'].resize(80);
        $(items[i]['operator'].input).attr("readonly","true");
        //################### Frontend #############
        if(typeof items[i]['field'].options['id_branch']!='undefined' && items[i]['field'].options['id_branch']=='Managed by'){
            items[i]['field'].setValue('id_branch');
            items[i]['logic'].setValue('=');
        }
    }
    /**
     * @author: Tran Viet Quoc
     */
    function createCombobox(id_input, id_div_container, onkeyup, classCSS){
        var i=div_itm_adv_search_num;
        //Combobox.href=site_url+"js/combobox/";
        //Combobox.init();
        var c=new Combobox();
        c.addClass(classCSS);
        c.numRow = 50;
        $(c.input).attr("id", id_input);
        $(c.input).keyup(function(){
            onkeyupVal(this);
        });
        if(typeof arr_display_format[lb_field]!='undefined' && typeof arr_display_format[lb_field]['lb_format']!='undefined'){
            c.params["lb_format"]=arr_display_format[lb_field]['lb_format'];
        }
        else{
            c.params["lb_format"]='';
        }
        var lb_field=items[i]['field'].value;
        c.funcURL='';
            var lb_source=arr_edit_mask[lb_field]['lb_source'];
            var lb_value=arr_edit_mask[lb_field]['lb_value_field'];
            var lb_display=arr_edit_mask[lb_field]['lb_display_field'];
			
           //  c.loadURL=c.funcURL+'ajax/load_combobox/'+lb_source+'/'+lb_value+'/'+lb_display+'/';
			 c.loadURL=base_url+'ajax/load_combobox/'+lb_source+'/'+lb_value+'/'+lb_display+'/';
        c.load();
        $("#"+i+"").append(c.html);

        return c;
    }
    function onkeyupVal(inputVal){
        if($(inputVal).val()=='' && div_itm_adv_search_num<2) $("#div_rs_adv_search_id").css("display","none");
    }
    /**
     * @author: Tran Viet Quoc
     */
    function createResultAdvSearch(){
        if(document.getElementById("div_rs_adv_search_id")==null){
            var html='<div id="div_rs_adv_search_id" class="search_border2" style="display: none; margin-top:0px;">';
            html+='Advanced search: </div>';
            $("#"+id_div_container_adv_search).append(html);
        }
    }
    /**
     * @author: Tran Viet Quoc
     */
    function changeSelect(val, item_num){
        if(val==''){
            var i=0;
            var j=div_itm_adv_search_num;
            for(i=item_num+1; i<=j; i++){
                delete items[i];
                $("#"+i).remove('');
                div_itm_adv_search_num--;
            }
        }
        else if(document.getElementById(item_num+1)==null){
            createItmAdvSearch();
        }

        // var position = $(advSearch.gridSearch.headDiv).position();
        // advSearch.gridSearch.freezeHeadDiv.style.top = position.top + 'px';

        // var positionBody = $(advSearch.gridSearch.bodyDiv).position();
        // advSearch.gridSearch.freezeBodyDiv.style.top = positionBody.top + 'px';

        try{
            if(typeof onChangeAdvSearch =='function')
            onChangeAdvSearch();
        }catch(ex){}
    }
    /**
     * @author: Tran Viet Quoc
     */
    function onChangeField(val, i){
        var lb_field=val;
        var obj_logic = document.getElementById('logic_'+i);
        var obj_val = document.getElementById('val_'+i);
        //var logic_val=obj_logic.value;
        var dataType=val.substr(0, 3);
        var c=items[i]['value'];
        c.index = i;
        if(lb_field=='bl_deactivated'){
            var optionDeactivated={};
            optionDeactivated['0']='Activate';
            optionDeactivated['1']='Inactivate';
            c.loadURL='';
            c.hasEmptyRow=false;
            items[i]['value'].isSetOptionFirst=true;
            c.clear();
            c.add(optionDeactivated);
            items[i]['value'].isSetOptionFirst=false;
            c.hasEmptyRow=true;
            items[i]['logic'].replace(logicDeactivated);
            $(items[i]['value'].input).attr("readonly","true");
            items[i]['value'].allowSearch=false;
            return;
        }else if(lb_field.substr(0,3)=='bl_'){
            var optionDeactivated={};
            optionDeactivated['1']='True';
            optionDeactivated['0']='False';
            c.loadURL='';
            c.hasEmptyRow=false;
            items[i]['value'].isSetOptionFirst=true;
            c.clear();
            c.add(optionDeactivated);
            c.hasEmptyRow=true;
            items[i]['value'].isSetOptionFirst=false;
            items[i]['logic'].replace(logicDeactivated);
            $(items[i]['value'].input).attr("readonly","true");
            items[i]['value'].allowSearch=false;
            return;
        }
        else{
            $(items[i]['value'].input).removeAttr("readonly");
            items[i]['value'].allowSearch=true;
        }

        if(typeof arr_display_format[lb_field]!='undefined' && typeof arr_display_format[lb_field]['lb_format']!='undefined'){
            c.params["lb_format"]=arr_display_format[lb_field]['lb_format'];
        }
        else{
            c.params["lb_format"]='';
        }
    
        //if( dataType!='id_' ){
        if(typeof arr_edit_mask[lb_field]=='undefined' || arr_edit_mask[lb_field]['bl_datalist']==0){
            c.loadURL=c.funcURL+lb_sp_select+'/'+lb_field+'/'+'_master_'+'/'+lb_field+'/';
        }
        else{
            var lb_source=arr_edit_mask[lb_field]['lb_source'];
            var lb_value=arr_edit_mask[lb_field]['lb_value_field'];
            var lb_display=arr_edit_mask[lb_field]['lb_display_field'];
           // c.loadURL=c.funcURL+'ajax/load_combobox/'+lb_source+'/'+lb_value+'/'+lb_display+'/';
		    c.loadURL=base_url+'ajax/load_combobox/'+lb_source+'/'+lb_value+'/'+lb_display+'/';
        }
        
        c.clear();
        
        if(typeof createOptionProduct=='function'){
            createOptionProduct(c);
        }
        
        c.load();
        
        if( dataType=='nb_' ){
            items[i]['logic'].replace(logicNum);
            if(!isNumberJS(obj_val.value)) obj_val.value='';
            obj_val.setAttribute("onkeypress", "fncInputNumber(event);");
        }
        else{
            items[i]['logic'].replace(logicStr);
            obj_val.setAttribute("onkeypress", "");
        }
        //obj_logic.value=logic_val;
    }
    /*
     * @author: Tran Viet Quoc
     */
    function getStrSearch(){
        // var pInfo=grid.getPageInfo();
        // if(pInfo.pageSize<=0){
            // pInfo.pageSize=100;
            // grid.setPageInfo(pInfo);
        // }
        //if($("#val_1").val()!='')
            $("#div_rs_adv_search_id").css("display","block");
        //else $("#div_rs_adv_search_id").css("display","none");
        
        var strwhere={};
        var strselect='';
        $.each(items,function(k,v){
            var field=v['field'].value;
            var logic=v['logic'].value;
            var value=v['value'].value;
            var operator=v['operator'].value;

            var field_display=$(v['field'].input).val();
            var logic_display=$(v['logic'].input).val();
            var value_display=$(v['value'].input).val();
            
            var operator_display=$(v['operator'].input).val();
            strselect+=field_display+' <u>'+logic_display+"</u> "+value_display+' <u>'+operator_display+'</u> ';

            if(field.substr(0,3)=='bl_'){
                value_display=value;
            }
            strwhere[k-1]={};
            strwhere[k-1]['field']=field;
            strwhere[k-1]['logic']=logic;
            strwhere[k-1]['value']=addslashes(value_display);
            strwhere[k-1]['operator']=operator;
        });

        if(div_itm_adv_search_num==1 && items[1]['field'].value=='id_branch' && items[1]['logic'].value=='=' && strwhere[0]['value']==''){
            strwhere[0]['logic']='like';
        }

        var rs=new Array();
        rs['strselect']=strselect;
        rs['strwhere']=strwhere;
        rs['dataService'] = {};
        return rs;
    }
</script>
