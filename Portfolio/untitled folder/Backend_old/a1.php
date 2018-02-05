<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<base href="/">-->
    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../Frontend/toGo/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Frontend/toGo/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../Frontend/toGo/css/angular-bootstrap-lightbox.css">

    <!-- Custom CSS -->
    <link href="../Frontend/toGo/css/thumbnail-gallery.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../Frontend/toGo/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

</head>

<body>

<?php
 echo "My first PHP script!<br>";
 $dbhost = 'localhost:3306';
 $dbuser = 'sunilkumarrai2d';
 $dbpass = 'sunhar143';
 $conn = mysql_connect($dbhost, $dbuser, $dbpass);
 if(! $conn ) {
//                die('Could not connect: ' . mysql_error());
                  echo('Could not connect: ' . mysql_error());
              }
          else{
                  echo '<h2>Connected successfully</h2>';
                  mysql_close($conn);
              }

if (isset($_POST["submit"])) 
    {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'This message is from '.$name;
		$to = "sunilkumarrai2@gmail.com";
		$subject = 'Message from a1.php';

		$body =" From: $name\n E-Mail: $email\n Message: $message";
        
      
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}

		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo $email;
			$errEmail = 'Please enter a valid email address';
		}

		if (!$_POST['message']) {
            echo $message;
			$errMessage = 'Please enter your message';
		}
		
		if ($human !== 5) {
            echo $human;
			$errHuman = 'Your anti-spam is incorrect';
		}
    
        if (!$errName && !$errEmail && !$errMessage && !$errHuman) 
            {
                if(mail($to,$subject,$body,$from)) 
                    {
	                   $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
	                }
                else{
                        echo '<h2>Mail Not Sent</h2>';
                        $result='<div id = "succsessNotice" class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	               }
            }
    }
?>
    
    
    
    <div class="row">
   
    <div class="col-lg-6">
                        <h1 class="page-header text-center"></h1>
				<form class="form-horizontal" role="form" method="post" action="a1.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Namesss</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
							<?php echo "<p class='text-danger'>$errHuman</p>";?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>
						</div>
					</div>
				</form>
    </div>
    
    </div>

    <!-- jQuery -->
    <script src="../Frontend/toGo/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Frontend/toGo/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>
    <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.2.js"></script>

    <!-- angular -->
    <script src="../Frontend/toGo/js/modules/app_module.js"></script>
    <script src="../Frontend/toGo/js/controllers/beauty_controller.js"></script>
    <script src="../Frontend/toGo/js/controllers/creative_controller.js"></script>
    <script src="../Frontend/toGo/js/controllers/specialfx_controller.js"></script>
    <script src="../Frontend/toGo/js/controllers/test_controller.js"></script>
    <script src="../Frontend/toGo/js/services/image_service.js"></script>
    <script src="../Frontend/toGo/js/routers/router.js"></script>
    <script src="../Frontend/toGo/js/directive/directive.js"></script>
    <script src="../Frontend/toGo/js/custom/custom.js"></script>
    <script src="../Frontend/toGo/js/angular-bootstrap-lightbox.js"></script>


</body>

</html>
