<?php session_start(); ?>
<html>
<head>
<title>
TO DO LIST
</title>
<script>
    function showform(){
	  document.getElementById('form').style.display="block";
	 } 
</script>
<meta charset="utf-8"/>
<link rel="stylesheet" href="home.css">
</head>
<body>
<center>

TO DO LIST
<div style="height:100px;overflow:auto;">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<th>task</th>
<th>deadline</th>
<?php
$uname=$password="";
$uname= $_SESSION['uname'];
$password= $_SESSION['passwd'];
  @$conn=mysql_connect("localhost","root","") or die("unable to connect");
      $query="select task,DATE_FORMAT(deadline,'%d-%m-%Y') deadline from task  where email=(select email from todo where name='$uname' and password='$password' )";
    @ $result= mysql_db_query("intern",$query) or die("unable execute query");
    while($array=mysql_fetch_row($result))
    {
       echo "<tr >
                         <td width=\"200px\"  class=\"societe\">$array[0]</td>
                           <td width=\"200px\"  class=\"societe\">$array[1]</td> 
                 </tr>";
	}			 
?>
</table>
</div>
<br><br><br><br><br><br><br>


  <input type="button"  value="New task" onclick=" showform()"/> 
  <div id="form" name="form" style="display:none">
  <form id="forrm" action="http://localhost/home.php" method="POST" >
   task <input type="text" name="task"/ required="required" placeholder="enter task to be completed"   size="55"  title="task can't be blank"/> <br>
  deadline <input type="text" name="deadline"  required="required" placeholder="dd-mm-yyyy"   title="enter the date format" size="55"  pattern="[0-9 -]+"/> <br>
  <input type="submit"> <br>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
      $task=$_POST["task"];
	  $deadline=$_POST["deadline"];
	   $query="select email from todo where name='$uname' and password='$password' ";
	   $result=@mysql_db_query("intern",$query);
	    $email=mysql_fetch_row($result);
	  $query="insert into task values('$task',STR_TO_DATE('$deadline','%d-%m-%Y'),'$email[0]')";
	   @mysql_db_query("intern",$query)  or die("unable to execute") ;
}  
?>
</div>
</center>
</body>
</html>
