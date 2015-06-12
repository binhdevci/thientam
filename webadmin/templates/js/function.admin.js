// Ẩn. Hiển thị Menu trái
function clickHide(type){
    if (type == 1){
        $('td.colum_left_lage').css('display','none');
        $('td.colum_left_small').css('display','table-cell');
        
        //nv_setCookie( 'colum_left_lage', '0', 86400000);
    }
    else {
        if (type == 2){
            $('td.colum_left_small').css('display','none');
            $('td.colum_left_lage').css('display','table-cell');
            
            //nv_setCookie( 'colum_left_lage', '1', 86400000);
        }
    }
}
// show or hide menu
function show_menu(){
    var showmenu = ( nv_getCookie( 'colum_left_lage' ) ) ? ( nv_getCookie('colum_left_lage')) : '1';
    if (showmenu == '1') {
        $('td.colum_left_small').hide();
        $('td.colum_left_lage').show();
    }else {
        $('td.colum_left_small').show();
        $('td.colum_left_lage').hide();
    }
}

// Submit button form

$(document).ready(function() {
    $('#bt_del').bind('click', function()
    {
          
        $('#adminform').submit();
    });    
});