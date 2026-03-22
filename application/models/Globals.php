<?php
class Globals extends CI_Model
{

	public function __construct () {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function session_rule()
	{
		if($this->session->userdata('login') == "")
		{
			//get user data
			redirect('auth');
		}
	}

	public function requestData()
	{
		# code...
		$requestData = json_decode(file_get_contents('php://input'), true);
		// print_r($requestData);die();
		if ($requestData != '') {
			# code...
			foreach ($requestData as $key => $val)
			{
				$requestData[$key] = (is_array($val)) ? (($val == array()) ? 0 : $val) : filter_var($val, FILTER_SANITIZE_STRING) ;				
			}			
			return $requestData;
		}
		else
		{
			$this->session_rule();
		}
	}
	
	public function logStore($arg)
	{
		# code...
		$data = array();

		if ($arg == 'insert') {
			# code...
			$data = array('date_created' => date('Y-m-d H:i:s'), 'created_by_nip' => $this->session->userdata('sesNip'));
		}
		elseif ($arg == 'update') {
			# code...
			$data = array('date_updated' => date('Y-m-d H:i:s'), 'updated_by_nip' => $this->session->userdata('sesNip'));
		}
		elseif ($arg == 'delete') {
			# code...
			$data = array('date_updated' => date('Y-m-d H:i:s'), 'updated_by_nip' => $this->session->userdata('sesNip'));
		}		
		
		return ($this->session->userdata('sesNip') != '') ? $data : 0 ;
	}
	
	public function importSqlFromFile($lines,$table)
	{
		# code...
		$templine = '';		
		$index = 0;
		echo "===============================================================================";			
		echo "\n";
		echo "Sql Seeding";
		echo "\n";
		echo "===============================================================================";						
		echo "\n";		
		echo "Tunggu yah, import sedang diproses";
		echo ">\n";		
		echo "memuat data ".$table." => ";
		foreach ($lines as $line)
		{
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';')
				{
				echo $index;
				echo '-';				
				if (($index % 20) == 0) {
					# code...
					echo ">\n";
					echo "memuat data ".$table." => ";					
				}
				$this->db->query($templine);
				// Reset temp variable to empty
				$templine = '';
				$index++;
			}
		}
		echo ">\n";				
	}
	function update($t,$w, $d){
      $this->db->where($w);
   	  $this->db->update($t, $d);
  	}

	function delete($t,$w){
		$this->db->where($w);
		$this->db->delete($t);
	}
	public function toNum($num) {
		return chr(substr("000".($num+65),-3));
	}	
}
