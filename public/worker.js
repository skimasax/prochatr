onmessage = function(e) {
//   console.log('Subscribe worker called');
	//Data
	var csrf = e.data[0].csrf;
	var url = e.data[0].url;

	//Subscribe user
	var json = JSON.stringify({"email": e.data[1].email});

	//Request
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader('Content-type','application/json; charset=utf-8');
	xhr.setRequestHeader('X-CSRF-Token', csrf);
	xhr.onload = function () {
		var response = xhr.responseText;

		//Response
		if (xhr.readyState == 4 && xhr.status == "200") {
			postMessage(JSON.parse(response));
		} 
		else if(xhr.readyState <= 4 && xhr.status != "419" && xhr.status != "404") {
			postMessage(JSON.parse({res: "Processing"}));
		}		
		else {
			postMessage(JSON.parse({res: "Failed"}));
		}

	}
	xhr.send(json);

  // postMessage(response);
  // e.data[0].url
  // e.data[1].email
  // console.log(e.data[0].csrf);
}