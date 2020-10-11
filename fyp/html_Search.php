<?php

class HTML_Search
{
	
	public $db_Obj;
	public $baseurl;

	public function __construct()
	{
		$this->db_Obj = new DB_Class();
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
	}

	public function Get_Search_Category($variable_Value, $value)
	{
		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box"> Ads of ' . $variable_Value . ' : ' . $value . ' </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%;  "> <div class="agileits-top">';
		
		$rows = NULL;
		if($variable_Value == "Type")
		{
			$rows = $this->db_Obj->Get_ADs_of_Types($value);
		}
		else if($variable_Value == "Brand")
		{
			$rows = $this->db_Obj->Get_ADs_of_Brands($value);
		} 
		$counts = mysqli_num_rows($rows);  
		if(!empty($rows) && $counts > 0) 
		{ 
			echo ' <div id="audioDetails">
			<div class="container custmhome">
			<div class="row">
			<div class="col-md-12"> 
			<div class="row">';
 			foreach ($rows as $row)
			{  
				if($row['soldDelete'] == 0)
				{
					echo ' <div class="col-md-3"> <div class="adBtn" > <a href="'. $this->baseurl.'?val=ADdetail&ID='.$row['id'].'">  
						<div class="adImage" >   <img style="max-width:100%; max-height:100%; margin:0 auto;  "  src="advertisementBank/'. $row['pics'].'" title="'.$row['title'].'" > </div>
						<div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div> ';
					echo '<span class="text-muted" style="font-size:12px; margin:0; padding:0; color:black;"> <span class="block-ellipsis" style=" font-size:12px; color:black;">Price '.$row['price'].' pkr</span>'
					.' Dated : <span class="font-italic " style=" font-size:12px; color:black;">'.$row['uploadingDate'].'</span>  </span> </div>  </a> </div>';
				}
		    } // end of foreach loop
			echo '</div></div></div></div> </div>';
		} // end of if empty($rows)
		else
		{
			echo '<div><ul> <li> No Ads of this Brand or Type is uploaded yet </li> </ul> </div>  ';
		}  
		echo ' </div></div></div> ';
	} // end of Get_Search_Category


	public function Get_SearchBar_HTML($variable_Value)
	{
		echo  '<div id="content_wrapper"> <div class="featured_image">
		<div class="head_box"> Search results : ' . $variable_Value . ' </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 1%; padding-right: 3%; padding-bottom: 1%; padding-left: 3%;  "> <div class="agileits-top">';
		
		$rows = NULL; 
		$counts = 0;
		$rows = $this->db_Obj->Get_ADs_for_SearchBar($variable_Value); 
		$this->db_Obj->Get_insert_in_SearchTable($variable_Value); 

		$counts = mysqli_num_rows($rows);  
		if(!empty($rows) && $counts > 0) 
		{ 
			echo ' <div id="audioDetails">
			<div class="container custmhome">
			<div class="row">
			<div class="col-md-12"> 
			<div class="row">';
 			foreach ($rows as $row)
			{  
				if($row['soldDelete'] == 0)
				{
					echo ' <div class="col-md-3"> <div class="adBtn" > <a href="'. $this->baseurl.'?val=ADdetail&ID='.$row['id'].'">  
						<div class="adImage" >   <img style="max-width:100%; max-height:100%; margin:0 auto;  "  src="advertisementBank/'. $row['pics'].'" title="'.$row['title'].'" > </div>
						<div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div> ';
					echo '<span class="text-muted" style="font-size:12px; margin:0; padding:0; color:black;"> <span class="block-ellipsis" style=" font-size:12px; color:black;">Price '.$row['price'].' pkr</span>'
					.' Dated : <span class="font-italic " style=" font-size:12px; color:black;">'.$row['uploadingDate'].'</span>  </span> </div>  </a> </div>';
				}
		    } // end of foreach loop
			echo '</div></div></div></div> </div>';
		} // end of if empty($rows)
		else
		{
			echo '<div><ul> <li> No Ads of this search :  ' . $variable_Value . '</li> </ul> </div>  ';
		}  
		echo ' </div></div></div> ';
	} // end of Get_SearchBar_HTML



}// end of class HTML_Search
