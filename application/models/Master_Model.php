<?php
class Master_Model extends CI_Model
{

 function fetch_all()
 {
  $this->db->order_by('id', 'DESC');
  return $this->db->get('users');
 }

 function insert_api($data)
 {
  $this->db->insert('users', $data);
  if($this->db->affected_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }


 function login($email,$password)
 {
  $this->db->where("email", $email);
  $this->db->where("password", $password);
  $query = $this->db->get('users');
  return $query->result_array();
 }

 function fetch_single_user($user_id)
 {
  $this->db->where("id", $user_id);
  $query = $this->db->get('users');
  return $query->result_array();
 }
 
}

