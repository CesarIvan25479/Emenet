<?php
$servidor = '192.168.3.21\SQLEXPRESS,1400';
$infoConex = array("Database" => "C:\MyBusinessDatabase\MyBusinessPOS2011_cli.mdf", "UID" => "Inicio001", "PWD" => "123456789","CharacterSet" => "UTF-8");
$Conn=sqlsrv_connect($servidor, $infoConex);

// $servidor = '192.168.1.79\SQLEXPRESS,1433';
// $infoConex = array("Database" => "C:\MyBusinessDatabase\MyBusinessPOS2011_cli.mdf", "UID" => "Inicio2021", "PWD" => "CEsarivan12","CharacterSet" => "UTF-8");
// $Conn=sqlsrv_connect($servidor, $infoConex);
