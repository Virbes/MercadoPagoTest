<?php
// Obtener los datos enviados a través de la petición AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Procesar los datos y devolver una respuesta
if (!empty($data)) {
    $title = $data['title'];
    $price = $data['price'];
    $email = $data['email'];
    $name_client = $data['name'];

    // Hacer algo con los datos, por ejemplo, guardarlos en una base de datos

    include '../vendor/autoload.php';

    MercadoPago\SDK::setAccessToken('TEST-8540037631842682-092614-c3fc3ce73f3b3fa5312887952ccb95f3-650731289');

    $preference = new MercadoPago\Preference();

    $item = new MercadoPago\Item();
    $item->id = '1A2B3C4D5E';
    $item->title = $title;
    $item->quantity = 1;
    $item->unit_price = $price;
    $item->currency_id = 'MXN';

    $preference->items = array($item);
    $preference->back_urls = array(
        "success" => "https://www.nueva.apresolve.com/ins_online/mp_success.php",
        "failure" => "https://www.nueva.apresolve.com/ins_online/mp_fail.php"
    );
    $preference->metadata = array(
        "user_id" => "123456",
        "email" => $email,
        "product_name" => $title,
        "name" => $name_client
    );
    $preference->auto_return = "approved";
    $preference->binary_mode = true;
    $preference->save();


    $script = "
        const mp = new MercadoPago('TEST-fc84b021-ff49-4648-956a-9d8d20163fc7', {
            locale: 'es-MX',
        });

        mp.checkout({
            preference: {
                id: '$preference->id'
            },
            render: {
                container: '.checkout-btn',
                label: 'Pagar con Mercado Pago'
            }
        });
    ";


    echo $script;
} else {
    $response = array(
        'status' => 'error',
        'message' => 'No se recibieron datos.'
    );
    echo json_encode($response);
}
