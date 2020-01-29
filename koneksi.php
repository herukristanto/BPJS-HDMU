<?php
/* server sql pake IP */
$serverName = "182.168.0.116";//RSPIKSQ1
$connectionInfo = array( "Database"=>"HDMU","UID"=>"sa","PWD"=>"w@tch9u@rd");

//$serverName = "182.168.0.118";//RSPIKEMR
//$connectionInfo = array( "Database"=>"HDMU","UID"=>"pikdb","PWD"=>"0riginPIK");

/* koneksi ke database. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Koneksi Gagal 0</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* koneksi ke database. */
$conn1 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn1 === false )
{
     echo "Koneksi Gagal 1</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* koneksi ke database. */
$conn2 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn2 === false )
{
     echo "Koneksi Gagal 2</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* koneksi ke database. */
$conn3 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn3 === false )
{
     echo "Koneksi Gagal 3</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* koneksi ke database. */
$conn4 = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn4 === false )
{
     echo "Koneksi Gagal 4</br>";
     die( print_r( sqlsrv_errors(), true));
}
?>
