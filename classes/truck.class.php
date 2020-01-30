<?

	class Truck{
		
	private $dbconn;


/**************************Get Truck**********************************/

		public static function GetTruck(){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from truck where status='Active'";
		
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 

		public static function GetTruckTypeList(){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from truck_type";
		
			$dbconn->SetQuery($query);

			return $dbconn->LoadObjectList();
		} 
		
		public static function GetTruckType($type_id){

			global $config;
			
			$dbconn=db::singleton();
			
			$query = "select * from truck_type where truck_type_id=$type_id";
			//echo $query; die;
			$dbconn->SetQuery($query);

			return $dbconn->LoadObject();
		} 
		
				
	
}// class end 


?>