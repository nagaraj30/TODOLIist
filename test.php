<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
//.reg{color:#FFF1111;}
</style>
<link rel="stylesheet" href="http://localhost/test.css">
</head>

<body> 

<?php
// define variables and set to empty values
$name = $email = $gender = $contact= $address= $password=$repassword="";
$nameErr = $emailErr = $genderErr = $addressErr =$contactErr=$passwordErr=$repasswordErr= "";
$count=0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   if(empty($_POST["name"]))
   $nameErr="name is required";
   else
{
   $name = test_input($_POST["name"]);
   if (!preg_match("/^[a-zA-Z ]*$/",$name))
      {
      $nameErr = "Only letters and white space allowed"; 
      }
	  else 
	        $count++;
}
     if(empty($_POST["email"]))
    $emailErr="email is requied";
    else
    {
   $email = test_input($_POST["email"]);
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
      {
      $emailErr = "Invalid email format"; 
      }
	     else 
	        $count++;
   }

    if(empty($_POST["contact"]))
    $contactErr="contact is requied";
    else{
   $contact = test_input($_POST["contact"]);
	        $count++;
			}


  if(empty($_POST["password"]))
    $passwordErr="password is requied";
   else{
   $password = test_input($_POST["password"]);
    $count++;
       }
  if(empty($_POST["repassword"]))
    $repasswordErr="password is requied";
   else
   $repassword = test_input($_POST["repassword"]);
    

   

  if(empty($_POST["gender"]))
 $genderErr="gender is required";
 else {  
$gender = test_input($_POST["gender"]);
     $count++;
	 }
	 if($count==5)
{
    @$conn=mysql_connect("localhost","root","") or die("unable to connect");
	$query="insert into todo values('$name','$email','$contact','$password','$address','$gender')";
	@mysql_db_query("intern", $query)  or  die("email id is already registered");
     echo "<h1 class=\"reg\"><i>registration successful</i>   <a href=\"http://localhost/login.html\">SIGN IN</a></h1>";
	 
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

<h2><i>Registration Form</i></h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="http://localhost/test.php"> 
   Name <input type="text" name="name">
   <span class="error" >* <?php echo $nameErr; ?></span>
   <br><br>
   E-mail <input type="text" name="email">
    <span class="error">* <?php echo $emailErr; ?></span>
   <br><br>
   Contact no <input type="text" name="contact" maxlength="10">
     <span class="error">* <?php echo $contactErr; ?></span>
   <br><br>
   password <input type="password" name="password">
    <span class="error">* <?php echo $passwordErr; ?></span>
   <br><br>
   retype password  <input type="password" name="repassword">
     <span class="error">* <?php echo $repasswordErr;
                                                if($password!=$repassword)
                                                    echo "password didn't match"; ?></span>
   <br><br>
   Address <textarea name="comment" rows="5" cols="40"></textarea>
   
   <br><br>
   Gender
   <input type="radio" name="gender" value="female">Female
   <input type="radio" name="gender" value="male">Male
     <span class="error">* <?php echo $genderErr; ?></span>
   <br><br>
   
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
   

?>

</body>
</html>