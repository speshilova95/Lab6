<?php
require  'database.php';
require  'clients.php';
session_start();
$connect = new Database('SeaTour', 'root', '', 'localhost');

//Выводит все записи
$datas = Client::show_all();
foreach($datas as $data)
{
	echo "*- email: " . $data["Email"] . "<br/>". " - password: " . $data["Password"] . "<br/>". " - surname: " . $data["Surname"] . "<br/>". " - name: " . $data["Name"] . "<br/>". " - tel: " . $data["Phone"] . "<br/><br/>";
}
?>