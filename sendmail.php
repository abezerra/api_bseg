<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 03/07/2018
 * Time: 11:15
 */

ini_set('display_errors', 1);

error_reporting(E_ALL);

$from = "galima@brasal.com.br";

$to = "galima@brasal.com.br";

$subject = "Teste de proposta virtuos";

$message = "Virtuos VW";

$headers = "De:". $from;

mail($to, $subject, $message, $headers);

echo "Message has benn sented";