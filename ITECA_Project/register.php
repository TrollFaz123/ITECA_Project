<html>
    <head>
        <title>Registration form</title>
    </head>

    <body>
        <h1>Register</h1> 
            <a href="C:\Users\Bobby\Desktop\ITECA_Project\Shop page\shop.html">Shop</a> | 
            <a href="C:\Users\Bobby\Desktop\ITECA_Project\register.php">Register</a> | 
            <a href="C:\Users\Bobby\Desktop\ITECA_Project\Login\login.html">Login</a> 
        <hr />

        <form action="./register.php" class="form" method="POST">
	
	        <h1>create a new account</h1>

	            <div class="">
	            <?php
		            // check to see if the user successfully created an account
		            if (isset($success) && $success == true){
			            echo '<p color="green">Your account has been created. <a href="C:\Users\Bobby\Desktop\ITECA_Project\Login\login.html">Click here</a> to login!<p>';
		            }
		            // check to see if the error message is set, if so display it
		            else if (isset($error_msg))
			            echo '<p color="red">'.$error_msg.'</p>';
                    else
                        echo ''; // do nothing
		
	            ?>
	            </div>

	            <div>
		            <input type="text" name="username" value="" placeholder="enter a username" autocomplete="off" required />
	            </div>
	            <div>
		            <input type="text" name="email" value="" placeholder="provide an email" autocomplete="off" required />
	            </div>
	            <div>
		            <input type="password" name="passwd" value="" placeholder="enter a password" autocomplete="off" required />
	            </div>
	            <div>
		            <p>password must be at least 5 characters and<br /> have a special character, e.g. !#$.,:;()</font></p>
	            </div>					
	            <div>
		            <input type="password" name="confirm_password" value="" placeholder="confirm your password" autocomplete="off" required />
	            </div>
	
	            <div>
		            <input type="submit" name="registerBtn" value="create account" />
	            </div>

	            <p class="center"><br />
		            Already have an account? <a href="<?php echo SITE_ADDR ?>/login">Login here</a>
	            </p>
        </form>
    </body>

    <?php 
        // include our connect script 
        require_once("connect.php"); 
    
        // check to see if there is a user already logged in, if so redirect them 
        session_start(); 
        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) 
            header("Location: C:\Users\Bobby\Desktop\ITECA_Project\Shop page\shop.html");  // redirect the user to the home page
        if (isset($_POST['registerBtn'])){ 
            // get all of the form data 
            $username = $_POST['username']; 
            $email = $_POST['email']; 
            $passwd = $_POST['passwd']; 
            $passwd_again = $_POST['passwd_again']; 
            
        }
        
        // verify all the required form data was entered
        if ($username != "" && $passwd != "" && $passwd_again != ""){
            // make sure the two passwords match
            if ($passwd === $passwd_again){
                // make sure the password meets the min strength requirements
                if ( strlen($passwd) >= 5 && strpbrk($passwd, "!#$.,:;()") != false ){
                    
                }
                else
                    $error_msg = 'Your password is not strong enough. Please use another.';
            }
            else
                $error_msg = 'Your passwords did not match.';
        }
        else
            $error_msg = 'Please fill out all required fields.';

        // query the database to see if the username is taken
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
        if (mysqli_num_rows($query) == 0){
        // create and format some variables for the database
        $id = '';
        $passwd = md5($passwd);
        $date_created = time();
        $last_login = 0;
        $status = 1;
        }
        else
            $error_msg = 'The username <i>'.$username.'</i> is already taken. Please use another.';
    
        // insert the user into the database
        mysqli_query($conn, "INSERT INTO users VALUES (
            '{$id}', '{$username}', '{$email}', '{$passwd}', '{$date_created}', '{$last_login}', '{$status}')");

        // verify the user's account was created
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
            if (mysqli_num_rows($query) == 1){
                $success = true;
            }
            else
            $error_msg = 'An error occurred and your account was not created.';
    ?>

</html>