<?php


    $serverName = "DESKTOP-4110JVT\SQLEXPRESS"; //serverName\instanceName


    $connectionInfo = array("Database"=> "Proiect_BD");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
   

    //  if($conn) echo "Connection established. <br/>";
    //      else{ 
    //          echo "Connection could not be established. <br/>";
    //         die(print_r(sqlsrv_erorrs(), true));
            
    //             }






?>