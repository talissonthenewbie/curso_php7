<?php 
	require_once("config.php");
	

	/*$sql = new Sql();
	$usuarios=$sql->select("SELECT * FROM usuarios");
	echo json_encode($usuarios);*/

	/*$root = new Usuario();
	$root->loadID(50);
	echo $root;*/

	/*$lista = Usuario::getList();
	echo json_encode($lista);*/

	/*$busca = Usuario::busca("este3");
	echo json_encode($busca);*/


	/*$usuario = new Usuario();
	$usuario->login("teste", "senha0");
	echo $usuario;*/

	$aluno = new Usuario("talisson10", "testando");
	$aluno->insert();
	echo $aluno;