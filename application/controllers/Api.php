<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('Master_Model');
  $this->load->library('form_validation');
 }

 function index()
 {
  $data = $this->Master_Model->fetch_all();
  echo json_encode($data->result_array());
 }
 
 function insert()
 {
  $this->form_validation->set_rules("first_name", "First Name", "required|alpha");
  $this->form_validation->set_rules("last_name", "Last Name", "required|alpha");
  $this->form_validation->set_rules("email", "Email", "required|valid_email");
  $this->form_validation->set_rules("phone_number", "Phone Number", "required|numeric|exact_length[10]");
  $this->form_validation->set_rules("password", "Password", "required|min_length[6]|max_length[12]");
  $array = array();
  if($this->form_validation->run())
  {
   $data = array(
    'first_name'    => trim($this->input->post('first_name')),
    'last_name'     => trim($this->input->post('last_name')),
    'email' 		=> trim($this->input->post('email')),
    'phone_number'  => trim($this->input->post('phone_number')),
    'password'      => base64_encode(trim($this->input->post('password'))), 

   );
   $this->Master_Model->insert_api($data);
   $array = array(
    'success'  => true
   );
  }
  else
  {
   $array = array(
    'error'              => true,
    'first_name_error'   => form_error('first_name'),
    'last_name_error'    => form_error('last_name'),
    'email_error'        => form_error('email'),
    'phone_number_error' => form_error('phone_number'),
    'password_error'     => form_error('password')
   );
  }
  echo json_encode($array, true);
 }

 function login()
 {
  $this->form_validation->set_rules("email", "Email", "required|valid_email");
  $this->form_validation->set_rules("password", "Password", "required|min_length[6]|max_length[12]");
  $array = array();
  if($this->form_validation->run())
  {
   $email	 =trim($this->input->post('email'));
   $password = base64_encode(trim($this->input->post('password')));
   $data = $this->Master_Model->login($email,$password);
   	foreach($data as $row)
	{
	    $array['first_name']   = $row["first_name"];
	    $array['last_name']    = $row["last_name"];
	    $array['email'] 	   = $row["email"];
	    $array['phone_number'] = $row["phone_number"];
	}
  }
  else
  {
   $array = array(
    'error'              => true,
    'email_error'        => form_error('email'),
    'password_error'     => form_error('password')
   );
  }
  echo json_encode($array, true);
 }

 function fetch_single()
 {
  if($this->input->post('id'))
  {
   $data = $this->Master_Model->fetch_single_user($this->input->post('id'));
   foreach($data as $row)
   {
    $output['first_name'] = $row["first_name"];
    $output['last_name'] = $row["last_name"];
   }
   echo json_encode(@ $output);
  }
 }
}






