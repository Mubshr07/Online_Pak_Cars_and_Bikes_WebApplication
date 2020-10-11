<?php 

class I_SOLD_IT extends DB_Class {
	public $audioID;
	public $json_Msg = [];
	public function __construct(){ 
		//return ($id-1);
	}
	public function Sold($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['success_Msg'] = "Status Changed to SOLD";
		$this->json_Msg['sold_ok'] =  $this->changeStatus_to_SOLD($id);
		
		return $this->json_Msg;
	}
} //end of I_SOLD_IT Class



class I_DELETE_IT extends DB_Class {
	public $audioID;
	public $json_Msg = [];
	public function __construct(){ 
		//return ($id-1);
	}
	public function Delete_This($id){
		$this->json_Msg['id'] = $id;
		$this->json_Msg['success_Msg'] = "Status Changed to DELETE";
		$this->json_Msg['delete_ok'] =  $this->changeStatus_to_DELETE($id); 

		return $this->json_Msg;
	}
} //end of I_DELETE_IT Class

 




?>