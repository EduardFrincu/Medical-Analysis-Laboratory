<?php 
session_start();



if($_SESSION["logged_in"]==true){ 
    include('connection.php');
                
            $query_butoane = "SELECT DISTINCT A.Nume_Categorie FROM Categorie A 
            INNER JOIN Analiza B ON A.Id_Categorie=B.Id_Categorie
            INNER JOIN [Analiza-Pacient] C ON B.Id_Analiza=C.Id_Analiza
            INNER JOIN Pacienti D ON C.Id_Pacient=D.Id_Pacient
            WHERE D.CNP = '".$_SESSION["CNP"]."'";

            $analize_query = "SELECT K.Nume_Categorie, A.Nume_Analiza, A.Valoare_Normala, R.Valoare, A.Pret , CONVERT(date,R.Data) AS Data_ef FROM Analiza A
            INNER JOIN Rezultate R ON A.Id_Rezultat = R.Id_Rezultat
            INNER JOIN Categorie K ON A.Id_Categorie = K.Id_Categorie
            INNER JOIN [Analiza-Pacient] B ON A.Id_Analiza  = B.Id_Analiza
            INNER JOIN Pacienti C ON B.Id_Pacient = C.Id_Pacient
            WHERE  C.CNP = '".$_SESSION["CNP"]."'";

            $query_pret_total = "SELECT SUM(A.Pret) AS Total, C.Nume_Categorie FROM Analiza A 
                                 INNER JOIN Categorie C ON A.Id_Categorie = C.Id_Categorie
                                 WHERE A.Id_Analiza IN ( SELECT AP.Id_Analiza FROM [Analiza-Pacient] AP 
                                                         WHERE AP.Id_Pacient = (SELECT P.Id_Pacient FROM Pacienti P 
                                                                                WHERE P.CNP = '".$_SESSION["CNP"]."'))
                                GROUP BY A.Id_Categorie, C.Nume_Categorie";

            $query_recomandare = "SELECT COUNT(A.Id_Analiza) AS Numar, 
                                 (SELECT C.Nume_Categorie FROM Categorie C WHERE A.Id_Categorie = C.Id_Categorie) AS Categorie
                                 FROM Analiza A
                                 INNER JOIN [Analiza-Pacient] AP ON A.Id_Analiza = AP.Id_Analiza
                                 INNER JOIN Pacienti P ON AP.Id_Pacient = P.Id_Pacient
                                 INNER JOIN Rezultate R ON R.Id_Rezultat = A.Id_Rezultat
                                 WHERE P.CNP = '".$_SESSION["CNP"]."' AND A.Valoare_Normala !=R.Valoare
                                 GROUP BY A.Id_Categorie";

            $rezultat_recomandare = sqlsrv_query($conn, $query_recomandare, array(), array( "Scrollable" => 'static' ));  
            $rezultat_pret_total = sqlsrv_query($conn, $query_pret_total, array(), array( "Scrollable" => 'static' ));  
            $rezultat = sqlsrv_query($conn, $query_butoane, array(), array( "Scrollable" => 'static' )); 
            //$row = sqlsrv_fetch_array($rezultat);
        }
            
?>
            
    <html>
    <head>
        <link rel="stylesheet" href="analize_style.css">
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

        <body>
            <div class="background"> 
                <div class="navbar">
                        <a class="brand" href="home_page.php">
                            <img src="atom.svg" class="logo">  
                        </a>
                        
                        <a class="navbar-button" href="logout.php"> Log out</a> 
                        <a class= "navbar-button" href="laboratoare.php"> Laboratoare </a>
                        <a class="navbar-button" href="home_page.php"> Home </a>
                        <a class = "navbar-button" href="actualizare.php"> Actualizare Informatii </a>
                </div>

                <div class="container">

                    <h2 id = "para"> Tipuri de analize efectuate: </h2>
                    <!-- <form action = "home.php" method="POST"> -->
                    <?php
                    $index = 0;
                    while($row = sqlsrv_fetch_array($rezultat)){ 
                                             
                        if($row['Nume_Categorie'] == "Biochimie")
                            $index = "Biochimie";
                        else if($row['Nume_Categorie'] == "Imunologie")
                            $index = "Imunologie";
                        else if($row['Nume_Categorie'] == "Hematologie")
                            $index = "Hematologie";
                        else if($row['Nume_Categorie'] == "Hormoni")
                            $index = "Hormoni";
                        else if($row['Nume_Categorie'] == "Parazitologie")
                            $index = "Parazitologie";
                        else if($row['Nume_Categorie'] == "Microbiologie")
                            $index = "Microbiologie";
                 ?>
                        <button class="categories" id="<?php echo $index ."Btn";?>" > <?php echo $row['Nume_Categorie'] ."<br>"; ?> </button> <br>
                        
                   
                    <?php }                 
                    $num = sqlsrv_num_rows($rezultat);
                    if($num==0)  {
                    ?> <p> NU ATI EFECTUAT ANALIZE </p> <?php } ?>

                </div>
                    
                <div id="hematologieModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeHematologie">&times;</span>
                            <h3 class = "pop-up-title">Hematologie</h3>
                            
                            <?php 
                                
                                
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' ));  ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Hematologie') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Hematologie'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                    <?php
                                    }}
                                     while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                            if($row_recomandare['Categorie'] == 'Hematologie' && $row_recomandare['Numar'] >=3){?>
                                                <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                        <?php
                                        }}
                                    ?>
                        </div> 
                    </div>
                </div>
                
                <div id="biochimieModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeBiochimie">&times;</span>
                            <h3 class = "pop-up-title">Biochimie</h3>
                            
                            <?php 
                                
                                $rezultat_pret_total = sqlsrv_query($conn, $query_pret_total, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' ));  
                                $rezultat_recomandare = sqlsrv_query($conn, $query_recomandare, array(), array( "Scrollable" => 'static' ));  ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Biochimie') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Biochimie'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                <?php
                                }}

                                while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                    if($row_recomandare['Categorie'] == 'Biochimie' && $row_recomandare['Numar'] >=3){?>
                                        <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                <?php

                                }}
                                ?>

                        </div> 
                    </div>
                </div>

                <div id="imunologieModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeImunologie">&times;</span>
                            <h3 class = "pop-up-title">Imunologie</h3>
                            
                            <?php 
                                
                                $rezultat_pret_total = sqlsrv_query($conn, $query_pret_total, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' ));
                                $rezultat_recomandare = sqlsrv_query($conn, $query_recomandare, array(), array( "Scrollable" => 'static' ));  ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Imunologie') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Imunologie'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                <?php
                                }}
                                while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                    if($row_recomandare['Categorie'] == 'Imunologie' && $row_recomandare['Numar'] >=3){?>
                                        <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                <?php

                                }}

                                ?>

                        </div> 
                    </div>
                </div>


               <div id="parazitologieModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeParazitologie">&times;</span>
                            <h3 class = "pop-up-title">Parazitologie</h3>
                            
                            <?php 
                                
                                $rezultat_pret_total = sqlsrv_query($conn, $query_pret_total, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_recomandare = sqlsrv_query($conn, $query_recomandare, array(), array( "Scrollable" => 'static' )); ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Parazitologie') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Parazitologie'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                <?php
                                }}

                                while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                    if($row_recomandare['Categorie'] == 'Parazitologie' && $row_recomandare['Numar'] >=3){?>
                                        <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                <?php

                                }}


                                ?>

                        </div> 
                    </div>
                </div>

                <div id="microbiologieModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeMicrobiologie">&times;</span>
                            <h3 class = "pop-up-title">Microbiologie</h3>
                            
                            <?php 
                                
                                
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' ));  ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Microbiologie') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Microbiologie'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                    <?php
                                    }}
                                     while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                            if($row_recomandare['Categorie'] == 'Microbiologie' && $row_recomandare['Numar'] >=3){?>
                                                <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                        <?php
                                        }}
                                    ?>
                        </div> 
                    </div>
                </div>

                <div id="hormoniModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="closeHormoni">&times;</span>
                            <h3 class = "pop-up-title">Hormoni</h3>
                            
                            <?php 
                                
                                $rezultat_pret_total = sqlsrv_query($conn, $query_pret_total, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_analize = sqlsrv_query($conn, $analize_query, array(), array( "Scrollable" => 'static' )); 
                                $rezultat_recomandare = sqlsrv_query($conn, $query_recomandare, array(), array( "Scrollable" => 'static' )); ?>
                                <table class = "analize_table">
                                    <tr> 
                                        <th>Analiza</th>
                                        <th>Valoare Normala</th> 
                                        <th>Valoare obtinuta</th>
                                        <th>Pret</th>
                                        <th>Data efectuarii</th>                                                                                                                  
                                    </tr> 
                                    <?php
                                    while($row = sqlsrv_fetch_array($rezultat_analize)){
                                        if($row['Nume_Categorie'] == 'Hormoni') {?>
                                            <tr> 
                                                <td> <?php echo $row['Nume_Analiza'];?> </td>
                                                <td> <?php echo $row['Valoare_Normala'];?> </td>
                                                <td> <?php echo $row['Valoare'];?> </td>
                                                <td> <?php echo $row['Pret'];?> </td>
                                                <td> <?php echo $row['Data_ef'] ->format('d.m.Y');?> </td>                                                
                                            </tr>                                        
                                    <?php
                                    }}
                                    ?>
                                </table>
                                <?php while($row_pret = sqlsrv_fetch_array($rezultat_pret_total)){
                                        if($row_pret['Nume_Categorie'] == 'Hormoni'){?>
                                            <h4> Total pret:<?php echo $row_pret['Total'];?> </h4>
                                    
                                <?php
                                }}

                                while($row_recomandare = sqlsrv_fetch_array($rezultat_recomandare)){
                                    if($row_recomandare['Categorie'] == 'Hormoni' && $row_recomandare['Numar'] >=3){?>
                                        <h4> Avand in vedere rezultatele, va recomandam sa refaceti analizele cat mai curand posibil. </h4>
                                <?php

                                }}
                                ?>

                        </div> 
                    </div>
                </div>
            </div> 
            <script src = "./scripts/analize_modal.js" > </script>
        </body>
    
    </html>






