<?php
include($_SERVER['DOCUMENT_ROOT'] . "/_integra/include/conn.php");
include '../vendor/autoload.php';
MercadoPago\SDK::setAccessToken('TEST-8540037631842682-092614-c3fc3ce73f3b3fa5312887952ccb95f3-650731289');

$payment = $_GET['payment_id'];
$status = $_GET['status'];
$payment_type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];

echo '<h3>Pago Exitoso</h3>';

echo $payment . '<br>';
echo $status . '<br>';
echo $payment_type . '<br>';
echo $order_id . '<br><br>';


$preference_id = $_GET['preference_id'];
$preference = MercadoPago\Preference::get($preference_id);

$user_id = $preference->metadata->user_id;
$name = $preference->metadata->name;
$email = $preference->metadata->email;
$product_name = $preference->metadata->product_name;

echo "¡Gracias por tu compra, $user_id! Tu pago por $product_name ha sido procesado con éxito. Te enviaremos un correo a $email" . '<br>' . '<br>' . '<br>' . '<hr>';


echo '<hr>';
echo '<hr>';
echo '<hr>';
echo '<hr>';
echo '<hr>';
echo '<hr>';


/**
 * Enviar correo de agradecimiento despues de que la compra sea exitosa
 */

$txt = "
    <div>
        <strong>Hola $name, Gracias por tu Pago al curso.</strong><br>
        <p>$product_name</p>
        ------------------------------------------------<br>
        
        <strong>Tus datos de contacto son:</strong><br>
        ------------------------------------------------<br>
        <strong>Nombre: </strong>$name<br>
        <strong>Email: </strong>$email<br>
        <strong>Curso: </strong>$product_name<br>
        
        ------------------------------------------------<br>

        <strong>Referencia de pago: </strong>$order_id<br>
        <strong>Metodo de pago: </strong>Mercado Pago<br>
        <br><br><br><br>
    </div>
";

echo $txt;


$sfrom = $_SESSION["_TNOMBRE_"] . " <" . $_SESSION["_EMAIL_"] . ">"; // Cuenta que envia 
$srea = $_SESSION["_EMAIL_"]; // Responder a
$sdestinatario = $email; // Cuenta destino
$ssubject = 'Pago Curso Apresolve acreditado';

$sheader = "From:" . $sfrom . "\r\nReply-To:" . $srea . "\r\n";
$sheader = $sheader . "X-Mailer:PHP/" . phpversion() . "\r\n";
$sheader = $sheader . "Mime-Version: 1.0\r\n";
$sheader = $sheader . "Content-Type: text/html";



mail($sdestinatario, $ssubject, $txt, $sheader);