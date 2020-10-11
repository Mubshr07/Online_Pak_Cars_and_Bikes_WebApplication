function _(el) {
	return document.getElementById(el);
}

function Upload() {
	var xhr = createRequestObject();
	var frmdta;
	console.log("in uploading form function");
	if (document.forms["form_upload"].checkValidity()) {
		console.log("valid uploading tags");
		frmdta = new FormData(document.forms.form_upload);
		var file = document.getElementById("file1").files[0];
		frmdta.append("file1", file);
		_("upload_responseDiv").style.display = "block";

		xhr.upload.addEventListener("progress", progressHandler, false);

		xhr.addEventListener("progress", progressHandler, true);
		xhr.addEventListener("load", completeHandler, false);
		xhr.addEventListener("error", errorHandler, false);
		xhr.addEventListener("abort", abortHandler, false);
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function MyProfile() {
	var xhr = createRequestObject();
	var frmdta;
	if (document.forms["form_myprofile"].checkValidity()) {
		console.log(" form_myprofile validation checked ");
		frmdta = new FormData(document.forms.form_myprofile);
		xhr.onload = function () {
			//console.log(xhr.status);
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				//console.log(s); 
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				if (ourData["myprofile"]) {
					//console.log("This is the myprofile update form response ");
				}

				renderHTML(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");


		}; // end of onerror function
		xhr.onprogress = function (event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function Login() {
	var xhr = createRequestObject();
	var frmdta;

	if (document.forms['formlogin'].checkValidity()) {
		//console.log(" form_login validation checked ");
		frmdta = new FormData(document.forms.formlogin);
		xhr.onload = function () {
			//console.log(xhr.status);
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s);
				s = Json_Replacable(s);
				//console.log(s); 
				var ourData = JSON.parse(s);
				console.log(ourData);
				if (ourData["log"]) {
					console.log('\nSucessfull Person');
				} 
				renderHTML(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");

		}; // end of onerror function
		xhr.onprogress = function (event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);

	}
}

function Register() {
	var xhr = createRequestObject();
	var frmdta;
	if (document.forms["form_signup"].checkValidity()) {
		//console.log(" form_signup validation checked ");
		frmdta = new FormData(document.forms.form_signup);
		xhr.onload = function () {
			//console.log(xhr.status);
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s);
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				console.log(ourData);
				renderHTML(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");

		}; // end of onerror function
		xhr.onprogress = function (event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);

	}
}

function renderHTML(data) {
	var output = _("output");
	while (output.hasChildNodes()) {
		output.removeChild(output.firstChild);
	}

	if (_("output2")) {
		var output2 = _("output2");
		while (output2.hasChildNodes()) {
			output2.removeChild(output2.firstChild);
		}
		if (data["passwordChange"]) {
			output2.insertAdjacentHTML('beforeend', "<span style='color:lime; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");
		}
	}

	if (data["error"]) {
		output.insertAdjacentHTML('beforeend', "<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["error"] + "</span><br>");
	}

	if (data["playlist_created"]) {
		output.insertAdjacentHTML('beforeend', "<span style='color:lime; font-size:21px; font-weight:600;'>" + data["msg"] + "</span><br>");
	}
	//login form
	if (data["login"]) {
		console.log('inLoginForm Data');
		output.insertAdjacentHTML('beforeend', "<span style='color:lime; font-size:21px; font-weight:600;'>" + data["username"] + "</span><br>");
		if (data["login_success"]) {
			console.log('redirecting');
			window.location = window.location.protocol + "//" + window.location.host + "/fyp/"
		}
	}

	//signup form
	if (data["signup"]) {
		output.insertAdjacentHTML('beforeend', "<span style='color:lime; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
		if (ourData["signup_success"] == true) {
			window.location = window.location.protocol + "//" + window.location.host + "/fyp/?val=login"
		}
	}

	// myProfile Update form
	if (data["myprofile"]) {
		output.insertAdjacentHTML('beforeend', "<span style='color:lime; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");
	}
	
	if (document.getElementById('form_upload')) {
		output.insertAdjacentHTML('beforeend', "<span style='color:yellow; font-size:21px; font-weight:600;'>" + data["successMsg"] + "</span><br>");
		//document.getElementById("form_upload").reset();
	}
	setTimeout(Romve_xhrMsg, 2000);
}

function Romve_xhrMsg() {
	var output;
	if (_("outputtitle")) {
		output = _("outputtitle");
	} else {
		output = _("output");
	}
	while (output.hasChildNodes()) {
		output.removeChild(output.firstChild);
	} 
	if (_("output2")) {
		output = _("output2");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
	}
	
}

function Disable_this(sender) {
	console.log(sender);
	_(sender).disabled = true;
}

function Enable_this(sender) {
	_(sender).disabled = false;
}

function ADdetail_Function(sender) {
	//console.log('playing ' + sender.value);
	var formName = "form_ADdetail" + sender.value;
	//console.log(formName);
	var frmdta;
	var xhr = createRequestObject();
	if (document.getElementById(formName)) {
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function () {
			//console.log(xhr.status);
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s);
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				//console.log(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} // end of if for 
} // end of function ADdetail_Function(sender)
 
function form_updateAd(sender) { 
	var formName = "form_update" ; //+ sender.value; 
	var frmdta;``
	var xhr = createRequestObject();
	if (document.getElementById(formName)) { 
		frmdta =  new FormData(document.forms.namedItem(formName));
		var file = document.getElementById("file1").files[0];
		frmdta.append("file1", file);
		_("upload_responseDiv").style.display = "block";

		xhr.upload.addEventListener("progress", progressHandler, false);
		xhr.addEventListener("progress", progressHandler, true);
		xhr.addEventListener("load", completeHandler, false);
		xhr.addEventListener("error", errorHandler, false);
		xhr.addEventListener("abort", abortHandler, false);
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
} // end of function share_this(sender)


function MyProfileChangePassword(sender) {
	var xhr = createRequestObject();
	var frmdta;
	if (document.forms["form_myprofilePassChange"].checkValidity()) {
		console.log(" form_myprofilePassChange validation checked ");
		frmdta = new FormData(document.forms.form_myprofilePassChange);
		xhr.onload = function () {
			//console.log(xhr.status);
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s); 
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				renderHTML(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");


		}; // end of onerror function
		xhr.onprogress = function (event) {
			//console.log('Received ' + event.loaded + ' of ' + event.total + ' bytes');
		}; // end of onprogress 
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = document.getElementById("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function Get_userPosts(sender) {
	var formName = "form_oneUserPosts";
	var frmdta;
	var xhr = createRequestObject();
	if (document.forms[formName].checkValidity()) {
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				//console.log(s); 
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				//console.log(ourData);
				renderUserPost(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} else {
		var output = _("output");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

function renderUserPost(data) {
	var output = _(data["output_id"]);
	while (output.hasChildNodes()) {
		output.removeChild(output.firstChild);
	}
	if (data["output_id"] == "output") {
		output.insertAdjacentHTML('beforeend', "<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["msg"] + "</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	} else if (data["output_id"] == "outputMain") {
		//console.log(data); 
		if (data['hasposts'] == true) {
			var table = _("userPostsTable");
			table.style.display = "inline-block";
			for (var i = 0; i < data['length']; i++) {
				var row = table.insertRow(i + 1);

				var cell0 = row.insertCell(0);
				var cell1 = row.insertCell(1);
				var cell2 = row.insertCell(2);
				var cell3 = row.insertCell(3);
				var cell4 = row.insertCell(4);
				var cell5 = row.insertCell(5);
				var cell6 = row.insertCell(6);
				var cell7 = row.insertCell(7);
				//var cell8 = row.insertCell(8);
				//var cell9 = row.insertCell(9);

				cell0.innerHTML = i + 1; // data[i]['id'];
				cell1.innerHTML = '<span class="text-break  block-ellipsis">' + data[i]['title'] + "</span>";
				cell2.innerHTML = data[i]['updatingDate'];
				cell3.innerHTML = data[i]['type'];
				cell4.innerHTML = data[i]['price'];  
				cell5.innerHTML = data[i]['brandName'];
				cell6.innerHTML = data[i]['modelName'];
				cell7.innerHTML = data[i]['0'];
			}
		}
		//output.insertAdjacentHTML('beforeend',"<span style='color:cyan; font-size:21px; font-weight:600;'>" + data["id"] + "</span><br>");	
	} else {
		alert(" Some this else is comming to you. Hahahahahahhaha");
	}
}
 
function I_SOLD_THIS(sender) { 
	var formName = "form_SOLD"; // + sender.value;
	var frmdta;
	var xhr = createRequestObject();
	if (_(formName)) {
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s); 
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				//console.log(ourData);
				findBestRedirectionPath(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} // end of if for 
} // end of function like_this(sender)
 
function I_DELETE_THIS(sender) { 
	var formName = "form_deleteThisAD"; // + sender.value;
	var frmdta;
	var xhr = createRequestObject();
	if (_(formName)) {
		frmdta = new FormData(document.forms.namedItem(formName));
		xhr.onload = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s); 
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				//console.log(ourData);
				findBestRedirectionPath(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
	} // end of if for 
} // end of function like_this(sender)
 
function findBestRedirectionPath(data)
{
	if (data["sold_ok"] || data["delete_ok"]) {
		console.log('redirecting');
		window.location = window.location.protocol + "//" + window.location.host + "/fyp/?val=myAllPosts"
	}
}


function Search_Bar(sender) {
	var formName = "form_searchBar";
	var frmdta;
	var xhr = createRequestObject();
	if (document.forms["form_searchBar"].checkValidity()) {
		frmdta = new FormData(document.forms.namedItem(formName));
		//console.log(frmdta);
		xhr.onload = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				var s = xhr.responseText;
				console.log(s);
				s = Json_Replacable(s);
				var ourData = JSON.parse(s);
				Render_SearchDate(ourData);
			} else {
				console.log("We connected to the server. but server return an error.");
			}
		};
		xhr.onerror = function () {
			console.log(" errors in XhrReuest ");
		};
		xhr.open('POST', 'xhrRequest.php');
		xhr.send(frmdta);
		_(formName).reset();
	} // end of if for 
	else {
		var output = document.getElementById("outputdate");
		while (output.hasChildNodes()) {
			output.removeChild(output.firstChild);
		}
		output.insertAdjacentHTML('beforeend', "<span style='color:#eb0042; font-weight:600;'> Please fill the form first</span><br>");
		setTimeout(Romve_xhrMsg, 2000);
	}
}

 
 


 


//#########################################################################
//###						Important Functions							###
//#########################################################################

//-------------- File Uploading Events --------------
function fileValidation() {
	var fileInput = document.getElementById('file1');
	var filePath = fileInput.value;
	var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
	if (!allowedExtensions.exec(filePath)) {
		alert('Please upload file having extensions .png /.jpg /.jpeg only.');
		fileInput.value = '';
		return false;
	} else {
		//alert(' Great job');
	}
}

function progressHandler(event) {
	//console.log("ProgressHandler method fired");

	_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
	var percent = (event.loaded / event.total) * 100;
	//console.log(percent +  " Progress bar Object " + _("progressBar"));
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
	var s = event.target.responseText;
	//console.log(s);
	s = s.replace(/\\n/g, "\\n")
		.replace(/\\'/g, "\\'")
		.replace(/\\"/g, '\\"')
		.replace(/\\&/g, "\\&")
		.replace(/\\r/g, "\\r")
		.replace(/\\t/g, "\\t")
		.replace(/\\b/g, "\\b")
		.replace(/\\f/g, "\\f");
	// remove non-printable and other non-valid JSON chars
	s = s.replace(/[\u0000-\u0019]+/g, "");

	var ourData = JSON.parse(s);

	console.log(ourData);
	renderHTML(ourData);

	_("status").innerHTML = "";
	//_("status").innerHTML = ourData["successMsg"];
	_("loaded_n_total").innerHTML = "";
	_("progressBar").value = 00;
	_("upload_responseDiv").style.display = "none";
 
	//console.log(" CompleteHandler status element value : " + _("status")); 
	if(ourData['update_success'] == true)
	{ 
		window.location = window.location.protocol + "//" + window.location.host + "/fyp/?val=ADedit&ID="+ourData["adID"];
	}
	if(ourData['upload_success'] == true)
	{ 
		window.location = window.location.protocol + "//" + window.location.host + "/fyp/?val=myAllPosts";
	}
}

function errorHandler(event) {
	_("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
	_("status").innerHTML = "Upload Aborted";
}

function createRequestObject() {
	var http;
	if (navigator.appName == "Microsoft Internet Explorer") {
		http = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		http = new XMLHttpRequest();
	}
	return http;
}

function Json_Replacable(s) {
	s = s.replace(/\\n/g, "\\n");
	s = s.replace(/\\'/g, "\\'");
	s = s.replace(/\\"/g, '\\"');
	s = s.replace(/\\&/g, "\\&");
	s = s.replace(/\\r/g, "\\r");
	s = s.replace(/\\t/g, "\\t");
	s = s.replace(/\\b/g, "\\b");
	s = s.replace(/\\f/g, "\\f");
	// remove non-printable and other non-valid JSON chars
	s = s.replace(/[\u0000-\u0019]+/g, "");
	return s;
}
