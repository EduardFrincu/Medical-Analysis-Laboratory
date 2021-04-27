<?php session_start();
    include('connection.php'); // conectarea la baza de date
    
    if($_SESSION['adm'] == "true"){
        $query_nr_pacienti = "SELECT L.Oras, L.Strada, L.Nr_Strada, L.Telefon, COUNT(DISTINCT P.Id_Pacient) AS nr_Pacienti FROM [Analiza-Punct_de_lucru] AP 
                              INNER JOIN Punct_de_lucru L ON AP.Id_Punct_de_lucru = L.Id_Punct_de_lucru
                              INNER JOIN Analiza A ON A.Id_Analiza = AP.Id_Analiza 
                              INNER JOIN [Analiza-Pacient] APa ON Apa.Id_Analiza = A.Id_Analiza
                              INNER JOIN Pacienti P ON APa.Id_Pacient = P.Id_Pacient
                              GROUP BY AP.Id_Punct_de_lucru, L.Oras, L.Strada, L.Nr_Strada, L.Telefon";
        $rezultat_nr_pacienti = sqlsrv_query($conn, $query_nr_pacienti, array(), array( "Scrollable" => 'static' ));

        $query_dropdown = "SELECT DISTINCT Oras FROM Punct_de_lucru";
        $rezultat_dropdown = sqlsrv_query($conn, $query_dropdown, array(), array( "Scrollable" => 'static' ));
        
        
        $query_dropdown_categorie = "SELECT Nume_Categorie FROM Categorie";
        $reuzltat_dropdown_categorie = sqlsrv_query($conn, $query_dropdown_categorie, array(), array( "Scrollable" => 'static' ));

        



        if(isset($_POST['SubmitButtonCat'])){
            if($_POST['inputCategorie'])
                    $input_Categorie = $_POST['inputCategorie'];
       
        }
        
        if(isset($_POST['SubmitButton'])){
            if($_POST['inputOras'])
                    $input_Oras = $_POST['inputOras'];    
        }

        if(isset($_POST['SubmitButtonPac'])){
            if($_POST['CNP']) $input_CNP_Pac = $_POST['CNP'];
            if($_POST['Nume']) $input_Nume_Pac = $_POST['Nume'];
            if($_POST['Prenume']) $input_Prenume_Pac = $_POST['Prenume'];

            $query_delete = "DELETE FROM Pacienti WHERE CNP = '$input_CNP_Pac'  AND Nume = '$input_Nume_Pac' AND Prenume = '$input_Prenume_Pac' ";
        $statement = sqlsrv_query($conn, $query_delete);

        }

        
       
?>

<html>
    <head>
        <link rel="stylesheet" href="admin.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

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
                    <button id = "modifyLabBtn" class = "categories"> Modifica </button>


                    <table id = "labs_table">
                        <tr> 
                            <th>Oras</th>
                            <th>Strada</th> 
                            <th>Numar Strada</th>
                            <th>Telefon</th>
                            <th>Numar Pacienti</th>
                            
                        </tr> 
                        <?php
                        while($row = sqlsrv_fetch_array($rezultat_nr_pacienti)){?>


                            <tr> 
                                <td> <?php echo $row['Oras'];?> </td>
                                <td> <?php echo $row['Strada'];?> </td>
                                <td> <?php echo $row['Nr_Strada'];?> </td>
                                <td> <?php echo $row['Telefon'];?> </td>
                                <td> <?php echo $row['nr_Pacienti'];?> </td>
                                
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <button type="button" class="collapsible">Afisare Pacienti in functie de laboratoare</button>
                <div class="content">
                    <h4 style = "color:white">Se vor afisa pacientii ce au efectuat analize la laboratoarele din orasul specificat </h4>
                   
                    <form action="admin.php" method="POST">
                        <select id="locatie" name="inputOras" type = "text" class = "categories">
                            <option disabled = "disabled" selected = "selected"> Oras </option>
                                <?php
                                    while($row_dropdown = sqlsrv_fetch_array($rezultat_dropdown)){?> 
                                        <option value = "<?php echo $row_dropdown['Oras'];?>"> <?php echo $row_dropdown['Oras'];?></option>   
                                <?php  }                                
                                ?>
                        </select>
                        <input type="submit" name="SubmitButton" class = "categories"/>
                    </form>
                    <?php if(isset($input_Oras)){?>
                    <p style = "color:white"> <?php echo $input_Oras; ?> </p>
                        <?php }?>
                    <?php if(isset($_POST['SubmitButton'])){
                       
                        $query_pacienti_pe_orase = "SELECT DISTINCT P.Nume, P.Prenume, P.CNP, P.Oras, P.Strada FROM Pacienti P
                        INNER JOIN [Analiza-Pacient] AP ON P.Id_Pacient = AP.Id_Pacient
                        WHERE AP.Id_Analiza IN (SELECT AL.Id_Analiza FROM [Analiza-Punct_de_lucru] AL
                                                INNER JOIN Punct_de_lucru L ON L.Id_Punct_de_lucru = AL.Id_Punct_de_lucru
                                                WHERE L.Oras = '$input_Oras')";
                                                

                        $rezultat_pacienti_pe_orase = sqlsrv_query($conn, $query_pacienti_pe_orase, array(), array( "Scrollable" => 'static' )); 
                        if(sqlsrv_num_rows($rezultat_pacienti_pe_orase)!=0){               
                        ?>

                    
                    <table id = "labs_table">
                        <tr> 
                            <th>Nume</th>
                            <th>Prenume</th> 
                            <th>CNP</th>
                            <th>Oras</th>
                            <th>Strada</th>
                            
                        </tr> 
                        <?php
                        while($row_pacienti = sqlsrv_fetch_array($rezultat_pacienti_pe_orase)){?>


                            <tr> 
                                <td> <?php echo $row_pacienti['Nume'];?> </td>
                                <td> <?php echo $row_pacienti['Prenume'];?> </td>
                                <td> <?php echo $row_pacienti['CNP'];?> </td>
                                <td> <?php echo $row_pacienti['Oras'];?> </td>
                                <td> <?php echo $row_pacienti['Strada'];?> </td>
                                
                            </tr>
                            
                        <?php }}}?>
                    </table>

                                
                </div>
                <button type="button" class="collapsible">Afisare pacienti in functie de tipul analizelor efectuate</button>
                <div class="content">
                    
                <form action="admin.php" method="POST">
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
                                
                                $query_pacienti_categorie = "SELECT DISTINCT  P.Nume, P.Prenume, C.Nume_Categorie FROM Pacienti P
                                                INNER JOIN [Analiza-Pacient] AP ON AP.Id_Pacient = P.Id_Pacient
                                                INNER JOIN Analiza A ON A.Id_Analiza = AP.Id_Analiza
                                                INNER JOIN Categorie C ON C.Id_Categorie = A.Id_Categorie
                                                WHERE C.Nume_Categorie = '$input_Categorie'";
                                $rezultat_pacienti_categorie = sqlsrv_query($conn, $query_pacienti_categorie, array(), array( "Scrollable" => 'static' ));

                                
                                
                                while($row_pac_cat = sqlsrv_fetch_array($rezultat_pacienti_categorie)){
                                    $nume = $row_pac_cat['Nume'];
                                    

                                $query_pacienti_categorie2 = "SELECT  A.Nume_Analiza,R.Valoare FROM [Analiza-Pacient] AP
                                                  INNER JOIN Pacienti P ON AP.Id_Pacient = P.Id_Pacient
                                                  INNER JOIN Analiza A ON A.Id_Analiza = AP.Id_Analiza
                                                  INNER JOIN Categorie C ON C.Id_Categorie = A.Id_Categorie
                                                  INNER JOIN Rezultate R ON R.Id_Rezultat = A.Id_Rezultat
                                                  WHERE C.Nume_Categorie = '$input_Categorie' 
                                                  AND P.Nume = '$nume'";

                                $rezultat_pacienti_categorie2 = sqlsrv_query($conn, $query_pacienti_categorie2, array(), array( "Scrollable" => 'static' )); ?>
                                  
                                        <h3 style= "color:white"> <?php echo $row_pac_cat['Nume']." ". $row_pac_cat['Prenume'];?> </h3>
                                        <ul class= "list">
                                        <?php while($row_pac_cat2 = sqlsrv_fetch_array($rezultat_pacienti_categorie2)){?>
                                            <li style= "color:white"><span> <?php echo $row_pac_cat2['Nume_Analiza'].", rezultat: ". $row_pac_cat2['Valoare'];?> </span></li>

                                       <?php }
                                        ?>
                                        </ul>                                                
                                    <?php }
                            }}?>


                </div>
                <button type="button" class="collapsible">Top 3 pacienti ce au beneficiat de servicii</button>
                <div class="content">
                            <?php
                            $query_top_3 = "SELECT TOP 3 P.Nume, P.Prenume, COUNT(AP.Id_Analiza) AS Numar  FROM Pacienti P
                                            INNER JOIN [Analiza-Pacient] AP ON P.Id_Pacient = AP.Id_Pacient
                                            GROUP BY P.Nume, P.Prenume
                                            ORDER BY Numar DESC";  
                            $rezultat_top_3 = sqlsrv_query($conn, $query_top_3, array(), array( "Scrollable" => 'static' ));?>
                <table id = "labs_table">
                        <tr> 
                            <th>Nume</th>
                            <th>Prenume</th> 
                            <th>Numar Analize </th>
                            
                            
                        </tr> 
                        <?php
                        while($row_top_3 = sqlsrv_fetch_array($rezultat_top_3)){?>


                            <tr> 
                                <td> <?php echo $row_top_3['Nume'];?> </td>
                                <td> <?php echo $row_top_3['Prenume'];?> </td>
                                <td> <?php echo $row_top_3['Numar'];?> </td>
                                
                                
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <button type="button" class="collapsible">Inchidere cont</button>
                <div class="content">
                    <button id = "deletePacientBtn" class = "categories"> Inchidere Cont</button>
                    
                </div>

                <button type="button" class="collapsible">Afisare Pacienti</button>
                <div class="content">
                    <table id = "labs_table">
                        <tr> 
                            <th>Nume</th>
                            <th>Prenume</th> 
                            <th>CNP </th>
                            <th>Oras </th>
                            <th>Strada </th>
                            <th>Nr . Strada </th>
                            
                            
                            
                        </tr> 
                        <?php
                        $query1 = "SELECT Nume, Prenume, CNP, Oras, Strada, Nr_Strada FROM Pacienti WHERE Nume != 'admin'";
                        $rezultat1 = sqlsrv_query($conn, $query1, array(), array( "Scrollable" => 'static' ));
                        while($row1 = sqlsrv_fetch_array($rezultat1)){?>


                            <tr> 
                                <td> <?php echo $row1['Nume'];?> </td>
                                <td> <?php echo $row1['Prenume'];?> </td>
                                <td> <?php echo $row1['CNP'];?> </td>
                                <td> <?php echo $row1['Oras'];?> </td>
                                <td> <?php echo $row1['Strada'];?> </td>
                                <td> <?php echo $row1['Nr_Strada'];?> </td>
                                
                                
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </table>
                    
                </div>   



                <button type="button" class="collapsible">Afisare Laboratoare</button>
                <div class="content">
                    <table id = "labs_table">
                        <tr> 
                            <th>Oras</th>
                            <th>Strada</th> 
                            <th>Nr. Strada </th>
                            <th>Telefon </th>
                            
                            
                            
                            
                        </tr> 
                        <?php
                        $query2 = "SELECT Oras, Strada, Nr_Strada, Telefon FROM Punct_de_lucru";
                        $rezultat2 = sqlsrv_query($conn, $query2, array(), array( "Scrollable" => 'static' ));
                        while($row2 = sqlsrv_fetch_array($rezultat2)){?>


                            <tr> 
                                <td> <?php echo $row2['Oras'];?> </td>
                                <td> <?php echo $row2['Strada'];?> </td>
                                <td> <?php echo $row2['Nr_Strada'];?> </td>
                                <td> <?php echo $row2['Telefon'];?> </td>
                                                                
                                
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </table>
                    
                </div>  




            </div>

            <div id="deletePacientModal" class="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="closePacient">&times;</span>
                        <h3 class = "pop-up-title">Inchidere cont</h3>

                        <form id = "add-form" action="" class = "admin-form" method="POST">
                            <input name = "CNP" type = "text" placeholder = "CNP">  <br>
                            <input name = "Nume" type = "text" placeholder = "Nume">  <br>
                            <input name = "Prenume" type = "text" placeholder = "Prenume">  <br>
                            


                            <button name = "SubmitButtonPac" type="submit">  Inchide </button>
                            
                        </form>
                      
                    </div> 
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

            <div id="deleteLabModal" class="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close1">&times;</span>
                        <h3 class = "pop-up-title">STERGERE PUNCT DE LUCRU</h3>

                        <form id = "delete-form" action="adaugare_lab.php" class = "admin-form" method="POST">
                            <input name = "oras" type = "text" placeholder = "Oras">  <br>
                            <input name = "strada" type = "text" placeholder = "Strada">  <br>
                            <input name = "nr_strada" type = "text" placeholder = "Nr. Strada">  <br>
                            <input name = "telefon" type = "text" placeholder = "Telefon">  <br>
                            <input name = "form_value" type = "hidden" value ="2"> <br>


                            <button name = "lab-submit" type="submit">  Sterge </button>
                            
                        </form>
                      
                    </div> 
                </div>
            </div>

            <div id="modifyLabModal" class="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close2">&times;</span>
                        <h3 class = "pop-up-title">ACTUALIZARE PUNCT DE LUCRU</h3>

                        <form id = "modify-form" action="adaugare_lab.php" class = "admin-form" method="POST">
                          
                            
                            <input name = "oras" type = "text" placeholder = "Oras">  <br>
                            <input name = "strada" type = "text" placeholder = "Strada">  <br>
                            <input name = "nr_strada" type = "text" placeholder = "Nr. Strada">  <br>
                            <input name = "telefon" type = "text" placeholder = "Telefon">  <br>
                            <input name = "parametru" type = "text" placeholder = "?">  <br>
                            <input name = "form_value" type = "hidden" value ="3"> <br>

                            <input id = "newval" name = "new_value" type = "radio" value = "Oras">
                                <label class = "new_value_labels" for = "newval"> Oras </label> <br>
                            <input id = "newval" name = "new_value" type = "radio" value = "Strada">
                                <label class = "new_value_labels" for = "newval"> Strada </label> <br>
                            <input id = "newval" name = "new_value" type = "radio" value = "Nr_Strada">
                                <label class = "new_value_labels" for = "newval"> Nr.Strada </label> <br>
                            <input id = "newval" name = "new_value" type = "radio" value = "Telefon">
                                <label class = "new_value_labels" for = "newval"> Telefon </label> <br>


                            <button name = "lab-modify-submit" type="submit">  Modifica </button>
                            
                        </form>
                      
                    </div> 
                </div>
            




        <script src = "./scripts/admin_modal.js" > </script>
    </body>




</html>
<?php  }
    else if(isset($_SESSION['adm']) == false || $_SESSION['adm'] == "false") {
        header("Location:login.php");
    }
?>