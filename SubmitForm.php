<?php  
    /* Connect to the local server using Windows Authentication and  
    specify the AdventureWorks database as the database in use. */  
    $connectionInfo = array("UID" => "joey@final-proj-t1", "pwd" => "{#Kangar88}", "Database" => "final_proj_t1", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:final-proj-t1.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {  
        echo "Could not connect.\n";  
        die(print_r(sqlsrv_errors(), true));  
    }  

    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $EmailAddress = $_POST['emailAddress'];
    $Department = $_POST['department'];
    $StartDate = $_POST['date'];

    /* Set up the parameterized query. */  
    $tsql = "INSERT INTO Employee   
            (Id,   
            FirstName,   
            LastName,   
            EmailAddress,   
            Department,   
            StartDate)  
            VALUES   
            (?, ?, ?, ?, ?, ?)";  

    /* Set parameter values. */  
    $params = array(rand(100000,999999), $FirstName, $LastName, $EmailAddress, $Department, $StartDate);  

    /* Prepare and execute the query. */  
    $stmt = sqlsrv_query($conn, $tsql, $params);  
    if ($stmt) {  
        echo "Row successfully inserted.\n";  
    } else {  
        echo "Row insertion failed.\n";  
        die(print_r(sqlsrv_errors(), true));  
    }  

    /* Free statement and connection resources. */  
    sqlsrv_free_stmt($stmt);  
    sqlsrv_close($conn);  
?> 

