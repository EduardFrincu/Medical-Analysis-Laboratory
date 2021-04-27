<?php
    session_start();
    $_SESSION=array();

    $errors = array();

    include('connection.php');
    
    if(isset($_POST['reg-submit'])){
       
        if($_POST['COD'])
            $cnp = $_POST['COD'];

        if($_POST['nume'])
            $nume = $_POST['nume'];
            
        if($_POST['prenume'])
            $prenume = $_POST['prenume'];

        if($_POST['data_nasterii'])
            $data_nasterii = $_POST['data_nasterii'];

       // if($_POST['oras'])
        //    $oras = $_POST['oras'];

        if($_POST['sex'])
            $sex = $_POST['sex'];

        if($_POST['pwd1'])
            $pwd1 = $_POST['pwd1'];

        if($_POST['pwd2'])
            $pwd2 = $_POST['pwd2'];


            
    }
    $message="";
    if($pwd1==$pwd2){
    
        $query = "INSERT INTO Pacienti (Nume, Prenume,CNP, Data_nasterii, Sex, Parola) 
        VALUES ('$nume', '$prenume', '$cnp', '$data_nasterii', '$sex', '$pwd1') ";

        $query1 = "SELECT * FROM Pacienti WHERE CNP= '$cnp'";
        $rezultat = sqlsrv_query($conn, $query1, array(), array( "Scrollable" => 'static' ));
        $num = sqlsrv_num_rows($rezultat);
       
        
       if($num == 0){
        
         $statement = sqlsrv_query($conn, $query);
         $message = "Felicitari, v-ati creat un cont!";
         
    }
         else if ($num>0) $message = "Contul exista deja!";
            

    }
    else {
       $message="Parolele nu coincid";


    
   }
?>

<html>

    <head>
    <link rel="stylesheet" href="adaugare.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
    </head>

    <body>
        <div class= "background">
            <div class="navbar">

                <a class="brand" href="home_page.php">

                    <img src="atom.svg" class="logo">  
    
                </a>

                
                <a class="navbar-button" href="home.php"> Home </a>

            </div>
            <div class="container"> 
               <h2> <?php echo $message . "<br>"; ?> </h2>

 <?php 
                
                    if($message == "Contul exista deja!"){
 ?>                     
                        <p> Daca aveti deja un cont, atunci puteti sa va autentificati, apasand butonul de mai jos. Ca date pentru autentificare folositi CNP- ul dumneavoastra si parola aleasa. </p>
                        <a class="container-button" href="login.php"> LOG IN </a>
 <?php
                    }

                   if($message=="Parolele nu coincid"){
?>
                    <p> Ne pare rau. Va rugam sa completati inca o data formularul de mai jos, apasand butonul de mai jos. </p>
                    <a class="container-button" href="register.php"> Register </a>
<?php                 }
                    
                    if($message == "Felicitari, v-ati creat un cont!"  ){
?>                     
                           <p> Ne bucuram sa va avem aproape. Pentru a va conecta, apasati butonul de mai jos. Ca date pentru autentificare folositi CNP- ul dumneavoastra si parola aleasa. </p>
                           <a class="container-button" href="login.php"> LOG IN </a>
<?php
                       }

?>
            </div>
        </div>
           

    </body>



</html>