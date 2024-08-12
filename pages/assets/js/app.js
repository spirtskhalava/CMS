'use strict';

/* ===== Enable Bootstrap Popover (on element  ====== */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

/* ==== Enable Bootstrap Alert ====== */
//var alertList = document.querySelectorAll('.alert')
//alertList.forEach(function (alert) {
//  new bootstrap.Alert(alert)
//});

const alertList = document.querySelectorAll('.alert')
const alerts = [...alertList].map(element => new bootstrap.Alert(element))


/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler'); 
const sidePanel = document.getElementById('app-sidepanel');  
const sidePanelDrop = document.getElementById('sidepanel-drop'); 
const sidePanelClose = document.getElementById('sidepanel-close'); 
const role = document.getElementById('role'); 

window.addEventListener('load', function(){
	responsiveSidePanel(); 
});

window.addEventListener('resize', function(){
	responsiveSidePanel(); 
});


function responsiveSidePanel() {
    let w = window.innerWidth;
	if(w >= 1200) {
	    // if larger 
	    //console.log('larger');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
		
	} else {
	    // if smaller
	    //console.log('smaller');
	    sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
	}
};

sidePanelToggler.addEventListener('click', () => {
	if (sidePanel.classList.contains('sidepanel-visible')) {
		console.log('visible');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
		
	} else {
		console.log('hidden');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
	}
});



sidePanelClose.addEventListener('click', (e) => {
	e.preventDefault();
	sidePanelToggler.click();
});

sidePanelDrop.addEventListener('click', (e) => {
	sidePanelToggler.click();
});

const carModels = {
    Toyota: ["Camry", "Corolla", "RAV4", "Highlander"],
    Honda: ["Civic", "Accord", "CR-V", "Pilot"],
    Ford: ["F-150", "Escape", "Focus", "Explorer"]
};

// Function to populate models based on selected brand
function populateModels() {
    const brandDropdown = document.getElementById("brandDropdown");
    const modelDropdown = document.getElementById("modelDropdown");
    const selectedBrand = brandDropdown.value;
    
    // Clear existing options
    modelDropdown.innerHTML = "<option value=''>Select Model</option>";
    
    // Populate models based on selected brand
    if (selectedBrand && carModels[selectedBrand]) {
        carModels[selectedBrand].forEach(model => {
            const option = document.createElement("option");
            option.value = model;
            option.textContent = model;
            modelDropdown.appendChild(option);
        });
    }
}

function fetchAuction() {
    const brandDropdown = document.getElementById("auctionVal");
    const modelDropdown = document.getElementById("result");
    if(brandDropdown){
    const selectedBrand = brandDropdown.value=="" ? "copart" : brandDropdown.value;
    modelDropdown.innerHTML = "<option value=''>Select Location</option>";
    if (selectedBrand) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "cms/../../fetch_auction.php?location=" + encodeURIComponent(selectedBrand), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const models = JSON.parse(xhr.responseText);
                models.forEach(model => {
                    const option = document.createElement("option");
                    option.value = model;
                    option.textContent = model;
                    modelDropdown.appendChild(option);
                });
            }
        };
        xhr.send();
    }
    }
    
   
}
fetchAuction();

function lookupVIN() {
    const vinInput = document.getElementById("vinInput").value;
    const apiKey = "ZrQEPSkKc2FuZHJvMTIxMUBnbWFpbC5jb20=";
    
    // Make API request to Auto.dev
    fetch(`https://auto.dev/api/vin/${vinInput}?api_key=${apiKey}`)
    .then(response => response.json())
    .then(data => {
    console.log("data",data);
        document.getElementById("make").value = data.make.name;
        document.getElementById("model").value = data.model.name;
        document.getElementById("year").value = data.years[0].year;
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Failed to retrieve data. Please try again.");
    });
}

if(document.getElementById("consignee")){
    document.getElementById("consignee").addEventListener("change", function() {
        var selectedValue = this.value;
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        if (selectedValue == 'add') {
            myModal.show();
        }
    });

    function toggleAdditionalFields() {
    var selectedValue = document.getElementById("dropdownSelect").value;
    document.getElementById("company").style.display = (selectedValue === "company") ? "block" : "none";
    var elements = document.getElementsByClassName("private_use");
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.display = (selectedValue === "private") ? "block" : "none";
      }
  }

  document.getElementById("dropdownSelect").addEventListener("change", toggleAdditionalFields);
}
if(document.getElementById("saveButton")){
document.getElementById("saveButton").addEventListener("click", function() {
    var dropdownSelect = document.getElementById("dropdownSelect").value;
    var company = document.getElementById("company").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var country = document.getElementById("country").value;
    var city = document.getElementById("city").value;
    var address = document.getElementById("address").value;
    var saddress = document.getElementById("saddress").value;
    var zip = document.getElementById("zip").value;
    var phone = document.getElementById("phone").value;
    var unique_id = document.getElementById("unique_id").value;
    var email = document.getElementById("email").value;
    var type = document.getElementById("type").value;
    var comment = document.getElementById("comment").value;
    var user_id = document.getElementById("user_id").value;

    var formData = new FormData();
    formData.append("dropdownSelect", dropdownSelect);
    formData.append("company", company);
    formData.append("fname", fname);
    formData.append("lname", lname);
    formData.append("country", country);
    formData.append("city", city);
    formData.append("address", address);
    formData.append("saddress", saddress);
    formData.append("zip", zip);
    formData.append("phone", phone);
    formData.append("unique_id", unique_id);
    formData.append("email", email);
    formData.append("type", type);
    formData.append("comment", comment);
    formData.append("user_id", user_id);

    fetch("../../../cms/add-consignee.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => { 
         var dropdown = document.getElementById("consignee");
         var optionElement = document.createElement("option");
         optionElement.value = data.user_id;
         optionElement.textContent = data.company!=='' ?  data.company : data.firstname+' '+ data.lastname;
         dropdown.prepend(optionElement);
         document.getElementsByClassName("btn-secondary")[0].click();
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
}

if(document.getElementById("add_user_record")){
    $('#add_user_record').click(function(e){
        e.preventDefault();
        $('#addModal').modal('show');
    });
}


$('.edit').click(function(){
    var id = $(this).data('id');
    $.ajax({
        url: 'fetch_user_record.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(data){
            $('#name').val(data.name);
            $('#username').val(data.username);
            $('#role').append('<option value="admin">admin</option><option value="dealer">dealer</option><option value="accountant">accountant</option>');
            $('#user_id').val(data.id);
            $('#editModal').modal('show');
        }
    });
});

$('#saveBtn').click(function(){
    var formData = $('#editForm').serialize();
    $.ajax({
        url: 'save_user_record.php',
        type: 'POST',
        data: formData,
        success: function(response){
            $('#editModal').modal('hide');
            window.location.href = 'user.php';
        }
    });
});

$('.delete').click(function(){
    var id = $(this).data('id');
    $.ajax({
        url: 'delete_user_record.php',
        type: 'POST',
        data: { id: id },
        success: function(response){
            window.location.href = 'user.php';
        }
    });
});

$('#saveRecord').click(function(e){
    var data={
        username: $('#user_name').val(),
        name: $('#fname').val(),
        role: $('#user_role').val(),
        password: $('#password').val(),
       }
    $.ajax({
        url: 'add_user_record.php',
        type: 'POST',
        data: data,
        success: function(response){
            window.location.href = 'user.php';
        }
    });
});

function updateDropdownBalance() {
    $.ajax({
        url: 'get_balance.php',
        type: 'GET',
        success: function(response) {
            $('#user-dropdown-toggle').html(response);
        },
        error: function() {
            alert('An error occurred while fetching the balance.');
        }
    });
}

// Update balance display when page loads
updateDropdownBalance();