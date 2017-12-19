function validateForm() {
	var error = 0
	var usercomplaint = document.forms["formRecord"]["usercomplaint"];
	var errorUser = document.getElementById("errorUser");

	var numbercomplaint = document.forms["formRecord"]["numbercomplaint"];
	var errorNumber = document.getElementById("errorNumber");

	var complainttitle = document.forms["formRecord"]["complainttitle"];
	var errorComplaint = document.getElementById("errorComplaint");

	var complaintreceived = document.forms["formRecord"]["complaintreceived"];
	var errorReceived = document.getElementById("errorReceived");

	var complaintinformation = document.forms["formRecord"]["complaintinformation"];
	var errorInformation = document.getElementById("errorInformation");

	if (usercomplaint.value == "") {
        errorUser.innerHTML = "(Tidak boleh kosong)";
        errorUser.style.color = "red"; 
        error += 1
    }else
    	errorUser.innerHTML = "";

    if(numbercomplaint.value == "") {
    	errorNumber.innerHTML = "(Tidak boleh kosong)"
    	errorNumber.style.color	= "red";
    	error += 1
    }else
    	errorNumber.innerHTML = "";

    if(complainttitle.value == "") {
    	errorComplaint.innerHTML = "(Tidak boleh kosong)"
    	errorComplaint.style.color	= "red";
    	error += 1
    }else
    	errorComplaint.innerHTML = "";

    if(complaintreceived.value == "") {
    	errorReceived.innerHTML = "(Tidak boleh kosong)"
    	errorReceived.style.color	= "red";
    	error += 1
    }else
    	errorReceived.innerHTML = "";

    if(complaintinformation.value == "") {
    	errorInformation.innerHTML = "(Tidak boleh kosong)"
    	errorInformation.style.color	= "red";
    	error += 1
    }else
    	errorInformation.innerHTML = "";

    if (error > 0) {
    	return false
    }
    else 
    	return true
}

function confirmSelesai()
{
    var confirmed = confirm("Apakah anda yakin sudah selesai ?");
    return confirmed;
}

function confirmHapus()
{
    var confirmed = confirm("Apakah anda yakin ingin menghapus ?");
    return confirmed;
}

function confirmLanjut()
{
    var confirmed = confirm("Apakah anda yakin ingin lanjut ?");
    return confirmed;
}

function confirmHapusIni()
{
    var confirmed = confirm("Apakah anda yakin ingin menghapus proses ini ?");
    return confirmed;
}

function confirmation()
{
    var confirmed = confirm("Apakah anda yakin ingin mengupdate ?");
    return confirmed;
}