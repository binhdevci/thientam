<script type="text/javascript">
function insert(file)
{
  $("#<?=$this->uri->segment(3)?>", top.document).val(file);
  parent.$.fn.colorbox.close();
}
</script>
<? $seg2 = $this->uri->segment(2); ?>

<div class="media-upload-header">
    <ul id="menu">
        <li><a href="<?=base_url()?>index.php/file_manager/index/<?=$this->uri->segment(3)?>" <?if($seg2=='index'){echo ' class="current"';}?>><?=lang('library');?></a></li>
        <li><a href="<?=base_url()?>index.php/filemanager/upload/<?=$this->uri->segment(3)?>" <?if($seg2=='upload'){echo ' class="current"';}?>><?=lang('upload_file');?></a></li>
    </ul>
</div>
<div style="padding: 20px;height: 350px; overflow: auto;">
    <table class="site">
    <?
    foreach($list as $rs):
    //$img = explode('/',$rs->lb_url);
    ?>
        <tr>
            <td><a id="cboxClose" href="javascript:;" onclick="insert('<?=$rs->lb_url?>');"><?=$this->icon_library->loadtypefile($rs->lb_url,$rs->lb_ext)?></a></td>
            <td><a id="cboxClose" href="javascript:;" onclick="insert('<?=$rs->lb_url?>');"><?=$rs->lb_name?></a></td>
            <td style="width: 120px;font-weight: bold;"><a id="cboxClose" href="javascript:;" onclick="insert('<?=$rs->lb_url?>');"><?=lang('choose_file');?></a></td>
        </tr>
    <? endforeach;?>
    </table>
    <div class="pages"><?=$pagination?></div>
</div>