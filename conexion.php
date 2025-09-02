<?php
$host='localhost';
$user='root';
$password='';
$database='classicmodels';
$mysqli= new mysqli($host,$user,$password,$database);
if($mysqli->connect_errno)
{
  echo "Error - No se pudo conectar a la BD: ".$mysqli->connect_errno.'<br>';
}