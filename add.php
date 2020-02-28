<?php 

	include('config/db_connect.php');

	// if(isset($_GET['submit'])){
	// 	echo htmlspecialchars($_GET['email']);
	// 	echo htmlspecialchars($_GET['title']);
	// 	echo htmlspecialchars($_GET['ingredients']);
	// }
	$title=$email=$ingredients="";
   $errors=array('email'=>'','title'=>'','ingredients'=>'');
//Fixing XSS attack and validation and using POST Request because it is more secure
	if(isset($_POST['submit'])){
		//echo htmlspecialchars($_POST['email']);
		//echo htmlspecialchars($_POST['title']);
		//echo htmlspecialchars($_POST['ingredients']);

		//check the email
		if(empty($_POST['email'])){
			$errors['email']= "An email address is required <br/>";
		}else{
			$email=$_POST['email'];
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors['email']='Email must be a valid email address';
			}
		}

		//check the title
		if(empty($_POST['title'])){
			$errors['title']= "A title  is required <br/>";
		}else{
			$title=$_POST['title'];
			if(!preg_match('/^[a-z A-Z\s]+$/',$title)){	
				$errors['title']= 'Title must be letters and spaces only';
			}
		}

		//check the ingredients 
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] =" At least one ingredient is required <br/>";
		}else{
			$ingredients=$_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
		    $errors['ingredients']='Ingredients must be a comma separated list';
}
		}
		
		//checking to see if there are any errors in the form
		if(array_filter($errors)){
			echo 'Errors in form';
		}else{
			$email=mysqli_real_escape_string($conn,$_POST['email']);
			$title=mysqli_real_escape_string($conn,$_POST['title']);
			$ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

			//create sql insert into
			$sql="INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients') ";

			//save to database and check if it works
			if(mysqli_query($conn,$sql)){
				//sucess
				header('Location:index.php');

			}else{
				//error
				echo 'Query Error :' .mysqli_error($conn);
			}
			//header('Location:index.php');


		}

	}//end of POST request

 ?>

 <!DOCTYPE html>
<html>
<?php include('templates/header.php') ?>

<section class="container grey-text">
	<h4 class="center">Add a Pizza</h4>
	<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<label>Your Email:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>

		<label>Pizza Title:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>

		<label>Ingredients(comma seperated):</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
		<div class="red-text"><?php echo $errors['ingredients']; ?></div>

		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php') ?>
</html>