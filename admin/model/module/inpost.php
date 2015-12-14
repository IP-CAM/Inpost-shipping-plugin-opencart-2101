<?php
########################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com  #
########################################################################################
class ModelModuleInpost extends Model
{
	/*
	 * Most modules do not require their own database access. If you do want to store some new data that doesn't fit into the existing
	 * database tables, you could create them here like the example function below.
	 * 
	 * This file is basically just included for completeness of the DIY module. There are some uses for it, but these are more advanced and
	 * by the time you get to those I doubt you'll be needing my help :)
	 */
	
	// This function is how my blog module creates it's tables to store blog entries. You would call this function in your controller in a
	// function called install(). The install() function is called automatically by OC versions 1.4.9.x, and maybe 1.4.8.x when a module is
	// installed in admin.
	public function createTable()
	{
		$sql = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . 
			"order_shipping_inpostparcels (
			id int(11) unsigned NOT NULL auto_increment,
			order_id int(11) NOT NULL,
			parcel_id varchar(200) NOT NULL default '',
			parcel_status varchar(200) NOT NULL default '',
			parcel_detail text NOT NULL default '',
			parcel_target_machine_id varchar(200) NOT NULL default '',
			parcel_target_machine_detail text NOT NULL default '',
			sticker_creation_date TIMESTAMP NULL DEFAULT NULL,
			creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			file_name text NOT NULL default '',
			api_source varchar(3) NOT NULL default '',
			variables text NOT NULL default '',
			PRIMARY KEY  id  (id)
			) DEFAULT CHARSET=utf8;";

		$query = $this->db->query($sql);
	}

	///
	// deleteTable function
	//
	// @brief Remove the InPost parcel data table.
	//
	public function deleteTable()
	{
		$sql = "DROP TABLE IF EXISTS " . DB_PREFIX . 
			"order_shipping_inpostparcels";

		$query = $this->db->query($sql);
	}

	///
	// getTotalParcels function
	//
	// @brief Return the total number of parcels in the database
	//
	// @return Total parcels int
	//
	public function getTotalParcels($data = array())
	{
      		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order_shipping_inpostparcels`";

		if (isset($data['filter_parcel_id']) && !is_null($data['filter_parcel_id'])) {
			$sql .= " WHERE parcel_id = '" . (int)$data['filter_parcel_id'] . "'";
		} else {
			$sql .= " WHERE order_id > '0'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_parcel_status'])) {
			$sql .= " AND parcel_status LIKE '%" . $this->db->escape($data['filter_parcel_status']) . "%'";
		}

		if (!empty($data['filter_machine'])) {
			$sql .= " AND parcel_target_machine_id = '" . $data['filter_machine'] . "'";
		}


		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(creation_date) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_sticker'])) {
			$sql .= " AND DATE(sticker_creation_date) = DATE('" . $this->db->escape($data['filter_date_sticker']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	///
	// getParcels function
	//
	// @brief Get all of the selected parcels
	//
	public function getParcels($data = array())
	{
		$sql = "SELECT * FROM `" . DB_PREFIX . "order_shipping_inpostparcels`";

		if (isset($data['filter_parcel_id']) && !is_null($data['filter_parcel_id'])) {
			$sql .= " WHERE parcel_id = '" . (int)$data['filter_parcel_id'] . "'";
		} else {
			$sql .= " WHERE order_id > '0'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_parcel_status'])) {
			$sql .= " AND parcel_status LIKE '%" . $this->db->escape($data['filter_parcel_status']) . "%'";
		}

		if (!empty($data['filter_target_machine_id'])) {
			$sql .= " AND parcel_target_machine_id = '" . $data['filter_target_machine_id'] . "'";
		}


		if (!empty($data['filter_creation_date'])) {
			$sql .= " AND DATE(creation_date) = DATE('" . $this->db->escape($data['filter_creation_date']) . "')";
		}

		if (!empty($data['filter_sticker_creation_date'])) {
			$sql .= " AND DATE(sticker_creation_date) = DATE('" . $this->db->escape($data['filter_sticker_creation_date']) . "')";
		}

		$sort_data = array(
			'order_id',
			'parcel_id',
			'parcel_status',
			'parcel_target_machine_id',
			'creation_date',
			'sticker_creation_date'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY order_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	///
	// getParcelDetails function
	//
	// @brief Get all of the details of the parcel
	//
	public function getParcelDetails($order_id)
	{
		$sql = "SELECT * FROM `" . DB_PREFIX . "order_shipping_inpostparcels` WHERE order_id = " . $order_id;

		$query = $this->db->query($sql);

		return $query->rows;
	}

	///
	// getParcel function
	//
	// @brief Get all of the details of the parcel
	//
	public function getParcel($order_id)
	{
		$sql = "SELECT * FROM `" . DB_PREFIX . "order_shipping_inpostparcels` WHERE order_id = " . $order_id;

		$query = $this->db->query($sql);

		if ($query->num_rows)
		{
			$var = explode(':', $query->row['variables']);

			return array(
				'order_id'       => $query->row['order_id'],
				'parcel_id'      => $query->row['parcel_id'],
				'parcel_status'  => $query->row['parcel_status'],
				'parcel_detail'  => $query->row['parcel_detail'],
				'parcel_machine' => $query->row['parcel_target_machine_id'],
				'mobile'         => $var[0],
				'size'           => $var[1],
				'email'          => $var[2],
				'creation_date'  => $query->row['creation_date'],
			);
		}
		else
		{
			return false;
		}
	}

	///
	// setParcelDetails function
	//
	// @brief Set the details of the parcel
	//
	public function setParcelDetails($order_id, $details)
	{
		$sql = "UPDATE `" . DB_PREFIX .
			"order_shipping_inpostparcels`" .
			" SET parcel_detail = '" . json_encode($details) .
			"' WHERE order_id = '" . $order_id . "'";

		$query = $this->db->query($sql);

		return $query;
	}

	///
	// setParcelId function
	//
	// @brief Set the Parcel ID of the order row.
	// @param String The order number to be saved against.
	// @param String The parcel ID to be saved.
	//
	public function setParcelId($order_id, $parcel_id)
	{
		$sql = "UPDATE `" . DB_PREFIX .
			"order_shipping_inpostparcels`" .
			" SET parcel_id = '" . $parcel_id .
			"' WHERE order_id = '" . $order_id . "'";

		$query = $this->db->query($sql);

		return $query;
	}

	///
	// setParcelStickerDate function
	//
	// @brief Set the date / time the sticker was created.
	//
	public function setParcelStickerDate($parcels, $filename)
	{
		$array_parcel = explode(';', $parcels);

		foreach($array_parcel as $parcel)
		{
			$sql = "UPDATE `" . DB_PREFIX .
				"order_shipping_inpostparcels`" .
				" SET sticker_creation_date = '" . date('Y-m-d H:i:s') .
				"', file_name = \"<a href='" . $filename . "' target='_blank'>Click Here</a>\"" .
				", parcel_status = 'Prepared' " .
				" WHERE parcel_id = '" . $parcel . "'";

			$query = $this->db->query($sql);
		}

		return $query;
	}

	///
	// setParcellToCancelled function
	//
	// @brief Change the status of the Order / Parcel to cancelled.
	//
	public function setParcelToCancelled($order_id)
	{
		$sql = "UPDATE `" . DB_PREFIX .
			"order_shipping_inpostparcels`" .
			" SET parcel_status = 'Cancelled'" .
			" WHERE order_id = '" . $order_id . "'";

		$query = $this->db->query($sql);

		return $query;
	}

	///
	// editParcel function
	//
	// @brief Allow the user to change some parcel details.
	//
	public function editParcel($order_id, $data)
	{
		$vars = $this->db->escape($data['mobile']) . ':' .
			$this->db->escape($data['size']) . ':' .
			$this->db->escape($data['email']);

		$sql = "UPDATE `" . DB_PREFIX .
			"order_shipping_inpostparcels`" .
			" SET variables = '" . $vars . "'" .
			", parcel_target_machine_id = '" .
			$this->db->escape($data['machine_id']) .
			"' WHERE order_id = '" . $order_id . "'";

		$query = $this->db->query($sql);

		return $query;
	}

}
?>
