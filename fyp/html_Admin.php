<?php 

class HTML_Admin {

	public $baseurl;

	public $db_Obj;
	public $category;

	public function __construct()
	{
	    $this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";

		  $this->db_Obj = new DB_Class(); 
		  
	} // end of contructor

 

	public function GiveMe_seeOneuserPosts ()
	{
		echo '<div id="content_wrapper">
        	<div class="featured_image">
            <div class="head_box">Select User to See his/her all Posts </div>
	        </div> 
			<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 10px; padding-right: 20px; padding-bottom: 0px; padding-left: 20px; ">
				<div class="agileits-top">';



				echo ' <div id="audioDetails"><table  id="userPostsTable" class="table table-hover table-responsive "  style="font-size:11pt; display:none;"><thead style="width:100%;">
			        <tr>
			            <th>S/N</th>
			            <th>Title</th>
			            <th>Updating Time</th>
			            <th>Type</th>
			            <th>Price</th>
			            <th>Brand</th>
			            <th>Model</th>
			            <th>View</th>
			             
			        </tr> </thead> <tbody>';

	  		
				echo '</tbody> </table> </div>';



				echo '<div id="outputMain">
				<form method="post" name="form_oneUserPosts" id="form_oneUserPosts">
				  
				  <div class="row form-group">
				    <label for="userid" class="col-sm-3 col-form-label"> <span style="color:red"> *</span> Enter User ID : </label>
					<div class="col-sm-9">
				    	<input type="number" class="form-control" name="userid" placeholder="id" required ></div>
				  </div>
				  <input type="hidden"  class="hidden" name="oneUserPosts" value="oneUserPosts">

				  <input type="button" class="btn btn-primary btn-lg btn-block" value="Check Posts" onclick="Get_userPosts(this)">
				</form> 
				
				<br> <div id="output"> </div>

			</div></div></div></div> ';
	}


	
	public function GiveMe_WEB_INFO ()
	{


		$totalUsers = $this->db_Obj->total_Users();
		if($totalUsers == NULL) $totalUsers = 0; 
		//$totalUsers = $totalUsers-1;

		$displayADs = $this->db_Obj->total_displayADs();
		//if($displayADs == NULL) $displayADs = 0; 
		//else $displayADs = $displayADs-1;

		$totalSOLD = $this->db_Obj->total_ADs_SOLD();
		if($totalSOLD == NULL) $totalSOLD = 0; 
		//else $totalSOLD = $totalSOLD-1;

		
		$totalDeleted = $this->db_Obj->total_ADs_DELETE();
		if($totalDeleted == NULL) $totalDeleted = 0;
		//else $totalDeleted = $totalDeleted-1; 

		echo ' <div id="content_wrapper">
		
		
		<div class="featured_image"> 
		<div class="head_box"> Total Users Information </div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
			<table class="table table-striped">
				<tbody>
					<tr> 
						<th  style=" width:70%;"> Total Registered Users </th>
						<th  style=" width:29%;">'.$totalUsers .'</th>
					</tr> 
					<tr> 
						<th  style=" width:70%;"> Total Ads Displaying </th>
						<th  style=" width:29%;">'.$displayADs .'</th>
					</tr> 
					<tr> 
						<th  style=" width:70%;"> Total Sold Ads </th>
						<th  style=" width:29%;">'.$totalSOLD .'</th>
					</tr> 
					<tr> 
						<th  style="width:70%;"> Total Deleted Ads </th>
						<th  style="width:29%;">'.$totalDeleted .'</th>
					</tr>
				</tbody> 
			</table>
		 </div> </div></div>
		



		 <div class="featured_image">
		 <div class="head_box"> Top Sold Vehicle </div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Serial No</th>
						<th>Brand Name</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Toyota</td>
						<td> model2 </td>
					</tr> 
					<tr>
						<td>2</td>
						<td>Suzuki</td>
						<td> model25 </td>
					</tr>  
					<tr>
						<td> 3 </td>
						<td> Honda </td>
						<td> model2 </td>
					</tr> 
				</tbody>
		</table>
		 </div> </div></div>


		
		
		
		 <div class="featured_image">
		 <div class="head_box"> Top Searched Vehicle </div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
			<table class="table table-striped">
				<thead>
					<tr>
						<th> Serial No </th>
						<th> Searched </th> 
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> 1 </td> 
						<td> model2 </td>
					</tr> 
					<tr>
						<td> 2 </td> 
						<td> model25 </td>
					</tr>  
					<tr>
						<td> 3 </td>
						<td> Honda </td>
					</tr> 
				</tbody>
		</table>
		 </div> </div></div>
		
		
		
		</div> ';
	}


 
} // end of class


?>