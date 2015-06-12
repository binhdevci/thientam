<script type="text/javascript">
	function insert(file)
	{
		$("#<?=$this->uri->segment(3)?>", top.document).val(file);
		parent.$.fn.colorbox.close();
	}
</script>
<?$seg2 = $this->uri->segment(2); ?>

<div class="media-upload-header">
    <ul id="menu">
        <li><a href="<?=base_url()?>index.php/filemanager/index/<?=$this->uri->segment(3)?>" <?if($seg2=='index'){echo ' class="current"';}?>>
            <?=lang('library');?>
            </a></li>
        <li><a href="<?=base_url()?>index.php/filemanager/upload/<?=$this->uri->segment(3)?>" <?if($seg2=='upload'){echo ' class="current"';}?>>
            <?=lang('upload_file');?>
            </a></li>
    </ul>
</div>
<div class="form_upload">
    <div align="center" style="padding-top: 20px;">
<?php
  echo form_open_multipart('filemanager/upload/'.$this->uri->segment(3));
?>
        <?=lang('choose_file_upload');?>
        <input  type="file" name="filedata">
        <input type="hidden" name="id" value="1">
        <input type="submit" name="upload" value="Upload">
        <?  echo form_close();
?>
    </div>
    <? if(isset($file))
	{
    	//$img = explode('/',$file); 
    ?>
    <table class="site">
        <tr>
            <td><a id="closelink" href="#" onclick="insert('<?=$file?>');"><img src="<?=base_url_site().$file?>" height="50" alt=""></a></td>
            <td style="width: 150px"><a id="closelink" href="#" onclick="insert('<?=$file?>');"><b><?=lang('choose_file');?></b></a></td>
        </tr>
    </table>
    <? }?>
</div>
