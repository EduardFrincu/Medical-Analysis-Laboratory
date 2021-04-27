var addModal = document.getElementById("addModal");
var deleteLabModal = document.getElementById("deleteLabModal");
var modifyLabModal = document.getElementById("modifyLabModal");
var deletePacientModal = document.getElementById("deletePacientModal");

var addBtn = document.getElementById("addBtn");
var deleteLabBtn = document.getElementById("deleteLabBtn");
var modifyLabBtn = document.getElementById("modifyLabBtn");
var deletePacientBtn = document.getElementById("deletePacientBtn");

var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close1")[0];
var span2 = document.getElementsByClassName("close2")[0];
var span3 = document.getElementsByClassName("closePacient")[0];

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
    content.style.display = "none";
    } else {
    content.style.display = "block";
    }
});
}


// deschidere pop up
addBtn.onclick = function() {
  addModal.style.display = "block";
}

deleteLabBtn.onclick = function() {
    deleteLabModal.style.display = "block";
  }
modifyLabBtn.onclick = function(){
    modifyLabModal.style.display = "block";
}
deletePacientBtn.onclick = function(){
  deletePacientModal.style.display = "block";
}


// inchidere prin apasarea x
span.onclick = function() {
  addModal.style.display = "none";
}

span1.onclick = function() {
    deleteLabModal.style.display = "none";
  }

span2.onclick = function(){
    modifyLabModal.style.display = "none";
}
span3.onclick = function(){
  deletePacientModal.style.display = "none";
}


// inchidere prin apasarea random in afara acestuia
window.onclick = function(event) {
  if (event.target == addModal) {
    addModal.style.display = "none";
  }
  else if (event.target == deleteLabModal) {
    deleteLabModal.style.display = "none";
  }
  else if(event.target == modifyLabModal){
    modifyLabModal.style.display = "none";
  }
  else if(event.target == deletePacientModal) deletePacientModal.style.display = "none";
}



