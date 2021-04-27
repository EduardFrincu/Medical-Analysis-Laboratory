<?php

include('connection.php');




$query_dropdown_categorie = "SELECT Nume_Categorie FROM Categorie";
$reuzltat_dropdown_categorie = sqlsrv_query($conn, $query_dropdown_categorie, array(), array( "Scrollable" => 'static' ));


$message = "";

if(isset($_POST['SubmitButtonCat'])){

    if($_POST['inputCategorie'])
            $input_Categorie = $_POST['inputCategorie'];
    $message = "Success! You entered: " . $input_Categorie;



}
?>

<html>
    <body>    
    <form action="test.php" method="POST">
                        <select id="locatie" name="inputCategorie" type = "text" class = "categories">
                            <option disabled = "disabled" selected = "selected"> Categorie </option>
                                <?php
                                    while($row_dropdown_categorie = sqlsrv_fetch_array($reuzltat_dropdown_categorie)){?> 
                                        <option value = "<?php echo $row_dropdown_categorie['Nume_Categorie'];?>"> <?php echo $row_dropdown_categorie['Nume_Categorie'];?></option>   
                                <?php  }                                
                                ?>
                        </select>
                        <input type="submit" name="SubmitButtonCat" class = "categories"/>
                    </form>  

                    <?php if(isset($input_Categorie)){
                            if(isset($_POST['SubmitButtonCat'])){
                                
                                $query_misto = "SELECT DISTINCT  P.Nume, P.Prenume, C.Nume_Categorie FROM Pacienti P
                                                INNER JOIN [Analiza-Pacient] AP ON AP.Id_Pacient = P.Id_Pacient
                                                INNER JOIN Analiza A ON A.Id_Analiza = AP.Id_Analiza
                                                INNER JOIN Categorie C ON C.Id_Categorie = A.Id_Categorie
                                                WHERE C.Nume_Categorie = '$input_Categorie'";
                                $rezultat_misto = sqlsrv_query($conn, $query_misto, array(), array( "Scrollable" => 'static' ));

                                
                                
                                while($row_misto = sqlsrv_fetch_array($rezultat_misto)){
                                    $nume = $row_misto['Nume'];
                                    

                                $query_misto_2 = "SELECT  A.Nume_Analiza,R.Valoare FROM [Analiza-Pacient] AP
                                                  INNER JOIN Pacienti P ON AP.Id_Pacient = P.Id_Pacient
                                                  INNER JOIN Analiza A ON A.Id_Analiza = AP.Id_Analiza
                                                  INNER JOIN Categorie C ON C.Id_Categorie = A.Id_Categorie
                                                  INNER JOIN Rezultate R ON R.Id_Rezultat = A.Id_Rezultat
                                                  WHERE C.Nume_Categorie = '$input_Categorie' 
                                                  AND P.Nume = '$nume'";

                                $rezultat_misto_2 = sqlsrv_query($conn, $query_misto_2, array(), array( "Scrollable" => 'static' )); ?>
                                  
                                        <h3> <?php echo $row_misto['Nume']." ". $row_misto['Prenume'];?> </h3>

                                        <?php while($row_misto_2 = sqlsrv_fetch_array($rezultat_misto_2)){?>
                                            <h5> <?php echo $row_misto_2['Nume_Analiza']." ". $row_misto_2['Valoare'];?> </h5>

                                       <?php }
                                        ?>
                                        
                                        
                                   
                                    
                                    <?php }





                            }}?>
       <h1> <?php echo $message; ?> </h1>


    </body>
</html>
<?php


