<?php  
  include("class.phpmailer.php");
  include("class.smtp.php");
  date_default_timezone_set("Europe/Paris"); 
  $mail             = new PHPMailer(); 
  $body             = "Test de PHPMailer."; 
  $mail->IsSMTP();
  $mail->SMTPAuth   = true;
  $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true)); // ignorer l'erreur de certificat.
  $mail->Host       = "mail.votredomaine.tld";  
  $mail->Port       = 587;
  $mail->Username   = "votre email";
  $mail->Password   = "mot de passe";        
  $mail->From       = "votre email"; //adresse d’envoi correspondant au login entré précédemment
  $mail->FromName   = "votre nom"; // nom qui sera affiché
  $mail->Subject    = "This is the subject"; // sujet
  $mail->AltBody    = "corps du message au format texte"; //Body au format texte
  $mail->WordWrap   = 50; // nombre de caractères pour le retour à la ligne automatique
  $mail->MsgHTML($body); 
  $mail->AddReplyTo("votre mail","votre nom");
  $mail->AddAttachment("./examples/images/phpmailer.gif");// pièce jointe si besoin
  $mail->AddAddress("adresse destinataire 1","adresse destinataire 2");
  $mail->IsHTML(true); // envoyer au format html, passer a false si en mode texte 
  if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Le message à bien été envoyé";
  } 
?>