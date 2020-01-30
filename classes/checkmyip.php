<?php

function get_client_ip() 
{ 
    // Get REMOTE_ADDR as the Client IP. 
    $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR ); 

	$proxy_ip = "";
    // Check for headers used by proxy servers to send the Client IP. We should look for HTTP_CLIENT_IP before HTTP_X_FORWARDED_FOR.
    if (@$_SERVER["HTTP_CLIENT_IP"]) 
        $proxy_ip = @$_SERVER["HTTP_CLIENT_IP"];
    elseif (@$_SERVER["HTTP_X_FORWARDED_FOR"])
        $proxy_ip = @$_SERVER["HTTP_X_FORWARDED_FOR"]; 
	
	//$proxy_ip = "10.9.2.56";
    // Proxy is used, see if the specified Client IP is valid. Sometimes it's 10.x.x.x or 127.x.x.x... Just making sure. 
    if ($proxy_ip) 
    {
     //   if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $proxy_ip, $ip_list) ) 
      //  { 
			
       		if(ip_is_private($proxy_ip)==false) 
		
				$client_ip = $proxy_ip;

       // } 
    } 

	//return sprintf('%u', ip2long($client_ip)); 
    return $client_ip; 

}

$client_ip = get_client_ip();

/*print("<br><br>Remote IP = ". @$_SERVER['REMOTE_ADDR']);
print("<br><br>Client IP = ". @$_SERVER['HTTP_CLIENT_IP']);
print("<br><br>Proxy IP = ". @$_SERVER['HTTP_X_FORWARDED_FOR']);
print("<br><br>Client Detected IP = ". $client_ip);

//sprintf('%u', ip2long($client_ip));


print("<br><br>");*/

//print_r($_SERVER);


function ip_is_private ($ip) {

    $pri_addrs = array (
                      '10.0.0.0|10.255.255.255', // single class A network
                      '172.16.0.0|172.31.255.255', // 16 contiguous class B network
                      '192.168.0.0|192.168.255.255', // 256 contiguous class C network
                      '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
                      '127.0.0.0|127.255.255.255' // localhost
                     );

    $long_ip = ip2long ($ip);
    if ($long_ip != -1) {

        foreach ($pri_addrs AS $pri_addr) {
            list ($start, $end) = explode('|', $pri_addr);

             // IF IS PRIVATE
             if ($long_ip >= ip2long ($start) && $long_ip <= ip2long ($end)) {
                 return true;
             }
        }
    }

    return false;
}

?>	