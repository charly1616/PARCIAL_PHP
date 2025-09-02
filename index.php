<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Front-End con HTML+PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            margin: 20px;
        }
        .container {
            border: 1px solid black;
            width: 500px;
            padding: 15px;
            margin: auto;
        }
        h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        select, input[type="text"], button {
            margin: 5px;
            padding: 4px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        .total {
            text-align: right;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-back {
            display: block;
            margin: 20px auto;
            padding: 6px 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Front-End con HTML+PHP</h3>

        <!-- Customers -->
        <label for="customers">Customers:</label>
        <select id="customers" name="customers">
            <option>--Seleccione--</option>
            <option value="1">Cliente 1</option>
            <option value="2">Cliente 2</option>
        </select>
        <button>Ok1</button>
        <br>

        <!-- Orders -->
        <label for="orders">Orders:</label>
        <select id="orders" name="orders">
            <option>--Seleccione--</option>
            <option value="1">Orden 1</option>
            <option value="2">Orden 2</option>
        </select>
        <button>Ok2</button>

        <br><br>
        <!-- Customer Data -->
        <label>CustomerNumber:</label>
        <input type="text" size="5">
        <label>CustomerName:</label>
        <input type="text" size="20">
        <label>Phone:</label>
        <input type="text" size="10">
        <br><br>
        <label>OrderNumber:</label>
        <input type="text" size="8">
        <label>orderDate:</label>
        <input type="text" size="10">

        <!-- Tabla de detalles -->
        <div>
            <?php include 'orderTable.php'; ?>
        </div>

        <!-- Total -->
        <div class="total">
            Total de la Orden <span style="font-size:22px;">$14.000.00</span>
        </div>

        <!-- Botón -->
        <button class="btn-back">Back</button>
    </div>
</body>
</html>
