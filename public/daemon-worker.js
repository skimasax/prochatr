onmessage = function(e) {
//   console.log('MyDaemon Called..');
	//Data
	var csrf = e.data[0].csrf;
	var url = e.data[0].url;
	var json = JSON.stringify({"userid": null});

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

	}
	xhr.send(json);
}