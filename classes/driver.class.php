<?

	class Driver{
		
	private $dbconn;


/**************************Get Truck**********************************/

		public static function GetDriverTruck($driver_id=""){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "SELECT u1.name driver, u1.login_id, u1.user_status,d.*,u2.name as owner_name,u2.user_id as owner_id
				FROM  user u1
				INNER JOIN driver d ON d.user_id=u1.user_id
				INNER JOIN user u2 ON u2.user_id=d.owner_id
				where u1.user_id =3";
		// echo $query;die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();

			// SELECT u1.name driver, u1.login_id, u1.user_status, d.*, t.*,u2.name owner_name,u2.user_id owner_id
			// 			FROM user u1
			// 			INNER JOIN driver d ON u1.user_id = d.user_id
			// 			INNER JOIN truck t on t.user_id = u1.user_id
			// 			INNER JOIN user u2 on u2.user_id = d.owner_id
			// 			where u1.user_id =".$driver_id;
		} 
		
				
	
}// class end 


?>