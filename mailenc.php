<?php
 $cemail = 'srini@gmail.com';
 $password = '3jd974hr89h';
 $method = 'aes-256-cbc';
 
 $password = substr(hash('sha256', $password, true), 0, 32);
 $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
 $cmailencrypt = base64_encode(openssl_encrypt($cemail, $method, $password, OPENSSL_RAW_DATA, $iv));
 
 // My secret message 1234
 //$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
 
 //echo 'plaintext=' . $cemail . "\n";
 //echo 'cipher=' . $method . "\n";
 echo 'encrypted to: ' . $cmailencrypt . ' '; 
 //echo 'decrypted to: ' . $decrypted . ' ';
?> 