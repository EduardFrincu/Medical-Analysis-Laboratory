<?php 
    session_start();
    $_SESSION['adm'] = "true";
    include('connection.php');


    if(isset($_POST['lab-modify-submit'])){

        if($_POST['parametru'])
            $parametru = $_POST['parametru'];
        
        if($_POST['new_value'])
            $new_value = $_POST['new_value'];

        if($_POST['oras'])
            $oras = $_POST['oras'];

        if($_POST['strada'])
            $strada = $_POST['strada'];
            
        if($_POST['nr_strada'])
            $nr_strada = $_POST['nr_strada'];

        if($_POST['telefon'])
            $telefon = $_POST['telefon']; 

        if($_POST['form_value'])  
            $form_value = $_POST['form_value']; 


    }

    if(isset($_POST['lab-submit'])){
       
       
        if($_POST['oras'])
            $oras = $_POST['oras'];

        if($_POST['strada'])
            $strada = $_POST['strada'];
            
        if($_POST['nr_strada'])
            $nr_strada = $_POST['nr_strada'];

        if($_POST['telefon'])
            $telefon = $_POST['telefon'];  
        if($_POST['form_value'])  
            $form_value = $_POST['form_value'];       
    }
    
    //Laboratoare

    if($form_value == 1) $query = "INSERT INTO Punct_de_lucru (Oras, Strada, Nr_Strada, Telefon) VALUES ('$oras', '$strada', '$nr_strada', '$telefon')";
    else if($form_value == 2) $query = "DELETE FROM Punct_de_lucru WHERE Oras= '$oras'AND Strada='$strada'AND Nr_Strada = '$nr_strada' AND Telefon = '$telefon' ";
    else if($form_value == 3) {
        $query = "UPDATE Punct_de_lucru 
                  SET $new_value = '$parametru'
                  WHERE Oras = '$oras' AND Strada = '$strada' AND Nr_Strada = '$nr_strada' AND Telefon = '$telefon'";
                  echo $query;
    }

    $statement = sqlsrv_query($conn, $query);
    
    header("Location:admin.php");
?>



