<?php
	if($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME']))
 	{
 		header("Location: ../index.php");
 	}
	if(isset($_POST['signup']))
	{
		$screenName = $_POST['screenName'];
		$email 		= $_POST['email'];
		$password   = $_POST['password'];
		$error 		= '';

		if(empty($screenName) or empty($password) or empty($email))
		{
			$error = 'All Fields are required !';
		}else{
				$screenName = $getFromU->checkInput($screenName);
				$email 		= $getFromU->checkInput($email);
				$password   = $getFromU->checkInput($password);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$error = 'Invalid Email Format!';
				}
				else if(strlen($screenName) > 20)
				{
						$error = 'Name must be between 6 to 20 characaters';
				}
				else if(strlen($password) < 7 )
				{
						$error = 'Password is too short it must be between 6 or more ';
				}
				else
				{
					if($getFromU->checkEmail($email) === true)
					{
							$error = 'This Email is already used';
					}
					else
					{
						$user_id = $getFromU->create('users', array('email' => $email, 'password' => md5($password), 'screenName' => $screenName, 
							'profileImage' => 'assets/images/defaultProfileImage.png', 'profileCover' => 'assets/images/defaultCoverImage.png'));
						$_SESSION['user_id'] = $user_id;
						
						header('Location: includes/signup.php?step=1');
						echo "a7a".$user_id;
					}
				}
		}
	}
?>
<form method="post">
<div class="signup-div"> 
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
	</ul>
	<?php
		if(isset($error))
		{
			echo '<li class="error-li">
	 			 <div class="span-fp-error"> ' . $error . ' </div>
	 			 </li>';
		}
	?>
	  
	
</div>
</form>