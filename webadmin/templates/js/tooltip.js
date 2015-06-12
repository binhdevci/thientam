function remove_tip(){
    $('#JT').remove()
}
function add_tip(linkId){
    title = $("#"+linkId).attr('title');
    content = $("#content"+linkId).html();
    if(title == false)title="&nbsp;";
    var de = document.documentElement;
    var w = self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
    var hasArea = w - getAbsoluteLeft(linkId);
    var clickElementy = getAbsoluteTop(linkId) + 70; //set y position

        $("body").append("<div id='JT' style='width:250px'><div id='JT_arrow_left'></div><div id='JT_close_left'>"+title+"</div><div id='JT_copy'>"+content+"</div></div>");//right side
        var arrowOffset = getElementWidth(linkId) + 11;
        var clickElementx = getAbsoluteLeft(linkId) + arrowOffset; //set x position

    $('#JT').css({left: clickElementx+"px", top: clickElementy+"px"});
    $('#JT').show();
    //$('#JT_copy').load(url);

}

function getElementWidth(objectId) {
    x = document.getElementById(objectId);
    return x.offsetWidth;
}

function getAbsoluteLeft(objectId) {
    // Get an object left position from the upper left viewport corner
    o = document.getElementById(objectId)
    oLeft = o.offsetLeft            // Get left position from the parent object
    while(o.offsetParent!=null) {   // Parse the parent hierarchy up to the document element
        oParent = o.offsetParent    // Get parent object reference
        oLeft += oParent.offsetLeft // Add parent left position
        o = oParent
    }
    return oLeft
}

function getAbsoluteTop(objectId) {
    // Get an object top position from the upper left viewport corner
    o = document.getElementById(objectId)
    oTop = o.offsetTop            // Get top position from the parent object
    while(o.offsetParent!=null) { // Parse the parent hierarchy up to the document element
        oParent = o.offsetParent  // Get parent object reference
        oTop += oParent.offsetTop // Add parent top position
        o = oParent
    }
    return oTop
}

function parseQuery ( query ) {
   var Params = new Object ();
   if ( ! query ) return Params; // return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) continue;
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function blockEvents(evt) {
              if(evt.target){
              evt.preventDefault();
              }else{
              evt.returnValue = false;
              }
}