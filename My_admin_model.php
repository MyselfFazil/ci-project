<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_admin_model extends CI_Model{

	// table cloumns 
	public $user_login;
	public $user_pass;
	public $pass_salt;
	public $user_email;
	public $user_registered;
	public $user_nicename;

	public function __construct()
	{

	}

	public function create_user( $user_data = array() )
	{
		// get posted value and insert into users table
		$data = array(
			'user_pass'			=>	password_hash($user_data['password'], PASSWORD_BCRYPT),		
			'pass_salt' 		=>	password_hash($this->user_pass, PASSWORD_BCRYPT),
			'user_email' 		=>	$user_data['emailaddress'],
			'user_nicename' 	=>	$user_data['firstname'],
			'user_registered'	=>	date("Y-m-d h:i:s")
		);
		
		/*
		** set values for inserts - set() will also accept an optional third parameter ($escape), 
		** that will prevent data from being escaped if set to FALSE.
		*/

		$this->db->set($data);

		/*
		** Insert data into users table.
		*/

		$user = $this->db->insert('users');
		return $user;
	}	
}