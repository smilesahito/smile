<?php

		
		extract($_REQUEST);
		
		$file_path=$filepath.$file;
		
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=" . basename($file_path) . ""); 

		readfile ($file_path);
		exit(); 


?>		