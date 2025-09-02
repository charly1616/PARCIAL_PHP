<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Front-End con HTML+PHP</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.15);
            max-width: 700px;
            margin: auto;
            padding: 30px;
        }
        h2 {
            margin: 0 0 20px 0;
            font-size: 20px;
            text-align: center;
            color: #444;
        }
        .form-section {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }
        label {
            font-weight: 500;
            font-size: 14px;
            min-width: 120px;
        }
        select, input[type="text"] {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            flex: 1;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        button:hover {
            background: #43a047;
        }
        .customer-info, .order-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        .customer-info label, .order-info label {
            font-size: 13px;
        }
        .customer-info input, .order-info input {
            width: 100%;
        }
        .table-container {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 14px;
        }
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .total span {
            font-size: 22px;
            color: #222;
        }
        .btn-back {
            display: block;
            margin: 25px auto 0 auto;
            background: #607d8b;
            padding: 8px 20px;
        }
        .btn-back:hover {
            background: #546e7a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Front-End con HTML+PHP</h2>

        <!-- Customers -->
        <div class="form-section">
            <label for="customers">Customers:</label>
            <select id="customers" name="customers">
                <option>--Seleccione--</option>
                <option value="1">Cliente 1</option>
                <option value="2">Cliente 2</option>
            </select>
            <button>Ok1</button>
        </div>

        <!-- Orders -->
        <div class="form-section">
            <label for="orders">Orders:</label>
            <select id="orders" name="orders">
                <option>--Seleccione--</option>
                <option value="1">Orden 1</option>
                <option value="2">Orden 2</option>
            </select>
            <button>Ok2</button>
        </div>

        <!-- Customer Data -->
        <div class="customer-info">
            <div>
                <label>CustomerNumber:</label>
                <input type="text">
            </div>
            <div>
                <label>CustomerName:</label>
                <input type="text">
            </div>
            <div>
                <label>Phone:</label>
                <input type="text">
            </div>
        </div>

        <!-- Order Data -->
        <div class="order-info">
            <div>
                <label>OrderNumber:</label>
                <input type="text">
            </div>
            <div>
                <label>OrderDate:</label>
                <input type="text">
            </div>
        </div>

        <!-- Tabla de detalles -->
        <div class="table-container">
            <?php include 'orderTable.php'; ?>
        </div>

        <!-- Total -->
        <div class="total">
            Total de la Orden <span>$14.000.00</span>
        </div>

        <!-- Botón -->
        <button class="btn-back">Back</button>
    </div>
</body>
</html>
