<?php

// Store a string into the variable which
// needs to be encrypted
$simple_string = "YSr Inc";

// Display the original string
echo "Original String: " . $simple_string . "\n"."<br/>";

// Store cipher method
$ciphering = "BF-CBC";

// Use OpenSSL encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// Use random_bytes() function to generate a random initialization vector (iv)
$encryption_iv = random_bytes($iv_length);

// Alternatively, you can use a fixed iv if needed
// $encryption_iv = openssl_random_pseudo_bytes($iv_length);

// Use php_uname() as the encryption key
$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// Encryption process
$encryption = openssl_encrypt($simple_string, $ciphering,
	$encryption_key, $options, $encryption_iv);

// Display the encrypted string
echo "<br/>Encrypted String: " . $encryption . "\n"."<br/>";

// Decryption process
$test =
    "HkofRRsdSiFIGRISNI1UXnJ-TAsdBO
    IEFBgdGk5KBRYIC1|JWVI1VXNIRXoEYE9YNVA
    MIRkdRkYTExogSkcWIBdOGzcRB3|dBVtSBnIbQ
    FN2AkOKHAlkYzArCT5caTYZJ2ExXAcqXTpgKjB
    qbSsrBj83XV×ZRHUBU1ZVXjpSAx8WRhpFBxA3
    WnNg T30EXUBFAQZdVIUIUDUXERgcRzgNDUsK
    VQpSRwhRCE1 DB3ViTOsBCUdKUFQJAVcFIQxM
    RxMaFjcVOWVFDVZ5VVZ2A19DBk04|hoWGU1G
    BAOJT30KRI5QBE10VUYPVXdVztOCxMVR0gV
    GRIUREsCEx0kSk8cHRw3FDhLRQhNB1JPfHNa
    RFAeldeQE4HAxwXFxs6UgMcFkgdQhYUQhpK
    OxNMUBwaHkVNExgYIEZDBF4";

$decryption = openssl_decrypt($encryption, $ciphering,
	$encryption_key, $options, $encryption_iv);

// Display the decrypted string
echo "<br/>Decrypted String: " . $decryption;

?>
