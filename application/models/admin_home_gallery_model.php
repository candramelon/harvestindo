<?php

class Admin_home_gallery_model extends CI_Model{

	function __construct(){
		$this->load->database();
	}
	
	function list_data() {
		$query = "select * from home_gallery order by gallery_id";
        $query = $this->db->query($query);
       // query();
        if ($query->num_rows() == 0)
            return array();
        $data = $query->result_array();
        foreach ($data as $index => $row) {}
        return $data;
	}

	function read_id($id)
	{
		$this->db->select('a.*', 1); // ambil seluruh data
		$this->db->where('a.gallery_id', $id);
		$query = $this->db->get('home_gallery a', 1); // parameter limit harus 1
		$result = null; // inisialisasi variabel. biasakanlah, untuk mencegah warning dari php.
		foreach($query->result_array() as $row)	$result = ($row); // render dulu dunk!
		return $result; 
	}
	
	
	
	function create($data){

		$this->db->trans_start();
		$this->db->insert('home_gallery', $data);
		$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		return $id;
	}

	function update($data, $id){

		$this->db->trans_start();
		$this->db->where('gallery_id', $id);
		$this->db->update('home_gallery', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function show($id){
		$data['gallery_status'] = 1;
		$this->db->trans_start();
		$this->db->where('gallery_id', $id);
		$this->db->update('home_gallery', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function dont_show($id){
		$data['gallery_status'] = 0;
		$this->db->trans_start();
		$this->db->where('gallery_id', $id);
		$this->db->update('home_gallery', $data);
	
		$this->db->trans_complete();
		return $id;
	}
	
	function delete($id){

		$this->db->trans_start();
		$this->db->where('gallery_id', $id);
		$this->db->delete('home_gallery');
		$this->db->trans_complete();
		
	}

	function get_img($table, $column, $param){



		$sql = "select $column as result from $table where $param";
		
		$query = $this->db->query($sql);
		
		$result = null;
		foreach ($query->result_array() as $row) $result = ($row);
		return $result['result'];
	
		

	}	
	
}