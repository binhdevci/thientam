<script>
	var base_url="<?=base_url()?>";
</script>
<?
	/*if(isset($advance_search))
	echo $advance_search;*/
	$attributes = array('class' => 'email', 'id' => 'checknew');
	echo form_open('image/dels', $attributes);
?>

<table class="admindata">
    <thead>
        
		<tr>
			<th><?=lang('name_image');?></th>
			<th style="width:200px;"><?=lang('title_link');?></th>
            <th style="width:100px;"><?=lang('create_date')?></th>
            <th class="publish"><?=lang('functions');?></th>
        </tr>
    </thead>
    <?
        $k=1;
        $i=1;
        foreach($list as $rs):
	?>
    <tr class="row<?=$k?>">
		<td><?=$rs->lb_name?></td>
		
		<td><?=$rs->lb_alias?></td>
        <td><?=format_date_show($rs->dt_create)?></td>
        <td align="center">
			<?//=icon_edit('image/edit/'.$rs->id_image)?>
            <span id="publish<?=$rs->id_image?>">
            	<?=icon_active("'pl_image'","'id_image'",$rs->id_image,$rs->bl_active)?>
            </span>
            <?//=icon_del('image/del/'.$rs->id_image.'/'.(int)$this->uri->segment(4))?></td>
    </tr>
    <?
        $k=1-$k;
        $i++;
        endforeach;
	?>
    <tfoot>
		
	</tfoot>
</table>
<?=form_close()?>
