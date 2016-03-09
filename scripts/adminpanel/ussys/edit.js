// JavaScript Document
function $(id){
	return document.getElementById(id);
}
window.onload = function(){
	$('txtusername').focus();
	var cname,ccompany,cphone;


	//验证用户名
	$('txtusername').oninput = function (){
		name = $('txtusername').value;
		 var reg =/^([\u4e00-\u9fa5]){2,7}$/;;
		 //var lreg = /^[\s\S]{2,7}$/;
		if(!reg.test(name)){
			$('nameprompt').innerHTML = '<font color=red>姓名只允许2-7位汉字</font>';
			cname = '';
		//}else if(!lreg.test(name)){
	//		$('nameprompt').innerHTML = '<font color=red>长度只能为2-7个汉字</font>';
	//		cname = '';
		}
		else{
			$('nameprompt').innerHTML = '<font color=green>注册名符合标准</font>';
			cname = 'yes';
		}

	}
	//当用户名称文本框失去焦点时，系统调用处理页查看用户是否存在
	$('company').oninput = function(){
		company = $('company').value;
		if(company=""){
			$('comprompt').innerHTML = '<font color=red>必填</font>';
			ccompany = '';
		}else{
			$('comprompt').innerHTML = '<font color=green></font>';
			ccompany = 'yes';

		}

	}


	//验证email
	$('mobile').oninput = function(){
		phone = $('mobile').value;
	   var reg = /^1\d{10}$/g;
		if(!reg.test(phone)){
			$('phoneprompt').innerHTML = '<font color=red>手机号码应为11数字</font>';
			cphone = '';
		}else{
			$('phoneprompt').innerHTML = '<font color=green>输入正确</font>';
			cphone = 'yes';

		}

	}


}
