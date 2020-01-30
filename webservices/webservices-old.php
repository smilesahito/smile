<?
    include("../classes/common.class.php"); 
	
switch($_GET['action'])
{

	case "login":

		if(isset($_GET['uname']) && isset($_GET['pwd']))
		{	
			$user=array();
			$user['status']=0;

			if(Admin::GetLogin()) 
			{
				if(isset($_SESSION['sess_admin_access_level']) && $_SESSION['sess_admin_access_level']<>1)
				{
					$user['status']=1;
					$user['info']['type']=$_SESSION['sess_admin_access_level'];

					if(isset($_SESSION['sess_admin_id']))
					{
						$user['info']['id']=$_SESSION['sess_admin_id'];
					}

					if(isset($_SESSION['sess_admin_name']))
					{
						$user['info']['name']=$_SESSION['sess_admin_name'];
					}
					if($_SESSION['sess_admin_access_level']==4)
					{
					$truck = Driver::GetDriverTruck($_SESSION['sess_admin_id']); 
						$user['info']['truck_type']=$truck->truck_type;
						$user['info']['truck_company']=$truck->truck_company;
						$user['info']['truck_model']=$truck->truck_model;
						$user['info']['truck_capacity']=$truck->truck_capacity;
					}
				}
			}

			$login=json_encode($user);

			echo $login;
		}
	break;
		
	case "postedload":
		if(isset($_GET['user_id']))
		{
			$posted_loads = GoodsOwner::GetLoadPost($_GET['user_id']); 
		}
		else if(isset($_GET['truck_type']))
		{
			$posted_loads = GoodsOwner::GetLoadPost("",$_GET['truck_type']); 
		}

		if($posted_loads) 
		{
			foreach($posted_loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;
		
	case "acceptload":
		
		$loadpost=array();
		$loadpost['status']=0;

		$accept_load=GoodsOwner::AcceptLoad($_GET['user_id'],$_GET['load_id']); 
		$loadpost['status']=$accept_load;
		
		$loadpost_status=json_encode($loadpost);

		echo $loadpost_status;

	break;

	case "security_code":
		
		$securitycode=array();
		$securitycode['status']=0;

		$code=GoodsOwner::SecurityCodeCheck($_GET['load_id'],$_GET['security_code']); 
		if($code!="")
		{
			$securitycode['status']=1;
			
		}
		
		$securitycode_status=json_encode($securitycode);

		echo $securitycode_status;

	break;

	case "acceptedload":

		if(isset($_GET['user_id']))
		{
		  $loads = GoodsOwner::GetAcceptedLoad($_GET['user_id']);
		}
		else if(isset($_GET['owner_id']))
		{
		  $loads = GoodsOwner::GetAcceptedLoad("",$_GET['owner_id']);
		}
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;
		
	case "load":

		if(isset($_GET['user_id']) && isset($_GET['status']))
		{
		  $loads = Load::GetLoad($_GET['user_id'],"",$_GET['status']);
		}
		else if(isset($_GET['owner_id']) && isset($_GET['status']))
		{
		  $loads = Load::GetLoad("",$_GET['owner_id'],$_GET['status']);
		}
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;	
		
	case "ownerload":


		  $loads = GoodsOwner::GetOwnerLoad($_GET['owner_id']);
		
		if($loads) 
		{
			foreach($loads as $row)
			{
				$json[]=$row;
			}
			
			$posts=json_encode($json);
			echo $posts;
		}
	break;		
		
	case "addpickup":

	  Load::AddLoadPickup($_GET['load_id'],$_GET['latitude'],$_GET['longitude'],$_GET['status']);
	break;
		
	case "getpickup":

	 $load=Load::GetLoadPickup($_GET['load_id']);
		if($load) 
		{
				$json=(array) $load;
			
			$maxpicpoint=json_encode($json);
			echo $maxpicpoint;
		}
	break;
		
	case "addmsg":

	  Load::AddLoadMsg($_GET['load_id'],$_GET['text']);
	break;
		
	case "getmsg":

	 $load=Load::GetLoadMsg($_GET['load_id']);
		if($load) 
		{
			foreach($load as $row)
			{
				$json[]=$row;
			}
			
			$msg=json_encode($json);
			echo $msg;
		}
	break;
		
	case "server_key":
		
		$serverkey=array();
		$serverkey['goodsowner']=$_GET['goodsowner'];
		$serverkey['driver']=$_GET['driver'];
		$serverkey['token']=$_GET['token'];
		$serverkey['server_key']=$config["server_key"];
			
		
		$serverkey_detail=json_encode($serverkey);

		echo $serverkey_detail;

	break;

		
	case "addtoken":
		
		$loadpost['status']=0;

		$add_token=GoodsOwner::AddToken($owner_id,$_GET['token']); 
		
		if($add_token==1)
		{
			$add_token['status']=1;
		}
		
		$token_status=json_encode($add_token);

		echo $token_status;

	break;
		
	case "pushnotification":
		
		header("location: pushnotification.php?owner_id=$owner_id&title='".$title."'&body='".$body."'");
	break;
}

?>
