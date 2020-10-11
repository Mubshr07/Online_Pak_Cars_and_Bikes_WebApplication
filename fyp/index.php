<?php

session_start();

  include 'redirect.php';

	$redirectObj = new Redirect();
	if((!empty($_GET)) && (isset($_GET['val']))) {
		
		$adID = 0;
		$urlVar = $_GET['val'];
		if(isset($_GET['ID']))
			$adID = $_GET['ID']; 
		if($urlVar == 'logout')
		{ 
			session_unset();  
			$redirectObj->Go_to_HOME_Page();
		}
		else if($urlVar == 'home')
		{
			$redirectObj->Go_to_HOME_Page() ;
		}
		else if($urlVar == 'registor')
		{
			$redirectObj->Go_to_Registration();
		}
		else if($urlVar == 'login')
		{
			$redirectObj->Go_to_Login() ;
		}
		else if($urlVar == 'upload')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_Upload();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'myprofile')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_myProfile();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'myAllPosts')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_User_All_Posts();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else if($urlVar == 'ADdetail')
		{ 
			$redirectObj->Go_to_ADdetail($adID) ;
		}
		else if($urlVar == 'ADedit')
		{ 
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_ADedit($adID) ;
			}
			else{
				$redirectObj->Go_to_Login();
			}			
		} 
		else if($urlVar == 'singleuserPosts')
		{
			$redirectObj->singleuserPosts();
		}
		else if($urlVar == 'webinfo')
		{
			if(isset($_SESSION["log"]) && $_SESSION['log']){
				$redirectObj->Go_to_WebInfo();
			}
			else{
				$redirectObj->Go_to_Login();
			}
		}
		else
		{
			$redirectObj->Go_to_HOME_Page();
		}
	}

	else if( isset($_GET['search'])) {
		$variable_Value = $_GET['search'];
		$value = $_GET['searchVal'];
		$redirectObj->Go_to_Search_Results($variable_Value, $value);
	}
	else if( isset($_GET['searchBar'])) {
		$variable_Value = $_GET['searchBar']; 
		$redirectObj->Go_to_SearchBar_Results($variable_Value);
	}
	else
	{
		$redirectObj->Go_to_HOME_Page();
	}

	

?>