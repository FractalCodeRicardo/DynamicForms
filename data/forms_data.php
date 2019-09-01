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
		$result = $this->pdo->query('SELECT id, description from forms where id=' .$id)->fetch(PDO::FETCH_NUM);

		$form = null;
		if($result!=null){

			$form = new Form();
			$form->Id=$result[0];
			$form->Description=$result[1];


		}

		return $form;

	}


	function deleteForm($id){
		$command  = $this->pdo->prepare('DELETE FROM columns where id_form='. $id);
		$command->execute();


		$command = $this->pdo->prepare('DELETE FROM forms where id='. $id);
		$command->execute();
	}


	function getColumnsArray($idForm){
		$result = $this->pdo
					   ->query('SELECT id, description, id_type, name from columns where id_form='. $idForm)
					   ->fetchAll(PDO::FETCH_NUM);

		return $result;
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


	function getColumn($idColumn){
		$sql = 'SELECT id, description, id_type, name from columns where id='. $idColumn;

		$result = $this->pdo
					   ->query($sql)
					   ->fetch(PDO::FETCH_NUM);

	
		if($result==null)			   
			return null;

		$column =  new Column();

		$column->Id = $result[0];
		$column->Description = $result[1];
		$column->Type = $result[2];
		$column->Name = $result[3];

		return $column;
	}




	function saveForm($form){

		if($form->Id<=0)
			$this->insertForm($form);
		else
			$this->updateForm($form);
	}


	function insertForm($form){
		$sql = "INSERT INTO forms (id, description) VALUES (?,?)";

		$stmt= $this->pdo->prepare($sql);
		$stmt->execute([$form->Id, $form->Description]);
	}


	function saveColumn($idForm,$column){

		if($column->Id<=0)
			$this->insertColumn($idForm, $column);
		else
			$this->updateColumn($idForm, $column);
	}

	function insertColumn($idForm, $column){
		$sql = "INSERT INTO columns (id, description,id_type, name, id_form) VALUES (?,?,?,?,?)";

		$stmt= $this->pdo->prepare($sql);
		$result = $stmt->execute([$column->Id, $column->Description , $column->Type, $column->Name, $idForm]);

		if(!$result)
			var_dump($stmt->errorInfo());
	
	}

	function updateColumn($idForm, $column){
		$sql = "UPDATE columns SET description=?, id_type=?, name=? where id=" . $column->Id;
		$stmt= $this->pdo->prepare($sql);
		$result=$stmt->execute([$column->Description, $column->Type, $column->Name ]);


		if(!$result)
			var_dump($stmt->errorInfo());
	}


	function updateForm($form){
		$sql = "UPDATE forms SET description=? where id=" . $form->Id;
		$stmt= $this->pdo->prepare($sql);
		$result=$stmt->execute([$form->Description]);


		if(!$result)
			var_dump($stmt->errorInfo());
	}




}

 ?>