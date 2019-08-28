<?php 



class FormsData{

	private $pdo;


	function __construct($pdo){
		$this->pdo = $pdo;
	}



	function getForms(){

		   $result = $this->pdo
						->query('SELECT * FROM forms')
						->fetchAll(PDO::FETCH_NUM);
	 	
	 	return $result;

	}


	function getForm($id){
		$result = $this->pdo->query('SELECT id, description from forms')->fetch(PDO::FETCH_NUM);

		$form = null;
		if($result!=null){

			$form = new Form();
			$form->Id=$result[0];
			$form->Description=$result[1];


		}

		return $form;

	}


	function getColumns($idForm){
		$result = $this->pdo
					   ->query('SELECT id, description, id_type, name from columns')
					   ->fetchAll(PDO::FETCH_NUM);

		$list = [];


		foreach($result as $row){
			$column =  new Column();
			$column->Id = $row[0];
			$column->Description = $row[1];
			$column->Type = $row[2];
			$column->Name = $row[3];

			array_push($list, $column);
		}

		return $list;
	}



	function saveForm($form){

		$this->insertForm($form);

	}


	function insertForm($form){
		$sql = "INSERT INTO forms (id, description) VALUES (?,?)";
		var_dump($sql);
		$stmt= $this->pdo->prepare($sql);
		$stmt->execute([$form->Id, $form->Description]);
	}



}

 ?>