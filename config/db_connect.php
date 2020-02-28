<?php 

//connect to database
	$conn=mysqli_connect('localhost','cheremeh','test1234','ninja_pizza');

//check to c if connction is working
	if(!$conn){
		echo 'Connection Error: '. mysqli_connect_error();
	}

 ?>