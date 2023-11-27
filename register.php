<?php include('includes/header.php');
include('includes/navbar.php');
?>
<?php

$firstName = $lastName = $email = $password = $repassword = $phone = $address1 = $city = $province = $zip = '';
$firstNameErr = $lastNameErr = $emailErr = $passwordErr = $repasswordErr = $phoneErr = $address1Err = $unitNumberErr = $cityErr = $provinceErr = $zipErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $unitNumber = $_POST["unitnumber"];

  if (empty($_POST["fname"])) {
    $firstNameErr = "First Name is required";
} else {
    $firstName = test_input($_POST["fname"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
        $firstNameErr = "Only letters and white space allowed";
    } else {
       
        $firstName = strtoupper($firstName);
    }
}

  if (empty($_POST["lname"])) {
    $lastNameErr = "Last Name is required";
  } else {
    $lastName = test_input($_POST["lname"]);

    
    if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
      $lastNameErr = "Only letters and white space allowed";
    }
    else {
       
      $lastName = strtoupper($lastName);
  }
  }

  if (empty($_POST["uemail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["uemail"]);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["upassword"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["upassword"]);
  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  }

  if (empty($_POST["reupassword"])) {
    $repasswordErr = "Please confirm your password";
  } else {
    $repassword = test_input($_POST["reupassword"]);

    if ($repassword !== $password) {
      $repasswordErr = "Passwords do not match";
    }
  }

  if (!empty($_POST["phone"])) {
    $phone = test_input($_POST["phone"]);

    if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone)) {
      $phoneErr = "Invalid phone number format (e.g., 123-456-7890)";
    }
  }

  if (!empty($_POST["address1"])) {
    $address1 = test_input($_POST["address1"]);
  } else {
       
    $address1 = strtoupper($address1);
}

  if (!empty($_POST["inputCity"])) {
    $city = test_input($_POST["inputCity"]);
  }
  else {
  $city = strtoupper($city);}

  
  if (!empty($_POST["province"])) {
    $province = test_input($_POST["province"]);
  }else {
       
    $province = strtoupper($province);
}
  
  if (!empty($_POST["inputZip"])) {
    $zip = test_input($_POST["inputZip"]);


    if (!preg_match("/^\d{5}$/", $inputZip)) {
      $zipErr = "Invalid zip code format (e.g., 12345)";
    }
    else {
       
      $zip = strtoupper($inputZip);
  }
  }

  include 'database/conn.php';


  $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, email, password, phone, address1, unit_number, city, province, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssss", $firstName, $lastName, $email, $hashedPassword, $phone, $address1, $unitNumber, $city, $province, $zip);

  if ($stmt->execute()) {
    echo "Registration successful!";
    header('Location: index.php');
    exit();
  } else {
    header('Location: register.php');
    exit();
  }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="container mt-4 mb-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post" class="bg-light p-4 rounded border">

        <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" class="form-control" id="fname" name="fname" required>
          <span class="error"><?php echo $firstNameErr; ?></span>
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input type="text" class="form-control" id="lname" name="lname" required>
          <span class="error"><?php echo $lastNameErr; ?></span>
        </div>
        <div class="form-group">
          <label for="uemail">Email</label></label>
          <input type="text" class="form-control" id="uemail" name="uemail" required>
          <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div class="form-group ">
          <label for="upassword">Password</label>
          <input type="password" class="form-control" id="upassword" name="upassword" required>
          <span class="error"><?php echo $passwordErr; ?></span>
        </div>

        <div class="form-group">
          <label for="reupassword">Confirm Password</label>
          <input type="password" class="form-control" id="reupassword" placeholder="confirmpassword" name="reupassword">
          <span class="error"><?php echo $repasswordErr; ?></span>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number </label>
          <input type="text" class="form-control" id="phone" placeholder="000-000-0000" name="phone">
          <span class="error"><?php echo $phoneErr; ?></span>
        </div>
        <div class="form-group">
          <label for="address1">Address </label>
          <input type="text" class="form-control" id="address1" placeholder="Street Name" name="address1">
          <span class="error"><?php echo $address1Err; ?></span>
        </div>
        <div class="form-group">
          <label for="unitnumber">Unit Number </label>
          <input type="text" class="form-control" id="unitnumber" placeholder="Unit Number" name="unitnumber">
        </div>
        <div class="form-group ">
          <label for="inputCity">City</label>
          <input type="text" class="form-control" id="inputCity" name="inputCity">
          <span class="error"><?php echo $cityErr; ?></span>
        </div>
        <div class="form-group ">
          <label for="inputState">State/Province </label>
          <input type="text" class="form-control" id="province" name="province">
          <span class="error"><?php echo $provinceErr; ?></span>
        </div>
        <div class="form-group">
          <label for="inputZip">Zip</label>
          <input type="text" class="form-control" id="inputZip" name="inputZip">
          <span class="error"><?php echo $zipErr; ?></span>
        </div>
        <div class="form-group mt-4">
          <button type="submit" class="btn btn-success">Register</button>
      </form>
    </div>
  </div>
</div>
</div>

<?php include('includes/footer.php');

?>