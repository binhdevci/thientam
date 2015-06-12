<?
	$k = 1;
	$i = 1 ;
	foreach($list as $rs):
?>

    <tr class="row<?=$k?> news-<?=$i?>">
        <td><input type="checkbox" class="checkbox_id_news<?=$i?>" id="checkbox_id_tags<?=$i?>" name="ar_id_news[]" checked="checked" value="<?=$rs->id_tags?>" >
            <input type="hidden" class="hdn_checkbox_id_news<?=$i?>" id="hdn_checkbox_id_tags<?=$i?>" name="hdn_arrvote[]"  value="<?=$rs->id_tags?>">
            <input type="hidden" class="hdn_delete_checkbox_id_news<?=$i?>" id="hdn_checkbox_id_tags<?=$i?>" name="hdn_delete_arrvote[]"  value="0"></td>
        <td class="w300"><?=$rs->lb_name?></td>
       
    </tr>
<?
	$k=1-$k;
	$i++;
	endforeach;
?>
