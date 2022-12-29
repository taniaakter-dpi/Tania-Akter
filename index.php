<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h3>IIST University Admission Form</h3>
  <p>Try to submit the form.</p>

  <?php
// define variables and set to empty values
$nameErr = $DepartmentErr = $rollErr = $gpaErr = "";
$name = $Department = $roll = $gpa = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
}
  if (empty($_POST["Department"])) {
    $DepartmentErr = "Department is required";
  } else{
    $Department= $_POST["Department"];
  }
  
    
  if (empty($_POST["roll"])) {
    $rollErr = "Roll is required";
  } else {
    if(!is_numeric($_POST["roll"])) {
        $rollErr = "Roll must be number";
  } else{
    $roll = $_POST["roll"];
  }
  }
  if (empty($_POST["gpa"])) {
    $gpa = "";
  } else {
    if(!is_numeric($_POST["gpa"])) {
        $gpaErr = "GPA must be number";
  } else{
    $gpa = $_POST["gpa"];
  }
  }
//date insert in database
if($nameErr =="" AND $DepartmentErr == "" AND $rollErr =="" AND $gpaErr == ""){
    InsertData();

}
function InsertData($name, $Department, $roll, $gpa){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO student info(Studentname, Department, Roll, GPA)
VALUES ('Tania', 'CSE', 147089, 5.00)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<form action="/Day-28 project/index.php" class="was-validated" method="post">
    <div class="mb-3 mt-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required value="<?php echo $name;?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
     <div class="mb-3 mt-3">
      <label for="department" class="form-label">Department:</label>
      <select class="form-select" id="department" name="Department">
      <option value="CSE">CSE</option>
      <option value="ETE">ETE</option>
      <option value="EEE">EEE</option>
      <option value="CIVIL">CIVIL</option>
    </select>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
     <div class="mb-3 mt-3">
      <label for="roll" class="form-label">Roll:</label>
      <input type="text" class="form-control" id="roll" placeholder="Enter your roll number" name="roll" required value="<?php echo $roll; ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div> <div class="mb-3 mt-3">
      <label for="gpa" class="form-label">GPA:</label>
      <input type="text" class="form-control" id="gpa" placeholder="Enter your GPA" name="gpa" required value="<?php echo $gpa; ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>