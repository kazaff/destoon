$(function() {

	$("input[name='txt_username']").blur(function() {
		var obj = document.getElementById("txt_username");
		var msgArea = obj.getAttribute("msgArea");
		if (obj.value != '') {
			var aa = validElement(obj);
			if (!aa) {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).css("color", "red");
				$("#u").val(""); 
			} else {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).css("color", "green");
				var url = "index.php?do=register";
				$.ajax( {
					type : "POST",
					url : url,
					cache : false,
					async : false,
					data : "check_username=" + obj.value,
					dataType : "json",
					error : function(json) {
						$("#" + msgArea).css("color", "red");
						$("#" + msgArea).html('系统繁忙，请稍后再试...');
						$("#u").val("");
					},
					success : function(json) {
						if (json.status == 0) {
							$("#" + msgArea).css("color", "red");
							$("#" + msgArea).html('用户已经被占用了!');
							$("#u").val("");
							
						} else if(json.status == 1) {
							
							$("#" + msgArea).html('用户名可以使用!');
							$("#u").val("1");
						}else if(json.status == 2){
							$("#" + msgArea).css("color", "red");
							$("#"+ msgArea).html('<b>用户名非法</b>');
							$("#u").val("");
						}
					}
				});
			}
		} else {
			$("#" + msgArea).parent().removeClass('alert');
			$("#" + msgArea).html("用户名不能为空！");
			$("#" + msgArea).css("color", "red");
		}

	}).focus(function() {
		var obj = document.getElementById("txt_username");
		var msgArea = obj.getAttribute("msgArea");
		$("#" + msgArea).parent().addClass('alert');
		$("#" + msgArea).css("color", "");
		$("#" + msgArea).html('用户名输入3-20字符之间');
	})
	$("input[name='pwd_password']").blur(function() {
		var obj = document.getElementById("pwd_password");
		var msgArea = obj.getAttribute("msgArea");
		if (obj.value != '') {
			var aa = validElement(obj);
			if (!aa) {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).css("color", "red");
			} else {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).html("OK");
				$("#" + msgArea).css("color", "green");
			}
		} else {
			$("#" + msgArea).parent().removeClass('alert');
			$("#" + msgArea).html("密码输入不能为空！");
			$("#" + msgArea).css("color", "red");
		}

	}).focus(function() {
		var obj = document.getElementById("pwd_password");
		var msgArea = obj.getAttribute("msgArea");
		$("#" + msgArea).parent().addClass('alert');
		$("#" + msgArea).css("color", "");
		$("#" + msgArea).html('密码输入6-20字符之间');
	})
	$("input[name='pwd_password2']").blur(function() {
		var obj = document.getElementById("pwd_password2");
		var msgArea = obj.getAttribute("msgArea");
		if (obj.value != '') {
			var aa = validElement(obj);
			if (!aa) {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).css("color", "red");
				$("#p").val("");
			} else {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).html("OK");
				$("#" + msgArea).css("color", "green");
				$("#p").val("1");
			}
		} else {
			$("#" + msgArea).parent().removeClass('alert');
			$("#" + msgArea).html("重复密码不能为空！");
			$("#" + msgArea).css("color", "red");
			$("#p").val("");
		}

	}).focus(function() {
		var obj = document.getElementById("pwd_password2");
		var msgArea = obj.getAttribute("msgArea");
		$("#" + msgArea).parent().addClass('alert');
		$("#" + msgArea).css("color", "");
		$("#" + msgArea).html('请重复输入密码');
	})
	$("input[name='txt_email']").blur(function() {
		var obj = document.getElementById("txt_email");
		var msgArea = obj.getAttribute("msgArea");
		if (obj.value != '') {
			var aa = validElement(obj);
			if (!aa) {
				$("#" + msgArea).parent().removeClass('alert');
				$("#" + msgArea).css("color", "red");
				$("#e").val("");
			} else {
				$("#" + msgArea).parent().removeClass('alert');
			$("#" + msgArea).css("color", "green");
			var url = "index.php?do=register";
			$.ajax( {
				type : "POST",
				url : url,
				cache : false,
				async : false,
				data : "check_email=" + obj.value,
				dataType : "json",
				error : function(json) {
					$("#" + msgArea).css("color", "red");
					$("#" + msgArea).html('系统繁忙，请稍后再试...');
					$("#e").val("");
			},
				success : function(json) {
					if (json.status == 0) {
						$("#" + msgArea).css("color", "red");
						$("#" + msgArea).html('邮箱已经使用过了!');
						$("#e").val("");
						
					} else {
						$("#" + msgArea).html('邮箱可以使用!');
						$("#e").val("1");
												
					}
				}
			});

		}
	} else {
		$("#" + msgArea).parent().removeClass('alert');
		$("#" + msgArea).html("电子邮箱不能为空！");
		$("#" + msgArea).css("color", "red");
	}
   }).focus(function() {
		var obj = document.getElementById("txt_email");
		var msgArea = obj.getAttribute("msgArea");
		$("#" + msgArea).parent().addClass('alert');
		$("#" + msgArea).css("color", "");
		$("#" + msgArea).html('格式:user@qq.com');
	})
    $("#sbt_reg").click(function(){
		 
		if ($("#u").val()!=1) {
	            showDialog("用户名不正确，或者有误!","alert","错误提示","document.getElementById('txt_username').focus()");
				return false;
		}
		else if($("#e").val()!=1)  {
				showDialog("电子邮箱有误，或者不正确","alert","错误提示","document.getElementById('txt_email').focus();");
				return false;
		}else if ($("#p").val() != 1){
				showDialog("密码输入有误，或者不正确","alert","错误提示","document.getElementById('pwd_password').focus();");
				return false;
		}else{
			 return  checkForm(this.form,true);
		} 
		 
	})	
	
})