<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $password = md5($_POST['password']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $dateOfBirth = $_POST['dateOfBirth'];
   $gender = $_POST['gender'];
   $userType = $_POST['userType'];

   $select = "SELECT * FROM end_user WHERE user_name = '$user_name'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists!';
   } else {
      

      $insert = "INSERT INTO end_user (user_name, Password, Name, dateOfBirth, Gender, UserType) VALUES ('$user_name','$password','$name','$dateOfBirth','$gender','$userType')";

      if(mysqli_query($conn, $insert)) {
         header('location:login.php');
      } else {
         $error[] = 'Error: ' . mysqli_error($conn);
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="user_name" required placeholder="Enter your username">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="date" name="dateOfBirth" required placeholder="Enter your date of birth">
      <select name="gender" required>
         <option value="male">Male</option>
         <option value="female">Female</option>
         <option value="other">Other</option>
      </select>
      <select name="userType" required>
         <option value="regular user">Regular User</option>
         <option value="project owner">Project Owner</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>
