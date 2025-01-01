<?php
ini_set('max_execution_time', '0');

error_reporting(E_ALL);

include ('class_db.php');
include ('class_getTwitchUserData.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Streamer Setup</title>
	</head>
	<body>
		<h1>Streamer Setup</h1>
		<br><br>
		<?php
		if(isset($_POST['username']))
		{
			$tcr = new TwitchGetUser();

			$user_data = $tcr->run($_POST['username']);
			
			$id = $user_data['id'];
			$login = $user_data['login'];
			$display_name = $user_data['display_name'];
				
			$db = new db();
			$get_auto_increment = $db->get_auto_increment();
		}
		else if(isset($_POST['id']) && isset($_POST['login']) && isset($_POST['display_name']))
		{
			$db = new db();
			$result = $db->insert_data($_POST['id'], $_POST['login'], $_POST['display_name']);
			if($result)
			{
				echo "success!";
				die();
			}
			else
			{
				echo "ERROR!<br>";
				echo $result;
				die();
			}
			die();
		}
		else
		{
		}

		if( isset($id) && isset($login) && isset($display_name) )
		{
			?>
				<form action="setup.php" method="post">
					<table>
						<tr>
							<td>Twitch ID</td>
							<td><input type="text" name="id" value="<?php echo $id; ?>"></td>
						</tr>
						<tr>
							<td>Twitch Login</td>
							<td><input type="text" name="login" value="<?php echo $login; ?>"></td>
						</tr>
						<tr>
							<td>Twitch Display Name</td>
							<td><input type="text" name="display_name" value="<?php echo $display_name; ?>"></td>
						</tr>
						<tr>
							<td>MySQL ID</td>
							<td><input type="text" value="<?php echo $get_auto_increment['AUTO_INCREMENT']; ?>"></td>
						</tr>
					</table>
					<br><br>
					<input type="submit" value="Submit">
					<input type="button" onclick="location.href='setup.php';" value="Reset" />
				</form> 
			<?php
		}
		else
		{
			?>
			<form action="setup.php" method="post">
				<label for="username">Twitch Username:</label>
				<input type="text" id="username" name="username">
				<br><br>
				<input type="submit" value="Submit">
			</form> 
			<?php
		}
		?>
	</body>
</html> 