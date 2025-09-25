# PHP Helpers para SIFEN 🇵🇾

Este repositorio contiene pequeños ejemplos y ayudas en **PHP** orientados al uso del **SIFEN** (Sistema Integrado de Facturación Electrónica Nacional – SET Paraguay).

La idea es facilitar tareas comunes que se presentan en la integración con SIFEN, tales como:

- Generar y enviar lotes de documentos electrónicos (DE).
- Envío de XML comprimidos (ZIP) vía SOAP.
- Ejemplos de uso de certificados digitales (`.p12` / `.pem`) con `cURL`.
- Mostrar y depurar las respuestas XML devueltas por SIFEN.

## 📂 Contenido

- `enviar_lote_simple.php`  
  Script básico en PHP que toma un archivo ZIP, lo codifica en base64 y lo envía al endpoint SOAP de SIFEN usando un certificado digital.  
  Muestra la respuesta XML **tal cual** llega del servicio.

- Otros pequeños fragmentos de código en PHP para pruebas y automatizaciones.

## ⚡ Requisitos

- PHP 7.4+ con extensión `curl` habilitada.
- Certificado digital válido en formato `.p12` o `.pem`.
- Acceso a los endpoints de pruebas o producción de la SET.

## 🚀 Uso rápido

1. Ajustar variables en el script:
   ```php
   $endpoint      = 'https://...';        // URL SOAP de envío
   $secuencia     = '123456';             // dId del lote
   $ruta_zip      = '/ruta/al/lote.zip';  // archivo ZIP a enviar
   $cert_file     = '/ruta/certificado.p12';
   $cert_password = 'clave_certificado';
   $cert_type     = 'P12';
