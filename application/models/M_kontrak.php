<?php

class m_kontrak extends CI_Model {

    var $table = 'KONTRAK';

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
        return $this->db->query("SELECT KONTRAK_SEQ.NEXTVAL AS ID FROM DUAL")->row()->ID;
    }

    function getAll($cond = "") {

        if ($cond != "") {

            $this->db->where($cond);
        }
        return $this->db->get($this->table);
    }

    function getAll2($cond = "") {
        $this->db->select("$this->table.KONTRAK_ID");
        if ($cond != "") {

            $this->db->where($cond);
        }
        
        
        $this->db->from($this->table);
        $this->db->limit(1);
        $this->db->order_by("KONTRAK_ID", "DESC");
        $this->db->where("KONTRAK_NOMINAL >",1000000);
        return $this->db->get();
    }

    function get($id) {

        $this->db->where("KONTRAK_ID", $id);
        return $this->db->get($this->table)->row();
    }

    function getByPengadaan($id) {
        $this->db->select("$this->table.*");

        $this->db->select("TO_CHAR(TANGGAL_MULAI_KONTRAK, 'DD/MM/YYYY') AS TANGGAL_MULAI_KONTRAK", false);
        $this->db->select("TO_CHAR(TANGGAL_SELESAI_KONTRAK, 'DD/MM/YYYY') AS TANGGAL_SELESAI_KONTRAK", false);
        $this->db->select("TO_CHAR(TANGGAL_MULAI_PEKERJAAN, 'DD/MM/YYYY') AS TANGGAL_MULAI_PEKERJAAN", false);
        $this->db->select("TO_CHAR(TANGGAL_SELESAI_PEKERJAAN, 'DD/MM/YYYY') AS TANGGAL_SELESAI_PEKERJAAN", false);
        $this->db->from($this->table);
        $this->db->where("PENGADAAN_ID", $id);
        return $this->db->get()->row();
    }

    /* END OF READ */

    /* BEGIN UPDATE */

    function update($id, $data) {
        $this->db->where("KONTRAK_ID", $id);
        $this->db->update($this->table, $data);
    }

    /* END OF UPDATE */


    /* BEGIN DELETE */

    function delete($id) {
        $this->db->where("KONTRAK_ID", $id);
        $this->db->delete($this->table);
    }

    function deleteByPengadaan($id) {
        $this->db->where("PENGADAAN_ID", $id);
        $this->db->delete($this->table);
    }

    /* END OF DELETE */
}

?>
