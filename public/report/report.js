$(document).ready( function () {
var root = location.origin+"/";
var site = location.origin+"/Ajax/";
var str = window.location.href; 
var page = str.match(/Admin/g);

    setInterval(function(){ 
        // getData();
    }, 3000);

    if(page){
        setInterval(function() {
            $("#reloads").load(root+"/Admin/getRegistered","");
        }, 30);
    }

    function getData(){
        doaJSjax(site+"getData", {arg: 1});
    }

    function doaJSjax(url, data){
        setHeaders();
        $.ajax({
            url: url,
            method: "POST",
            data:  data,
            dataType:'JSON',
            success: function(data)
            {
                if(data.state == 1)
                {
                    if(data.type == "Account Creation"){
                        if(data.msg == "Success"){
                            $("#form")[0].reset();
                            iziToast.show({
                                position: 'topRight',
                                color: 'green',
                                title: 'Good',
                                message: data.msg
                            });
                        }
                        else{
                            iziToast.show({
                                position: 'topRight',
                                color: 'red',
                                title: 'Error',
                                message: data.msg
                            });
                        }
                    }                    
                    else if(data.type == "Assignment"){
                        if(data.msg == "Assignment Successful"){
                            $("#form")[0].reset();
                            iziToast.show({
                                position: 'topRight',
                                color: 'green',
                                title: 'Good',
                                message: data.msg
                            });
                        }
                        else{
                            iziToast.show({
                                position: 'topRight',
                                color: 'red',
                                title: 'Error',
                                message: data.msg
                            });
                        }
                    }
                    else{
                        $("#inflowtotal").html(data.Inflow);
                        $("#inflowpercentage").html(data.percentageInflow+"%");
                        $("#outflowtotal").html(data.Outflow);
                        $("#outflowpercentage").html(data.percentageOutflow+"%");
                        $("#transaction").html(data.Transactions);
                        $("#transactionpercentage").html(data.percentageTransactions+"%");
                        $("#membertotal").html(data.members);                        
                    }
                }
                else{
                    error = '<span class="text-center text-danger">Please enter valid password.</span>';
                    $("#errorPassHandler").html(error);
                    $(".loader").addClass('disp-0');
                }                 
            }         
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

    //Code for Date Function
    var curpage = str.match(/calendar/g);
    if(curpage){
        iziToast.show({
            position: 'topRight',
            color: 'green',
            title: 'Almost there.',
            message: 'Setting up calendar in 2s',
            timeout: 1000,
        });
         setInterval(function(){ 
             var peas = document.querySelectorAll(".fc-past");
             $.each(peas, function(i){
                
             // Each click
                 $(peas[i]).click( function(event){
                  var date = peas[i].getAttribute('data-date');
                  if(date.length > 0){
                        var win = window.open(root+"getRecordCalendar?date="+peas[i].getAttribute('data-date'), '_blank');
                        win.focus();
                  }
                 });

             });
         }, 1000);
    }

    //Create New User Account
    $("#create").click(function(event) {
        doaJSjax(site+"createAccount", {fullname: $("#fullname").val(), username: $("#username").val(), password: $("#password").val(), category: $("#category").val(), email: $("#email").val()});
    });

    //Assign to New Account
    $("#save").click(function(event) {
        var name = $("#name").next()[0].innerText;
        var merchant = $("#merchant").next()[0].innerText;
        var manager = $("#manager").next()[0].innerText;

        doaJSjax(site+"save", {name: name, merchant: merchant, manager: manager});
    });

    

} );