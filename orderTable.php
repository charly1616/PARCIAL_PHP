<?php
// Datos de ejemplo (pueden venir de una BD)
$orderDetails = [
    ["productCode" => 100, "productName" => "Yuca Playera", "quantityOrdered" => 3, "priceEach" => 1500],
    ["productCode" => 102, "productName" => "Ñame Espino", "quantityOrdered" => 2, "priceEach" => 2500],
    ["productCode" => 103, "productName" => "Auyama AAA", "quantityOrdered" => 1, "priceEach" => 4500],
];
?>

<table>
    <tr>
        <th>productCode</th>
        <th>productName</th>
        <th>quantityOrdered</th>
        <th>priceEach</th>
    </tr>
    <?php foreach ($orderDetails as $row): ?>
        <tr>
            <td><?php echo $row['productCode']; ?></td>
            <td><?php echo $row['productName']; ?></td>
            <td><?php echo $row['quantityOrdered']; ?></td>
            <td><?php echo number_format($row['priceEach'], 0, ',', '.'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
