<?php
require_once 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-8540037631842682-092614-c3fc3ce73f3b3fa5312887952ccb95f3-650731289');

$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->id = '1A2B3C4D5E';
$item->title = 'Xbox One';
$item->quantity = 1;
$item->unit_price = 6000;
$item->currency_id = 'MXN';

$preference->items = array($item);
$preference->back_urls = array(
    "success" => "http://localhost/MercadoPago_test/captura.php",
    "failure" => "http://localhost/MercadoPago_test/fallo.php"
);
$preference->auto_return = "approved";
$preference->binary_mode = true;
$preference->save();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>

    <h1>Mercado PAGO</h1>

    <div class="checkout-btn"></div>

    <script type="text/javascript">
        const mp = new MercadoPago('TEST-fc84b021-ff49-4648-956a-9d8d20163fc7', {
            locale: 'es-MX',
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id ?>'
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con Mercado Pago'
            }
        });
    </script>

</body>

</html>