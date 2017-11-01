<?php
session_start();

if (!isset($_SESSION['username'])) { //validates that admin has indeed logged in
    
    header("Location: index.php");
    
}

 include '../../dbConnection.php';
$conn = getDatabaseConnection();

function getDepartmentInfo(){
    global $conn;        
    $sql = "SELECT deptName, departmentId 
            FROM tc_department 
            ORDER BY deptName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
    
}


if (isset($_GET['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $email    = $_GET['email'];
    $universityId = $_GET['universityId'];
    $phone    = $_GET['phone'];
    $gender   = $_GET['gender'];
    $role   = $_GET['role'];
    $deptId   = $_GET['deptId'];
    
    //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
    
    $sql = "INSERT INTO tc_user
            (firstName, lastName, email, universityId, gender, phone, role, deptId)
            VALUES
            (:fName, :lName, :email, :universityId, :gender, :phone, :role, :deptId)";
    $namedParameters = array();
    $namedParameters[':fName'] =  $firstName;
    $namedParameters[':lName'] =  $lastName;
    $namedParameters[':email'] =  $email;
    $namedParameters[':universityId'] =  $universityId;
    $namedParameters[':gender'] = $gender;
    $namedParameters[':phone']  = $phone;
    $namedParameters[':role']   = $role;
    $namedParameters[':deptId'] = $deptId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    echo "User has been added successfully!";
            
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Adding New User </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         
    </head>
    <body>

    <h1> Admin Section </h1>
    <h2> Adding New Users </h2>

    <fieldset>
        
        <legend> Add New User </legend>
        
        <form>
            
            First Name: <input type="text" name="firstName" required /> <br>
            Last Name: <input type="text" name="lastName" required/> <br>
            Email: <input type="text" name="email"/> <br>
            University Id: <input type="text" name="universityId"/> <br>
            Phone: <input type="text" name="phone"/> <br>
            Gender: <input type="radio" name="gender" value="F" id="genderF" required/> 
                    <label for="genderF">Female</label>
                    <input type="radio" name="gender" value="M" id="genderM"  required/> 
                    <label for="genderM">Male</label><br>
            Role:   <select name="role">
                        <option value=""> Select One </option>
                        <option>Faculty</option>
                        <option>Student</option>
                        <option>Staff</option>
                    </select>
            <br />
            Department: <select name="deptId">
                            <option value=""> Select One </option>
                            <?php
                            
                                $departments = getDepartmentInfo();
                                foreach ($departments as $record) {
                                    echo "<option value='$record[departmentId]'>$record[deptName]</option>";
                                }
                            
                            ?>
                            
                        </select>
                        <br />
                <input type="submit" name="addUserForm" value="Add User!"/>
        </form>
        
    </fieldset>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>