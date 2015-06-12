<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=(!empty($title))?$title:'';?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/system.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/layout_basic.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/icon.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/styles.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/administrator.css">

<script type="text/javascript" src="<?=base_url()?>templates/js/jquery-core.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/ui/jquery.colorbox.min.js"></script> 
<script type="text/javascript" src="<?=base_url()?>templates/js/apps.js"></script>
 
</head>
<body>
    <div class="wrapper">
        <?=$this->load->view($page)?>
    </div>
</body>
</html>
