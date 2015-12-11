<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com  		   #
################################################################################################
class ControllerModuleInpost extends Controller
{
	private $error = array(); 

	///
	// install function
	//
	public function install()
	{
		$this->load->model('module/inpost');
		$this->model_module_inpost->createTable(); 
 
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('inpost', array('inpost_status'=>1));
	}

	///
	// uninstall function
	//
	public function uninstall()
	{
		//************************************************************
		// Do not delete the parcel table.
		// The user can do this, if wanted, using the DB manager.
		//************************************************************
		//$this->load->model('module/impost');
		//$this->model_module_inpost->deleteTable();
         
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('my_module', array('my_module_status'=>0));
	}

	///
	// index function
	//
	// @brief Do the main admin actions for the module.
	//
	public function index()
	{
		//Load the language file for this module
		$this->load->language('module/inpost');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
		{
			$this->model_setting_setting->editSetting('inpost', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		//This is how the language gets pulled through from the language file.
		//
		// If you want to use any extra language items - ie extra text on your admin page for any reason,
		// then just add an extra line to the $text_strings array with the name you want to call the extra text,
		// then add the same named item to the $_[] array in the language file.
		//
		// 'my_module_example' is added here as an example of how to add - see admin/language/english/module/my_module.php for the
		// other required part.
		
		$text_strings = array(
				'heading_title',
				'text_enabled',
				'text_disabled',
				'text_edit',
				'text_register',
				'text_about',
				'text_content_top',
				'text_content_bottom',
				'text_column_left',
				'text_column_right',
				'entry_layout',
				'entry_limit',
				'entry_image',
				'entry_position',
				'entry_status',
				'entry_sort_order',
				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove',
				'label_api_key', //this is an example extra field added
				'label_api_url',
				'label_max_weight',
				'label_max_sizea',
				'label_max_sizeb',
				'label_max_sizec',
				'label_err_api_key',
				'label_err_api_url',
				'label_err_max_weight',
				'label_err_max_sizea',
				'label_err_max_sizeb',
				'label_err_max_sizec',
		);
		
		foreach ($text_strings as $text)
		{
			$data[$text] = $this->language->get($text);
		}
		//END LANGUAGE
		
		//The following code pulls in the required data from either config files or user
		//submitted data (when the user presses save in admin). Add any extra config data
		// you want to store.
		//
		// NOTE: These must have the same names as the form data in your my_module.tpl file
		//
		$config_data = array(
			'inpost_api_url', //this becomes available in our view by the foreach loop just below.
			'inpost_api_key',
			'inpost_max_weight',
			'inpost_max_sizea',
			'inpost_max_sizeb',
			'inpost_max_sizec',
		);
		
		foreach ($config_data as $conf)
		{
			if (isset($this->request->post[$conf]))
			{
				$data[$conf] = $this->request->post[$conf];
			}
			else
			{
				$data[$conf] = $this->config->get($conf);
			}
		}
	
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if(isset($this->error['api_key']))
		{
			$data['error_api_key'] = $this->error['api_key'];
		}
		else
		{
			$data['error_api_key'] = '';
		}
		if(isset($this->error['api_url']))
		{
			$data['error_api_url'] = $this->error['api_url'];
		}
		else
		{
			$data['error_api_url'] = '';
		}
		if(isset($this->error['max_weight']))
		{
			$data['error_max_weight'] = $this->error['max_weight'];
		}
		else
		{
			$data['error_max_weight'] = '';
		}
		if(isset($this->error['max_sizea']))
		{
			$data['error_max_sizea'] = $this->error['max_sizea'];
		}
		else
		{
			$data['error_max_sizea'] = '';
		}
		if(isset($this->error['max_sizeb']))
		{
			$data['error_max_sizeb'] = $this->error['max_sizeb'];
		}
		else
		{
			$data['error_max_sizeb'] = '';
		}
		if(isset($this->error['max_sizec']))
		{
			$data['error_max_sizec'] = $this->error['max_sizec'];
		}
		else
		{
			$data['error_max_sizec'] = '';
		}

		// SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS
		// UNLESS YOU CHANGE YOUR MODULE NAME.
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
   		);

   		$data['breadcrumbs'][] = array(
       			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
   		);
		
   		$data['breadcrumbs'][] = array(
       			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/inpost', 'token=' . $this->session->data['token'], 'SSL'),
   		);
		
		$data['action'] = $this->url->link('module/inpost', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		// This code handles the situation where you have multiple
		// instances of this module, for different layouts.
		$data['modules'] = array();
		
		if (isset($this->request->post['inpost_module']))
		{
			$data['modules'] = $this->request->post['inpost_module'];
		}
		elseif ($this->config->get('inpost_module'))
		{ 
			$data['modules'] = $this->config->get('inpost_module');
		}		

		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		// Choose which template file will be used to display this request.
		$this->template = 'module/inpost.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		// Send the output.
		$this->response->setOutput($this->load->view('module/inpost.tpl', $data));
	}
	
	///
	// 
	// This function is called to ensure that the settings chosen by the admin user are allowed/valid.
	// You can add checks in here of your own.
	// 
	//
	private function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/inpost'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(strlen(utf8_decode($this->request->post['inpost_api_key'])) == 0)
		{
			$this->error['api_key'] = $this->language->get('label_err_api_key');
		}
		if(strlen(utf8_decode($this->request->post['inpost_api_url'])) == 0)
		{
			$this->error['api_url'] = $this->language->get('label_err_api_url');
		}
		if(strlen(utf8_decode($this->request->post['inpost_max_weight'])) == 0)
		{
			$this->error['max_weight'] = $this->language->get('label_err_max_weight');
		}
		if(strlen(utf8_decode($this->request->post['inpost_max_sizea'])) == 0)
		{
			$this->error['max_sizea'] = $this->language->get('label_err_max_sizea');
		}
		if(strlen(utf8_decode($this->request->post['inpost_max_sizeb'])) == 0)
		{
			$this->error['max_sizeb'] = $this->language->get('label_err_max_sizeb');
		}
		if(strlen(utf8_decode($this->request->post['inpost_max_sizec'])) == 0)
		{
			$this->error['max_sizec'] = $this->language->get('label_err_max_sizec');
		}

		if (!$this->error)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}	
	}


}
?>
