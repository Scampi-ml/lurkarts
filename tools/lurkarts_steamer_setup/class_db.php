<?php
class db
{	
	public $conn_sql;	
		
	public $db_host				= '127.0.0.1';
	public $db_user				= 'xampp';
	public $db_password			= 'xampp';
	public $db_database			= 'lurkarts';
		
	public function __construct()
	{
		$this->conn_sql = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_database);
		
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			die();
		}
	}		

	public function get_auto_increment()
	{
		$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'lurkarts' AND TABLE_NAME = 'streamers' ";
		$result = $this->conn_sql->query($sql);
		return mysqli_fetch_array($result);
	}
	
	public function insert_data($id, $login, $display_name)
	{
		$sql = "INSERT INTO streamers (user_id, name, display_name) VALUES ('".$id."', '".$login."', '".$display_name."')";
		if ($this->conn_sql->query($sql) === TRUE)
		{
			return true;
		}
		else
		{
			return $conn->error;
		}

	}

	
	
	
	
}
?>