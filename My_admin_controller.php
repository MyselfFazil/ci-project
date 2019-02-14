<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_admin_controller extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('template');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('captcha');
		$this->load->library('general');		

		$data['stylesheets'] = $this->template->enqueue_css("required/css");
		$data['scripts'] = $this->template->enqueue_js("required/js", "", TRUE, $order = array(
			"jquery", "popper", "bootstrap", "general"
		));
		header("Access-Control-Allow-Origin: *");
		return $this->data = $data;
	}

	public function dashboard()
	{
		$data = $this->data;
		$data['gretting'] = "<h4>Welcome to dashboard</h4>";
		$this->template->set('title', 'Dashboard');
		$this->template->load('default', 'contents', 'pages/my-admin/dashboard', $data);		
	}	

	public function login()
	{
		$data = $this->data;
		$this->template->set('title', 'Login Form');

		$this->form_validation->set_rules('user_login', 'Email', 'required');
		$this->form_validation->set_rules('user_pass', 'Password', 'required');

		if( $this->form_validation->run() === FALSE ) 
		{	
			$this->template->load('default', 'contents', 'pages/my-admin/login', $data);
		}
		else
		{
			$this->template->set('title', 'Dashboard');
			$this->session->set_flashdata('post_data', $this->input->post());
			redirect('myadmin/dashboard');	
		}
	}


	public function register_new_user()
	{
		$data = $this->data;
		// Set the view
		$this->template->set('title', 'Sign up form');
		
        // check if form is sumbited
		if( $this->input->post() )
		{

			if( $this->form_validation->run() == FALSE )
			{
				$captcha = $this->general->set_captcha();
				$this->session->unset_userdata('captcha_code'); 
				$this->session->set_userdata('captcha_code', $captcha['word']);
				$data['captcha'] = $captcha;
				$this->template->load('default', 'contents', 'pages/my-admin/register-new-user', $data);
			} 
			else
			{
				$input_captcha = $this->input->post('captcha');
				$sess_captcha = $this->session->userdata('captcha_code');
				if($input_captcha === $sess_captcha)
				{
					//echo "Captcha code matched!";
					$this->load->model('my_admin_model');
					$user = $this->my_admin_model->create_user($this->input->post());
					if( $user === TRUE )
					{
						$this->session->set_flashdata('signup_response', "You're successfully registered!");
						$this->template->load('default', 'contents', 'pages/my-admin/login', $data);
						redirect('myadmin/login');
					} 
					else
					{
						$this->session->set_flashdata('signup_response', "There is a problem with registering you in the system!");
						$captcha = $this->general->set_captcha();
						$this->session->unset_userdata('captcha_code'); 
						$this->session->set_userdata('captcha_code', $captcha['word']); 
						$data['captcha'] = $captcha;
						$this->template->load('default', 'contents', 'pages/my-admin/register-new-user', $data);
					}

				}
				else
				{
					echo "Captcha code does not match! please try again.";
					$captcha = $this->general->set_captcha();
					$this->session->unset_userdata('captcha_code'); 
					$this->session->set_userdata('captcha_code', $captcha['word']); 
					$data['captcha'] = $captcha;
					$this->template->load('default', 'contents', 'pages/my-admin/register-new-user', $data);
				}
			}

		}
		else 
		{
			$captcha = $this->general->set_captcha();
			$this->session->unset_userdata('captcha_code'); 
			$this->session->set_userdata('captcha_code', $captcha['word']);
			// pass captcha image to view 
			$data['captcha'] = $captcha;
			// Load the view
			$this->template->load('default', 'contents', 'pages/my-admin/register-new-user', $data);
		}

	}

	public function username_check($str)
    {
        if ($str == 'test')
        {
                $this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }
}
