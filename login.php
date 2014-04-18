<?php session_start(); ?>
<html>
<head>
<title>
TO-DO List
</title>
</head>
<body>
<center>
<?php

$url="login.php";
$username=$password="";
$count=1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    $username=$_POST["uname"];
     $password=$_POST["passwd"];
    $_SESSION['uname']=$username;
     $_SESSION['passwd']=$password;
   if(!empty($_POST["uname"])&& ! empty($_POST["passwd"]))
  {
      @$conn=mysql_connect("localhost","root","") or die("unable to connect");
      $query="select name,password from todo where name='$username' and password='$password'";
      @$result= mysql_db_query("intern",$query) or die("unable execute query");
     $array=mysql_fetch_row($result);
	 if($array[0]==$username && $array[1]==$password)
	 {
	      header( 'Location: http://localhost/home.php' ) ;

	 }
	   else
	         $count=0;
	    
   }
}
?>
<h1><i>LOGIN</i></h1>
<br><br>
<form   method="POST" action="http://localhost/login.php">
username  <input type="text" name="uname" placeholder="username" required="required"/ title="username can't be blank"  ><br>
passowrd <input type="text" name="passwd"placeholder="password" required="required"/ title="password can't be blank" ><br>
<input type="submit"  value="submit">

</form>
<?php
  if($count==0)
  {
   echo "<h2><i>login incorrect</i></h2>";
   }
   ?>
   
<a href="http://localhost/test.php"><h2><i>signup</i></h2></a>
</center>
</body>  
</html>