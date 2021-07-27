<?php
date_default_timezone_set("Asia/Jakarta");
$tgl=date("Y-m-d");
$tglskrg=date("d-m-Y");
$tglsurat=date("Y-m-10");
$tglskrgpendek=date("d/m/y");
$tanggal=date("d");
$bulanskrg=date("m");
$bulanpanjang=date("F");
$tahunskrg=date("Y");
$tahunbesok=$tahunskrg+1;
$namahari = date('l', strtotime($tgl));
$jtempo=date("Y-m-10");
$waktu=date("H:i:s");

$bulanindo = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'Nopember',
                '12' => 'Desember',
        );
		
if($bulanskrg=='01'){
	$bln='Januari';
	$count="7";
	$blnpendek='Jan';
}else if($bulanskrg=='02'){
	$bln='Februari';
	$count="8";
	$blnpendek='Feb';
}else if($bulanskrg=='03'){
	$bln='Maret';
	$count="9";
	$blnpendek='Mar';
}else if($bulanskrg=='04'){
	$bln='April';
	$count="10";
	$blnpendek='Apr';
}else if($bulanskrg=='05'){
	$bln='Mei';
	$count="11";
	$blnpendek='Mei';
}else if($bulanskrg=='06'){
	$bln='Juni';
	$count="12";
	$blnpendek='Jun';
}else if($bulanskrg=='07'){
	$bln='Juli';
	$count="1";
	$blnpendek='Jul';
}else if($bulanskrg=='08'){
	$bln='Agustus';
	$count="2";
	$blnpendek='Ags';
}else if($bulanskrg=='09'){
	$bln='September';
	$count="3";
	$blnpendek='Sep';
}else if($bulanskrg=='10'){
	$bln='Oktober';
	$count="4";
	$blnpendek='Okt';
}else if($bulanskrg=='11'){
	$bln='Nopember';
	$count="5";
	$blnpendek='Nop';
}else if($bulanskrg=='12'){
	$bln='Desember';
	$count="6";
	$blnpendek='Des';
}

$tgllengkap="$tanggal $bln $tahunskrg";
$jtempolengkap="10 $bln $tahunskrg";
//$jtemponowlengkap="10 $bln $tahunskrg";


?>