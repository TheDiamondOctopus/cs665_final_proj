<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!-- My own style sheet-->
    <link rel="stylesheet" href="main.css">
</head>





<body>

    <form action="https://cs665phptest1.azurewebsites.net/">
        <input class="btn btn-primary" type="submit" value="New Employee Form"/>
    </form>

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
        $params = array(rand(3,1000), $FirstName, $LastName, $EmailAddress, $Department, $StartDate);  

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


        <div class="container">
                <div class="row">
                    <table class="text-center" style="align-content: center">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Department</th>
                        <th>Start Date</th>
                    </tr>
                    <?php
                    try {
                        $conn = new PDO("sqlsrv:server = tcp:final-proj-t1.database.windows.net,1433; Database = final_proj_t1", "joey", "{#Kangar88}");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    catch (PDOException $e) {
                        print("Error connecting to SQL Server.");
                        die(print_r($e));
                    }
                    
                    //Code to connect to SQL Server -- Should be moved elsewhere since it contains a username and password to conncet to the DB:
                    $connectionInfo = array("UID" => "joey@final-proj-t1", "pwd" => "{#Kangar88}", "Database" => "final_proj_t1", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
                    $serverName = "tcp:final-proj-t1.database.windows.net,1433";
                    $conn = sqlsrv_connect($serverName, $connectionInfo);

                    $sql = "SELECT * FROM Employee";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>".$row['FirstName']."</td>";
                        echo "<td>".$row['LastName']."</td>";
                        echo "<td>".$row['EmailAddress']."</td>";
                        echo "<td>".$row['Department']."</td>";
                        echo "<td>".$row['StartDate']."</td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
                </div>
                </div>
</body>
<html>
