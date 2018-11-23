<!DOCTYPE html>
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

    
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
      </script>

    <script>
        $(document).ready(function(){
          var date_input=$('input[name="date"]'); //our date input has the name "date"
          var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
          var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
          };
          date_input.datepicker(options);
        })
    </script>

   <script>
        function handleSubmitButton(){
          var fname = document.getElementById("validationCustom01").value;
          var lname = document.getElementById("validationCustom02").value;
          var email = document.getElementById("inputEmail").value;
          var dept = document.getElementById("departmentSelection").value;
          var startDate = document.getElementById("date").value;

          console.log(fname + "," + lname + "," + email + "," + dept + "," + startDate);
        }
        </script>

  <?php
    function phpSubmitButton(){
      echo "this worked!";
    }
  ?>



    <title>New Employee Form</title>
</head>


<body>
    <h1>New Employee Form</h1>
    <br>
    <form class="needs-validation" novalidate>
        <!-- The below is for the Employee name, includes First and Last Names -->
        <label for="validationCustom01">Name</label>
        <div class="form-row">
                <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" id="validationCustom01" placeholder="First Name" value="" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name" value="" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
        </div>  
        <!-- This is the Employee's BU Email Address -->
        <label for="inputEmail">BU Email Address</label>
        <div class="form-row">
                <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
        </div> 
        <!-- This is for the Employee's Department in the College of Communication (COM) -->
        <label for="inputEmail">Department</label>
        <div class="form-row">
                <div class="form-group">
                        <select class="form-control" id="departmentSelection">
                            <option value="Career Services">Career Services</option>
                            <option value="CIMS">CIMS</option>
                            <option value="COMIT">COMIT</option>
                            <option value="FilmTV">FilmTV</option>
                            <option value="Graduate Affairs">Graduate Affairs</option>
                            <option value="JO">JO</option>
                            <option value="MC">MC</option>
                            <option value="NNN">NNN</option>
                            <option value="Undergraduate Affairs">Undergraduate Affairs</option>
                        </select>
                    </div>
        </div> 
        <!-- This is for the Employee's Start Date at COM -->
        <label for="inputEmail">Start Date</label>
        <div class="form-row">
                <div class="form-group"> <!-- Date input -->
                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                  </div>
        </div>    
        
        <button class="btn btn-primary" type="button" onClick="phpSubmitButton()">Submit form</button>
      </form>


      <!-- The below code deals with grabbing the data from the dbo.Employee table on the MS SQL Server -->
      <br>
      <br>

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

</html>