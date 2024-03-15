<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		redirect('account/login', 'refresh');
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='off');
			
			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login succeed
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				redirect($this->mModule);
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}
		
		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render('login', 'empty');
	}

	public function fromfrontend($identity,$password)
	{
		$this->load->library('form_builder');
		$this->load->helper('encodedecode');
		$form = $this->form_builder->create_form();
		
		//$msg = "aW5mb0AjISomXiUkI18tfnNreWJvdW5kLmlv";
		$identity = decode($identity);
		$password = decode($password);
		//print("<pre>".print_r($decode_string,true)."</pre>");exit;
		//print("<pre>".print_r($password,true)."</pre>");
			
		if ($this->ion_auth->login($identity, $password, FALSE))
		{
			// login succeed
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
			redirect($this->mModule);
		}
		else
		{
			// login failed
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
			$this->mViewData['form'] = $form;
			$this->mBodyClass = 'login-page';
			$this->render('login', 'empty');
		}
			// display form when no POST data, or validation failed
			$this->mViewData['form'] = $form;
			$this->mBodyClass = 'login-page';
			$this->render('login', 'empty');
	}
}
