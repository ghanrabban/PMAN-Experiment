<?php

class m_login extends CI_Model {

    var $table = 'user';

    function __construct() {
        parent::__construct();
    }

    /* BEGIN CREATE */

    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    /* END OF CREATE */

  
	

    function getAll($cond = "") {
        
        if($cond  != ""){
             $this->db->where($cond);
        }
        
        $this->db->order_by("USERNAME");
        return $this->db->get($this->table);
    }
	
	
    function get($id) {
        $this->db->where("USER_ID", "$id");
        return $this->db->get($this->table)->row();
    }
    
    function login($email, $password) {
        $this->db->where("email", strtolower($email));
        $this->db->where("password", ($password));
        return $this->db->get($this->table)->row();
    }

    /* END OF READ */

    /* BEGIN UPDATE */

    function update($id, $data) {
        $this->db->where("USER_ID", $id);
        $this->db->update($this->table, $data);
    }

    /* END OF UPDATE */


    /* BEGIN DELETE */

    function delete($id) {
        $this->db->where("USER_ID", $id);
        $this->db->delete($this->table);
    }

    /* END OF DELETE */
}

?>
