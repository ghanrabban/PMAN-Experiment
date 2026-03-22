<?php

class m_bidang extends CI_Model {

    var $table = 'BIDANG';
    var $view = 'BIDANG_SUBBIDANG';

    function __construct() {
        parent::__construct();
    }

    /* BEGIN CREATE */

    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    /* END OF CREATE */

    /* BEGIN READ */

    function id() {
        return $this->db->query("SELECT BIDANG_SEQ.NEXTVAL AS ID FROM DUAL")->row()->ID;
    }

    function getAll() {
        $this->db->order_by("BIDANG_NAMA");
        return $this->db->get($this->table);
    }
    
     function getAllBidang() {
 
        return $this->db->get($this->view);
    }

    function get($id) {
        $this->db->where("BIDANG_ID", intval($id));
        return $this->db->get($this->table)->row();
    }

    function getByPengadaan($id) {
        $this->db->where("JENIS_PENGADAAN_ID", intval($id));
        $this->db->order_by("BIDANG_KD");
        return $this->db->get($this->table);
    }

    function getMax($jp_id) {
        $this->db->select("max(BIDANG_KD) as max", false);
        $this->db->from($this->table);
        $this->db->where("JENIS_PENGADAAN_ID", intval($jp_id));
        return $this->db->get()->row();
    }

    function getNext($jp_id, $kd) {
        $this->db->where("BIDANG_KD >", $kd);
        $this->db->where("JENIS_PENGADAAN_ID", $jp_id);
        $this->db->order_by("BIDANG_KD", "asc");
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    function getPrev($jp_id, $kd) {
        $this->db->where("BIDANG_KD <", $kd);
        $this->db->where("JENIS_PENGADAAN_ID", $jp_id);
        $this->db->order_by("BIDANG_KD", "desc");
        $this->db->limit(1);
        return $this->db->get($this->table)->row();
    }

    /* END OF READ */

    /* BEGIN UPDATE */

    function update($id, $data) {
        $this->db->where("BIDANG_ID", $id);
        $this->db->update($this->table, $data);
    }

    /* END OF UPDATE */


    /* BEGIN DELETE */

    function delete($id) {
        $this->db->where("BIDANG_ID", $id);
        $this->db->delete($this->table);
    }

    /* END OF DELETE */
}

?>
