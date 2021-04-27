let hematologieBtn = document.getElementById("HematologieBtn");
let imunologieBtn = document.getElementById("ImunologieBtn");
let biochimieBtn = document.getElementById("BiochimieBtn");
let parazitologieBtn = document.getElementById("ParazitologieBtn");
let hormoniBtn = document.getElementById("HormoniBtn");
let microbiologieBtn = document.getElementById("microbiologieBtn");


let hematologieModal = document.getElementById("hematologieModal");
let biochimieModal = document.getElementById("biochimieModal");
let imunologieModal = document.getElementById("imunologieModal");
let parazitologieModal = document.getElementById("parazitologieModal");
let hormoniModal = document.getElementById("hormoniModal");
let microbiologieModal = document.getElementById("microbiologieModal");


let spanHematologie = document.getElementsByClassName("closeHematologie")[0];
let spanBiochimie = document.getElementsByClassName("closeBiochimie")[0];
let spanImunologie = document.getElementsByClassName("closeImunologie")[0];
let spanParazitologie = document.getElementsByClassName("closeParazitologie")[0];
let spanHormoni = document.getElementsByClassName("closeHormoni")[0];
let spanMicrobiologie = document.getElementsByClassName("closeHormoni")[0];

//MODAL MICROBIOLOGIE

if(microbiologieBtn)
  microbiologieBtn.onclick = function () {
    microbiologieModal.style.display = "block";
  };

spanMicrobiologie.onclick = function () {
  microbiologieModal.style.display = "none";
};



//MODAL HEMATOLOGIE
if(hematologieBtn)
  hematologieBtn.onclick = function () {
    hematologieModal.style.display = "block";
  };

spanHematologie.onclick = function () {
  hematologieModal.style.display = "none";
};
//MODAL BIOCHIMIE
if(biochimieBtn)
biochimieBtn.onclick = function () {
    biochimieModal.style.display = "block";
  };


spanBiochimie.onclick = function () {
  biochimieModal.style.display = "none";
};
//MODAL IMUNOLOGIE
if(imunologieBtn)
  imunologieBtn.onclick = function () {
    imunologieModal.style.display = "block";
  };


spanImunologie.onclick = function () {
  imunologieModal.style.display = "none";
};
//MODAL PARAZITOLOGIE
if(parazitologieBtn)
  parazitologieBtn.onclick = function () {
    parazitologieModal.style.display = "block";
  };


spanParazitologie.onclick = function () {
  parazitologieModal.style.display = "none";
};

//MODAL HORMONI

if(hormoniBtn)
hormoniBtn.onclick = function(){
    hormoniModal.style.display = "block";
};

spanHormoni.onclick = function(){
    hormoniModal.style.display = "none";
};

//inchidere prin apasare in afara pop up ului

window.onclick = function () {
  if (event.target == hematologieModal) hematologieModal.style.display = "none";
  else if (event.target == biochimieModal) biochimieModal.style.display = "none";
  else if (event.target == imunologieModal) imunologieModal.style.display = "none";
  else if(event.target == parazitologieModal) parazitologieModal.style.display = "none";
  else if(event.target == hormoniModal) hormoniModal.style.display = "none";
  else if(event.target == microbiologieModal) microbiologieModal.style.display = "none";
};
