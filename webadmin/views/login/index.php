<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<title><?=lang('login');?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/login.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/system.css">
</head>
<body>
<?
	if($this->session->userdata('user_group') >=24)
	{
		redirect(base_url().'admincp');
	}
?>
<div id="wrapper">
    <?
	if($this->session->flashdata('message')){
		echo '<div class="message">'.$this->session->flashdata('message').'</div>';
	}if($this->session->flashdata('error')){
		echo '<div class="error">'.$this->session->flashdata('error').'</div>';
	}if($this->session->flashdata('notes')){
		echo '<div class="notes">'.$this->session->flashdata('notes').'</div>';
	}
?>
    <div id="body_login">
        <div id="content">
            <?=form_open(base_url());?>
            <div><?=lang('user_name');?></div>
            <div>
                <input type="text" name="user_login" value="<?=set_value('user_login')?>" class="login">
            </div>
            <div><?=lang('password');?></div>
            <div>
                <input type="password" name="user_pass" class="login">
            </div>
            <div align="center">
                <input type="checkbox" name="remembet">
                <?=lang('remember');?>
                <input type="submit" name="login" value="<?=lang('login');?>" class="buttom">
            </div>
            <?=form_close()?>
        </div>
    </div>
    <div align="center">
        <?=form_error('user_login')?>
    </div>
    <div align="center">
        <?=form_error('user_pass')?>
    </div>
</div>
</body>
</html>