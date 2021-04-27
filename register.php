<html>
<head>
<link rel = "stylesheet" href = "register_style.css">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
</head>
<body>
<div class="background"> 
    <div class="navbar">
            <a class="brand" href="home_page.php">
                <img src="atom.svg" class="brand-logo">  
            </a>

            <a class="navbar-button" href="login.php"> Log In </a>
            <a class="navbar-button" href="home.php"> Home </a>
            
    </div>

    <div class="login-page">
        <div class="form">
            <div class = "login">
                <div class = "login-header">
                    <a class="brand" href="#">
                        <img src="atom.svg" class="logo">  
                    </a>
                    <h3>INREGISTRARE</h3>
                    <p>Introduceti datele:</p>
                 </div>
            </div>

            <form class = 'login-form' action="adaugare.php" method="POST" >
               
                    <input name ="COD" type = "text" placeholder="CNP" maxlength="13" >  <br/>
                    <input name ="nume" type = "text" placeholder="Nume"  >  <br/>
                    <input name ="prenume" type = "text" placeholder="Prenume"  >  <br/>
                    <input name ="data_nasterii" type = "date" placeholder="Data Nasterii" max="2020-11-27"  >  <br/>

                    <select id = "gen" name ="sex" type = "text">  <br/>
                    
                        <option disabled="disabled" selected="selected">Sex</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    
                    </select>
                    <!-- <input name="oras" type= "text" placeholder = "Oras"> <br> -->
                    <input name="pwd1" type= "password" placeholder = "Parola"> <br>
                    <input name="pwd2" type= "password" placeholder = "Confirmati Parola"> <br>
                    <button name = "reg-submit" type="submit">  Register </button>
                
            </form>

        </div>
    </div>

    </div> 
</body>

</html>