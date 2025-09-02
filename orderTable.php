<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost/Apipedidos/orders.php?productCode=S18_1749",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
    exit(1);
}

$orders = json_decode($response, true); // array asociativo
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listado de Pedidos</title>
</head>
<body>
    <h2>Detalles Orden</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>productCode</th>
            <th>productName</th>
            <th>quantityOrdered</th>
            <th>priceEach</th>
        </tr>
        <?php 
        $total = 0;
        if (!empty($orders)): ?>
            <?php foreach ($orders as $row): 
                $total += $row['quantityOrdered'] * $row['priceEach'];
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['productCode']); ?></td>
                    <td><?= htmlspecialchars($row['productName']); ?></td>
                    <td><?= htmlspecialchars($row['quantityOrdered']); ?></td>
                    <td>$<?= number_format($row['priceEach'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No hay pedidos</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Total -->
    <h3>Total de la Orden: $<?= number_format($total, 0, ',', '.'); ?></h3>
</body>
</html>
