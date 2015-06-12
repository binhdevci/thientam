var the_form	= window.document.frmUser;
function check_All(status) 
{
	for (i = 0; i < the_form.length; i++) {
		the_form.elements[i].checked = status;
	}
}
function delConfrim()
{
  return confirm("Ban co muon xoa ko")	
}
function submit_list(flag)
{
	if (selected_item()){
		the_form.factive.value = flag;
		the_form.submit();
	}
}
function delete_list(the_url) {
	if (selected_item()){
		question = confirm("Ban co muon xoa khong ?")
		if (question != "0"){
			the_form.action = the_url;
			the_form.submit();
		}
	}
}
function selected_item(){
	var name_count = the_form.length;

	for (i=0;i<name_count;i++){
		if (the_form.elements[i].checked){
			return true;
		}
	}
	alert('Hay chon 1 user');
	return false;
}
