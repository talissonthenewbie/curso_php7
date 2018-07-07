<?php 
class Usuario{
	private $id_usuario;
	private $login;
	private $senha;
	private $dt_cadastro;


	public function getIdUsuario(){
		return $this->id_usuario;
	}

	public function setIdUsuario($value){
		$this->id_usuario = $value;
	}


	public function getLogin(){
		return $this->login;
	}

	public function setLogin($value){
		$this->login = $value;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $value;
	}

	public function getDtCadastro(){
		return $this->dt_cadastro;
	}

	public function setDtCadastro($value){
		$this->dt_cadastro = $value;
	}


	public function loadID($id){
		$sql = new Sql();
		$resultado = $sql->select("SELECT * FROM usuarios WHERE id_usuario = :ID", array(':ID' =>$id));
		if(count($resultado)>0){
			$this->setData($resultado[0]);
		}
	}



	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM usuarios ORDER BY login;");
	}


	public static function busca($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM usuarios WHERE login LIKE :BUSCA ORDER BY LOGIN", array(
			':BUSCA'=>"%".$login."%"
		));
	}	



	public function login($login, $senha){

		$sql = new Sql();
		$resultado = $sql->select("SELECT * FROM usuarios WHERE login = :LOGIN AND senha = :SENHA", array(":LOGIN" =>$login, ":SENHA"=>$senha));
		if(count($resultado)>0){

			$this->setData($resultado[0]);
			
		}
		else {
					throw new Exception("Login e/ou senha inválidos");
					
				}		
	}


	public function setData($data){
		$this->setIdUsuario($data['id_usuario']);
		$this->setLogin($data['login']);
		$this->setSenha($data['senha']);
		$this->setDtCadastro(new DateTime($data['dt_cadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			':LOGIN'=>$this->getLogin(), ':SENHA'=>$this->getSenha()
		));
		if(count($resultado)>0){

			$this->setData($resultado[0]);
			
		}
	}

	public function __construct($login = "", $senha=""){
		$this->setLogin=$login;
		$this->setSenha=$senha;
	}

	public function __toString(){
			return json_encode(array(
				'id_usuario'=>$this->getIdUsuario(),
				'login'=>$this->getLogin(),
				'senha'=>$this->getSenha(),
				'dt_cadastro'=>$this->getDtCadastro()->format('d/m/Y - H:i:s')

			));
		}



}
 ?>
