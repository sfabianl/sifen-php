<?php

include 'configSifen.php';


$secuencia     = '123456789';                                // dId del lote
$ruta_zip      = 'xml.zip';                        // archivo .zip a enviar



if (PHP_SAPI !== 'cli') {
    header('Content-Type: text/plain; charset=utf-8');
}


if (!is_file($ruta_zip)) {
    http_response_code(500);
    echo "ERROR: No se encontró el archivo ZIP en: {$ruta_zip}\n";
    exit;
}
if (!is_file($cert_file)) {
    http_response_code(500);
    echo "ERROR: No se encontró el certificado en: {$cert_file}\n";
    exit;
}


$zip_raw  = file_get_contents($ruta_zip);
$zip_b64  = base64_encode($zip_raw);


$xml = <<<XML
<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope">
  <env:Header/>
  <env:Body>
    <rEnvioLote xmlns="http://ekuatia.set.gov.py/sifen/xsd">
      <dId>{$secuencia}</dId>
      <xDE>{$zip_b64}</xDE>
    </rEnvioLote>
  </env:Body>
</env:Envelope>
XML;


$ch = curl_init($_UrlWSEnvio);
curl_setopt_array($ch, [
    CURLOPT_POST            => true,
    CURLOPT_POSTFIELDS      => $xml,
    CURLOPT_HTTPHEADER      => [
        'Content-Type: application/soap+xml; charset=utf-8',
        'Content-Length: ' . strlen($xml),
    ],
    CURLOPT_SSLCERT         => $cert_file,
    CURLOPT_SSLCERTTYPE     => $cert_type,          // 'P12' (o 'PEM')
    CURLOPT_SSLCERTPASSWD   => $cert_password,
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_HEADER          => true,
    CURLOPT_FOLLOWLOCATION  => false,
    CURLOPT_CONNECTTIMEOUT  => 10,
    CURLOPT_TIMEOUT         => 60,
]);

$response = curl_exec($ch);
$errno    = curl_errno($ch);
$errstr   = curl_error($ch);
$httpcode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


if ($errno !== 0) {
    http_response_code(502);
    echo "CURL_ERROR ({$errno}): {$errstr}\n";
    exit;
}


list($raw_headers, $body) = explode("\r\n\r\n", $response, 2);


echo $body;
