<?php 

function encrypt(string $filename, string $key) {

    $iv = '1234567890123456';

    $file = fopen($filename, 'rb');
    $fileData = fread($file, filesize($filename));
    fclose($file);

    $encryptedData = openssl_encrypt($fileData, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
	if ($encryptedData != "FALSE"){
		$fileToWrite = fopen($filename, 'wb');
		fwrite($fileToWrite, $encryptedData);
		fclose($fileToWrite);
		return 1;
	}
	return 0;
}

function decrypt(string $filename, string $key) {

    $iv = '1234567890123456';

    $file = fopen($filename, 'rb');
    $fileData = fread($file, filesize($filename));
    fclose($file);

    $decryptedData = openssl_decrypt($fileData, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);

    //$fileData = fopen($filename, 'wb');
    //fwrite($fileData, $decryptedData);
    //fclose($filename);
	return $decryptedData;
}
?>