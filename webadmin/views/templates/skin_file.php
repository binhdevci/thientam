<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Quản trị hệ thống</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/file.css">
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery-core.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/apps.js"></script>


</head>
<body>
<? $seg2 = $this->uri->segment(2);?>
<div class="wrapper">
    <div class="header">
        <div class="title">Quản lý File</div>
        <div class="close"><a onclick="self.parent.tb_remove();" href="#"><img alt="" src="<?=base_url()?>templates/images/close.png" /></a></div>
    </div>
    <div class="media-upload-header">
        <ul id="menu">
            <li><a href="<?=base_url()?>filemanager/index" <?if($seg2=='index'){echo ' class="current"';}?>>Thư viện</a></li>
            <li><a href="<?=base_url()?>filemanager/upload" <?if($seg2=='upload'){echo ' class="current"';}?>>Upload FIle</a></li>
        </ul>
    </div>
    <?=$this->load->view($page)?>
</div>
</body>