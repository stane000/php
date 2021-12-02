<?php 
	function pickerDateToMysql($pickerDate){
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $pickerDate);
		return $date->format('d. m. Y H:i:s');
	}  
    
	     
	function get_user_name($user, $users){
              
		while($row = mysqli_fetch_array($users))
		{
			if($user == $row["id"]){
				return $row["username"];
			}
			
		}
		return "no user";

		// $query  = "SELECT * FROM users";
		// $query .= " WHERE id='" .  $user. "' AND archive='N'";
		// $result = @mysqli_query($MySQL, $query);
		// $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		// return $row['username'];
		
	}

?>