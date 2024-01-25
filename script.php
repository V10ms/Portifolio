<?php

$message = "Line 1\r\nLine 2\r\nLine 3";

// Se as linhas forem maiores que 70 caracteres, deve-se usar wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Envia
mail('vitormanoel64544@gmail.com', 'Meu Assunto', $message);

?>