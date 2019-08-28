<?php 

class Connection
{

	private $hostName='127.0.0.1';
	private $dataBase='dynamic_forms';
	private $user='root';
	private $password='toor';



	function __construct(){

	}

	


	function getPDO(){


		try
        {
            $dns = "mysql:host=" . $this->hostName . ";dbname=" . $this->dataBase;
			$pdo = new PDO($dns, $this->user, $this->password);

			return $pdo;
        }
        catch(PDOException $e)
        {
            print "Error Founds: ".$e->getMessage().PHP_EOL;
            die();
        }

		return null;
	}

}

 ?>