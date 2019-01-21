<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});
if (isset($_POST["body"])) {
	# code...

include("PHPMailer.php");
include("SMTP.php");
$body = $_POST['body'];

$mail = new PHPMailer;

$mail->isSMTP();

$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "jgarcia@intt2.com";
$mail->Password = "bienvenido19";
$mail->setFrom('jgarcia@intt2.com', 'INT DEVELOPERS');
//$mail->addReplyTo('replyto@example.com', 'First Last');

//$mail->addAddress('hdiaz@groundbreaking.mx', 'HUGO DIAZ');

$mail->addAddress('jgarcia@intt2.com', 'jc');
$mail->Subject = 'WARNING ';
$mail->isHTML(true);

 $mail->Body    = ''.$body;
 $mail->AltBody = "?";

 

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
  
}
}else{

	echo "NO POST DATA sent xd";
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "John Doe\n";
	fwrite($myfile, $txt);
	$txt = "Jane Doe\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	
}
//$app->run();
