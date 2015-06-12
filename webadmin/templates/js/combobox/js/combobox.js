function importFile(filename){
        var ext = /^.+\.([^.]+)$/.exec(filename);
        ext = (ext == null) ? "" : ext[1].toLowerCase();
        var fileref = null;
        switch (ext)
        {
                case 'js':
                        fileref = document.createElement('script');
                        fileref.setAttribute("type","text/javascript");
                        fileref.setAttribute("src", filename);
                break;
                case 'css':
                        fileref = document.createElement("link");
                        fileref.setAttribute("rel", "stylesheet");
                        fileref.setAttribute("type", "text/css");
                        fileref.setAttribute("href", filename);
                break;
                default:
                  fileref = 'undefined';
        }
        if (typeof fileref!="undefined")
                document.getElementsByTagName("head")[0].appendChild(fileref);
}
function like(str, key){
    if(typeof str!='undefined' && typeof key!='undefined'){
        var length=key.length;
        str=str.toString().toLowerCase();
        str=str.substr(0, length);
        key=key.toString().toLowerCase();
        ret = ( str==key );
    }
    else ret = false;
    return ret;
}
/**
 * .disableTextSelect - Disable Text Select Plugin
 * Copyright (c) 2007 James Dempster (letssurf@gmail.com, http://www.jdempster.com/category/jquery/disabletextselect/)
 **/
(function($){if($.browser.mozilla){$.fn.disableTextSelect=function(){return this.each(function(){$(this).css({"MozUserSelect":"none"})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).css({"MozUserSelect":""})})}}else{if($.browser.msie){$.fn.disableTextSelect=function(){return this.each(function(){$(this).bind("selectstart.disableTextSelect",function(){return false})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).unbind("selectstart.disableTextSelect")})}}else{$.fn.disableTextSelect=function(){return this.each(function(){$(this).bind("mousedown.disableTextSelect",function(){return false})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).unbind("mousedown.disableTextSelect")})}}}})(jQuery)
//end disableTextSelect
var arrCombobox = new Array();
var activeCombobox = null;
function Combobox(config){
       this.combo = null;
       this.input = null;
       this.arrow = null;
       this.panel = null;
       this.options = {};
       this.optionFirst = {};
       this.isSetOptionFirst = true;
       this.params = {};
       this.items = {};
       this.classCSS = '';
       this.show = false;
       this.value = '';
       this.valueOld = '';
       this.display = '';
       this.disabled = false;
       this.loadURL = null;
       this.keySearch='';
       this.allowSearch=true;
       this.numRow = 500;
       this.numPage = 0;
       this.absolute=true;
       this.flagSearch=true;
       this.rowTotal=0;
       this.rowTotalSearch=0;
       this.numScroll=0;
       this.scrollHeight = 0;
       this.itemHeight=18;
       this.showing=false;
       this.width=233;
       this.maxHeight = 180;
       this.onShow=null;
       this.hasEmptyRow=true;
       this.onChange=function(val){};
       this.beforeChange=function(val){return true;};
       this.allowAdd = false;
       this.activeItem = null;
       this.firstLoad = false;
       this.searching = false;
       this.addNew = function(){
       }
       this.loadSuccess=function(){
           return true;
       }
       this.beforeSearch=function(){
       }
       var me=this;
       if(config){
           $.each(config, function(k, v){
               me[k] = v;
           });
       }
       this.container = $('<span></span>');
       this.input = $('<input type="text" class="combo-text" autocomplete="off" style="width: 180px;"/>');
       this.arrow = $('<span class="combo-arrow"></span>');
       this.combo = $('<span class="combo"></span>');
       this.newItem = $('<div class="combobox-item new-item">New...</div>');
       $(this.combo).append(this.input);
       $(this.combo).append(this.arrow);
       this.panel = $('<div class="panel" style=""></div>');
       //disableSelection(this.panel);
       //$(this.panel).select(function(){return false;});
       $(this.panel).disableTextSelect();
       $(this.panel).select(function(){return false;});
       this.panelBorder=$('<div class="panel-border" style="width: 199px; max-height: '+this.maxHeight+'px;"></div>');
       $(this.panelBorder).append(this.panel);
       //############## Function ##############
       this.resize=function(w){
           var width=w ? w : this.width;
           $(this.input).css('width', width-19);
           $(this.panelBorder).css('width', width);
       }
       this.resize();
       this.showPanel=function(){
           activeCombobox=this;
           if(this.onShow!=false){
               if(typeof this.onShow=='function') this.onShow();
               if(!this.showing){
                   if(this.numPage==0){ //################
                       this.load();
                   }
                   this.showing=true;
                   var position=$(this.combo).position();
                   if(this.position=='offset'){
                     position=$(this.combo).offset();
                   }
                   var left=position.left;
                   var top=position.top+22;
                   
                   $(this.panelBorder).css("position", "absolute");
                   $(this.panelBorder).css("left", left);
                   $(this.panelBorder).css("top", top);
                   
                   $(this.panelBorder).css("display", "block");
                   $(this.panelBorder).css("z-index", "10000");
                   $(this.panel).css("display", "inline");
                   $(this.panel).css("z-index", "10000");
                   
                   this.showAll();
                   if(typeof this.beforeShow=='function') this.beforeShow(position);
               }
           }
       };
       this.showWaiting=function(){
           $(this.input).addClass("loading");
           $(this.combo).addClass("combo-loading");
       }
       this.hideWaiting=function(){
           $(this.input).removeClass("loading");
           $(this.combo).removeClass("combo-loading");
       }
       this.hidePanel = function(){
           if(this.showing){
               $(this.panelBorder).css("display", "none");
               $(this.panel).css("display", "none");
               this.showing=false;
               if(typeof this.beforeHide=='function') this.beforeHide();
           }
       }
       this.autoHide = function(){
           var p=$(this.combo).parents();
           $.each(p,function(k,v){
               $(v).scroll( function(){
                   me.hidePanel();
               });
           });
       }
       $(this.combo).click(function(){
           me.showPanel();
           $(me.input).focus();
       });
       $(this.panelBorder).mousemove(function(){
           me.show=true;
           $(me.input).focus();
       });
       $(this.panelBorder).mouseout(function(){
           me.show=false;
       });
       $(this.input).blur(function(){
           if(!me.show) me.hidePanel();
       });
       $(this.input).keyup(function(event){
           if( me.disabled!=true ){
               var val=$(this).val();
               var readonly=$(this).attr("readonly");
               me.showPanel();
               if(event.ctrlKey==false){
                   //38 up, 40 down
                   if( event.keyCode == 38 ){ //up
                       if( me.activeItem==null ){
                           me.activeItem = $(me.panel).children()[0];
                           $(me.activeItem).addClass('combobox-item-hover');
                       }else{
                           var prev = $(me.activeItem).prev();
                           while( $(prev).css('display')=='none' ){
                                   prev = $(prev).prev();
                           }
                           if( prev[0] ){
                               $(me.activeItem).removeClass('combobox-item-hover');
                               me.activeItem = prev;
                               var itemTop = $(me.activeItem).position();
                               var scrollTop = me.panelBorder.scrollTop();
                               if( itemTop.top < 0 ){
                                   me.panelBorder.scrollTop(scrollTop-me.maxHeight+30);
                               }
                               //$(prev).focus();
                               $(prev).addClass('combobox-item-hover');
                           }
                       }
                   }
                   else if( event.keyCode == 40 ){ //down
                       if( me.activeItem==null ){
                           me.activeItem = $(me.panel).children()[0];
                           $(me.activeItem).addClass('combobox-item-hover');
                       }else{
                           var next = $(me.activeItem).next();
                           while( $(next).css('display')=='none' ){
                                   next = $(next).next();
                           }
                           if( next[0] ){
                               $(me.activeItem).removeClass('combobox-item-hover');
                               me.activeItem = next;
                               itemTop = $(me.activeItem).position();
                               scrollTop = me.panelBorder.scrollTop();
                               if( (itemTop.top-me.maxHeight+20) > 0 ){
                                   me.panelBorder.scrollTop(scrollTop+me.maxHeight-20);
                               }
                               //$(next).focus();
                               $(next).addClass('combobox-item-hover');
                           }
                       }
                   }
                   else if( event.keyCode == 13 ){
                       if( me.activeItem!=null ){
                           $(me.activeItem).click();
                       }
                   }
                   else if( event.keyCode == 9 ){
                       if( readonly!=true ){
                       }
                       else{
                           me.showAll();
                       }
                   }else{
                       if( readonly!=true ){
                           me.search(val);
                       }
                       else{
                           me.showAll();
                       }
                   }
               }//ctrlKey==false
           }
       });

       this.resizeForIE8=function(rowTotalSearch){
           if ( $.browser.msie ){
               if($.browser.version=='8.0'){

                   var d= this.panelBorder.outerWidth()-this.panelBorder[0].scrollWidth;
//alert(d);
                   var h = 0;
                   if(rowTotalSearch){

                   }else{
                       rowTotalSearch=this.rowTotal;
                       if(this.allowAdd==true){
                           rowTotalSearch-=1;
                       }
                   }
                   h = (rowTotalSearch/1)*(this.itemHeight);
                   if(h<180){
                       if( d<2){
                           $(this.panelBorder).height(h+17);
                       }else{
                           $(this.panelBorder).height(h);
                       }
                   }else{
                       $(this.panelBorder).height(180);
                   }
                   
               }
           }
       }

       this.showAll=function(){
           me.params['value']='';
           if(this.loadURL!=null && this.loadURL!='' && this.searching==true){
               this.searching = false;
               this.empty();
               this.load();
           }
           $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );
           $.each(this.options, function(k, v){
               $(me.items[k]).css("display","");
           });
           this.resizeForIE8();
       }
       this.search = function( key ){
           this.showWaiting();
           this.searching = true;
           $(this.activeItem).removeClass('combobox-item-hover');
           this.activeItem = null;
               if(this.loadURL!=null && this.loadURL!=''){
                   //this.clear();
                   this.empty();
                   //this.load(key);
				   
                   //this.showWaiting();
                   var offset=(this.numPage)*this.numRow;
                   if(this.loadURL!=null && this.loadURL!='')
                   if( (offset <= (this.rowTotal-1) ) || this.rowTotal==0 ){
                       var url = this.loadURL+offset+'/'+this.numRow;
                       me.params['value'] = addslashes(key);
                       this.numPage++;
                       if(this.post!=null){
                            this.post.abort();
                        }
                       this.post=$.post(
                           url,
                           me.params,
                           function(data){
                               //if(responseCallBack(data)==false) return false;
                               $(me.panel).css("height", (data.total/1+1)*(me.itemHeight) );
                               if(data.data!=null){
                                   me.add(data.data);
                                   $(me.panelBorder).scrollTop((offset)*(me.itemHeight)-300);
                                   me.params['value']='';
                               }else{
                                   me.add({'':''});
                               }
                               me.hideWaiting();
                               me.beforeSearch();
                               me.resizeForIE8();
                           },
                           "json"
                       );
                   }
               }else{
                   $(this.panelBorder).scrollTop(0);
                   $(this.panel).css("height", 0 );
                   var i=0;
                   $.each(this.options, function(k, v){
                       if( like(v, key) || (k==0 && v=='') ){
                           $(me.items[k]).css("display","block");
                           i++;
                       }
                       else{
                           $(me.items[k]).css("display","none");
                       }
                   });
                   if(this.allowAdd==true) i++;
                   var height=$(me.panel).height()+ ( i*me.itemHeight );
                   me.rowTotalSearch=i;
                   $(me.panel).css("height", height );
                   Combobox.reBuild();
                   me.hideWaiting();
                   me.beforeSearch();
                   me.resizeForIE8(i);
               }
               
       }
       this.addEmptyRow = function(){
           if(this.hasEmptyRow==true){
               var item=$('<div class="combobox-item" value=""></div>');
               this.options[''] = '';
               $(item).click(function(){
                   me.setValue('');
                   me.hidePanel();
               });
               this.items['']=item;
               $(this.panel).append(item);
               this.rowTotal++;//###
               $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
               this.reBuild();
           }
       }
       this.add = function(options){
           $(this.activeItem).removeClass('combobox-item-hover');
           this.activeItem = null;
           var item='';

           $.each(options, function(k, v){
               if( (v!='' && v!=null && v!='null' && typeof v!='undefined' && typeof me.options[k]=='undefined') || (k=='' && v=='' && typeof me.options['']=='undefined' ) ){
                   item=$('<div class="combobox-item" value="'+k+'">'+v+'</div>');
                   me.options[k]=v;
                   $(item).click(function(){
                       me.hidePanel();
                       me.setValue(k);
                       //$(me.input).val(v);// 4/1/2012
                       //me.value=k;
                   });
                   me.items[k]=item;
                   $(me.panel).append(item);
                   me.rowTotal++;//###
                   //alert(k+'---'+v);
                   
               }
           });
           
           if(this.allowAdd==true){
               //this.newItem=$('<div class="combobox-item new-item" href="javascript:void(0);">New...</div>');
               $(this.newItem).click(function(){
                   me.hidePanel();
                   me.addNew();
               });
               //$(this.panel).children('.new-item').remove();
               $(this.panel).remove(this.newItem);
               $(this.panel).append(this.newItem);
               this.rowTotal++;
               //$(this.panel).css("height", (this.rowTotal/1+1)*(this.itemHeight) );//####
           }else{
               $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
               
           }
           this.resizeForIE8();
           this.reBuild();
               $.each(me.options, function(k, v){
                   me.optionFirst[k]=v;
                   if(me.isSetOptionFirst && me.value=='') me.setValue(k);
                   return false;
               });
       }
       this.prepend = function(options){
           var item='';
           $.each(options, function(k, v){
               if(typeof me.options[k]=='undefined'){
                   me.options[k]=v;
                   item=$('<div class="combobox-item" value="'+k+'">'+v+'</div>');
                   $(item).click(function(){
                       $(me.input).val(v);
                       me.value=k;
                       me.hidePanel();
                   });
                   $(me.panel).prepend(item);
               }
           });
           this.reBuild();
       }
       this.replace = function(options){
           this.clear();
           this.add(options);
       }
       this.load = function(){
           
           var offset=(this.numPage)*this.numRow;
           if(this.loadURL!=null && this.loadURL!='')
           if( (offset <= (this.rowTotal-1) ) || this.rowTotal==0 ){
               var url = this.loadURL+offset+'/'+this.numRow;
               this.numPage++;
               this.params['value_cmb'] = this.value;
               this.showWaiting();
               
               $.post(
                   url,
                   me.params,
                   function(data){
			//if(responseCallBack(data)==false) return false;
                       $(me.panel).css("height", (data.total/1+1)*(me.itemHeight) );
                       //me.rowTotal=data.total;
                       if(data.data!=null){
                           if(me.firstLoad==false){
                               me.firstLoad=true;
                               me.empty();
                           }
                           me.add(data.data);
                           $(me.panelBorder).scrollTop((offset)*(me.itemHeight)-300);
                           me.resizeForIE8();
                       }
                       me.hideWaiting();
                       me.loadSuccess();
                   },
                   "json"
               );
           }
       }
       this.setValue = function(val){
           if(this.beforeChange(val)!=false){
               var opVal=this.options[val];
               if(opVal!=null && typeof opVal!='undefined') {
                   this.valueOld=this.value/1;
                   this.value=val;
                   $(this.input).val( this.options[val] );
                   this.display=opVal;
                   if(typeof this.beforeSetValue=='function') this.beforeSetValue();
                   if(typeof this.onChange=='function') this.onChange(val);
               }
           }
       }
       this.setValueNoEvent = function(val){
               var opVal=this.options[val];
               if(opVal!=null && typeof opVal!='undefined') {
                   this.valueOld=this.value/1;
                   this.value=val;
                   $(this.input).val( this.options[val] );
                   this.display=opVal;
               }
       }
       this.change=function(){
           this.setValue(this.value);
       }
       this.addNewItem=function(){
           if(this.allowAdd==true || this.allowAdd=='true'){
               $(this.newItem).click(function(){
                   me.hidePanel();
                   me.addNew();
               });
               $(this.panel).children('.new-item').remove();
               $(this.panel).append(this.newItem);
               this.rowTotal++;
           }
       }
       this.clear=function(){
           $(this.input).val('');
           this.value='';
           this.setValue('');
           $(this.panel).empty();
           this.numPage=0;
           this.rowTotal=0;
           this.options = {};
           this.addEmptyRow();
           this.addNewItem();
           this.reBuild();
       }
       this.empty=function(){
           $(this.panel).empty();
           this.numPage=0;
           this.rowTotal=0;
           this.options = {};
           this.addEmptyRow();
           this.addNewItem();
           this.reBuild();
       }
       this.disable=function(blCreate){
           //var disabled = $(this.html).parent().attr("disabled");
           //alert(disabled);
           //if(disabled || blCreate==true){
           if(blCreate==true || blCreate=='true'){
               this.disabled=true;
               $(this.input).attr("readonly", true);
               if(typeof this.showPanelOld=='undefined'){
                   this.showPanelOld = this.showPanel;
               }
               this.showPanel=function(){return;}
               $(this.arrow).addClass("combo-disabled");
               $(this.combo).addClass("combo-disabled");
           }
       }
       this.enable=function(){
               $(this.input).removeAttr("readonly");
               this.disabled=false;
               if(typeof this.showPanelOld=='function'){
                   this.showPanel = this.showPanelOld;
               }
               $(this.arrow).removeClass("combo-disabled");
               $(this.combo).removeClass("combo-disabled");
       }
       this.addClass=function(classCSS){
           $(this.container).addClass(classCSS);
       }
       this.reBuild = function(){
           /*$(this.panel).children(".combobox-item").mouseover( function(){
               $(me.activeItem).removeClass("combobox-item-hover");
               me.activeItem = this;
               $(this).addClass("combobox-item-hover");
           });*/
           //$(this.panel).children(".combobox-item").mouseout(function(){$(this).removeClass("combobox-item-hover");});
       }
       //############## Event #####################
       $(this.panelBorder).scroll(function(event){
            var scrollTop = event.currentTarget.scrollTop;
            var i=(me.itemHeight)*(me.numPage)*me.numRow;
            if((scrollTop+300)>i){
                me.load();
            }
       });
       //############## Init ######################
       this.html = this.container;
       $(this.html).append(this.combo);
       $(this.html).append(this.panelBorder);
       if(this.allowAdd==true) this.rowTotal++;
       this.addEmptyRow();
       //this.addNewItem();
       /*this.reBuild();
       $(this.combo).children(".combo-arrow").mouseover( function(){
           $(this).addClass("combo-arrow-hover");
       });
       $(this.combo).children(".combo-arrow").mouseout(  function(){
           $(this).removeClass("combo-arrow-hover");
       });*/
}
Combobox.build=function(){
   /*$(".combo-arrow").mouseover( function(){$(this).addClass("combo-arrow-hover");});
   $(".combo-arrow").mouseout(  function(){$(this).removeClass("combo-arrow-hover");});

   $(".combobox-item").mouseover( function(){$(this).addClass("combobox-item-hover");});
   $(".combobox-item").mouseout(function(){$(this).removeClass("combobox-item-hover");});
   $(".combobox-item").mousedown(function(){
       $(this).removeClass("combobox-item-hover");
   });

   $(".panel-border .panel div").mouseover( function(){$(this).addClass("combobox-item-hover");});
   $(".panel-border .panel div").mouseout(function(){$(this).removeClass("combobox-item-hover");});
   $(".panel-border .panel div").mousedown(function(){
       $(this).removeClass("combobox-item-hover");
   });*/
}
Combobox.reBuild=function(){
   /*$(".combo-arrow").mouseover( function(){$(this).addClass("combo-arrow-hover");});
   $(".combo-arrow").mouseout(  function(){$(this).removeClass("combo-arrow-hover");});

   $(".combobox-item").mouseover( function(){$(this).addClass("combobox-item-hover");});
   $(".combobox-item").mouseout(function(){$(this).removeClass("combobox-item-hover");});
   $(".combobox-item").mousedown(function(){
       $(this).removeClass("combobox-item-hover");
   });

   $(".panel-border .panel div").mouseover( function(){$(this).addClass("combobox-item-hover");});
   $(".panel-border .panel div").mouseout(function(){$(this).removeClass("combobox-item-hover");});
   $(".panel-border .panel div").mousedown(function(){
       $(this).removeClass("combobox-item-hover");
   });*/
}
//Combobox.href=null;
Combobox.init = function(){
     $(document).ready(function(){
           //Combobox.build();
     });
}
Combobox.init();
//##############################################################################
//##############################################################################
//##############################################################################
//##############################################################################
// options[k] = [value, parent, level]
function ComboboxLevel(config){
    var me=this;
    this.inheritFrom=Combobox;
    this.inheritFrom(config);
    /*
     * this.setValue = function(val){
           this.value=val;
           var opVal=this.options[val];
           if(opVal!=null && typeof opVal!='undefined') {
               $(this.input).val( this.options[val] );
               this.display=opVal;
           }
           //else $(this.input).val(val);
           if(typeof this.beforeSetValue=='function') this.beforeSetValue();
           if(typeof this.onChange=='function') this.onChange(val);
       }
     */
    this.setValue = function(k){
           if(typeof this.beforeChange=='function'){
               var change=this.beforeChange(this.value,k);
               if( !change ) {
                   return false;
               }
           }
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           //parent.a=this.options;
           var opVal=this.options[k][0];
           if(opVal!=null && typeof opVal!='undefined'){
               $(this.input).val( opVal );
           }
           else {
               $(this.input).val('');
           }
           if(typeof this.onChange=='function') this.onChange(k);
           if(typeof this.beforeSetValue=='function') this.beforeSetValue();
           //$(this.input).val(val);
           this.hidePanel();
    }
    this.check=false;
    this.isParent=function(p,c){
       if(typeof this.options[c] != 'undefined'){
                if( this.options[c][1]==p || p==c){
                    //alert('t');
                    this.check=true;
                    //return true;
                }
                else{
                    this.isParent(p,this.options[c][1]);
                    //alert('tf');
                    //return false;
                }
       }else{
           //alert('f');
           //return false;
       }
    }
    this.add = function(options){
           var item='';
           $.each(options, function(k, v){
               if( (v[0]!='' && v[0]!=null && v[0]!='null' && typeof v[0]!='undefined' && typeof me.options[k]=='undefined') || (k==0 && v[0]=='' && me.rowTotal<1 ) ){
                   item=$('<div value="'+k+'">'+v[0]+'</div>');
                   $(item).addClass("item_"+v[2]);
                   me.options[k]=v;
                   $(item).click(function(){
                       me.setValue(k,v[0]);
                   });
                   if(typeof me.items[ v[2] ] == 'undefined' ) me.items[ v[2] ]={};
                   me.items[ v[2] ][k]=item;
                   if(v[2]==0){
                       $(me.panel).append(item);
                       me.rowTotal++;
                   }
                   else {
                       if(typeof me.items[ v[2]/1-1 ]!='undefined'){
                           $(me.items[ v[2]/1-1 ][ v[1] ]).after(item);
                           me.rowTotal++;
                       }
                   }
               }
           });
           $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
           Combobox.reBuild();
    }
    this.search = function(){
        return;
    }
}
//##############################################################################
//##############################################################################
//##############################################################################
//##############################################################################
//##############################################################################
// options[k] = [value, parent, level]
function ComboboxTreeGroup(config){
    var me=this;
    this.inheritFrom=Combobox;
    this.inheritFrom(config);
    $(this.panelBorder).addClass("panel-border-tree");
    $(this.panelBorder).css("positon","static");
    $(this.panel).css("positon","static");
    $(this.panelBorder).css("display","block");
    $(this.panel).css("display","block");
    this.setValue = function(k,val){
           if(typeof this.beforeChange=='function'){
               var change=this.beforeChange(this.value,k);
               if( !change ) {
                   return false;
               }
           }
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           var opVal=this.options[k][0];
           if(opVal!=null && typeof opVal!='undefined') $(this.input).val( opVal );
           else $(this.input).val('');

           if(typeof this.onChange=='function') this.onChange(k);

           $(this.input).val(val);
           this.hidePanel();
    }
    this.check=false;
    this.isParent=function(p,c){
       if(typeof this.options[c] != 'undefined'){
                if( this.options[c][1]==p || p==c){
                    //alert('t');
                    this.check=true;
                    //return true;
                }
                else{
                    this.isParent(p,this.options[c][1]);
                    //alert('tf');
                    //return false;
                }
       }else{
           //alert('f');
           //return false;
       }
    }
    this.resize=function(w, h){
           var width=w ? w : this.width;
           var height=h ? h : this.height;
           $(this.input).css('width', width-19);
           $(this.panelBorder).css('width', width);
           $(this.panelBorder).css('height', height);
       }
    this.add = function(options){
           var item='';
           $.each(options, function(k, v){
               if( (v[0]!='' && v[0]!=null && v[0]!='null' && typeof v[0]!='undefined' && typeof me.options[k]=='undefined')  ){
                   item=$('<div value="'+k+'">'+v[0]+'</div>');
                   $(item).addClass("item_"+v[2]);
                   me.options[k]=v;
                   $(item).click(function(){
                       //me.setValue(k,v[0]); //#########################
                       $(".panel-border-tree .panel div").removeClass("combobox-item-selected");
                       $(this).addClass("combobox-item-selected");
                   });
                   if(typeof me.items[ v[2] ] == 'undefined' ) me.items[ v[2] ]={};
                   me.items[ v[2] ][k]=item;
                   if(v[2]==0){
                       $(me.panel).append(item);
                       me.rowTotal++;
                   }
                   else {
                       if(typeof me.items[ v[2]/1-1 ]!='undefined'){
                           $(me.items[ v[2]/1-1 ][ v[1] ]).after(item);
                           me.rowTotal++;
                       }
                   }
               }
           });
           $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
           Combobox.reBuild();
    }
    this.search = function(){
        return;
    }
}
//##############################################################################
function ComboboxTree(config){
    var me=this;
    this.inheritFrom=Combobox;
    this.inheritFrom(config);
    this.newItem = $('<div class="combobox-item ">&nbsp;&nbsp;New...</div>');
    this.showAll=function(){
        me.params['value']='';
        if(this.loadURL!=null && this.loadURL!=''){
            this.empty();
            this.load();
        }
        $(this.panel).css("height", "" );
        //$(this.panel).css({display:'block'});
        //$(this.panel).css("height", (this.rowTotal/1+3)*(this.itemHeight) );//####
        $.each(this.options, function(k, v){
            $(me.items[k]).css("display","");
        });
    }
    this.addNewItem=function(){
           if(this.allowAdd==true || this.allowAdd=='true'){
               $(this.newItem).click(function(){
                   me.hidePanel();
                   me.addNew();
               });
               $(this.panel).children('.new-item').remove();
               $(this.panel).append(this.newItem);
               this.rowTotal++;
           }
       }
    this.setValue = function(k){
        
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           var opVal=this.options[k]['text'];
           if(opVal!=null && typeof opVal!='undefined'){
               $(this.input).val( opVal );
           }
           else {
               $(this.input).val('');
           }
           this.display=$(this.input).val();
           if(typeof this.onChange=='function') this.onChange(k);
           if(typeof this.beforeSetValue=='function') this.beforeSetValue();
           if(typeof this.beforeChange=='function') this.beforeChange(k);
           //$(this.input).val(val);
           this.hidePanel();
    }

    this.setValueNoEvent = function(k){
        
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           var opVal=this.options[k]['text'];
           if(opVal!=null && typeof opVal!='undefined'){
               $(this.input).val( opVal );
           }
           else {
               $(this.input).val('');
           }
           this.display=$(this.input).val();
           this.hidePanel();

           if(typeof this.beforeSetValue=='function') this.beforeSetValue();
           if(typeof this.beforeChange=='function') this.beforeChange(k);
    }

    this.check=false;
    this.add = function(options, level, container, parent){
           level=level?level:0;
           if(typeof container == 'undefined'){
               container = me.panel;
           }
           if(typeof parent == 'undefined'){
               parent = 0;
           }
           $.each(options, function(k, v){
               var item='';
               var text = v['text'];
               var val = k;
               var childs = v['childs'];
               //if( (v!='' && v!=null && v!='null' && typeof v!='undefined' && typeof me.options[k]=='undefined') || (k=='' && v=='' && typeof me.options['']=='undefined' ) ){
               if( text!='' && typeof text!='undefined'){
                   //item = $('<div class="combobox-tree-item item_'+level+'" value="'+val+'"></div>');
                   item = $('<div class="combobox-tree-item" value="'+val+'"></div>');
                   var item_text = $('<a class="combobox-tree-item-text" >'+text+'</a>');
                   v['parent'] = parent;
                   me.options[val] = v;
                   if(v['allowSelect']=='false'){
                       item_text = $('<a>'+text+'</a>');
                   }else{
                       $(item_text).click(function(){
                           /*var parentVal = val;
                           var parentObj = me.options[val];
                           var parentTemp = me.options[val]['parent'];
                           while( typeof me.options[parentTemp] != 'undefined' ){
                               parentObj = me.options[parentTemp];
                               parentVal = parentTemp;
                               parentTemp = me.options[parentTemp]['parent'];
                           }
                           me.setValue( parentVal );
                           $(me.input).val( parentObj['text'] );
                           me.hidePanel();
                           */
                           me.hidePanel();
                           me.setValue(val);
                       });
                   }
                   me.items[val] = item;
                   if(childs){
                       var node = $('<a class="cmb-expand" href="javascript:void(0);" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>');
                       node.collapse = true;
                       $(node).click(function(){
                           var next = $(item).next();
                           //me.showHide(next);
                           if(node.collapse==true){
                               node.collapse=false;
                               //$(next).show('normal');
                               $(next).slideDown();
                               $(node).attr('class', 'cmb-collapse');
                           }else{
                               node.collapse=true;
                               //$(next).hide('normal');
                               $(next).slideUp();
                               $(node).attr('class', 'cmb-expand');
                           }
                       });
                       $(item).append(node);
                       $(item).append(item_text);
                       $(container).append(item);
                       var childContainer = $('<p style="display:none"></p>');
                       $(container).append(childContainer);
                       me.add(childs, level+1, childContainer, val);
                   }else{
                       $(item).append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                       $(item).append(item_text);
                       $(container).append(item);
                   }
                   me.rowTotal++;//###
               }
           });
           
           //$(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
           if(this.allowAdd==true){
               //this.newItem=$('<div class="combobox-item new-item" href="javascript:void(0);">New...</div>');
               $(this.newItem).click(function(){
                   me.hidePanel();
                   me.addNew();
               });
               $(this.panel).children('.new-item').remove();
               $(this.panel).append(this.newItem);
               this.rowTotal++;
               //$(this.panel).css("height", (this.rowTotal/1+1)*(this.itemHeight) );//####
               /*if($.browser.msie==true && $.browser.version=='7.0'){
                   $(this.panel).css("height", (this.rowTotal/1+1)*(this.itemHeight) );//####
               }*/
           }else{
               $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
               //$(this.panel).css("height", "100%" );//####
           }
           this.reBuild();
           $.each(me.options, function(k, v){
               me.optionFirst[k]=v;
               //if(me.isSetOptionFirst && me.value=='') me.setValue(k);
               return false;
           });
    }
    this.reBuild = function(){
           /*$(".combobox-tree-item").mouseover( function(){
               $(me.activeItem).removeClass("combobox-item-hover");
               me.activeItem = this;
               $(this).addClass("combobox-item-hover");
           });
           $(".combobox-tree-item").mouseout(function(){$(this).removeClass("combobox-item-hover");});
           $(this.panel).children(".combobox-item").mouseover( function(){
               $(me.activeItem).removeClass("combobox-item-hover");
               me.activeItem = this;
               $(this).addClass("combobox-item-hover");
           });
           $(this.panel).children(".combobox-item").mouseout( function(){
               $(this).removeClass("combobox-item-hover");
           });*/
    }
    this.search = function(){
        return;
    }
    this.addNewItem();
    this.reBuild();
}
//##############################################################################
function TreeView(config){
    var me=this;
    this.inheritFrom=Combobox;
    this.inheritFrom(config);
    this.showAll=function(){
        me.params['value']='';
        if(this.loadURL!=null && this.loadURL!=''){
            this.empty();
            this.load();
        }
        $(this.panel).css("height", "" );
        $.each(this.options, function(k, v){
            $(me.items[k]).css("display","");
        });
    }
    this.setValue = function(k){
           if(typeof this.beforeChange=='function'){
               var change=this.beforeChange(this.value,k);
               if( !change ) {
                   return false;
               }
           }
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           var opVal=this.options[k]['text'];
           if(opVal!=null && typeof opVal!='undefined'){
               $(this.input).val( opVal );
           }
           else {
               $(this.input).val('');
           }
           if(typeof this.onChange=='function') this.onChange(k);
           if(typeof this.beforeSetValue=='function') this.beforeSetValue();
           //$(this.input).val(val);
           this.hidePanel();
    }
    
    this.setValueNoEvent = function(k){
           if(typeof this.beforeChange=='function'){
               var change=this.beforeChange(this.value,k);
               if( !change ) {
                   return false;
               }
           }
           this.value=k;
           if(typeof this.options[k]=='undefined') this.options[k]=[];
           var opVal=this.options[k]['text'];
           if(opVal!=null && typeof opVal!='undefined'){
               $(this.input).val( opVal );
           }
           else {
               $(this.input).val('');
           }
           this.hidePanel();
    }

    this.check=false;
    this.createEditor = function(type, name, readonly,val,obj_type){
       var editor = '';
       if(type=='radio'){
           editor = $('<input name="treeViewRadio" id="tv_'+obj_type+'_'+val+'" type="radio" />');
       }
       else if(type=='checkbox'){
           editor = $('<input type="checkbox" id="tv_'+obj_type+'_'+name+'" name="'+name+'" '+readonly+'/>');
           
           if( val!='' && in_array(val,me.arr_id_ts) ){
               $(editor).removeAttr('disabled');
               $(editor)[0].checked=true;
           }
       }
       return editor;
    };
    this.add = function(options, level, container, parent){
           if(typeof container == 'undefined'){
               container = me.panel;
           }
           if(typeof parent == 'undefined'){
               parent = 0;
           }
           $.each(options, function(k, v){
               var item='';
               var text = v['text'];
               var type = v['type'];
               var val = v['value'];
               var childs = v['childs'];
               var name = v['name'];
               var item_text='';
               var bandwidth = '';
               var readonly='';
               var class_gray='';
               if(type=='checkbox'){
                   bandwidth = v['bandwidth'];
                   var num = v['num'];
                   readonly=v['readonly'];
                   class_gray=v['class'];
                   if( val!='' && in_array(val,me.arr_id_ts) ){
                       class_gray='';
                   }
                   item_text = '&nbsp;<a class="combobox-tree-item-text '+class_gray+'" bandwidth="'+bandwidth+'" text_ts="'+text+'" num="'+num+'" >'+num+'. '+text+'</a>';
               }else{
                   item_text = '&nbsp;<a class="combobox-tree-item-text" bandwidth="'+bandwidth+'" >'+text+'</a>';
               }
               item = $('<div class="combobox-tree-item item_'+level+'" value="'+val+'"></div>');
               //if( (v!='' && v!=null && v!='null' && typeof v!='undefined' && typeof me.options[k]=='undefined') || (k=='' && v=='' && typeof me.options['']=='undefined' ) ){
                   me.items[k] = item;
                   var editor='';
                   if(childs){
                       
                       var node = $('<a class="cmb-expand" onclick="expandCollapse(\''+name+'\',\''+val+'\',\''+me.window_name+'\',this);" href="javascript:void(0);" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>');
                       node.collapse = true;
                       $(node).click(function(){
                           var next = $(item).next();
                           //me.showHide(next);
                           if(node.collapse==true){
                               node.collapse=false;
                               $(next).show('normal');
                               $(node).attr('class', 'cmb-collapse');
                           }else{
                               node.collapse=true;
                               $(next).hide('normal');
                               $(node).attr('class', 'cmb-expand');
                           }
                       });
                       $(item).append(node);
                       editor = me.createEditor(type, '','',val,v['obj_type']);
                       $(item).append(editor);
                       $(item).append(item_text);
                       $(container).append(item);
                       var childContainer = $('<p style="display:none"></p>');
                       $(container).append(childContainer);
                       //var addChild = function(){
                           me.add(childs, level+1, childContainer, k);
                       //}
                       //setTimeout(addChild,1);
                   }else{
                       $(item).append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                       editor = me.createEditor(type, parent,readonly,val,v['obj_type']);
                       $(item).append(editor);
                       $(item).append(item_text);
                       $(container).append(item);
                   }
                   me.rowTotal++;//###
                   v['parent'] = parent;
                   //v['value'] = k;
                   me.options[k] = v;
                   var editorName = $(editor).attr('name');
                   $(editor).click(function(){
                       var i=0;
                       //var parentVal = val;
                       var parentObj = me.options[k];
                       var parentTemp = me.options[k]['parent'];
                       me.value = new Array();
                       me.value[0] = parentObj;
                       i++;
                       while( typeof me.options[parentTemp] != 'undefined' ){
                           parentObj = me.options[parentTemp];
                           me.value[i] = parentObj;
                           //me.value[i]['value'] = parentTemp;
                           //parentVal = parentTemp;
                           parentTemp = me.options[parentTemp]['parent'];
                           i++;
                       }
                       if( editor[0].type == 'checkbox' ){
                           $("input[type:checkbox][name!='"+editorName+"']" ).each(function(){
                               $(this)[0].checked = false;
                           });
                           var strVal = '';
                           var arr_id_ts = new Array();
                           var bandwidth = 0;
                           var str_num = '';
                           $("input[type:checkbox][name='"+editorName+"'][checked] + a").each(function(k,v){
                               bandwidth += $(this).attr('bandwidth')/1;
                               strVal += $(this).attr('text_ts')+"&nbsp;";
                               str_num += $(this).attr('num')+"&nbsp;";
                               var idTemp = $($(this).parent()).attr('value');
                               idTemp = idTemp;
                               arr_id_ts.push(idTemp);
                           });
                           me.value[0]['str_num'] = str_num;
                           me.value[0]['text'] = strVal;
                           me.value[0]['value'] = arr_id_ts;
                           me.value[0]['bandwidth'] = bandwidth;
                       }
                       else if( editor[0].type == 'radio' ){
                           $("input:checkbox").each(function(){
                               $(this)[0].checked = false;
                           });
                       }
                       me.isChange=true;
                       //me.setValue( parentVal );
                       //$(me.input).val( parentObj['text'] );
                       //me.hidePanel();
                   });
               //}
           });
           //$(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );//####
           /*this.reBuild();
           $.each(me.options, function(k, v){
               me.optionFirst[k]=v;
               //if(me.isSetOptionFirst && me.value=='') me.setValue(k);
               return false;
           });*/
    }
    this.reBuild = function(){
           //$(this.panel).children(".combobox-tree-item").mouseover( function(){$(this).addClass("combobox-item-hover");});
           //$(this.panel).children(".combobox-tree-item").mouseout(function(){$(this).removeClass("combobox-item-hover");});
    }
    this.search = function(){
        return;
    }
}
function expandCollapse(name,id,window_name,me){
    switch(name){
        case 'poptree_card':
            break;
        case 'poptree_port':
            var bl_loaded = $(me).attr('bl_loaded');
            if(!bl_loaded){            
                $(me).attr('bl_loaded', 'true');
                var url = site_url+'index.php/windowfrontend/loadTSByIDPort/'+id+'/'+window_name;
                $.post(
                    url,
                    null,
                    function(data){
                        var html='';
                        $.each(data, function(k, v){
                            html+='<div class="combobox-tree-item item_3">';
                            html+='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkbox_ts"/>&nbsp;';
                            html+='<a num="1" text_ts="TS1" bandwidth="100000" class="combobox-tree-item-text ">'+v['num']+'. '+v['text']+'</a>';
                            html+='</div>';
                        });
                        c.add(data,3,$(me).parent().next(),'port_'+id);
                    },
                    'json'
                );
            }
            break;
    }
}
//##############################################################################
function CreateCmbHeader(dataCombobox, site_url, index_page){
    if(dataCombobox!='' && dataCombobox!=null)
    $(document).ready(function(){
        //Combobox.href=site_url+"js/combobox/";
        Combobox.init();
        c=new Array();
        $.each(dataCombobox,function(k, v){
            var lb_field=k;
            var lb_sp_select=v['lb_sp_select'];
            var id_container='';
            var id_container_detail='';
            if(typeof v['id_container']== 'undefined'){
                id_container=lb_field+"_combobox";
            }
            else {
                id_container=v['id_container'];
            }
            if(typeof v['id_container_detail']== 'undefined'){
                id_container_detail=lb_field+"_detail";
            }
            else {
                id_container_detail=v['id_container_detail'];
            }
            c[k]=new Combobox();
            c[k].numRow = 500;
            $("#"+id_container).append('<input id="'+lb_field+'" name="'+lb_field+'" type="hidden"/>');
            var valueC=v['value'];
            var ob_value={};
            ob_value['']='';
            if(v['display']!=null) ob_value[valueC]=v['display'];
            c[k].add( ob_value );
            c[k].beforeSetValue=function(){
                $("#"+lb_field).val(c[k].value);
                if(valueC!=c[k].value) haschangedetailform=true;
                else haschangedetailform=false;
            }
            c[k].setValue(valueC);
            c[k].width=230;
            c[k].resize();
            //$(c.input).attr("id", lb_field);
            if(typeof v['lb_format']!=null ){
                c[k].params["lb_format"]=v['lb_format'];
            }
            else{
                c[k].params["lb_format"]='';
            }
            c[k].funcURL=site_url+index_page+'/windowfrontend/loadCmbSearchDetail/';
            if( lb_field.substr(0, 3)!='id_' ){
                c[k].loadURL=c[k].funcURL+lb_sp_select+'/'+lb_field+'/'+'_master_'+'/';
            }
            else{
                var lb_source=v['lb_source'];
                var lb_value=v['lb_value_field'];
                var lb_display=v['lb_display_field'];
                var str_display=v['str_display_field'];
                c[k].loadURL=c[k].funcURL+lb_source+'/'+lb_value+'/'+lb_display+'/';
                if(str_display!=''){
                    c[k].onChange=function(){
                        var url=site_url+index_page+'/windowmasterdetail/loadDetailCombobox';
                        $.post(
                            url,
                            {
                                lb_source : lb_source,
                                lb_value_field : lb_value,
                                lb_display_field : lb_display,
                                str_display_field : str_display,
                                value : this.value
                            },
                            function(data){
                               // if(responseCallBack(data)==false) return false;
                                var detail=$("#"+id_container_detail);
                                if(data!=null){
                                    var html='<table width="100%" border="0">';
                                    $.each(data, function(k, v){
                                        html+='<tr><td width="75px;" align="right">'+v.lb_caption+':&nbsp;</td><td>'+v.data+'</td></tr>';
                                    });
                                    html+='</table>';
                                    $(detail).html(html);
                                }
                                else $(detail).html('');
                            },
                            'json'
                        );
                    }
                    c[k].onChange();
                }
            }
            //c.load();
            $("#"+id_container).append(c[k].html);
        });
        return c;
    });
}
function ComboboxGrid(config){
    var me=this;
    this.inheritFrom=Combobox;
    this.inheritFrom(config);
    this.showAll=function(){
           me.params['value']='';
           if(this.loadURL!=null && this.loadURL!=''){
               //this.empty();
               this.load();
           }
           $(this.panel).css("height", (this.rowTotal/1)*(this.itemHeight) );
           $.each(this.options, function(k, v){
               $(me.items[k]).css("display","");
           });
       }
}
Combobox.create = function(){
    $('.combobox').each(function(){
//return false;
        //if( !$(this).hasClass('combobox') ) return false;
        $(this).removeClass('combobox');
        var value = $(this).attr('value');
        var idhd = $(this).attr('idhd');
        var classhd = $(this).attr('classhd');
        var options = $(this).attr('options');
        var onChange = $(this).attr('onChange');
        var beforeChange = $(this).attr('beforeChange');
        var field = $(this).attr('field');
        var idRow = $(this).attr('idRow');
        var width = $(this).attr('width');
        var allowAdd = $(this).attr('allowAdd');
        var addNew = $(this).attr('addNew');
        var display = $(this).attr('display');
        var disabled = $(this).attr('disabled');
        var urlLoad = $(this).attr('urlLoad');
        var comboboxType = $(this).attr('comboboxType');
        var group = $(this).attr('group');
        var text = $(this).attr('text');
        var name='';
        classhd = classhd ? classhd : '';
        if(idhd){
            name = idhd;
            idhd = "id='"+idhd+"'";
        }else{
            idhd = '';
        }
        var hd = $('<input type="hidden" class="'+classhd+'" '+idhd+' name="'+name+'"/>');
        var config = {
            width : width ? width : 149
        };
        if(allowAdd==true || allowAdd=='true'){
            config['allowAdd'] = true;
            if(addNew) {
                config['addNew'] = window[addNew];
            }
        }
        var c = '';
        if(comboboxType=='treeview'){
            c = new ComboboxTree(config);
        }else{
            c = new Combobox(config);
        }
        c.group = group;
        c.ht_input=hd;
        if(beforeChange && window[beforeChange]){
            c.beforeChange=window[beforeChange];
        }
        $(c.input).keyup(function(event){
            //console.log(event);
            if(event.ctrlKey==false && c.disabled!=true && event.keyCode != 13 && event.keyCode != 9 && event.keyCode != 37 && event.keyCode != 39){
               $(hd).val('');
               $(c.input).addClass("hint");
            }
        });
        /*$(c.input).keypress(function(event){
            console.log(event);
        });*/
        if(disabled == true || disabled == 'true'){
            c.disable(true);
            hd.attr('disabled','true');
        }
        c.idRow = idRow;
        c.isSetOptionFirst = false;
        if(display) $(c.combo).css("display", display);
        if(options && window[options]){
            c.add(window[options]);
        }
        if(urlLoad){
            c.loadURL = urlLoad;   
            c.numRow=50;
            //c.load();
        }
        if(value){
            if(typeof c.options[value]!='undefined'){
                c.setValue(value);
                $(hd).val(value);
            }
        }
        if(text){
            $(c.input).val(text);
            if(value){
                c.value=value;
                $(hd).val(value);
            }
        }
        c.onChange=function(val){
            $(c.input).removeClass("hint");
            $(hd).val(val);
            if(onChange && window[onChange]) window[onChange](val, this.idRow, this);
        }
        //c.absolute=false;
        c.position = "offset";
        $(this).parent().append(hd);
        //$(this).replaceWith(c.combo);
        $(this).append(c.combo);
        $(document.body).append(c.panelBorder);
        if(field){
            c.field = field;
            if(typeof arrCombobox[field]=='undefined'){
                arrCombobox[field] = {};
            }
            arrCombobox[field][idRow] = c;
        }
       
        c.beforeShow=function(position){
           if(position.top==0){
               position=$(c.combo).offset();
           }
           var left=position.left;
           var top=position.top+22;
           var winHeight = 0;
           if(typeof window.innerHeight=='undefined'){
               winHeight = (document.body.clientHeight)? document.body.clientHeight: document.documentElement.Height;
           }else{
               winHeight = window.innerHeight;
           }

           winHeight=$(window).height();
//alert(winHeight);
           var heightPanelBorder = $(c.panelBorder).height();
           //alert( winHeight+'--'+top+'--'+heightPanelBorder );
           if( (winHeight-top)<(heightPanelBorder+22) ){
               top=top-(heightPanelBorder+22);
               $(c.panelBorder).css('border-top','1px solid #ff6600');
           }else{
               $(c.panelBorder).css('border-top','none');
           }
           $(c.panelBorder).css("position", "absolute");
           $(c.panelBorder).css("left", left);
           $(c.panelBorder).css("top", top);
           $(c.panelBorder).css("display", "block");
           $(c.panelBorder).css("z-index", "1000");
           
        }

        c.beforeSearch=function(){
           var position=$(this.combo).position();
           if(this.position=='offset'){
             position=$(this.combo).offset();
           }
           c.beforeShow(position);
        }
        
        c.loadSuccess=function(){
           var position=$(this.combo).position();
           if(this.position=='offset'){
               position=$(this.combo).offset();
           }
           c.beforeShow(position);
        }
       
    });
	
}
function addslashes(str){
		return str.replace(/'/g, "\\'");
}