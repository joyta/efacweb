<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['protocol'] = 'smtp';  // protocolo de envio de correo
$config['smtp_host'] = "ssl://smtp.gmail.com"; // dirección SMTP del servidor                              
$config['smtp_user'] = 'efacweb@gmail.com'; // Cargado desde parametro: remplazarlo por un cuenta real de Gmail - usuario SMTP
$config['smtp_pass'] = 'efacweb2015'; //Cargada desde parámetro
$config['smtp_port'] = 465; // 465 o el '587' --  Puerto SMTP 
$config['smtp_timeout'] = '30';  // Tiempo de espera SMTP(segundos)
$config['newline']  = "\r\n";
$config['crlf']  = "\r\n";
$config['mailtype'] = 'html'; // o text para texto sin HTML
$config['charset']    = 'utf-8';

