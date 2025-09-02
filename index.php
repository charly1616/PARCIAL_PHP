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
        .hidden { display: none; }
        .customer-info, .order-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        .table-container {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        table { width: 100%; border-collapse: collapse; }
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
        tr:nth-child(even) { background: #f9f9f9; }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .total span { font-size: 22px; color: #222; }
        .btn-back {
            display: block;
            margin: 25px auto 0 auto;
            background: #607d8b;
            padding: 8px 20px;
        }
        .btn-back:hover { background: #546e7a; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Front-End con HTML+PHP</h2>

        <!-- Customers -->
        <div class="form-section" id="customer-section">
            <label for="customers">Customers:</label>
            <select id="customers">
                <option value="">--Seleccione--</option>
            </select>
            <button id="btnCustomer">Ok1</button>
        </div>

        <!-- Orders -->
        <div class="form-section hidden" id="order-section">
            <label for="orders">Orders:</label>
            <select id="orders">
                <option value="">--Seleccione--</option>
            </select>
            <button id="btnOrder">Ok2</button>
        </div>

        <div id="no-orders-message" class="hidden" style="text-align:center; color:#b71c1c; font-weight:bold; margin:15px 0;">
            No hay pedidos para este cliente
        </div>

        <!-- Detalles -->
        <div id="details-section" class="hidden">
            <div class="customer-info">
                <div>
                    <label>CustomerNumber:</label>
                    <input type="text" id="customerNumber" readonly>
                </div>
                <div>
                    <label>CustomerName:</label>
                    <input type="text" id="customerName" readonly>
                </div>
                <div>
                    <label>Phone:</label>
                    <input type="text" id="phone" readonly>
                </div>
            </div>

            <div class="order-info">
                <div>
                    <label>OrderNumber:</label>
                    <input type="text" id="orderNumber" readonly>
                </div>
                <div>
                    <label>OrderDate:</label>
                    <input type="text" id="orderDate" readonly>
                </div>
            </div>

            <!-- Tabla -->
            <div class="table-container" id="orderTable"></div>

            <div class="total">
                Total de la Orden <span id="orderTotal">$0.00</span>
            </div>

            <button class="btn-back">Back</button>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Cargar clientes
        fetch("http://localhost/Apipedidos/customers.php")
            .then(res => res.json())
            .then(data => {
                let select = document.getElementById("customers");
                data.forEach(c => {
                    let opt = document.createElement("option");
                    opt.value = c.customerNumber;
                    opt.textContent = c.customerName;
                    select.appendChild(opt);
                });
            });
    });

    // Mostrar órdenes del cliente
    document.getElementById("btnCustomer").addEventListener("click", () => {
        let customerId = document.getElementById("customers").value;
        if (!customerId) return alert("Seleccione un cliente");

        fetch(`http://localhost/Apipedidos/orderscustomers.php?id=${customerId}`)
            .then(res => res.json())
            .then(data => {
                let select = document.getElementById("orders");
                let orderSection = document.getElementById("order-section");
                let noOrdersMessage = document.getElementById("no-orders-message");

                select.innerHTML = '<option value="">--Seleccione--</option>';
                orderSection.classList.add("hidden");
                noOrdersMessage.classList.add("hidden");

                if (data["codigo"] === "-1" || data.length === 0) {
                    noOrdersMessage.classList.remove("hidden");
                    return;
                }

                let uniqueOrders = [];
                let seen = new Set();
                data.forEach(o => {
                    if (!seen.has(o.orderNumber)) {
                        seen.add(o.orderNumber);
                        uniqueOrders.push(o);
                    }
                });

                uniqueOrders.forEach(o => {
                    let opt = document.createElement("option");
                    opt.value = o.orderNumber;
                    opt.textContent = "Orden #" + o.orderNumber;
                    select.appendChild(opt);
                });

                orderSection.classList.remove("hidden");

                // Datos de cliente
                document.getElementById("customerNumber").value = data[0].customerNumber;
                document.getElementById("customerName").value = data[0].customerName;
                document.getElementById("phone").value = data[0].phone;
            });
    });

    // Mostrar detalles de la orden
    document.getElementById("btnOrder").addEventListener("click", () => {
        let orderId = document.getElementById("orders").value;
        if (!orderId) return alert("Seleccione una orden");

        fetch("http://localhost/Apipedidos/orders.php?id=" + orderId)
            .then(res => res.json())
            .then(data => {
                // data = array de detalles [{productCode, productName, quantityOrdered, priceEach}]
                let tableHTML = `
                    <table>
                        <tr>
                            <th>productCode</th>
                            <th>productName</th>
                            <th>quantityOrdered</th>
                            <th>priceEach</th>
                        </tr>`;
                let total = 0;
                data.forEach(d => {
                    tableHTML += `
                        <tr>
                            <td>${d.productCode}</td>
                            <td>${d.productName}</td>
                            <td>${d.quantityOrdered}</td>
                            <td>$${Number(d.priceEach).toLocaleString()}</td>
                        </tr>`;
                    total += d.quantityOrdered * d.priceEach;
                });
                tableHTML += "</table>";

                document.getElementById("orderTable").innerHTML = tableHTML;
                document.getElementById("orderTotal").textContent = "$" + total.toLocaleString();
                document.getElementById("orderNumber").value = orderId;
                document.getElementById("orderDate").value = data[0].orderDate;


                document.getElementById("details-section").classList.remove("hidden");
            });
    });
    </script>
</body>
</html>
