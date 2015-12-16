<?php
class ControllerSaleInpostParcel extends Controller
{
	private $error = array();

	public function index()
	{
		$this->load->language('sale/inpost_parcel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/inpost');

		$this->getList();
 	}

	///
	// update function
	//
	public function update()
	{
		$this->load->language('sale/inpost_parcel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/inpost');
    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm())
		{
			$this->model_module_inpost->editParcel($this->request->get['order_id'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}
			
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
												
			if (isset($this->request->get['filter_parcel_status'])) {
				$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
			}
			
			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}
													
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    		$this->getForm();
  	}

	///
	// getList function
	//
	// @brief Build a list of the current parcels
	//
	private function getList()
	{
		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

		if (isset($this->request->get['filter_parcel_id'])) {
			$filter_parcel_id = $this->request->get['filter_parcel_id'];
		} else {
			$filter_parcel_id = null;
		}

		if (isset($this->request->get['filter_target_machine_id'])) {
			$filter_target_machine_id = $this->request->get['filter_target_machine_id'];
		} else {
			$filter_target_machine_id = null;
		}
		
		if (isset($this->request->get['filter_parcel_status'])) {
			$filter_parcel_status = $this->request->get['filter_parcel_status'];
		} else {
			$filter_parcel_status = null;
		}
		
		if (isset($this->request->get['filter_creation_date'])) {
			$filter_creation_date = $this->request->get['filter_creation_date'];
		} else {
			$filter_creation_date = null;
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$filter_sticker_creation_date = $this->request->get['filter_sticker_creation_date'];
		} else {
			$filter_sticker_creation_date = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'order_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}
											
		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
   		);

   		$data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'),
   		);

		$data['create'] = $this->url->link('sale/inpost_parcel/create',
			'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('sale/inpost_parcel/cancel',
			'token=' . $this->session->data['token'], 'SSL');
		$data['modify'] = $this->url->link('sale/inpost_parcel/modify',
			'token=' . $this->session->data['token'], 'SSL');
		$data['labels'] = $this->url->link('sale/inpost_parcel/labels',
			'token=' . $this->session->data['token'], 'SSL');

		$data['orders'] = array();

		$filter_data = array(
			'filter_order_id'      => $filter_order_id,
			'filter_parcel_id'     => $filter_parcel_id,
			'filter_parcel_status' => $filter_parcel_status,
			'filter_target_machine_id' => $filter_target_machine_id,
			'filter_creation_date' => $filter_creation_date,
			'filter_sticker_creation_date' => $filter_sticker_creation_date,
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                => $this->config->get('config_admin_limit')
		);

		$order_total = $this->model_module_inpost->getTotalParcels($filter_data);
		$results = $this->model_module_inpost->getParcels($filter_data);

		foreach ($results as $result)
		{
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/inpost_parcel/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
			);

			if (strtotime($result['creation_date']) > strtotime('-' . (int)$this->config->get('config_order_edit') . ' day')) {
				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
				);
			}
			
			$data['orders'][] = array(
				'order_id'      => $result['order_id'],
				'parcel_id'     => $result['parcel_id'],
				'parcel_status' => $result['parcel_status'],
				'file_name'     => $result['file_name'],
				'parcel_target_machine_id' => $result['parcel_target_machine_id'],
				'creation_date' => date($this->language->get('date_format_short'), strtotime($result['creation_date'])),
				'sticker_creation_date' =>
				($result['sticker_creation_date'] == null ? '' : date($this->language->get('date_format_short'), strtotime($result['sticker_creation_date']))),
				'selected'      => isset($this->request->post['selected']) && in_array($result['order_id'], $this->request->post['selected']),
				'view'          => $this->url->link('sale/inpost_parcel/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'edit'          => $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
			);
		}

		$data['heading_title']     = $this->language->get('heading_title');
		$data['text_list']         = $this->language->get('text_list');
		$data['text_no_results']   = $this->language->get('text_no_results');
		$data['text_missing']      = $this->language->get('text_missing');

		$data['column_order_id']   = $this->language->get('column_order_id');
		$data['column_parcel_id']  = $this->language->get('column_parcel_id');
		$data['column_parcel_status']     = $this->language->get('column_parcel_status');
		$data['column_target_machine_id'] = $this->language->get('column_target_machine_id');
		$data['column_creation_date'] = $this->language->get('column_creation_date');
		$data['column_file_name']     = $this->language->get('column_file_name');
		$data['column_sticker_creation_date'] = $this->language->get('column_sticker_creation_date');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_order_id']      = $this->language->get('entry_order_id');
		$data['entry_parcel_id']     = $this->language->get('entry_parcel_id');
		$data['entry_date_added']    = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');
		$data['entry_sticker_date']  = $this->language->get('entry_sticker_date');
		$data['entry_machine_id']    = $this->language->get('entry_machine_id');
		$data['entry_parcel_status'] = $this->language->get('entry_parcel_status');

		// Get the data for the parcel status select
		$data['select_parcel_status'] = array(
		'Avizo'           => $this->language->get('select_avizo'),
		'Claimed'         => $this->language->get('select_claimed'),
		'Created'         => $this->language->get('select_created'),
		'CustomerDelivering' => $this->language->get('select_customerdelivering'),
		'CustomerSent'    => $this->language->get('select_customersent'),
		'CustomerStored'  => $this->language->get('select_customerstored'),
		'Delivered'       => $this->language->get('select_delivered'),
		'DeliveredToAgency' => $this->language->get('select_deliveredtoagency'),
		'Expired'         => $this->language->get('select_expired'),
		'InTransit'       => $this->language->get('select_intransit'),
		'LabelDestroyed'  => $this->language->get('select_labeldestroyed'),
		'LabelExpired'    => $this->language->get('select_labelexpired'),
		'Missing'         => $this->language->get('select_missing'),
		'NotDelivered'    => $this->language->get('select_notdelivered'),
		'Prepared'        => $this->language->get('select_prepared'),
		'RetunedToAgency' => $this->language->get('select_retunedtoagency'),
		'Sent'            => $this->language->get('select_sent'),
		'Stored'          => $this->language->get('select_stored'),
		);

		$data['button_create'] = $this->language->get('button_create');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_modify'] = $this->language->get('button_modify');
		$data['button_labels'] = $this->language->get('button_labels');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view']   = $this->language->get('button_view');
		$data['button_edit']   = $this->language->get('button_edit');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}

		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_order'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=order_id' . $url, 'SSL');
		$data['sort_parcel_id'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_id' . $url, 'SSL');
		$data['sort_parcel_status'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_status' . $url, 'SSL');
		$data['sort_target_machine_id'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_target_machine_id' . $url, 'SSL');
		$data['sort_creation_date'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=creation_date' . $url, 'SSL');
		$data['sort_sticker_creation_date'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=sticker_creation_date' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}
											
		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination        = new Pagination();
		$pagination->total = $order_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url   = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

		$data['filter_order_id']          = $filter_order_id;
		$data['filter_parcel_id']         = $filter_parcel_id;
		$data['filter_parcel_status']     = $filter_parcel_status;
		$data['filter_target_machine_id'] = $filter_target_machine_id;
		$data['filter_creation_date']     = $filter_creation_date;
		$data['filter_sticker_creation_date'] = $filter_sticker_creation_date;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/parcel_list.tpl', $data));
  	}

	///
	// validateForm function
	//
	private function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'sale/inpost_parcel'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['machine_id']) < 1) || (utf8_strlen($this->request->post['machine_id']) > 14))
		{
      			$this->error['target_machine_id'] = $this->language->get('error_machine_id');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])))
		{
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if ((utf8_strlen($this->request->post['mobile']) < 9) ||
			(utf8_strlen($this->request->post['mobile']) > 9))
		{
			$this->error['mobile'] = $this->language->get('error_mobile');
		}

		$t_size = utf8_strtoupper($this->request->post['size']);
		if ((utf8_strlen($this->request->post['size']) != 1) ||
			($t_size != 'A' && $t_size != 'B' && $t_size != 'C') )
		{
      			$this->error['size'] = $this->language->get('error_size');
    		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    
	
	///
	// create function
	//
	// @brief create the parcel(s).
	//
	public function create()
	{
		$this->language->load('sale/inpost_parcel');

		$json = array();

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected']))
		{
			$orders = $this->request->post['selected'];
		}
		elseif (isset($this->request->get['order_id']))
		{
			$orders[] = $this->request->get['order_id'];
		}
		
		$this->load->language('system/library/inpostparcels');
		$this->load->model('module/inpost');

		// Need to create our own object.
		$object_ip = new Inpostparcels();

		// Get the config details for URL & key.
		$api_url = $this->config->get('inpost_api_url');
		$api_key = $this->config->get('inpost_api_key');

		$this->log->write('url = ' . $api_url . ' key = ' . $api_key);

		foreach ($orders as $order_id)
		{
			$ret = $this->model_module_inpost->getParcelDetails($order_id);

			// Check that the search finds the Order # in the
			// table and that the Parcel has not already been
			// created.
			if($ret == null || count($ret) == 0 ||
				$ret[0]['parcel_id'] != '' ||
				$ret[0]['parcel_status'] == "Cancelled")
			{
				continue;
			}

			$arr = explode(':', $ret[0]['variables']);

			$params = array(
				'url'           => $api_url . 'parcels',
				'token'         => $api_key,
				'methodType'    => 'POST',
				'params' => array(
				'description'   => 'Order :' . $order_id,
				'receiver' => array(
					'phone' => $arr[0],
					'email' => $arr[2]
				),
				'size'           => $arr[1],
				'tmp_id'         => $object_ip->generate(4, 15),
				'target_machine' => $ret[0]['parcel_target_machine_id'],
			)
			);

			$reply = $object_ip->connectInpostparcels($params);

			$parcel_id = "";

			if($reply['info']['http_code'] == '201')
			{
				$parcel_id = $reply['result']->id;
				$this->model_module_inpost->setParcelId(
					$order_id, $reply['result']->id);
			}
			else
			{
				$this->log->write("Failed to create parcel. Error code: " . $reply['info']['http_code']);
				$this->session->data['success'] = "Failed to create parcel. Error code: " . $reply['info']['http_code'];
			}

			if(!$json && $parcel_id != "")
			{
				// Now pay for the parcel
				$params['url']        = $api_url .
					'parcels/' .
					$parcel_id . '/pay';
				$params['token']      = $api_key;
				$params['methodType'] = 'POST';
				$params['params']     = array();

				$reply = $object_ip->connectInpostparcels($params);
				if($reply['info']['http_code'] != '204')
				{
					// Failed to pay for a parcel.
					// Tell the user.
					$this->session->data['success'] = "Failed to pay for parcel. Error code: " . $reply['info']['http_code'];
					$this->log->write("Failed to pay for parcel. Error code: " . $reply['info']['http_code']);
				}
			}

			if(!$json && $parcel_id != "")
			{
				// Now get the details for the parcel
				$params['url']        = $api_url .
					'parcels/' .
					$parcel_id;
				$params['token']      = $api_key;
				$params['methodType'] = 'GET';
				$params['params']     = array();

				$reply = $object_ip->connectInpostparcels($params);

				if($reply['info']['http_code'] == '200')
				{
					$this->model_module_inpost->setParcelDetails(
						$order_id, $reply['result']);
				}
			}
		}

		// Now return to the list of parcels
		$this->getList();
  	}

	///
	// labels function
	//
	// @brief Create the label(s) for parcels
	//
	public function labels()
	{
		$this->language->load('sale/inpost_parcel');

		$data['title'] = $this->language->get('heading_title');

		if (isset($this->request->server['HTTPS']) &&
			(($this->request->server['HTTPS'] == 'on') ||
			($this->request->server['HTTPS'] == '1')))
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$this->load->model('module/inpost');

		if ($this->request->server['REQUEST_METHOD'] == 'POST')
		{
			$json = array();

			$data['orders'] = array();

			$orders = array();

			if (isset($this->request->post['selected']))
			{
				$orders = $this->request->post['selected'];
			}
			elseif (isset($this->request->get['order_id']))
			{
				$orders[] = $this->request->get['order_id'];
			}
		
			$this->load->language('system/library/inpostparcels');
			$this->load->model('module/inpost');

			// Need to create our own object.
			$object_ip = new Inpostparcels();

			// Get the config details for URL & key.
			$api_url      = $this->config->get('inpost_api_url');
			$api_key      = $this->config->get('inpost_api_key');
			$label_format = $this->config->get('inpost_format');

			$parcel_sticker = array();

			foreach ($orders as $order_id)
			{
				$ret = $this->model_module_inpost->getParcelDetails($order_id);

				// Check that the search finds the Order # in the
				// table and that the Parcel has not already been
				// created.
				if($ret == null || count($ret) == 0 ||
					$ret[0]['sticker_creation_date'] != null
				|| $ret[0]['parcel_status'] == 'Cancelled')
				{
					$this->log->write('Labels, continiuing...');
					continue;
				}

				$parcel_sticker[] = $ret[0]['parcel_id'];
			}

			if (count($parcel_sticker) > 0)
			{
				if (count($parcel_sticker) > 1)
				{
					$parcel_list = implode(';', $parcel_sticker);
				}
				else
				{
					$parcel_list = $parcel_sticker[0];
				}

				if (strcasecmp($label_format, 'Pdf') == 0)
				{
					$format = 'Pdf';
					$type   = 'normal';
				}
				else
				{
					$format = 'Epl2';
					$type   = 'A6P';
				}


				$params['url']        = $api_url .
					'stickers/' .
					$parcel_list;
				$params['token']      = $api_key;
					$params['methodType'] = 'GET';
				$params['params']     = array(
					'format' => $format,
					'id'     => $parcel_list,
					'type'   => $type,
				);

				$reply = $object_ip->connectInpostparcels($params);

				if ($reply['info']['http_code'] == '200')
				{
					date_default_timezone_set('Europe/London');
					$timestamp = date('ymdH', time());
					if (strcasecmp($label_format, 'Pdf') == 0)
					{
						$extension = '.pdf';
						$header = 'Content-type: application/pdf';
					}
					else
					{
						$extension = '.epl';
						$header = 'Content-type: application/text';
					}
					$file_name = $timestamp . $extension;

					// Output to screen
					header($header);
					header("Content-Disposition:attachment; filename=$file_name");
					echo base64_decode($reply['result']);

				// Try and save the PDF as a local (server) file
				$base_name = '/pdf_files/' . 'stickers_' .
					date('Y-m-d_H-i-s') . $extension;
				$dir_filename = dirname(__FILE__) .
					$base_name;
				$filename     = HTTP_SERVER . 'controller/sale' . $base_name;

				$file = fopen($dir_filename, 'wb');

				if ($file != false)
				{
				fwrite($file, base64_decode($reply['result']));

					fclose($file);

					$this->model_module_inpost->setParcelStickerDate(
						$parcel_list,
						$filename);

					$this->session->data['success'] = $this->language->get('text_success');
				}
				}
				else
				{
					//$this->error['warning'] = 
					$this->session->data['success'] = 
						"Failed to create labels for parcel. Error code: " .
						$reply['info']['http_code'];
					if (isset($this->error['warning']))
					{
						$data['error_warning'] = $this->error['warning'];
					}
					else
					{
						$data['error_warning'] = '';
					}
				}
			}
		}

		$this->response->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'], 'SSL'));
	}

	///
	// cancel function
	//
	// @brief Try and cancel the selected parcel.
	//
	public function cancel()
	{
		$this->language->load('sale/inpost_parcel');

		$data['title'] = $this->language->get('heading_title');

		if (isset($this->request->server['HTTPS']) &&
			(($this->request->server['HTTPS'] == 'on') ||
			($this->request->server['HTTPS'] == '1')))
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$this->load->model('module/inpost');

		if ($this->request->server['REQUEST_METHOD'] == 'POST')
		{
			$json = array();

			$data['orders'] = array();

			$orders = array();

			if (isset($this->request->post['selected']))
			{
				$orders = $this->request->post['selected'];
			}
			elseif (isset($this->request->get['order_id']))
			{
				$orders[] = $this->request->get['order_id'];
			}
		
			$this->load->language('system/library/inpostparcels');
			$this->load->model('module/inpost');

			// Need to create our own object.
			$object_ip = new Inpostparcels();

			// Get the config details for URL & key.
			$api_url = $this->config->get('inpost_api_url');
			$api_key = $this->config->get('inpost_api_key');

			foreach ($orders as $order_id)
			{
				$ret = $this->model_module_inpost->getParcelDetails($order_id);

				if($ret == null || count($ret) == 0 ||
				   $ret[0]['parcel_status'] == 'Cancelled')
				{
					continue;
				}

				// Check to see if the parcel is partially
				// created but not actually sent to InPost in
				// any way. I.e. not parcel ID.
				if($ret != null && $ret[0]['parcel_id'] == '')
				{
					// Simply update status.
					$this->model_module_inpost->setParcelToCancelled($order_id);
					$this->log->write('Cancel, updated as no parcel created, yet...');
					continue;
				}

				$reply = $this->cancelPreparedParcel($object_ip, $ret[0]['parcel_id'], $api_key, $api_url);

				if($reply['info']['http_code'] == '204')
				{
					// Nothing went wrong. Update status
					$this->model_module_inpost->setParcelToCancelled($order_id);
				}
				else
				{
					$this->session->data['success'] = 
						"Failed to cancel the parcel. Error code: " .
						$reply['info']['http_code'];
					if (isset($this->error['warning']))
					{
						$data['error_warning'] = $this->error['warning'];
					}
					else
					{
						$data['error_warning'] = '';
					}
				}
			}
		}

		$this->response->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'], 'SSL'));
	}

	///
	// cancelPreparedParcel function
	//
	// @brief Cancel a parcel which has not had stickers printed.
	//
	private function cancelPreparedParcel($object_ip, $parcel_id, $api_key, $api_url)
	{
		$params['url']        = $api_url . 'parcels/' .
				$parcel_id .
				'/cancel-prepared';
		$params['token']      = $api_key;
		$params['methodType'] = 'POST';
		$params['params']     = array();

		$reply = $object_ip->connectInpostparcels($params);

		//$this->log->write('Reply = ' . json_encode($reply));

		return $reply;
	}

	///
	// info function
	//
	// @brief Display the details of the Parcel
	//
	public function info()
	{
		$this->load->model('module/inpost');

		if (isset($this->request->get['order_id']))
		{
			$order_id = $this->request->get['order_id'];
		}
		else
		{
			$order_id = 0;
		}

		$order_info = $this->model_module_inpost->getParcel($order_id);

		if ($order_info)
		{
			$this->load->language('sale/inpost_parcel');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$text_strings = array(
				'text_order_id',
				'text_parcel_id',
				'text_email',
				'text_order_detail',
				'text_parcel_status',
				'text_parcel_detail',
				'text_parcel_machine',
				'text_mobile',
				'text_size',
				'text_creation_date',
				'button_edit',
				'button_cancel',
			);	

			foreach ($text_strings as $text)
			{
				$data[$text] = $this->language->get($text);
			}
			//END LANGUAGE

			$data['token'] = $this->session->data['token'];

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}
			
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
												
			if (isset($this->request->get['filter_parcel_status'])) {
				$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
			}
			
			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			);

			$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
			);

			$data['edit'] = $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');

			$data['cancel'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$data['order_id'] = $this->request->get['order_id'];
			
			$data['email']          = $order_info['email'];
			$data['parcel_id']      = $order_info['parcel_id'];
			$data['parcel_status']  = $order_info['parcel_status'];
			$data['parcel_details'] = $order_info['parcel_detail'];
			$data['parcel_machine'] = $order_info['parcel_machine'];

			$data['mobile']         = $order_info['mobile'];
			$data['size']           = $order_info['size'];
			$data['email']          = $order_info['email'];
			$data['creation_date'] = date($this->language->get('date_format_short'), strtotime($order_info['creation_date']));
			$data['creation_time'] = date($this->language->get('time_format'), strtotime($order_info['creation_date']));

			// API login
			$this->load->model('user/api');

			$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

			if ($api_info)
			{
				$data['api_id']  = $api_info['api_id'];
				$data['api_key'] = $api_info['key'];
				$data['api_ip']  = $this->request->server['REMOTE_ADDR'];
			}
			else
			{
				$data['api_id']  = '';
				$data['api_key'] = '';
				$data['api_ip']  = '';
			}

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('sale/parcel_info.tpl', $data));
		}
		else
		{
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'),
			);
		
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('error/not_found.tpl', $data));
		}	
	}

	///
	// getForm function
	//
	// @brief Allow the user to edit the parcel details.
	//
	public function getForm() 
	{
		$this->load->model('module/inpost');

		$text_strings = array(
			'heading_title',
			'text_form',
			'text_no_results',
			'text_default',
			'text_select',
			'text_none',
			'text_wait',
			'text_order',
			'entry_email',
			'entry_telephone',
			'text_order_id',
			'text_parcel_id',
			'text_email',
			'text_parcel_status',
			'text_parcel_detail',
			'entry_target_machine_id',
			'text_mobile',
			'text_size',
			'text_size_a',
			'text_size_b',
			'text_size_c',
			'text_creation_date',
			'button_save',
			'button_cancel',
		);	

		foreach ($text_strings as $text)
		{
			$data[$text] = $this->language->get($text);
		}
		//END LANGUAGE

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['mobile'])) {
			$data['error_mobile'] = $this->error['mobile'];
		} else {
			$data['error_mobile'] = '';
		}

 		if (isset($this->error['size'])) {
			$data['error_size'] = $this->error['size'];
		} else {
			$data['error_size'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		
 		if (isset($this->error['target_machine_id'])) {
			$data['error_target_machine_id'] = $this->error['target_machine_id'];
		} else {
			$data['error_target_machine_id'] = '';
		}
						
		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
		);

		$data['action'] = $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL');

		$data['save'] = $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['cancel'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['order_id']) &&
			($this->request->server['REQUEST_METHOD'] != 'POST'))
		{
			$order_info = $this->model_module_inpost->getParcel($this->request->get['order_id']);
		}

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['order_id'])) {
			$data['order_id'] = $this->request->get['order_id'];
		} else {
			$data['order_id'] = 0;
		}
					
		if (isset($this->request->server['HTTPS']) &&
			(($this->request->server['HTTPS'] == 'on') ||
			($this->request->server['HTTPS'] == '1')))
		{
			$data['store_url'] = HTTPS_CATALOG;
		}
		else
		{
			$data['store_url'] = HTTP_CATALOG;
		}
		
		if (isset($this->request->post['email']))
		{
      			$data['email'] = $this->request->post['email'];
		}
		elseif (!empty($order_info))
		{ 
				$data['email'] = $order_info['email'];
		}
		else
		{
      			$data['email'] = '';
    		}

		if (isset($this->request->post['parcel_id']))
		{
      			$data['parcel_id'] = $this->request->post['parcel_id'];
		}
		elseif (!empty($order_info))
		{
      			$data['parcel_id'] = $order_info['parcel_id'];
		}
		else
		{
      			$data['parcel_id'] = '';
		}

		if (isset($this->request->post['mobile']))
		{
      			$data['mobile'] = $this->request->post['mobile'];
		}
		elseif (!empty($order_info))
		{ 
				$data['mobile'] = $order_info['mobile'];
		}
		else
		{
      			$data['mobile'] = '';
    		}
		
		if (isset($this->request->post['size']))
		{
      			$data['size'] = $this->request->post['size'];
		}
		elseif (!empty($order_info))
		{ 
				$data['size'] = $order_info['size'];
		}
		else
		{
      			$data['size'] = '';
    		}	

		// Setup an array for the possible parcel sizes.
		$data['parcel_sizes'] = array(
			'A' => $data['text_size_a'],
			'B' => $data['text_size_b'],
			'C' => $data['text_size_c'],
		);

		if (isset($this->request->post['target_machine_id']))
		{
      		$data['target_machine_id'] = $this->request->post['target_machine_id'];
		}
		elseif (!empty($order_info))
		{ 
			$data['target_machine_id'] = $order_info['parcel_machine'];
		}
		else
		{
      			$data['target_machine_id'] = '';
    		}

		// Check that we have not somehow gotten here with an order
		// of the wrong status.
		if ($order_info['parcel_status'] != 'Created')
		{
			$this->error['warning'] = $this->language->get('error_wrong_status');
			$this->getList();
			return;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('sale/parcel_form.tpl', $data));
  	}

}
?>
