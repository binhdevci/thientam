<script type="text/javascript">
function insert(file){
        $("#hinhanh", top.document).val(file);
        parent.$.fn.colorbox.close();
}


</script>
<?$seg2 = $this->uri->segment(2); ?>

<div class="media-upload-header">
    <ul id="menu">
        <li><a href="<?=base_url()?>index.php/editor/index" <?if($seg2=='index'){echo ' class="current"';}?>><?=lang('library');?></a></li>
        <li><a href="<?=base_url()?>index.php/editor/upload" <?if($seg2=='upload'){echo ' class="current"';}?>><?=lang('upload_file');?></a></li>
        <li>
    <div class="defaults">
        <p class="element">
        <label for="insert_width">Image Width:</label>
        <input type="text" value="0" name="insert_width" id="insert_width">

        <span>Left</span><input type="radio" value="left" name="insert_float">
        <span>Right</span><input type="radio" value="right" name="insert_float">
        <span>None</span><input type="radio" checked="checked" value="none" name="insert_float">
        </p>
    </div>         
        </li>
    </ul>
   
</div>
<div style="padding: 20px;">

    <ul class="list_img">
    <?foreach($list as $rs):?>
        <li>
            <div>
            
            <img onclick="javascript:insertImage('<?=base_url_site().$rs->lb_url?>', '<?=$rs->lb_name?>')" src="<?=base_url_site().$rs->lb_url?>" alt="" class="vnit_img" title="<?=lang('choose_file');?>"></div>
            <div class="title"><?=$rs->lb_name?></div>
        </li>    
    <?endforeach;?>
    </ul>
    <div class="pages"><?=$pagination?></div>
</div>

