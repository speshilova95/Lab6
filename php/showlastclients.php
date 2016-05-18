<?php
require  'database.php';
require  'clients.php';
session_start();
$connect = new Database('SeaTour', 'root', '', 'localhost');

//Выводит последнюю добавленную
$datas = Client::show_last();
foreach($datas as $data)
{
	echo "- email: " . $data["Email"] . "<br/>". " - password: " . $data["Password"] . "<br/>". " - surname: " . $data["Surname"] . "<br/>". " - name: " . $data["Name"] . "<br/>". " - tel: " . $data["Phone"] . "<br/><br/>";
}
?>