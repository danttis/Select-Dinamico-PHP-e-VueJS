<?php

//Configura de acesso ao banco de dados
//conexão
$conexao = new PDO('mysql:host=localhost;dbname=Municipios', 'root','');
$conexao->exec("SET CHARACTER SET utf8_unicode_ci");
return $conexao;
?>
