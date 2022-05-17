$(document).ready(function(){

setHeaders();
var root = location.origin+"/";
var site = location.origin+"/Ajax/";

var str = window.location.href;
var res = str.match(/dashboard/g);
var resetpass = str.match(/resetpassword/g);
var start = parseInt($(".pagenumlast").html());
var lastCount;

if(res){
	//Creating a web worker thread
	if (window.Worker) {
	    var Contacts = new Worker('daemon-worker.js');
	    var connections = new Worker('daemon-worker.js');
	    var callers = new Worker('daemon-worker.js');
	}

	//Repeated tasks
	setInterval(function(){
		PullContacts();
		PullConnections();
		PullCallers();
	}, 3000);

}

if(resetpass){
	//Get security question
	setInterval(function(){
		if($("#accusername").val().length > 0){
			doAjax(site+"getQuestion", {username: $("#accusername").val()});
		}
	}, 3000);
}

//Scroll to Load
$(window).scroll(function(){
	if ($(window).scrollTop() == $(document).height() - $(window).height()){
		loadmore();
	}
});

//Click to fetch
$("#loadmore").click(function(event) {
	loadmore();
});

function loadmore(){
	if($(".pagenumlast").html() > 0) {
		var pagenum = parseInt($(".pagenumlast").html())+start;
		getresult(site+"loadMoreConnection/?limit="+pagenum+"&offset="+start+"&param="+$("#need").val());
	}
}

function getresult(url) {
	$.ajax({
		url: url,
		type: "GET",
		beforeSend: function(){
			$('.loadericon').removeClass('disp-0');
			lastCount = $(".pagenumlast").html();
		},
		complete: function(){
			$('.loadericon').addClass('disp-0');
			snew = $(".pagenumlast").html();
			$(".pagenumlast").html($(".load_result").length);
		},
		success: function(data){
			$(".load_result:last-child()").after(data);
			if($(".load_result").length == lastCount){
			$(".message").html("No more connections");
				toastThis("No more connections");
			}
		},
		error: function(){}
	});
}

//END Of Scroll to load

//Assync Calls
function PullContacts(){
	//Take to web worker
    Contacts.postMessage([{type: "Contacts", csrf: $('meta[name="csrf-token"]').attr('content'), url: site+"getcontacts"}, 0]);
    Contacts.onmessage = function(e) {
		var result = e.data;
		if(result.res == "Success" && result.type == "getcontacts"){
			for(var i=0; i < result.data.length; i++){
				if(!$("#media"+result.data[i].login_id+".add").html()){
					var image = result.data[i].image;
					var state = "success";
					// console.log("Pulling contacts");
					if(result.data[i].image == "profile.png"){image = '../asset/img/user.png';}
					if(result.data[i].state == "Offline"){state = 'warning';}

					$("#itemremoved").after('<div class="media wow fadeIn add" style="text-transform: capitalize !important;" id="media'+result.data[i].login_id+'"><div class="media-left"><img src="'+image+'" id="contactimage'+result.data[i].login_id+'" alt="'+result.data[i].firstname+'" class="media-object" /></div><div class="media-body dash"><h4 class="media-heading"><span id="contactfirstname'+result.data[i].login_id+'">'+result.data[i].firstname+'</span>&nbsp;<span id="contactlastname'+result.data[i].login_id+'">'+result.data[i].lastname+'</span><br /><span class="badge badge-'+state+' " style="margin-right: 5px;">'+result.data[i].state+'</span><small id="contactprofession'+result.data[i].login_id+'" style="text-transform: capitalize;">'+result.data[i].profession+'</small><br /><small id="contactcity'+result.data[i].login_id+'">'+result.data[i].city+'</small><small id="contactstate'+result.data[i].login_id+'">'+result.data[i].country+'</small></h4></div><button class="btn btn-xs btn-danger" onclick="showProfile(\''+result.data[i].login_id+'\', \'contact\')" style="border-radius: 10px 0px 0px 10px;">Profile</button><button class="btn btn-xs btn-success" id="'+result.data[i].login_id+'" onclick="addThis(\''+result.data[i].login_id+'\')" style="border-radius: 0px 10px 10px 0px;">Add</button></div>');
				}
			}
		}
    }
	//End Of web worker
}
function PullConnections(){
	//Take to web worker
    connections.postMessage([{type: "Connections", csrf: $('meta[name="csrf-token"]').attr('content'), url: site+"getConnections"}, 0]);
    connections.onmessage = function(e) {
		var result = e.data;
		if(result.res == "Success" && result.type == "Connections"){
			$(".conCount").html(result.data.length);
			for(var i=0; i < result.data.length; i++){
				// console.log(1);
				if(!$("#media"+result.data[i].user_id+".conn").html()){
					// console.log('9');
					// console.log("Pulling contacts");
					var image = result.data[i].image;
					var state = "success";
					if(result.data[i].image == "profile.png"){image = '../asset/img/user.png';}
					if(result.data[i].state == "Offline"){state = 'warning';}

					$("#iteminserted").after('<div class="media wow fadeIn conn add" style="text-transform: capitalize !important;" id="media'+result.data[i].user_id+'"><div class="media-left"><img src="'+image+'" id="connectionimage'+result.data[i].user_id+'" alt="'+result.data[i].firstname.trim()+'" class="media-object" /></div><div class="media-body dash"><h4 class="media-heading"><span id="connectionfirstname'+result.data[i].user_id+'">'+result.data[i].firstname+'</span>&nbsp;&nbsp;<span id="connectionlastname'+result.data[i].user_id+'">'+result.data[i].lastname.trim()+'</span><br /><span class="badge badge-'+state+' " style="margin-right: 5px;">'+result.data[i].state+'</span><small id="connectionprofession'+result.data[i].user_id+'" style="text-transform: capitalize;">'+result.data[i].profession+'</small><br /><small id="connectioncity'+result.data[i].user_id+'">'+result.data[i].city+'</small><small id="connectionstate'+result.data[i].user_id+'">'+result.data[i].country+'</small></h4></div><button class="btn btn-xs btn-danger" onclick="showProfile(\''+result.data[i].user_id+'\', \'connection\')" style="border-radius: 10px 0px 0px 10px;">Profile</button><button class="btn btn-xs btn-success" id="'+result.data[i].user_id+'" onclick="showMessage(\''+result.data[i].user_id+'\', \'connection\')" style="border-radius: 0px 10px 10px 0px;">Message</button></div>');
				}
			}
		}
    }
	//End Of web worker
}
function PullCallers(){
	//Take to web worker
    callers.postMessage([{type: "Callers", csrf: $('meta[name="csrf-token"]').attr('content'), url: site+"getConnections"}, 0]);
    callers.onmessage = function(e) {
		var result = e.data;
		if(result.res == "Success" && result.type == "Callers"){
			$(".conCount").html(result.data.length);
			for(var i=0; i < result.data.length; i++){
				if(!$("#media"+result.data[i].user_id+".conncall").html()){
					// console.log('Pulling Callers');
					var image = result.data[i].image;
					var state = "success";
					if(result.data[i].image == "profile.png"){image = '../asset/img/user.png';}
					if(result.data[i].state == "Offline"){state = 'warning';}

					$("#iteminsertedCall").after('<div class="media wow fadeIn conncall add" style="text-transform: capitalize !important;" id="media'+result.data[i].user_id+'"><div class="media-left"><img src="'+image+'" id="callimage'+result.data[i].user_id+'" alt="'+result.data[i].firstname.trim()+'" class="media-object" /></div><div class="media-body dash"><h4 class="media-heading"><span id="callfirstname'+result.data[i].user_id+'">'+result.data[i].firstname+'</span>&nbsp;&nbsp;<span id="calllastname'+result.data[i].user_id+'">'+result.data[i].lastname.trim()+'</span><br /><span class="badge badge-'+state+' " style="margin-right: 5px;">'+result.data[i].state+'</span><small id="callprofession'+result.data[i].user_id+'" style="text-transform: capitalize;">'+result.data[i].profession+'</small><br /><small id="callcity'+result.data[i].user_id+'">'+result.data[i].city+'</small><small id="callstate'+result.data[i].user_id+'">'+result.data[i].country+'</small></h4></div><button title="Make Voice Call" class="btn btn-xs btn-danger" style="border-radius: 10px 0px 0px 10px; padding: 5px; padding-left: 13px; padding-right: 13px;"><div><i class="ion-ios-telephone"></i></div></button><button title="Make Video Call" class="btn btn-xs btn-success" style="border-radius: 0px 10px 10px 0px; padding: 5px; padding-left: 13px; padding-right: 13px;"><div><i class="ion-ios-videocam"></i></div></button></div>');
				}
			}
		}
    }
	//End Of web worker
}
//END Of Assync Calls

$("#account_username").val('Username goes here')
    $('.slide').slide({
	    'slideSpeed': 3000,
	    'isShowArrow': true,
	    'dotsEvent': 'mouseenter',
	    'isLoadAllImgs': true
    });

//Submit Registration
$(".stage1 > div > div:nth-child(2) > button").click(function(event) {
	$(".stage1 > div > div:nth-child(2) > img").removeClass('disp-0');
	event.preventDefault();
	var thisurl = $("#signupForm").attr('value');
	var formElement = $(".stage1 > div > div > div > input");
	var err = 0;

	$(".stage1 > div > div:nth-child(2) > button > img").show();

	formElement.each(function(index, el) {
		var Elementvalue = $("#"+formElement[index].id).val();
		if(Elementvalue.length < 2){
			$("#"+formElement[index].id).addClass('errForm');
			$("#signup > div > form > button > img").hide();
			err = 1;
		}
		else{
			$("#"+formElement[index].id).removeClass('errForm');
			$(".stage1 > div > div:nth-child(2) > button > img").show();
		}
	});

	//Ajax Submit if no Error
	if(err != 1){
		var url = thisurl;
		var data = {
			login_id: $("#login_id").val(),
			register_firstname: $("#register_firstname").val(),
			register_lastname: $("#register_lastname").val(),
			register_email: $("#register_email").val(),
			register_phone: $("#register_phone").val(),
			register_profession: $("#register_profession").val(),
			register_industry: $("#register_industry").val(),
			register_position: $("#register_position").val(),
			register_company: $("#register_company").val(),
			register_country: $("#register_country").val(),
			register_city: $("#register_city").val(),
			gender: $("#gender").val(),
			register_state: $("#register_state").val()
		};
		doAjax(url, data);
	}
	else{
		$(".stage1 > div > div:nth-child(2) > img").addClass('disp-0');
	}
	$(".stage1 > div > div:nth-child(2) > button > img").hide();
});


//Create Account
$("#stage2 > div > div:nth-child(2) > button").click(function(event) {
	$("#stage2 > div > div:nth-child(2) > img").removeClass('disp-0');
	event.preventDefault();
	if($("#account_password").val().length < 2 || $("#account_username").val().length < 2){
		$(".errresponseaccount > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br /> Username or Password Error");
		$(".errresponseaccount").removeClass("disp-0");
		$("#stage2 > div > div:nth-child(2) > img").addClass('disp-0');
	}
	else if($("#security").val().length < 2 || $("#answer").val().length < 2){
		$(".errresponseaccount > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br />Provide valid security question and answer");
		$(".errresponseaccount").removeClass("disp-0");
		$("#stage2 > div > div:nth-child(2) > img").addClass('disp-0');
	}
	else{
		doAjax(site+"CreateAccount", {login_id: $("#login_id").val(), username: $("#account_username").val(), password: $("#account_password").val(), email: $("#register_email").val(), security: $("#security").val(), answer: $("#answer").val()})
	}

});

//Logout
$("#logout").click(function(event) {

	doAjax(site+"Logout", {action: 'Logout', response: '_redir'})

});

//Login
$("#login > form > button").click(function(event) {
	$("#login > form > img").removeClass('disp-0');
	event.preventDefault();
	if($("#login_username").val().length > 2 && $("#login_password").val().length > 2){
		doAjax(site+"Login", {username: $("#login_username").val(), password: $("#login_password").val()})
	}
	else{
		$(".errresponselogin > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br /> Login Error. Please fill the form correctly.");
		$(".errresponselogin").removeClass("disp-0");
		$("#login > form > img").addClass('disp-0');
	}

});

//Launch
$("#launch").click(function(event) {
	$("#stage3 > div > div > form > center > img").removeClass('disp-0');
	event.preventDefault();
	if($("#account_username").val().length > 2 && $("#account_password").val().length > 2){
		doAjax(site+"Login", {username: $("#account_username").val(), password: $("#account_password").val()})
	}
	else{
		iziToast.show({
		    theme: 'light',
		    timeout: 100,
		    icon: 'icon-person',
		    title: 'Ooops',
		    message: 'Launch Failed',
		    position: 'topRight',
		    progressBarColor: 'rgb(0, 255, 184)'
		});
		$("#stage3 > div > div > form > center > img").addClass('disp-0');
	}

});

//Invite Trigger
$(".send_invite").click(function(event) {
	$("#inviteform > img").removeClass('disp-0');
	event.preventDefault();
	if($("#invite_email").val().length > 3){
		doAjax(site+"Invite", {email: $("#invite_email").val()})
	}
	else{
		$("#inviteinfo").html("Invitation Failed. Please Retry");
		$("#inviteform > img").addClass('disp-0');
	}

});

//Invite
$("#invitebtn").click(function(event) {
	event.preventDefault();
	$("#invite").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
});

//Login
$("#subscribe").click(function(event) {
	$(".footer-newsletter > form > img").removeClass('disp-0');
	event.preventDefault();
	if($("#subscribe_email").val().length > 2){
		//Take to web worker
		if (window.Worker) {
		var myWorkers = new Worker('worker.js');
		}

	    myWorkers.postMessage([{type: "Subscribe", csrf: $('meta[name="csrf-token"]').attr('content'), url: site+"Subscribe"}, {email: $("#subscribe_email").val()}]);

	    myWorkers.onmessage = function(e) {
			var result = e.data;

			if(result.res == "Success"){
				$("#subscribe_email").removeClass('err');
				$("#subscribe_email").val('');
				$("#errShow").html('Done. Thanks for subscribing');
			}
			else{
				$("#errShow").html(result.res);
			}
			$(".footer-newsletter > form > img").addClass('disp-0');

	    }
		//End Of web worker

	}
	else{
		$("#subscribe_email").addClass('err');
		$("#errShow").html('Address appears incorrect!');
		$(".footer-newsletter > form > img").addClass('disp-0');
	}

});

//Update Account
$("#update_form > button").click(function(event) {
	event.preventDefault();
	var data = {'firstname' : $("#update_firstname").val(), 'lastname' : $("#update_lastname").val(), 'email' : $("#update_email").val(), 'phone' : $("#update_phone").val(), 'company' : $("#update_company").val(), 'position' : $("#update_position").val(), 'profession' : $("#update_profession").val(), 'country' : $("#update_country").val(), 'cstate' : $("#update_state").val(), 'city' : $("#update_city").val()};
	doAjax(site+"UpdateAccount", data);
});

//Upload Excel
$(".import.excel").click(function(event) {
	event.preventDefault();
	$("#filetype").val('excel');
	$("#imageform").click();
});

//Change Image
$("#changeimage").click(function(event) {
	event.preventDefault();
	// ("#filetype").val('s');
	$("#imageform").click();
});

//Change Image
$("#imageform").change(function(event) {

    var formData = new FormData();
    var fileSelect = document.getElementById("imageform");
    if(fileSelect.files && fileSelect.files.length == 1){
     var file = fileSelect.files[0]
     formData.set("file", file , file.name);
     // console.log(formData)
		if($("#filetype").val() == "excel"){
			$(".import.excel > img.loaderabs").removeClass('disp-0');
			upload(site+"import", formData);
		}
		else{
			upload(site+"UpdateImage", formData);
		}
    }
});

function upload(url, data){
	$.ajax({
		url: url,
		method: "POST",
		data:  data,
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData:false,
			beforeSend : function()
			{
				$("#profileimage").attr('style', 'opacity: 0.4;');
			},
			success: function(data)
			{
				if(data.res == 1)
				{
					if(data.type == "UpdateImage")
					{
						$("#profileimage").attr('src', data.image);
						$(".profile_dash").attr('src', data.image);
						setTimeout(function(){
							iziToast.show({
							    theme: 'light',
							    timeout: 1000,
							    icon: 'icon-person',
							    title: 'Ooops',
							    message: 'Updated',
							    position: 'topRight',
							    progressBarColor: 'rgb(0, 255, 184)'
							});
						}, 1500);
					}
					if(data.type == "UploadExcel")
					{
						$(".import.excel > img.loaderabs").addClass('disp-0');
						iziToast.show({
						    theme: 'light',
						    timeout: 30000,
						    icon: 'icon-person',
						    title: 'Import',
						    message: 'Successful',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)',
						    buttons: [
						        ['<button>View</button>', function (instance, toast) {
						            instance.hide({
						                transitionOut: 'fadeOutUp',
						                onClosing: function(instance, toast, closedBy){
						                    location.href = root+"invites";
						                }
						            }, toast, 'buttonName');
						        }]
						    ]
						});
					}
				}
				else{
					$(".import > img.loaderabs").addClass('disp-0');
						iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: 'Ooops',
					    message: 'Upload Error!',
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
				$("#profileimage").attr('style', 'opacity: 1;');
			}
	});
}


//Reset Image
$("#resetimage").click(function(event) {
	event.preventDefault();
	doAjax(site+"UpdateImage", {'file': 0});
});


//Toggle Add
$(".toggleAdd").click(function(event) {
	$(".addContact:nth-child(1) > div:nth-child(1)").toggle();
	$(".addContact:nth-child(1) > div:nth-child(2)").toggle();
});

//Toggle Call
$(".toggleCall").click(function(event) {
	$(".mycall > div:nth-child(1)").toggle();
	$(".mycall > div:nth-child(2)").toggle();
});

//Toggle Connection
$(".toggleConnection").click(function(event) {
	$(".mycon > div:nth-child(1)").toggle();
	$(".mycon > div:nth-child(2)").toggle();
});

//Toggle Settings
$(".toggleSettings").click(function(event) {
	$(".myset > div:nth-child(1)").toggle();
	$(".myset > div:nth-child(2)").toggle();
});

var peas = document.querySelectorAll("#dashboard_options > div > div > div");
$.each(peas, function(i){
//Hide All
    $(peas[i]).click( function(event){
	$("#addInfo").show();
    	if(i == 1){
			$("#invite").modal({
			  escapeClose: false,
			  clickClose: false,
			});
    	}
    	else if(i == 4){
    		event.ProgressEvent();
    	}
    	else if(i == 7){
    		doAjax(site+"chatdetails", {id: 'trigger'});
    	}
    	else if(i == 8){
    		location.href = root+"userinterest?_dash=true";
    	}
    	else if(i == 9){
    		location.href = root+"setup?_connection=true&_dash=true";
    	}
    	else{
    		window.scrollBy(0, -50);
	    	$("#components").removeClass('disp-0');
	    	$("."+peas[i].id).removeClass('disp-0');
    	}
    });
});


$("#closeDash").click(function(event) {
	$("#components").addClass('disp-0');
	var closeDash = document.querySelectorAll("#dashboard_options > div > div > div");
	$.each(closeDash, function(i){
		$(".component"+i).addClass('disp-0');
	});
});

$("#register_email").change(function(event) {
	var url = site+"CheckEmail";
	var data = {
		register_email: $("#register_email").val()
	};
	doAjax(url, data)
});

$("#account_username").change(function(event) {
// 	$("#stage2 > form > button").addClass('disp-0');
	if($("#account_username").val().length > 1){
		doAjax(site+"checkAccount", {account_username: $("#account_username").val(), login_id: $("#login_id").val()})
	}
	else{
// 		$("#stage2 > form > button").addClass('disp-0');
	}
});

$(".closeAll").click(function(event) {
	$(".close-modal").click();
});

//Invite
$(".component2").click(function(event) {
	$("#invitebtn").click();
});

$("#retry").click(function(event) {
	$("#stage3").removeClass('active');
	$("#stage2").removeClass('active');
	$(".stage1").addClass('active');

	document.querySelectorAll(".reg-link")[0].setAttribute('class', 'nav-link reg-link active');
	document.querySelectorAll(".reg-link")[1].setAttribute('class', 'nav-link reg-link');
	document.querySelectorAll(".reg-link")[2].setAttribute('class', 'nav-link reg-link');

	//requestAnimationFrame
	$("#signupform").trigger("reset");
	$("#login > form").trigger("reset");

	//Reset login_id
	$("#login_id").val(generate());
});

function doAjax(url, data){
	setHeaders();
	$.ajax({
		url: url,
		method: 'post',
	    data: data,
	    dataType: 'json',

	    success: function(response){
	    	//Registration
			 if(response.type == "Registration"){
			 	if(response.res == "Failed: Data Error"){
					$(".errresponse > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br />"+response.res+".");
					$(".errresponse").removeClass("disp-0");
			 	}
			 	else if(response.res == "Success"){
			 		$(".errresponse").addClass("disp-0");
			 		//Switch State
			 		$("#accountform").trigger("reset");
			 		$(".stage1").removeClass('active');
			 		$("#stage3").removeClass('active');
			 		$("#stage2").addClass('active');

					document.querySelectorAll(".reg-link")[0].setAttribute('class', 'nav-link reg-link');
					document.querySelectorAll(".reg-link")[1].setAttribute('class', 'nav-link reg-link active');
					document.querySelectorAll(".reg-link")[2].setAttribute('class', 'nav-link reg-link');
			 	}
			 	$(".stage1 > div > div:nth-child(2) > button > img").hide();
			 	$(".stage1 > div > div:nth-child(2) > img").addClass('disp-0');
			}

			if(response.type == "CheckEmail"){
				if(response.res == "Verified"){
					$(".errresponse").addClass("disp-0");
				}
				else{
					$(".errresponse > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br /> Email exist. Please provide another email.");
					$(".errresponse").removeClass("disp-0");
				}
			}

			if(response.type == "Login"){
				if(response.res == "Credentials Mis-match"){
					$(".errresponselogin > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br />"+response.res+".");
					$(".errresponselogin").removeClass("disp-0");
					$("#stage3 > form > center > img").addClass('disp-0');
				}
				else if(response.res == "Success"){
					iziToast.show({
					    theme: 'light',
					    timeout: 10000,
					    icon: 'icon-person',
					    title: '',
					    message: response.res,
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
					$(".errresponselogin").addClass("disp-0");
					$("#login > form").trigger('reset');
					setTimeout(function(){
						iziToast.show({
						    theme: 'light',
						    timeout: 1000,
						    icon: 'icon-person',
						    title: '',
						    message: 'Redirecting ...',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)'
						});
					}, 1000);
					setTimeout(function(){ location.href = root+"dashboard" }, 3000);
				}
				$("#login > form > img").addClass('disp-0');
			}

			if(response.type == "Logout"){
				if(response.res == "1"){
					iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: 'Logged Out',
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
					setTimeout(function(){
						iziToast.show({
						    theme: 'light',
						    timeout: 1000,
						    icon: 'icon-person',
						    title: '',
						    message: 'Redirecting back...',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)'
						});
					}, 1000);
					setTimeout(function(){ location.href = root+"?_logout=true" }, 1500);
				}
				else if(response.res == "0"){
					iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: '',
					    message: response.res,
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
			}

			if(response.type == "UpdateAccount"){
				if(response.res == "1"){
					$("#profilefirstname").html(data.firstname);
					$("#profilelastname").html(data.lastname);

					$("#top_name").html(data.firstname+' '+data.lastname);

					$("#namesettings").html(data.firstname);

					$("#namecall").html(data.firstname);

					$("#nameconnections").html(data.firstname);

					$("#profession").html(data.profession);

					$("#profilecity").html(data.city);
					$("#profilestate").html(data.cstate);

					$("#country").html(data.country);

					setTimeout(function(){
						iziToast.show({
						    theme: 'light',
						    timeout: 1000,
						    icon: 'icon-person',
						    title: '',
						    message: 'Updating...',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)'
						});
					}, 1000);
					setTimeout(function(){
						iziToast.show({
						    theme: 'light',
						    timeout: 1000,
						    icon: 'icon-person',
						    title: '',
						    message: 'Updated !',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)'
						});
					}, 1500);
				}
				else if(response.res == "0"){
					iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: '',
					    message: 'Update Failed',
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
			}

			if(response.type == "UpdateImage"){
				if(response.res == "1"){
					$("#profileimage").attr('src', response.image);
					$(".profile_dash").attr('src', response.image);
					setTimeout(function(){
						iziToast.show({
						    theme: 'light',
						    timeout: 1000,
						    icon: 'icon-person',
						    title: '',
						    message: 'Updated !',
						    position: 'topRight',
						    progressBarColor: 'rgb(0, 255, 184)'
						});
					}, 1500);
				}
				else if(response.res == "0"){
					iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: '',
					    message: 'Update Failed',
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
			}

			if(response.type == "Invite"){
				if(response.res == "1"){
					$("#inviteinfo").html("Invitation sent!");
					$("#inviteform").trigger('reset');

					$("#invite_email").removeClass('err');
					$(".send_invite > span").text('Send');

					//Set Failed
					if(response.data.length > 0){
						var failed = "";
						for(var i=0; i < response.data.length; i++){
							failed += response.data[i]+", ";
						}

						$("#invite_email").val(failed);
						$("#invite_email").addClass('err');
						$(".send_invite > span").text('Resend');
					}
				}
				else if(response.res == "0"){
					$("#inviteinfo").html("Invitation Failed. Please Retry");
				}
				$("#inviteform > img").addClass('disp-0');
			}

			if(response.type == "chatdetails"){
				if(response.res == "1"){
					iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: '',
					    message: 'Loading ...',
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
						setTimeout(function(){
						window.open("https://web.prochatr.com/?platform=d455167924436a19e50282c2a8250688&userid="+response.property.user_id+"&key="+true, "_blank");
					}, 2000);
				}
				else{
					iziToast.show({
					    theme: 'light',
					    timeout: 10000,
					    icon: 'icon-person',
					    title: 'Oh',
					    message: response.msg,
					    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
			}

			if(response.type == "Account"){
				if(response.res == "Success"){
					//Switch State
			 		$("#stage3").addClass('active');
			 		$("#stage2").removeClass('active');
			 		$(".stage1").removeClass('active');

					document.querySelectorAll(".reg-link")[0].setAttribute('class', 'nav-link reg-link');
					document.querySelectorAll(".reg-link")[1].setAttribute('class', 'nav-link reg-link');
					document.querySelectorAll(".reg-link")[2].setAttribute('class', 'nav-link reg-link active');
				}
				else if(response.res == "Username Already Exist"){
					iziToast.show({
					    theme: 'light',
					    timeout: 1000,
					    icon: 'icon-person',
					    title: 'Ooops',
					    message: response.res,
					    position: 'topRight',
					    progressBarColor: 'rgb(0, 255, 184)'
					});
				}
				else if(response.res == "Verified"){
					$(".errresponseaccount > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br />"+response.res+".");
					$(".errresponseaccount").addClass("disp-0");
				}
				else{
					$(".errresponseaccount > p").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'><br />"+response.res+".");
					$(".errresponseaccount").removeClass("disp-0");
				}
				$("#stage2 > div > div:nth-child(2) > button > img").hide();
				$("#stage2 > div > div:nth-child(2) > img").addClass('disp-0');
			}

			if(response.type == "GetQuestion"){
				if(response.msg == "Success"){
			 		$("#accsecurity").val(response.data);
				}
				else{
					$("#accsecurity").val('No security question set ....');
				}
			}

		 }
	});
}

function generate_random_string(string_length){
    let random_string = '';
    let random_ascii;
    let ascii_low = 65;
    let ascii_high = 90
    for(let i = 0; i < string_length; i++) {
        random_ascii = Math.floor((Math.random() * (ascii_high - ascii_low)) + ascii_low);
        random_string += String.fromCharCode(random_ascii)
    }
    return random_string
}

function generate_random_number(){
    let num_low = 1;
    let num_high = 9;
    return Math.floor((Math.random() * (num_high - num_low)) + num_low);
}

function generate() {
    return generate_random_string(3) + generate_random_number()
}

function notify(msg){
	Swal.fire({
	  title: msg,
	  position: 'top-end',
	  showConfirmButton: false,
	  width: 200,
	  padding: '10px',
	  backdrop: `
	    rgba(0,0,123,0.4)
	    center left
	    no-repeat
	  `,
	  timer: 1000,
	})
}

 //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
    });
 }
//END
});

function removeThis(clicked){
	//Actual Add to Connection
	sitex = location.origin+"/Ajax/";
	doAjaxx(sitex+"removeConnection", {id: clicked});
	//Adjust animation
}

function addThis(clicked){
	//Actual Add to Connection
	site = location.origin+"/Ajax/";
	doAjaxx(site+"addConnection", {id: clicked});
	// END
}

function doAjaxx(url, data, i=null, lengthArr=null, pos, from=null){
	axios.post(url, data, i, lengthArr, pos, from)
	  .then(function (response) {
	  	if(response.data.res == 1)
  		{
  			if(response.data.type == "AddConnection"){
				//Adjust animation
				$(".addC > div:nth-child(1) > div#media"+data.id).css({"visibility": "visible", "animation-name": "flipInX"});
				$(".addC > div:nth-child(1) > div#media"+data.id).addClass('flipInX');
				$(".addC > div:nth-child(1) > div#media"+data.id).removeClass('bounceInDown');
				//Change Profile button
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button.btn-danger").html("View");
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button.btn-danger").attr("class", "btn btn-xs btn-success");
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button.btn-danger").attr("onclick", "showProfile('"+data.id+"', 'contact')");
				//Change Button
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button#"+data.id).html("Remove");
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button#"+data.id).attr("class", "btn btn-xs btn-danger");
				$(".addC > div:nth-child(1) > div#media"+data.id+" > button#"+data.id).attr("onclick", "removeThis('"+data.id+"')");
				//Clone
				$("#iteminsert").after($(".addC > div:nth-child(1) > div#media"+data.id).clone()[0]);
				//Remove DOM
				$(".addC > div:nth-child(1) > div#media"+data.id).fadeOut('slow');
				$(".addC > div:nth-child(1) > div#media"+data.id).remove();
				//Remove Info
				$("#addInfo").hide();
				$("#removeInfo").hide();

				var connectionList = $(".addC > div:nth-child(2) > div.media");
				var userList = $(".addC > div:nth-child(1) > div.media");
				if(connectionList.length < 1){
					$("#iteminsert").after('<div id="removeInfo"><br /><div class="col-md-12 wow flipInX text-center"><h1>::0::</h1></div><img src="https://img.icons8.com/doodle/96/000000/empty-box.png"><br />No User Found In Your Connection List<hr />Add From Our Database <br />or<br />import from other sources?<br /><br /><a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-warning btn-xs import">Google<img src="../asset/img/google.png" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="../asset/img/excel.png" style="width: 28px;"></button></div>');
				}
				if(userList.length < 1){
					$("#itemremoved").after('<div id="addInfo"><br/><br /><img src="https://img.icons8.com/doodle/96/000000/empty-box.png"><br />No User Found<hr />Interested in importing from other sources?<br /><br />import from other sources?<br /><br /><a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-warning btn-xs import">Google<img src="../asset/img/google.png" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="../asset/img/excel.png" style="width: 28px;"></button></div>');
				}
  			}
 	   		if(response.data.type == "saveInterest"){
  				if(response.data.msg == "Saved"){
  					setTimeout(function(){ location.href = location.origin+"/dashboard" }, 3000);
  				}
  				else{

  				}
  				toastThis(response.data.msg);
  			}
  			if(response.data.type == "RemoveConnection"){
				$(".addC > div:nth-child(2) > div#media"+data.id).css({"visibility": "visible", "animation-name": "flipInX"});
				$(".addC > div:nth-child(2) > div#media"+data.id).addClass('bounceInDown');
				$(".addC > div:nth-child(2) > div#media"+data.id).removeClass('flipInX');
				//Change Profile button
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button.btn-success").html("Profile");
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button.btn-success").attr("class", "btn btn-xs btn-danger");
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button.btn-success").attr("onclick", "showProfile('"+data.id+"', 'contact')");
				//Change Button
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button#"+data.id).html("Add");
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button#"+data.id).attr("class", "btn btn-xs btn-success");
				$(".addC > div:nth-child(2) > div#media"+data.id+" > button#"+data.id).attr("onclick", "addThis('"+data.id+"')");
				//Clone
				$("#itemremoved").after($(".addC > div:nth-child(2) > div#media"+data.id).clone()[0]);
				//Remove DOM
				$(".addC > div:nth-child(2) > div#media"+data.id).fadeOut('slow');
				$(".addC > div:nth-child(2) > div#media"+data.id).remove();
				//Remove Info
				$("#removeInfo").hide();
				$("#addInfo").hide();

				var connectionList = $(".addC > div:nth-child(2) > div.media");
				var userList = $(".addC > div:nth-child(1) > div.media");
				if(connectionList.length < 1){
					$("#iteminsert").after('<div id="removeInfo"><br /><div class="col-md-12 wow flipInX text-center"><h1>::0::</h1></div><img src="https://img.icons8.com/doodle/96/000000/empty-box.png"><br />No User Found In Your Connection List<hr />Add From Our Database <br />or<br />import from other sources?<br /><br /><a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-warning btn-xs import">Google<img src="../asset/img/google.png" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="../asset/img/excel.png" style="width: 28px;"></button></div>');
				}
				if(userList.length < 1){
					$("#itemremoved").after('<div id="addInfo"><br/><br /><img src="https://img.icons8.com/doodle/96/000000/empty-box.png"><br />No User Found<hr />Interested in importing from other sources?<br /><br />import from other sources?<br /><br /><a href="https://accounts.google.com/o/oauth2/auth?client_id=950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com&redirect_uri=https://prochatr.com/app/oauth&scope=https://www.google.com/m8/feeds/&response_type=code"><button type="button" class="btn btn-warning btn-xs import">Google<img src="../asset/img/google.png" style="width: 28px;"></button></a><button type="button" class="btn btn-info btn-xs import excel">Excel<img src="../asset/img/excel.png" style="width: 28px;"></button></div>');
				}
  			}
  			if(response.data.type == "Settings"){
					iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
  			}
  			if(response.data.type == "Security" && response.data.msg == "Security updated"){
  					$("#new_security").val('');
  					$("#new_answer").val('');
  				    $(".editsecurity > center > button > img").addClass('disp-0');
					iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
  			}
  			else if(response.data.type == "Security" && (response.data.msg == "Update Failed" || response.data.msg == "Error! Please Fill The Form")){
  				    $(".editsecurity > center > button > img").addClass('disp-0');
					iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
  			}
  			if(response.data.type == "Trylogin" && response.data.msg == "Success"){
				$("#commandlogin > img").addClass('disp-0');
				$("#reseterrsecurity").html('');
				iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: response.data.msg+". Logging in",
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});

				setTimeout(function(){
					location.href = location.origin+"/dashboard";
				}, 2000);

  			}
  			else if(response.data.type == "Trylogin" && (response.data.msg == "Invalid Details Provided" || response.data.msg == "Failed to Login" || response.data.msg == "Invalid Account")){
				$("#commandlogin > img").addClass('disp-0');
				$("#reseterrsecurity").html(response.data.msg);
				iziToast.show({
				    theme: 'light',
				    timeout: 1000,
				    icon: 'icon-person',
				    title: '',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
  			}
  			if(response.data.type == "getProfile"){
  				$("#profileresactivity").html(response.data.msg);
  			}
  			if(response.data.type == "updatePassword"){

  				if(response.data.msg == "Error! Please Fill The Form" ||response.data.msg == "Previous password does not match!"){
  					$(".errresponseUpdatePassword").html("<img src='../asset/img/error.svg' alt='' style='width: 40px; height:40px;'>"+response.data.msg+".<br /><br />");
  					$(".errresponseUpdatePassword").removeClass('disp-0');
  				}
  				else{
  					$(".errresponseUpdatePassword").html("Good!");
  					$("#prev_password").val('');
  					$("#new_password").val('');
  					$(".updatepassword>a.close-modal ").click();
  					$(".errresponseUpdatePassword").addClass('disp-0');
  				}

  				$(".updatepassword > center > img.loaderabs").addClass('disp-0');
  			}
  			if(response.data.type == "Resetlink"){

  				if(response.data.msg == "Link sent"){
  					$("#reset_account_email").val('');
  				}
  				$("#reseterr").html(response.data.msg);
  				$("#sendresetmail > img").addClass('disp-0');
  			}
			if(response.data.type == "InviteContact"){
				// console.log(response.data);
				if(from != "triggerinvite" && from !=""){
					if(lengthArr === i || lengthArr === i+1){
						$("button#invite#invite > img").addClass('disp-0');
						$("#reseterr").html('Invitation complete!');
						$("#reseterr").attr('style', 'background: #28a745; color: #FFF; border-radius: 0px; padding: 5px;');
					}

					if(response.data.res == "1"){
						$("#inviteall > img").addClass('disp-0');
						//Set Failed
						if(response.data.fail == 0){
							$("#inviteformcontact > div > div > div:nth-child(3) > i")[pos-1].setAttribute('style', 'display: none;');
							$("#invite"+pos).click();
						}
					}

					$("#inviteall > img").addClass('disp-0');
				}
				else{
					if(response.data.fail != 0){
						toastThis('Invite Error');
					}
					else{
						toastThis('Invite sent');
						$("#inviteListedLoader"+i+"").html('Retry +');
						$("#inviteListedLoader"+i+"").attr('title', 'Invited '+response.data.count+" time(s)");
						$("#time"+i).html('Invited '+response.data.count+" time(s)");
						$("#inviteListedLoader"+i+"").removeClass('btn-danger');
						$("#inviteListedLoader"+i+"").addClass('btn-warning');
					}

					$("#inviteListedLoader"+i+" > img.loaderabs").addClass('disp-0');
				}

			}
  			if(response.data.type == "Reset"){
  				$("#reseterr").html(response.data.msg);
  				$("#updatemypassword > img").addClass('disp-0');

  				if(response.data.msg == "Success"){
  					$("#reset_account_password").val('');
  					setTimeout(function(){
  						$("#login").modal({
						  escapeClose: false,
						  clickClose: false,
						  showClose: true
						});
  					}, 2000);
  					$("#login_password").val(data.password);
  				}

  			}
  			if(response.data.type == "sendMessage"){
  				$("#composemessage").val('');
  				$("#message > form > img.loaderabs").addClass('disp-0');
				iziToast.show({
				    theme: 'light',
				    timeout: 10000,
				    icon: 'icon-person',
				    title: 'Message',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
				$("#message > a").click();
  			}
  			if(response.data.type == "alternate_email"){
  				if(response.data.msg == "Saved"){
  					$("#alternate_email").val('');
  				}

  				$(".editalternate > center > button > img").addClass('disp-0');
				iziToast.show({
				    theme: 'light',
				    timeout: 10000,
				    icon: 'icon-person',
				    title: 'Alternate Email',
				    message: response.data.msg,
				    position: 'topRight',
				    progressBarColor: 'rgb(0, 255, 184)'
				});
  			}
  		}
  		else{
			iziToast.show({
			    theme: 'light',
			    timeout: 10000,
			    icon: 'icon-person',
			    title: 'Ooops',
			    message: 'Failed',
			    position: 'topRight',
			    progressBarColor: 'rgb(0, 255, 184)'
			});
  		}
	  })
	  .catch(function (error) {
	   // notify("Error");
	});
}

function notify(msg){
	Swal.fire({
	  title: msg,
	  position: 'top-end',
	  showConfirmButton: false,
	  width: 200,
	  padding: '10px',
	  backdrop: `
	    rgba(0,0,123,0.4)
	    center left
	    no-repeat
	  `,
	  timer: 1700,
	})
}

// Settings
$("#chatmode").change(function(){
	site = location.origin+"/Ajax/";
	if ($('#mailtoggle').is(":checked")){
		doAjaxx(site+'DoSettings', {action: 'chatmode', val: 'light'});
	}
	else{
		doAjaxx(site+'DoSettings', {action: 'chatmode', val: 'dark'});
	}
});

$("#mailtoggle").change(function(){
	site = location.origin+"/Ajax/";
	if ($('#mailtoggle').is(":checked")){
		doAjaxx(site+'DoSettings', {action: 'mail', val: 'on'});
	}
	else{
		doAjaxx(site+'DoSettings', {action: 'mail', val: 'off'});
	}
});

$("#prompttoggle").change(function(){
	site = location.origin+"/Ajax/";
	if ($('#prompttoggle').is(":checked")){
		doAjaxx(site+'DoSettings', {action: 'desktop', val: 'on'});
	}
	else{
		doAjaxx(site+'DoSettings', {action: 'desktop', val: 'off'});
	}
});

$("#blocktoggle").change(function(){
	site = location.origin+"/Ajax/";
	if ($('#blocktoggle').is(":checked")){
		doAjaxx(site+'DoSettings', {action: 'block', val: 'on'});
	}
	else{
		doAjaxx(site+'DoSettings', {action: 'block', val: 'off'});
	}
});

$("#updatepassword").click(function(){
	$(".updatepassword").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
});

$("#editalternate").click(function(){
	$(".editalternate").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
});

$("#editsecurity").click(function(){
	$(".editsecurity").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
});

$("#updatepasswordform").click(function(){
	$(".updatepassword > center > img.loaderabs").removeClass('disp-0');
	doAjaxx(location.origin+"/Ajax/updatepassword", {prev_password: $("#prev_password").val(), new_password: $("#new_password").val()})
});

$("#editatlernateform").click(function(){
	$(".editalternate > center > button > img").removeClass('disp-0');
	doAjaxx(location.origin+"/Ajax/alternate_email", {alternate_email: $("#alternate_email").val()})
});

$("#editsecuritybtn").click(function(){
	$(".editsecurity > center > button > img").removeClass('disp-0');
	doAjaxx(location.origin+"/Ajax/updatesecurity", {security: $("#new_security").val(), answer: $("#new_answer").val()})
});

//Reset Mail Link
$("#sendresetmail").click(function(){
	$("#reseterr").html("Processing....");
	$("#sendresetmail > img").removeClass('disp-0');
	doAjaxx(location.origin+"/Ajax/resetlink", {email: $("#reset_account_email").val()})
});

//Login with security
$("#commandlogin").click(function(){
	$("#reseterrsecurity").html("Processing....");
	$("#commandlogin > img").removeClass('disp-0');
	doAjaxx(location.origin+"/Ajax/trylogin", {accusername: $("#accusername").val(), answer: $("#accanswer").val()})
});

//Reset Update
$("#updatemypassword").click(function(){
	$("#reseterr").html("Processing....");
	$("#updatemypassword > img").removeClass('disp-0');

	var url_string = window.location.href;
	var Addressurl = new URL(url_string);
	var token = Addressurl.searchParams.get("_token");
	doAjaxx(location.origin+"/Ajax/doreset", {password: $("#reset_account_password").val(), token: token})
});


//TriggerInvite Dashboard
var triggerinvite = document.querySelectorAll(".triggerinvite");
$.each(triggerinvite, function(i){
//Hide All
    $(triggerinvite[i]).click( function(event){
    	var pos = i+1;
    	var addrs = $("#inviteListedInput"+pos).val();
    	$("#inviteListedLoader"+pos+" > img.loaderabs").removeClass('disp-0');

		doAjaxx(location.origin+'/Ajax/InviteContact', {'email' : addrs, 'pos' : pos, 'from': 'triggerinvite'}, pos, 1, pos, '');

    });
});

//Invite All Excel
$("#inviteallExcel").click(function(){
	//Click all
	var allEl = $("#inviteformcontact > div > div > div:nth-child(3) > label");
	allEl.each(function(index, el) {
		var pos = index+1;
		$("#inviteExcel"+pos).click();
	});
	$("#inviteallExcel > img").removeClass('disp-0');
	$("button#inviteExcel").click();
});

//Invite All
$("#inviteall").click(function(){
	//Click all
	var allEl = $("#inviteformcontact > div > div > div:nth-child(3) > label");
	allEl.each(function(index, el) {
		var pos = index+1;
		$("#invite"+pos).click();
	});
	$("#inviteall > img").removeClass('disp-0');
	$("button#invite").click();
});

//Invite and submit
$("button#inviteExcel").click(function(){
	var form = $("#inviteformcontact > div > div > div:nth-child(3) > input[name^='invite']:checked");
	var a = getFormData(form);

	if(form.length > 0)
	{
		var i = 0;
		var myVar = setInterval(function(){
			i = i+1;
			//Extract loop value
			const regex = /([0-9]*)$/gm;
			const str = ""+Object.keys(a)[i-1]+"";
			let m;
			m = regex.exec(str)[0];
			//END of Extract

			doAjaxx(location.origin+'/Ajax/InviteContact', {'email' : a[Object.keys(a)[i-1]], 'name': $("#inviteName"+m).html(), 'pos' : i, 'from': 'triggerinvite'}, i, Object.keys(a).length, m);

			if(i == Object.keys(a).length){
				clearInterval(myVar);
			}

		}, 5000);
	}
	else{
		$("#reseterr").removeClass("disp-0");
		$("#reseterr").html("Empty Selections");
		$("#reseterr").attr('style', 'background: #EEE; color: #000; border-radius: 0px; padding: 5px;');
		$("button#invite#invite > img").addClass('disp-0');
	}


});

//Invite and submit
$("button#invite").click(function(){
	var form = $("#inviteformcontact > div > div > div:nth-child(3) > input[name^='invite']:checked");
	var a = getFormData(form);

	if(form.length > 0)
	{
		var i = 0;
		var myVar = setInterval(function(){
			i = i+1;
			//Extract loop value
			const regex = /([0-9]*)$/gm;
			const str = ""+Object.keys(a)[i-1]+"";
			let m;
			m = regex.exec(str)[0];
			//END of Extract

			doAjaxx(location.origin+'/Ajax/InviteContact', {'email' : a[Object.keys(a)[i-1]], 'name': $("#inviteName"+m).html(), 'pos' : i, 'from': 'google'}, i, Object.keys(a).length, m);

			if(i == Object.keys(a).length){
				clearInterval(myVar);
			}

		}, 5000);
	}
	else{
		$("#reseterr").removeClass("disp-0");
		$("#reseterr").html("Empty Selections");
		$("#reseterr").attr('style', 'background: #EEE; color: #000; border-radius: 0px; padding: 5px;');
		$("button#invite#invite > img").addClass('disp-0');
	}


});

function getFormData(form){
	$("button#invite > img").removeClass('disp-0');
	$("#reseterr").removeClass("disp-0");
	$("#reseterr").html("Processing....");
	$("#reseterr").attr('style', 'background: red; color: #FFF; border-radius: 0px; padding: 5px;');
    var unindexed_array = form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
       indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}

function showProfile(id, type){
	event.preventDefault();
	//Set values
	$("#profileresfirstname").html($("#"+type+"firstname"+id).html());
	$("#profilereslastname").html($("#"+type+"lastname"+id).html());
	$("#profileresprofession").html($("#"+type+"profession"+id).html());
	$("#profilerescity").html($("#"+type+"city"+id).html());
	$("#profilerescountry").html($("#"+type+"state"+id).html());
	$("#profileresimage").attr('src', $("#"+type+"image"+id).attr('src'));

	doAjaxx(location.origin+'/Ajax/getProfile', {id: id})

	$("#profile").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
}

function showMessage(id, type){
	event.preventDefault();
	//Set values
	$("#aim").val(id);
	$("#messagefirstname").html($("#"+type+"firstname"+id).html());
	$("#messagelastname").html($("#"+type+"lastname"+id).html());
	$("#messageprofession").html($("#"+type+"profession"+id).html());
	$("#messagestate").html($("#"+type+"city"+id).html());
	$("#messagecountry").html($("#"+type+"state"+id).html());
	$("#messageimage").attr('src', $("#"+type+"image"+id).attr('src'));

	$("#message").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
}

function accept(id, type){
	event.preventDefault();
	$("#accepted"+id).removeClass('disp-0');
	$("#accept"+id).addClass('disp-0');
	doAjaxx(location.origin+'/Ajax/accept', {aim: id})
}

function sendMessage(){
	event.preventDefault();
	if($("#composemessage").val().length > 5){
		$("#message > form > img.loaderabs").removeClass('disp-0');
		doAjaxx(location.origin+'/Ajax/sendMessage', {message: $("#composemessage").val(), aim: $("#aim").val()})
	}
	else{
		iziToast.show({
		    theme: 'light',
		    timeout: 10000,
		    icon: 'icon-person',
		    title: 'Message',
		    message: 'Failed',
		    position: 'topRight',
		    progressBarColor: 'rgb(0, 255, 184)',
		    buttons: [
		        ['<button>Ok</button>', function (instance, toast) {
		            instance.hide({
		                transitionOut: 'fadeOutUp',
		                onClosing: function(instance, toast, closedBy){
		                }
		            }, toast, 'buttonName');
		        }]
		    ]
		});
	}
}

function toastThis(msg){
	iziToast.show({
	    theme: 'light',
	    timeout: 4000,
	    icon: 'icon-person',
	    title: '',
	    message: msg,
	    position: 'topRight',
	    progressBarColor: 'rgb(0, 255, 184)'
	});
}
 //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
    });
 }

function addCon(id){
	$("#result"+id+">div>button>img").removeClass('disp-0');
	doAjaxSimple(location.origin+"/Ajax/addConSetup", {id: id}, id);
}

function doAjaxSimple(url, data, i=null, lengthArr=null, pos, from=null){
	setHeaders();
	$.ajax({
		url: url,
		method: 'post',
	    data:data,
	    dataType: 'json',

	    success: function(response){
  			if(response.type == "addConSetup"){
  				if(response.state == 1){
					//Adjust animation
					$("#result"+i).css({"visibility": "visible", "animation-name": "rollOut"});
					$("#result"+i).addClass('rollOut');
					setTimeout(function(){
						$("#result"+i).addClass('disp-0');
					}, 600);
  				}
  			}
  			else if(response.type == "Voice"){
  				if(response.state == 1){
					//Adjust animation
					alert(1);
  				}
  			}
  			else if(response.type == "moreDetails"){
  				if(response.state == 1){
  					console.log(response.res);
  					if(response.res[0].cstate){var state = response.res[0].cstate;}
  					else{state = ""}
  					var view = '<div class="col-md-12 pick'+response.node+' wow load_resultG pad-0 animated slideInUp" id="resultInd" data-wow-duration="1.4s" style="visibility: visible; animation-duration: 1.4s;"><div class="">City: <span style="float: right;">'+response.res[0].city+'</span><br />State: <span style="float: right;">'+state+'</span><br />Country: <span style="float: right;">'+response.res[0].country+'</span><br />Industry:<span style="float: right;">'+response.res[0].position+'</span> <br />Profession: <span style="float: right;">'+response.res[0].profession+'</span><br />Experience: <span style="float: right;">'+response.res[0].experience+' Yr(s)</span></div></div>';

  						//Tools
  						$(".pick"+response.node+" .close").show();
						$(".pick"+response.node+" .open").hide();

					//Render
					$("#dump"+response.node).show();
  					$("#dump"+response.node).html(view);
  				}
  			}
  			else if(response.type == "fetchCalc"){
  				if(response.state == 1){
  					//Adjust UI
  					$("#resTitle").html(response.cat);

  					// Hide All
  					$("#resFirst").hide();
  					$("#resSecond").hide();
  					$("#resThird").hide();

  					switch(response.cat) {
  						// /(100*2)
  						case 'Network Build up':
  							$("#resFirst").show();
  							$("#resFirst #addC").html(response.res[0].Contact);
  							$("#resFirst #invitePop").html(response.res[0].Invite);
  							break;
  						case 'Professional Supports':
  							$("#resSecond").show();
  							$("#resSecond #sCon").html(response.res[0].Contact);
  							$("#resSecond #pCon").html(response.res[0].Contact);
  							break;
  						case 'Appropriate use of Tools':
  							$("#resThird").show();
  							$("#resThird #group").html(response.res[0].Groups);
  							$("#resThird #vCall").html(response.res[0].Video);
  							$("#resThird #iMessaging").html(response.res[0].Messaging);
  							$("#resThird #vMessaging").html(response.res[0].Voice);
  							$("#resThird #cMessaging").html(response.res[0].Conference);
  							break;
  					}
					//Adjust animation
					$(".showfetch").modal({
					  escapeClose: false,
					  clickClose: false,
					  showClose: true
					});

					console.log(response.res[0]);
  				}
  			}

	    }
	});
}

//Maximize List
$(".maximizeList").click(function(event) {
	$("#list > div:nth-child(1)").attr('class', 'col-md-4 disp-0');
	$("#list > div:nth-child(2)").attr('class', 'col-md-12');
});
//Minimize List
$(".minimizeList").click(function(event) {
	$("#list > div:nth-child(1)").attr('class', 'col-md-4');
	$("#list > div:nth-child(2)").attr('class', 'col-md-8');
});

//saveInterest List
$("#saveInterest").click(function(event) {
	doAjaxx(location.origin+'/Ajax/saveInterest', {about: $("#aboutme").val(),experience: $("#experience").val(),offer: $("#offer").val(),need: $("#need").val() })
});

function badge(cat){
	doAjaxSimple(location.origin+"/Ajax/setBadge", {cat: cat}, 1);
}

function fetchCalc(userVal, cat){
	doAjaxSimple(location.origin+"/Ajax/fetchCalc", {userVal: userVal, cat: cat}, 0);
}

function moreDetails(userVal){
	doAjaxSimple(location.origin+"/Ajax/moreDetails", {userVal: userVal}, 0);
}

function lessDetails(userVal){
	$("#dump"+userVal).hide();
	$(".pick"+userVal+" .close").hide();
	$(".pick"+userVal+" .open").show();
}

function triggerSubscribe(){
	$(".dosubscribe").modal({
	  escapeClose: false,
	  clickClose: false,
	  showClose: true
	});
}


