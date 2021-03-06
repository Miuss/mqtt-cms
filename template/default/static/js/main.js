
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}

function dateFormat(fmt,timestamp){
    var date = new Date(timestamp * 1000);
    var o = {
     "M+" : date.getMonth()+1, //月份
     "d+" : date.getDate(), //日
     "h+" : date.getHours(), //小时
     "m+" : date.getMinutes(), //分
     "s+" : date.getSeconds(), //秒
     "q+" : Math.floor((date.getMonth()+3)/3), //季度
     "S" : date.getMilliseconds() //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
    if(new RegExp("("+ k +")").test(fmt))
        fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
}

function show_page(time) {
    $(".page-loading").hide();
    $(".page-content").fadeIn(time);
}

$(".search-bar input").on('focus', function () {
    $(".search-bar .search-list").removeClass('h');
});

$(".search-bar input").on('blur', function () {
    $(".search-bar .search-list").addClass('h');
});

$(".search-bar input").on('input', function (e) {
    if($(".search-bar input").val()!=""){
        $(".search-bar").addClass("not-empty");
    }else{
        $(".search-bar").removeClass("not-empty");
    }
});
$("header .search-bar .cancel").on('click', function (e) {
    $(".search-bar input").val("");
    $(".search-bar").removeClass("not-empty");
});
$("header .search-icon").on('click', function (e) {
    $("header .mdui-toolbar").addClass("mobile");
});
$("header .search-bar .back").on('click', function (e) {
    $("header .mdui-toolbar").removeClass("mobile");
});

/*邮件验证码处理 */
var EmailCodeInterValObj; //timer变量，控制时间
var EmailCodecount = 60; //间隔函数，1秒执行
var EmailCodecurCount;//当前剩余秒数
function sendMessage() {
	EmailCodecurCount = EmailCodecount;
    $(".send-email").attr("disabled","true");
    $(".send-email").html(EmailCodecurCount + "秒后重发");
	EmailCodeInterValObj = window.setInterval(SetRemainTime, 1000);
}
function SetRemainTime() {
	if (EmailCodecurCount == 0) {//超时重新获取验证码                
		window.clearInterval(EmailCodeInterValObj);// 停止计时器
		$(".send-email").removeAttr("disabled");//移除禁用状态改为可用
		$(".send-email").html("发送验证码");
	}else {
		EmailCodecurCount--;
		$(".send-email").html(EmailCodecurCount + "秒后重发");
	}
}

$(".m-resetpass .send-email").on('click', function (e) {
    var email = $(".m-resetpass input[name='email']").val();
    var mailret = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
    if(email == "") {
        $(".m-resetpass .step-1").find(".mdui-textfield-error").eq(0).html("邮箱不能空");
        $(".m-resetpass .step-1").find(".mdui-textfield").eq(0).addClass("mdui-textfield-invalid-html5");
    }else if(!mailret.test(email)){
        $(".m-resetpass .step-1").find(".mdui-textfield-error").eq(0).html("邮箱格式错误");
        $(".m-resetpass .step-1").find(".mdui-textfield").eq(0).addClass("mdui-textfield-invalid-html5");
    }else if($(this).html()=="发送验证码"){
        sendMessage();
        $.post("/api/?act=email",{type: 'resetpass',email: email},function(x){
            mdui.snackbar({message: x.msg,position: 'right-bottom'});
        });
    }
});

$(".m-resetpass .action-btn-check").on('click', function (e) {
    var email = $(".m-resetpass input[name='email']").val();
    var code = $(".m-resetpass input[name='code']").val();
    var mailret = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
    if(mailret.test(email)) {
        $.post("/api/?act=emailcheck",{code: code,email: email},function(x){
            if(x.status == "error"){
                if(x.code==-1){
                    mdui.snackbar({message: x.msg,position: 'right-bottom'});
                }else{
                    $(".m-resetpass .step-1").find(".mdui-textfield-error").eq(x.code).html(x.msg);
                    $(".m-resetpass .step-1").find(".mdui-textfield").eq(x.code).addClass("mdui-textfield-invalid-html5");
                }
            }else{
                $(".m-resetpass .step-2 .mdui-dialog-title").text("找回"+email+"的密码");
                $(".m-resetpass .step-1").hide();
                $(".m-resetpass .step-2").show();
            }
        });
    }
});

$(".m-resetpass .back").on('click', function (e) {
    $(".m-resetpass .step-1").show();
    $(".m-resetpass .step-2").hide();
});

$(".m-resetpass .action-btn-resetpass").on('click', function (e) {
    var email = $(".m-resetpass input[name='email']").val();
    var code = $(".m-resetpass input[name='code']").val();
    var password = $(".m-resetpass input[name='password']").val();
    var repassword = $(".m-resetpass input[name='repassword']").val();
    if(password !=""&&repassword !=""){
        $.post("/api/?act=resetpass",{code: code,email: email,password: password,repassword: password},function(x){
            if(x.status == "error"){
                if(x.code==-1){
                    mdui.snackbar({message: x.msg,position: 'right-bottom'});
                }else{
                    $(".m-resetpass .step-2").find(".mdui-textfield-error").eq(x.code).html(x.msg);
                    $(".m-resetpass .step-2").find(".mdui-textfield").eq(x.code).addClass("mdui-textfield-invalid-html5");
                }
            }else{
                window.location.replace("/");
            }
        });
    }
});

/* Register */

$(".m-create-user .action-btn-create-user").on('click', function (e) {
    var email = $(".m-create-user input[name='email']").val();
    var username = $(".m-create-user input[name='username']").val();
    var password = $(".m-create-user input[name='password']").val();
    if(username !=""&&password !=""){
        $.post("/api/?act=user-create",{email: email,username: username,password: password},function(x){
            if(x.status == "error"){
                mdui.snackbar({message: x.msg,position: 'right-bottom'});
            }else{
                window.location.replace("/");
            }
        });
    }
});

/* Login */
$(".m-login .action-btn-login").on('click', function (e) {
    var username = $(".m-login input[name='username']").val();
    var password = $(".m-login input[name='password']").val();
    if(username !=""&&password !=""){
        $.post("/api/?act=login",{username: username,password: password},function(x){
            if(x.status=="error"){
                $(".m-login").find(".mdui-textfield-error").eq(1).html(x.msg);
                $(".m-login").find(".mdui-textfield").eq(1).addClass("mdui-textfield-invalid-html5");
            }else{
                window.location.replace("/");
            }
        });
    }
});

$(".save-user-security").click(function(){
    var oldpassword = $("input[name='oldpassword']").val(),newpassword = $("input[name='newpassword']").val(),renewpassword = $("input[name='renewpassword']").val(),email = $("input[name='email']").val();
    $.post("/api/?act=user-eidt-security",{oldpassword: oldpassword,newpassword: newpassword,renewpassword: renewpassword,email: email},function(x){
        mdui.snackbar({message: x.msg,position: 'right-bottom'});
        if(x.status == "success"){
            window.location.reload();
        }
    });
});

/* Device Create */
$("#CreateDevice .action-btn-create-device").on('click', function (e) {
    var name = $("#CreateDevice input[name='name']").val();
    var password = $("#CreateDevice input[name='password']").val();
    if(name !=""&&password !=""){
        $.post("/api/?act=device-create",{name: name,password: password},function(x){
            if(x.status=="error"){
                $(".m-login").find(".mdui-textfield-error").eq(1).html(x.msg);
                $(".m-login").find(".mdui-textfield").eq(1).addClass("mdui-textfield-invalid-html5");
            }else{
            }
        });
    }
});

/* Logout */
$(".action-logout").on('click', function (e) {
    $.post("/api/?act=logout",function(x){
        if(x.status=="success"){
            window.location.replace("/");
        }
    });
});

$(".copy").on("click", function(e) {
    $("body").append("<input id='copy-input'>");
    $("#copy-input").val($(this).attr("copy"));
    $("#copy-input").select();
    document.execCommand("copy");
    $("#copy-input").remove();
    mdui.snackbar({message: "已为您复制所选内容",position: 'right-bottom'});
});

function warnings(text) {
    $("body").prepend("<div class='alert'>"+
        "<div class='mdui-container'>"+text+"<button class='btn-close'><i class='mdui-icon material-icons'>close</i></button></div>"
    +"</div>");
}

$("body").on('click', '.alert .btn-close',function(e){
    $(this).parent().parent().remove();
});