<?php   
$nome = $_POST['nome_cont'];
$email = $_POST['email_cont'];
$opcoes = $_POST['tipo_cont'];
$mensagem = $_POST['detalhes_cont'];
 


$data =date("d/m/Y  H:i:s");

$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s'); 

require_once("phpmailer/class.phpmailer.php");

include "SenhaEmail.php";  
$para = $email; 
$de = 'vitormanoel64544@gmail.com';
$de_nome = 'Site Portifolio';
$assunto = $opcoes; 


function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
  global $error;
  $mail = new PHPMailer();
  $mail->IsSMTP();    // Ativar SMTP
  $mail->SMTPDebug = 1;   // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
  $mail->SMTPAuth = true;   // Autenticação ativada
  $mail->SMTPSecure = 'ssl';  // Padrão de segurança
  $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
  $mail->Port = 465;      // A porta 587 deverá estar aberta em seu servidor
  $mail->Username = USER;
  $mail->Password = PWD;
  $mail->SetFrom($de, $de_nome);
  $mail->Subject = $assunto;
  $mail->Body = $corpo;

  $mail->AddAddress($para);
  if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
    return false;
  } else {
    $error = 'Mensagem enviada!';
    return true;
  }
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

//$Vai    = "Nome: $nome\n\nE-mail: $email\n\nTelefone: $telefone\n\nMensagem: $mensagem\n\nResposta: $corpo"; //--->original

$arquivo = '

    Nome: '.$nome.'

    E-mail: '.$email.'

    Tipo de Orçamento: '.$opcoes.'

    Mensagem: '.$mensagem.'


    Este e-mail foi enviado em '.$data_envio.' às '.$hora_envio.'
    
';

 if (smtpmailer($de, $de, $de_nome, 'Nova Mesagem no portifolio', $arquivo)) {

  echo ('Sucesso enviado, '); // Redireciona para uma página de obrigado.
   header('location:index.html');
}
if (!empty($error)) echo $error;
?>