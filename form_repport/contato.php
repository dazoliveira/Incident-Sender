<?php
require_once('conexao.inc.php');
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user, $pass);

$incidentName = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["mensagem"];
$date = date('Y-m-d H:i:s');


$sql = 'INSERT INTO tb_incidents 
		(incident_name, message, created)
		VALUES (:incident_name, :message, :created)';

$stm = $db->prepare($sql);
$stm->execute(['incident_name'=>$incidentName, 'message'=>$message, 'created'=>$date]);
$ultimo_id = $db->lastInsertId();

echo "Thank you! Your message has been sent";


require_once("class/class.phpmailer.php");


$mail = new PHPMailer(true);


$mail->IsSMTP(); 
 
try {
	 $mail->SMTPAutoTLS = false;
     $mail->Host = 'smtp.seudomínio.com.br'; 
     $mail->SMTPAuth   = true; 
     $mail->Port       = 587; 
     $mail->Username = '???????'; 
     $mail->Password = '??????'; 
 

     $mail->SetFrom('Seu e-mail', 'Name'); 
     $mail->AddReplyTo('Seu e-mail', 'Name'); 
     $mail->Subject = $incidentName;
 
 

     $mail->AddAddress($email, 'Teste Locaweb');
 
 
     $mail->MsgHTML($message); 
 
     $mail->Send();
     echo "Mensagem enviada com sucesso</p>\n";

    }catch (phpmailerException $e) {
      echo $e->errorMessage(); 
}
