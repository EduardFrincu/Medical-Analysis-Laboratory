<?php 
    session_start();
    $_SESSION=array();
    $errors = array();
    include('connection.php');

    if(isset($_POST['reg-submit']))
    {
        if($_POST['oras'])
            $oras = $_POST['oras'];

        if($_POST['strada'])
            $strada = $_POST['strada'];

        if($_POST['nr_strada'])
            $nr_strada = $_POST['nr_strada'];
        
        if($_POST['telefon'])
            $telefon = $_POST['telefon'];
    }

    $query = "INSERT INTO Punct_de_lucru (Oras, Strada, Nr_Strada, Telefon)
              VALUES ('$oras', '$strada', '$nr_strada', '$telefon')";

    $statement = sqlsrv_query($conn, $query);

    header("Location:admin.php");
?>