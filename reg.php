 <!DOCTYPE html>

 <?php
 include 'connection.php';
 if(isset($_POST['signup_btn'])){
     $username=mysqli_real_escape_string($con,$_POST['username'] );
     $email=mysqli_real_escape_string($con,$_POST['email'] );
     $password=mysqli_real_escape_string($con,$_POST['password'] );
     $c_password=mysqli_real_escape_string($con,$_POST['c_password'] );
     if(empty($username)){
         $error="username field is required";
     
      }elseif(empty($email)){
          $error="email field is required";
      }elseif(empty($password)){
        $error="password field is required";
    }elseif($password !=$c_password){
        $error="password do not match";
    }elseif(strlen($username)<3 || strlen($username)>30){
        $error="username must be between 3 to 30 character";
    }elseif (strlen($password)<6){
        $error="password must be atleast 6 characters";
    }else {
        $check_email="SELECT * FROM form WHERE email='$email'";
        $data=mysqli_query($con,$check_email);
        $result=mysqli_fetch_array($data);
        if($result>0){
            $error='Email already exsist';
        }else {

            $password=md5($password);
            $insert="INSERT INTO form (username,email,password) Values('$username','$email','$password')";
            $q=mysqli_query($con,$insert);
            if($q){
                $success="your account has been created successfully";
            }
        }
    }
}

 ?>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel='stylesheet' type='text/css' href='signup.css'>
     <title>Document</title>
 </head>
 <body>
     <div class='signup'>
         <p style='color:red'>
             <?php
               if(isset($error)){
                   echo $error;
               }
             ?>
         </p>
         <p style='color:green'>
             <?php
               if(isset($success)){
                   echo $success;
               }
             ?>
         </p>
         <form action=''method='POST'>
             <input type='text' name="username" placeholder="username" value="<?php if (isset($error)){
                 echo $username;
             }?>">
            
             <input type='text' name="email" placeholder="email" value="<?php if (isset($error)){
                 echo $email ;
             }?>">
            
             <input type='password' name="password" placeholder="password">
             
             <input type='password' name="c_password" placeholder="confirm password">
             
             <input type='submit' name="signup_btn" value='signup'>
            
         </form>
</div>
 </body>
 </html>