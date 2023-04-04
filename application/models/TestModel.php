<?php

/**
 * Crud Model
 */
class TestModel extends CI_Model
{
//     public function get_records()
// 	{
// 		$result = $this->db->get('tbl_list');
// 		return $result->result();
// 	}

        function __construct(){
            parent::__construct();
            $this->load->database();
        }
      
        public function get_entries()
        {
            $query = $this->db->get('tbl_list');
            // if (count($query->result()) > 0) {
            return $query->result();
            // }
        }
        //ajax create
	public function insert_entry($data){
                return $this->db->update('tbl_list', $data, array('id' => $data['id']));
    }


        public function single_entry($id){
                $this->db->select('*');
                $this->db->from('tbl_list');
                $this->db->where('id',$id);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->row();
                }
        }
        public function getRole($username,$password){
            $this->db->select('type');
            $this->db->from('tbl_list');
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            $query = $this->db->get();
            if(count($query->result()) > 0){
                return $query->row();
              }
        }
        public function delete_entry($id)
    {
        return $this->db->delete('tbl_list', array('id' => $id));
    }





		
 
		public function login($username, $password){
			$query = $this->db->get_where('tbl_list', array('username'=>$username, 'password'=>$password));
			return $query->row_array();
		}
 
        public function search($searchTerm)
        {
        $this->db->like('firstName', $searchTerm);
        $this->db->or_like('lastName', $searchTerm);
        $this->db->or_like('username', $searchTerm);
        $query = $this->db->get('tbl_list');
        return $query->result_array(); // return the search results as an array
        }

    
}