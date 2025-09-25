<?php 

$ambiente=1;

$cert_file     = 'C:\xampp2\htdocs\envioLote\68c817ec6.p12';                 // .p12 o .pem
$cert_password = 'fs%M0n9n';                          // contraseña del .p12
$cert_type     = 'P12';                                      // 'P12' para .p12 — usa 'PEM' si corresponde

 if ($ambiente == '1') {
        $_UrlWSEnvio    = "https://sifen.set.gov.py/de/ws/async/recibe-lote.wsdl";
        $_UrlWSConsulta = "https://sifen.set.gov.py/de/ws/consultas/consulta-lote.wsdl";
 } else {
        $_UrlWSEnvio    = "https://sifen-test.set.gov.py/de/ws/async/recibe-lote.wsdl";
        $_UrlWSConsulta = "https://sifen-test.set.gov.py/de/ws/consultas/consulta-lote.wsdl";
 }
