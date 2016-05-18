<?php
session_start();
header("Content-Type: text/html; charset=utf-8"); 
$_SESSION['test'] = $_SERVER['REMOTE_ADDR']; 
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<title>Регистрация на сайте "Морской бриз" </title>
<link rel="stylesheet" href="style.css" media="all">
<meta charset="utf-8">
</HEAD>

<body>
<div class="button1">
<p> <button>Личный кабинет</button> </p>
</div>

<HEADER>
<div class="header1">
<p>Туристическое агенство "Морской бриз"</p>
</div>
<aside>
<p>Звонки принимаются круглосуточно +7(912)767-373-7</p>
</aside>
<div class="kursive">
Лето круглый год
</div>
</HEADER>

<div class="blok">
<div class="name">
<p>Регистрация нового клиента</p>
</div>
<div class="pole">
		<?php 
			require 'php/clients.php';
			echo Client::get_form('php/toclients.php','php/showclients.php','php/showlastclients.php');
			echo $_SESSION['message'];
			$_SESSION['message'] = ''; 
		?>
</div>
</div>

<div class="oplata">
<img src="pic/Oplata1.png" alt="00000">
</div>

<footer>
    #Генеральный директор агенства: Спешилова Ольга Алексеевна (АСУ-13-1б)
</footer>

</BODY>
</HTML>