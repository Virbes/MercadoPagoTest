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
    <script type="text/javascript" id="script-mp"></script>




    <script type="text/javascript">
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_details_mp.php');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        $('#script-mp').html(xhr.responseText);
                    } else {
                        console.error('Error en la petición.');
                    }
                }
            };
            const data = {
                title: $('#nombre_curso').val(),
                price: parsePrice($('#precio_final').text()),
                email: $('#in_email_p1').val(),
                name: $('#in_nombre_p1').val()
            };
            xhr.send(JSON.stringify(data));
    </script>

</body>

</html>