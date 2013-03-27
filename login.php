<?php
session_start();
require_once "bin/user.php";
include ('bin/database_connection.php');
if (isset($_POST['formsubmitted'])) {
    // Initialize a session:
    $error = array();//this array will store all error messages
  

    if (empty($_POST['email'])) {//if the email supplied is empty
        $error[] = 'You forgot to enter  your email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
           
            $email = $_POST['email'];
        } else {
             $error[] = 'Your email address is invalid  ';
        }


    }


    if (empty($_POST['password'])) {
        $error[] = 'Please Enter Your Password ';
    } else {
        $password = $_POST['password'];
    }


       if (empty($error))//if the array is empty , it means no error found
    { 

        // check credentials

        // Make the connection:
           $db = new MGDatabase();
            // update activation code to NULL
            try{
            $cursor = $db->find('users',
                array("email" => $email, "password" => $password, "activation" => NULL)
            );

                if(!$cursor->hasNext()){
                    $msg_error= 'Either Your Account is inactive or Email address /Password is Incorrect';
                }else{
                   $record = $cursor->getNext();
                    $user = new User($record['_id']->{'$id'});
                    $_SESSION['user'] = serialize($user);
                    var_dump($_SESSION['user']);
                    header("Location: index.php");

                }

            } catch(MongoConnectionException $e) {

            die("Failed to connect to database ".$e->getMessage());
            }
            catch(MongoException $e) {
            die('Failed to retrieve data '.$e->getMessage());
            }

    }  else {
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            echo '	<li>'.$values.'</li>';
        }
        echo '</ol></div>';
    }
    
    
    if(isset($msg_error)){
        
        echo '<div class="warning">'.$msg_error.' </div>';
    }

} // End of the main Submit conditional.



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>kaPoW Login Form</title>

<style type="text/css">
body {
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
.registration_form {
	margin:0 auto;
	width:500px;
	padding:14px;
}
label {
	width: 10em;
	float: left;
	margin-right: 0.5em;
	display: block
}
.submit {
	float:right;
}
fieldset {
	background:#EBF4FB none repeat scroll 0 0;
	border:2px solid #B7DDF2;
	width: 500px;
}
legend {
	color: #fff;
	background: #80D3E2;
	border: 1px solid #781351;
	padding: 2px 6px
}
.elements {
	padding:10px;
}
p {
	border-bottom:1px solid #B7DDF2;
	color:#666666;
	font-size:11px;
	margin-bottom:20px;
	padding-bottom:10px;
}
a{
    color:#0099FF;
font-weight:bold;
}

/* Box Style */


 .success, .warning, .errormsgbox, .validation {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
     font-weight:bold;
     width:450px;
     
}

.success {
   
	color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('images/success.png');
}
.warning {

	color: #9F6000;
	background-color: #FEEFB3;
	background-image: url('images/warning.png');
}
.errormsgbox {
 
	color: #D8000C;
	background-color: #FFBABA;
	background-image: url('images/error.png');
	
}
.validation {
 
	color: #D63301;
	background-color: #FFCCBA;
	background-image: url('images/error.png');
}



</style>

</head>
<body>


<form action="login.php" method="post" class="registration_form">
  <fieldset>
    <legend>kaPoW Login Form  </legend>

    <p>Please Enter Your Email and Password Below  </p>
    
    <div class="elements">
      <label for="email">Email :</label>
      <input type="text" id="email" name="email" size="25" />
    </div>
  
    <div class="elements">
      <label for="password">Password :</label>
      <input type="password" id="password" name="password" size="25" />
    </div>
    <div class="submit">
     <input type="hidden" name="formsubmitted" value="TRUE" />
      <input type="submit" value="Login" />
    </div>
  </fieldset>
</form>
Go Back to <a href="forgotpass.php">Go to Login page</a>
<br />
Go Back to <a href="index.php">Go to Sign Up page</a>
</body>
</html>
