<?php
// Api para retornar un usuario o un listado de usuarios
//http://localhost/Apipedidos/orderscustomers.php(Trae todos)
//http://localhost/Apipedidos/orderscustomers.php?id=242(Trae el producto con codigo )
//---------- getusuario-----------------
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requestes-Whit, Content-Type, Accept');
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers", "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
$json=file_get_contents('php://input');//captura el parametro en json {'id':118}
$params=json_decode($json);//paramteros
require('conexion.php');

$respuesta['codigo']='-1';
$respuesta['mensaje']='No hay registros';
$method = $_SERVER['REQUEST_METHOD'];//Cual es el metdodo de acceso (GET,PUT,POST,DELET PATCH)
if($method!='GET')
{
  $respuesta['mensaje']='Erros acceso no permitido por este método..';
  echo json_encode($respuesta);
  exit(1);
}
// si le enviamos parametros
$sql="select P.productCode,P.productName,P.productDescription,T.quantityOrdered,
T.priceEach,O.orderNumber,O.orderDate,O.status,C.customerNumber,
C.customerName,C.contactlastName,C.contactFirstName,C.phone
 from products P
 inner join orderdetails T on P.productCode=T.productCode
 inner join orders O on O.orderNumber=T.orderNumber
 inner join customers C on C.customerNumber=O.customerNumber
 ORDER by O.orderNumber";
if(isset($_GET['id']))//si recibe una variable por get llamada 'id'
{
    $id=$_GET['id'];
    $sql="select P.productCode,P.productName,P.productDescription,T.quantityOrdered,
    T.priceEach,O.orderNumber,O.orderDate,O.status,C.customerNumber,
    C.customerName,C.contactlastName,C.contactFirstName,C.phone
     from products P
     inner join orderdetails T on P.productCode=T.productCode
     inner join orders O on O.orderNumber=T.orderNumber
     inner join customers C on C.customerNumber=O.customerNumber
     where C.customerNumber=$id
     ORDER by O.orderNumber";
}   

$result=$mysqli->query($sql);//hace la consulta en la BD
if(mysqli_num_rows($result)>0)//si trajo registro
{
    $registros=mysqli_fetch_all($result,MYSQLI_ASSOC);//registr['id']=1,registr['nombres']='pedro'
    // conv los reg en array asociativos
    echo json_encode($registros);// {'id':1,'nombres':'pedro'}
}
else
{
    echo json_encode($respuesta);//{'codigo':'-1','mensaje':'No hay reg'}
}
?>
