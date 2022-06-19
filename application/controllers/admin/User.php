<?php
	
	class User extends CI_Controller{


		public function index(){

			$tmp['user'] = $this->Login_model->getAll();


			$tmp['title'] = 'User';
			$tmp['content'] = 'admin/user/user_view';
			$this->load->view('admin/layout/template', $tmp);
		}

		public function add()
		{
			$user = $this->Login_model;
			$val = $this->form_validation;
			$val->set_rules($user->rules());


			if ($val->run()) {
				
				$user->save();
				$this->session->set_flashdata('success', 'Berhasil disimpan');

			}

			$tmp['user'] = $this->Login_model->getAll();

			$tmp['content'] = 'admin/user/form_add';
			$this->load->view('admin/layout/template', $tmp);
		}

		public function update($id_user =null)
		{
			$user = $this->Login_model;
			if (!isset($id_user)) redirect('admin/user');

	        $tmp["datauser"] = $user->getById($id_user);
	        if (!$tmp["datauser"]) show_404();		

	        $tmp['content'] = 'admin/user/form_edit';
			$this->load->view('admin/layout/template', $tmp);	    
		}

		public function updateData()
		{
			$user = $this->Login_model;
	        $val = $this->form_validation;
	        $val->set_rules($user->rules());

	        if ($val->run()) {
	            $user->update();
	            $this->session->set_flashdata('success', 'Berhasil disimpan');
	            redirect('admin/user');
	        }					
		}

		public function delete($id_user)
		{
	        if (!isset($id_user)) show_404();

	        if ($this->Login_model->delete($id_user)){
	            $this->session->set_flashdata('delete','Data Berhasil Dihapus!');
	            redirect(site_url('admin/user'));
        	}
    
		}
	}
?>