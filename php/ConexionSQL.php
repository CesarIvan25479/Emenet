<?php
$servidor = '192.168.3.21\SQLEXPRESS,1400';
$infoConex = array("Database" => "C:\MyBusinessDatabase\MyBusinessPOS2011_cli.mdf", "UID" => "Inicio001", "PWD" => "123456789","CharacterSet" => "UTF-8");
$Conn=sqlsrv_connect($servidor, $infoConex);