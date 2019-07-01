<?php 

function Signature(string $filename, string $target_dir ) {

	print_r("PASO 2 - Entro en funcion signature!");print_r("<br />");
	
    //Datos que se quieren firmar:
	//$datos = 'Este texto será firmado. Thanks for your attention :)';
	$file = fopen($filename, 'rb');//rd: read en modo binario ASI ESTABA COMENTE PARA PROBAR!
	//$filename= 'C:\xampp\htdocs\uploads\hola.txt';//me da error la ruta de archivo, crear un archivo hola.txt con cualquier cosa dentro para probar.
	//$file = fopen($filename, 'rb');
	$datos = fread($file, filesize($filename));
    fclose($file);
	
	
	//Se deben crear dos claves aparejadas, una clave pública y otra privada
	//A continuación el array de configuración para la creación del juego de claves
	$configArgs = array(
		'config' => 'C:\xampp\php\extras\openssl\openssl.cnf', //<-- esta ruta es necesaria si trabajas con XAMPP
		'private_key_bits' => 2048,
		'private_key_type' => OPENSSL_KEYTYPE_RSA
	);
	print_r("PASO 3 - Se crearon las claves!");print_r("<br />");
	
	
	$resourceNewKeyPair = openssl_pkey_new($configArgs);
	
	if (!$resourceNewKeyPair) {
		echo 'Puede que tengas problemas con la ruta indicada en el array de configuración "$configArgs" ';
		echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
		exit;
	}
	print_r("PASO 4 - Todo ok con el array de configuracion!");print_r("<br />");
	
	
	//obtengo del recurso $resourceNewKeyPair la clave publica como un string 
	$details = openssl_pkey_get_details($resourceNewKeyPair);
	$publicKeyPem = $details['key'];
	
	print_r("PASO 5 - Clave publica a string!");print_r("<br />");
	
	
	//obtengo la clave privada como string dentro de la variable $privateKeyPem (la cual es pasada por referencia)
	if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, NULL, $configArgs)) {
		echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
		exit;
	}
	
	print_r("PASO 6 - Clave privada a string!");print_r("<br />");
	
	//guardo la clave publica y privada en disco:
	file_put_contents($target_dir . 'private_key_' . basename($filename) . '.pem', $privateKeyPem);
	file_put_contents($target_dir . 'public_key_' . basename($filename) . '.pem', $publicKeyPem);
	
	print_r("PASO 7 - Guardo la clave publica y privada en disco!");print_r("<br />");
	
	
	//si bien ya tengo cargado el string de la clave privada, lo voy a buscar a disco para verificar que el archivo private_key.pem haya sido correctamente generado:
	$privateKeyPem = file_get_contents($target_dir . 'private_key_' . basename($filename) . '.pem');
	
	print_r("PASO 8- Verifico que private_key.pem este en disco!");print_r("<br />");
	
	//obtengo la clave privada como resource desde el string
	$resourcePrivateKey = openssl_get_privatekey($privateKeyPem);
	
	print_r("PASO 9- Obtengo la clave privada!");print_r("<br />");
	
	
	//crear la firma dentro de la variable $firma (la cual es pasada por referencia)
	if (!openssl_sign($datos, $firma, $resourcePrivateKey, OPENSSL_ALGO_SHA256)) {
		echo openssl_error_string(); //en el caso que la función anterior de openssl arrojará algun error, este sería visualizado gracias a esta línea
		exit;
	}
	
	print_r("PASO 10- Creo la firma!");print_r("<br />");
	
	// guardar la firma en disco:
	file_put_contents($target_dir . 'signature_' . basename($filename) . '.dat', $firma);
	
	print_r("PASO 11- Guardo la firma en disco!");print_r("<br />");
	
	// comprobar la firma
	if (openssl_verify($datos, $firma, $publicKeyPem, 'sha256WithRSAEncryption') === 1) {
		echo 'La firma es valida y los datos son confiables';
		print_r("<br />");
	} else {
		echo 'La firma es invalida y/o los datos fueron alterados';
		print_r("<br />");
		return 0;
	}
	
	print_r("PASO 12- Verifico firma!");print_r("<br />");
	return 1;
}

function Verify(string $filename, string $filename_f, string $filename_kp ) {
	
	print_r("PASO 2 - Entro en funcion verify!");print_r("<br />");
	
	$file = fopen($filename, 'rb');//rd: read en modo binario
	$datos = fread($file, filesize($filename));
    fclose($file);
	
	$file_f = fopen($filename_f, 'rb');//rd: read en modo binario
	$datos_f = fread($file_f, filesize($filename_f));
    fclose($file_f);
	
	$file_kp = fopen($filename_kp, 'rb');//rd: read en modo binario
	$datos_kp = fread($file_kp, filesize($filename_kp));
    fclose($file_kp);
	
	// comprobar la firma
	if (openssl_verify($datos, $datos_f, $datos_kp, 'sha256WithRSAEncryption') === 1) {
		echo 'La firma es valida y los datos son confiables';
		print_r("<br />");
	} else {
		echo 'La firma es invalida y/o los datos fueron alterados';
		print_r("<br />");
		return 0;
	}
	
	return 1;
}

?>