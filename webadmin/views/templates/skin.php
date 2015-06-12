<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>
<?=lang('system_admin');?>
</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/administrator.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/icon.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/menu.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/system.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/ui/colorbox.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/datetheme.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/validation.css"/>
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery-core.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/function.admin.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/widget.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/apps.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/ui/jquery.colorbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/set_check_box.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/tooltip.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/price_format.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/JSCal2-1.7/src/js/jscal2.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/JSCal2-1.7/src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/js/JSCal2-1.7/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/js/JSCal2-1.7/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/js/JSCal2-1.7/src/css/steel/steel.css" />
<link rel="stylesheet" rev="stylesheet" type="text/css" href="<?php echo base_url() ;?>templates/js/combobox/skin/default/style.css"/>
<script type="text/javascript" language="javascript" src="<?php echo base_url() ;?>templates/js/combobox/js/combobox.js"></script>
<script type="text/javascript">
    var url = '<?=base_url()?>';
    var urlsite = '<?=base_url_site()?>';
    var urlimg = '<?=base_url_site().'/uploads/images/'?>';
    var BASE_URI = '<?=base_url()?>';
</script>
<script type="text/javascript">
    var instance;

    function update_instance()
    {
        instance = CKEDITOR.currentInstance;
    }

    (function($) {
        $(function(){
			
            $('textarea#wysiwyg-simple').ckeditor({
                toolbar: [
                    ['Source','Preview'],['pyroimages', 'pyrofiles','Image','Flash'],
                    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                    ['Undo','Redo'],
                    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['BidiLtr', 'BidiRtl'],
                    ['Link','Unlink','Anchor'],
                    ['Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                    ['Styles','Format','Font','FontSize'],
                    ['TextColor','BGColor'],
                    ['Maximize', 'ShowBlocks']
                  ],
                width: '850px',
                height: 150,
                dialog_backgroundCoverColor: '#000',
                defaultLanguage: 'en',
                language: 'en'
            });

            $('textarea#wysiwyg-advanced,#wysiwyg-advanced_en,#wysiwyg-advanced-feeling').ckeditor({
                toolbar: [
                    ['Source','Preview'],['pyroimages', 'pyrofiles','Image','Flash'],
                    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                    ['Undo','Redo'],
                    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['BidiLtr', 'BidiRtl'],
                    ['Link','Unlink','Anchor'],
                    ['Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
                    ['Styles','Format','Font','FontSize'],
                    ['TextColor','BGColor'],
                    ['Maximize', 'ShowBlocks']
                ],
                extraPlugins: 'pyroimages',
                width: '850px',
                height: 250,
                dialog_backgroundCoverColor: '#000',
                removePlugins: 'elementspath',
                defaultLanguage: 'en',
                language: 'en'
            });

        });
    })(jQuery);
</script>
</head>
<body>
<div align="center" style="display: none;" id="ajax-load">
    <div class="loading">Đang tải dữ liệu ...</div>
</div>
<?
if(!$this->session->userdata('lb_login_name')){
    redirect(base_url());
}
?>
<div id="wrapper">
    <ul id="topbar">
        <li> <a href="<?=base_url_site()?>" target="_blank" title="Site" class="button white fl"><span class="icon_single preview"></span></a> </li>
        <li class="s_1"></li>
        <li class="logo">
            <?=$this->config->item('site_name')?>
        </li>
        <li class="s_1"></li>
        <li class="fr"> <a href="<?=base_url()?>index.php/login/logout" title="logout" class="button red fl"><span class="icon_text logout"></span>
            <?=lang('logout');?>
            </a> </li>
        <li class="s_1 fr"></li>
        <li class="fr"> <a href="#" title="admin" class="button white fl"><span class="icon_text admin"></span>
            <?=$this->session->userdata('admin_fullname')?>
            </a> </li>
        <li class="fr"><a id="logged">Logged in as
            <?=$this->session->userdata('LoginName')?>
            </a></li>
    </ul>
    <div class="menubar">
        <?=$this->load->view('modules/mod_menu')?>
    </div>
    <div id="admincontent">
        <table class="table_full" style="width: 100%;">
            <tr>
                <td class="colum_left_small" valign="top" style="display: none;"><span onclick="clickHide(2)" class="lage">&nbsp;</span></td>
                <!--<td class="colum_left_lage" valign="top"><div style="padding-right:20px; padding-left:4px; width:200px">
                        <div class="divclose">
                            <div class="small" onclick="clickHide(1);">&nbsp;</div>
                        </div>
                        <div id="menu-left">
                            <?//=$this->load->view('modules/mod_menuleft')?>
                        </div>
                    </div></td>-->
                <td bgcolor="#F2F2F2" style="width: 100%;">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="3"><?php if(!empty($message)) echo "<div style='border:1px solid #fdb735; background-color: #e9ffef; padding:10px;margin-bottom:10px'>".$message."</div>";?>
                                <? if($this->session->flashdata('message')){
                                    echo '<div class="message">'.$this->session->flashdata('message').'</div>';
                                }if($this->session->flashdata('error')){
                                    echo '<div class="error">'.$this->session->flashdata('error').'</div>';
                                }if($this->session->flashdata('notes')){
                                    echo '<div class="notes">'.$this->session->flashdata('notes').'</div>';
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;height: 55px;">
                                <div class="title-admin"><?=$title?></div>
                            </td>
                            <td style="width: 25%; vertical-align: bottom;"><?php if(!empty($search_bar)){echo $search_bar;} ?></td>
                            <td style="width: 25%;">
                                <ul class="click">
                                    <li> <a title="<?=lang('back');?>" href="javascript:history.go(-1)"> <img src="<?=base_url()?>templates/images/refresh.png" alt=""/>
                                        <div>
                                            <?=lang('back');?>
                                        </div>
                                        </a> </li>
                                    <? if(!empty($print)){?>
                                    <li> <a title="Bản in" id="printer" class="cboxElement" href="<?=base_url().$print?>" onclick="printer()"> <img src="<?=base_url()?>templates/images/printer.png" alt=""/>
                                        <div>In</div>
                                        </a> </li>
                                    <? }?>
									 
                                    <? if(!empty($add)){?>
                                    <li> <a title="Thêm mới" href="<?=site_url($add)?>"> <img src="<?=base_url()?>templates/images/add.png" alt=""/>
                                        <div>
                                            <?=lang('add');?>
                                        </div>
                                        </a> </li>
                                    <? }?>
									<? if(!empty($search)){?>
                                    <li> 
										<a title="Tìm kiếm"   href="javascript:;;" onclick="advance_search();"> <img src="<?=base_url()?>templates/images/search.png" alt=""/>
                                        </a> 
									</li>
                                    <? }?>
                                    <? if(!empty($export)){?>
                                    <li> <a title="Export" href="<?=site_url($export)?>"> <img src="<?=base_url()?>templates/images/excel.png" alt="Export to Excel" width="25"/>
                                        <div>Export</div>
                                        </a> </li>
                                    <? }?>
                                    <!--
                                        <li>
                                            <a href="javascript:;" id="bt_del">
                                            xóa
                                            </a>
                                        </li>
                                    -->
                                </ul>
                            </td>
                        </tr>
						<tr>
                            <td colspan="3">
                                 <div id="view_port"></div>
                            </td>
                        </tr>
                       
                        <tr>
                            <td colspan="3">
                                <div id="box-content" class="box-content"><?=$this->load->view($page)?></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        setTimeout('$(".message").slideUp()', 1000) ;				
		$(".themmoi").click(function(){
				$('#my_form').submit();
		});
		$(".capnhat").click(function(){
				$('#my_form').submit();
		});
    }) ;
	
    function auto_search(url_search){
		
        var key_search = $("#key_search").val();
		if(key_search==''){ 
		<?
		$this->session->unset_userdata('key_search');
		$this->session->unset_userdata('field_search')	;		
		?>
		var arr=url_search.split('/');
		var control=arr[0];
		window.location='<? echo base_url()?>'+control;
		}
			$.ajax({
				type: "POST",
				url: "<? echo base_url();?>"+url_search,
				data: {key_search:key_search,field_search:$("#field_search").val(),type:"ajax"},
				cache: false,
				dataType: "html",
				success: function(data){
					$(".box-content").html(data);
				}
			});
		//}
    }
</script>
<div id="footer">
    <div>
        <?=lang('time_load_page');?>
        {elapsed_time}
        <?=lang('second');?>
    </div>
    <div>©
         Copyright
        <?=lang('site_name')?>
    </div>
    <div>
        <?=lang('help_online');?>
        : <a href="ymsgr:sendim?ngvanbinh_me">
        <?=lang('click_here');?>
        </a></div>
</div>
</body>
</html>
