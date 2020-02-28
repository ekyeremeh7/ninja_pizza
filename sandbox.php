<?php 
//superglobals
//$_GET['name'],$_POST['name'];
// echo $_SERVER['SERVER_NAME'].'<BR/>';
// echo $_SERVER['REQUEST_METHOD'].'<br/>';
// echo $_SERVER['SCRIPT_FILENAME'].'</br>';
// echo $_SERVER['PHP_SELF'] . '<br/>';


//$_SESSION ,$_COOKIE
if(isset($_POST['submit'])){

	//cookie for gender
	setcookie('gender',$_POST['gender'],time()+86400);

	session_start();
	$_SESSION['name']=$_POST['name'];
	echo $_SESSION['name'];
	header('Location:index.php');
}



//ternary operators

//$score=50;

// if($score > 40){
// 	echo "high score !!!";
// }else{
// 	echo "low score !!!";
// }

//$val=$score > 40 ? 'high score !':'low score !!';
//echo $val;


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
	<input type="text" name="name">
	<select name="gender">
		<option value="male">Male</option>
		<option value="female">Female</option>
	</select>
	<input type="submit" name="submit" value="submit">
	<!-- <input type="" name="name">
	<input type="submit" name="submit" value="submit"> -->
</form>

<!-- <p> <?php  echo $score > 40 ? 'high score !':'low score !!'; ?></p>
 --> </body>
 </html>