<html>
    <head>
        <!-- <link rel="stylesheet" href="admin.css"> -->
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        .background{
    background-image: url("admin_background.png");

    height:100%;
    background-size: center;
    background-position: center;

}
body{

    margin:0;
    font-family: "Dosis";
    font-size: 18px;
    
    
    
}
.navbar{

    overflow: hidden;
    z-index:3;
    background-image: linear-gradient(45deg,#5a5a5a,#303030);
    background-color: #2de1ee;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  
    
    


}
.navbar-button{

    color: #f2f2f2;
    float: right;
    text-align:center;
    padding: 17px 24px;
    text-decoration: none;
    border-radius:2px;
    background-color: #911c1c;
}
.navbar-button:hover{
    background-color: #c42121 ;


}
.container{


background-color: rgb(79, 78, 78);
border-radius: 23px;
padding-top: 1%;
padding-bottom:1%;
width: 70%;
margin: 5% auto;
box-shadow: 1px 4px 8px 1px rgba(0, 0, 0, 0.2), 20px 14px 30px 0 rgba(0, 0, 0, 0.19);
font-size: 18px;
text-align: center;


}
.logo{
    width: 78px;
    height: 52px;
    float: left;
    overflow: hidden;
    margin-top: 1px;
}
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 90%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  
}
.categories{
    font-family: "Dosis";
    /* text-transform: uppercase; */
    outline: 0px;
    background-color: #8f3232;
    background-image: linear-gradient(45deg, #e23737, #961111);
    width: 25%;
    border: 0;
    border-radius: 8px;
    padding: 1%;
    font-size: 21px;
    font-weight: 600;
    color: white;
    cursor: pointer;
    margin: 10px 17px 25px;
}
.categories:hover{


    background-image:  linear-gradient(45deg, #a82929, #7c2c2c);
   
}
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }
  
  @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
  }
  
  @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }
  

  .close,
  .close1 {
    color: rgb(0, 0, 0);
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close1:hover,
  .close:focus,
  .close1:focus {
    color: rgb(135, 0, 0);
    text-decoration: none;
    cursor: pointer;
  }
  
  .modal-body {padding: 2px 16px;}

  .pop-up-title{


    text-align:center;
  }
 

  .admin-form input{

    font-family: "Dosis";
    outline:0;
    background: #f2f2f2;
    width: 70%;
    border:0;
    margin: 0px 15% 15px 15%;
    padding: 4%;
    box-sizing: border-box;
    font-size: 16px;
    border-radius: 8px;

  }
  .admin-form button{

    font-family: "Dosis";
    text-transform: uppercase;
    outline: 0px;
    background-color: #328f8a;
    background-image: linear-gradient(45deg, #e23737, #961111);
    width:70%;
    border:0; 
    border-radius: 8px;
    padding:4%;
    font-size: 18px;
    font-weight: 600;
    color: white;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
    margin: 0px 15% 15px 15%;
  }
  .admin-form button:hover{
    background-image: linear-gradient(45deg, #a82929, #7c2c2c);
     
  
  }
  


</style>
        

    </head>

    <body>
        <div class = "background">
            <div class = "navbar">
                <a class="brand" href="#">
                    <img src="atom.svg" class="logo">  
                </a>

                <a class="navbar-button" href="logout.php">  Log out      
                                  
                </a> 
            </div>
            <div class="container" > 
                <button type="button" class="collapsible">Puncte de lucru</button>
                <div class="content">
                    <button id = "addBtn" class = "categories"> Adauga</button>
                    <button id = "deleteLabBtn" class = "categories"> Sterge </button>
                    <button class = "categories"> Modifica </button>
                </div>
                <button type="button" class="collapsible">Open Section 2</button>
                <div class="content">
                    <button id = "addBtn" class = "categories"> Adaugare punct de lucru </button>
                    <button id = "deleteLabBtn" class = "categories"> Stergere punct de lucru </button>
                    <button class = "categories"> Stergere profil </button>
                </div>
                <button type="button" class="collapsible">Open Section 3</button>
                <div class="content">
                    <button id = "addBtn" class = "categories"> Adaugare punct de lucru </button>
                    <button id = "deleteLabBtn" class = "categories"> Stergere punct de lucru </button>
                    <button class = "categories"> Stergere profil </button>
                </div>
                <button type="button" class="collapsible">Open Section 4</button>
                <div class="content">
                    <button id = "addBtn" class = "categories"> Adaugare punct de lucru </button>
                    <button id = "deleteLabBtn" class = "categories"> Stergere punct de lucru </button>
                    <button class = "categories"> Stergere profil </button>
                </div>
                <button type="button" class="collapsible">Open Section 5</button>
                <div class="content">
                    <button id = "addBtn" class = "categories"> Adaugare punct de lucru </button>
                    <button id = "deleteLabBtn" class = "categories"> Stergere punct de lucru </button>
                    <button class = "categories"> Stergere profil </button>
                </div>
            </div>

            <div id="addModal" class="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close">&times;</span>
                        <h3 class = "pop-up-title">ADAUGARE PUNCT DE LUCRU</h3>

                        <form id = "add-form" action="adaugare_lab.php" class = "admin-form" method="POST">
                            <input name = "oras" type = "text" placeholder = "Oras">  <br>
                            <input name = "strada" type = "text" placeholder = "Strada">  <br>
                            <input name = "nr_strada" type = "text" placeholder = "Nr. Strada">  <br>
                            <input name = "telefon" type = "text" placeholder = "Telefon">  <br>
                            <input name = "form_value" type = "hidden" value ="1"> <br>


                            <button name = "lab-submit" type="submit">  Adauga </button>
                            
                        </form>
                      
                    </div> 
                </div>
            </div>



            <script>
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


            var addModal = document.getElementById("addModal");
            var addBtn = document.getElementById("addBtn");
            var span = document.getElementsByClassName("close")[0];

            addBtn.onclick = function() {
                addModal.style.display = "block";
            }

            span.onclick = function() {
                addModal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == addModal) {
                     addModal.style.display = "none";
             } }

            </script>


                
        <script src = "./scripts/admin_modal.js" > </script>
    </body>

</html>

