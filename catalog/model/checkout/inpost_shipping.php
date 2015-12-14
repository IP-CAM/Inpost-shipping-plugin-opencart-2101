<?php
class ModelCheckoutInpostShipping extends Model
{
	public function addParcel($data)
	{
		$this->db->query("INSERT INTO `" . DB_PREFIX .
			"order_shipping_inpostparcels` SET order_id = '" .
			$this->db->escape($data['order_id']) .
			"', parcel_target_machine_id = '" .
			$this->db->escape($data['locker_id']) .
			"', variables = '" .
			$this->db->escape($data['mobile_number']) . ":" .
			$this->db->escape($data['parcel_size']) . ":" .
			$this->db->escape($data['email']) .
			"', parcel_status = 'Created', api_source='UK'" );

		$order_id = $this->db->getLastId();

		return $order_id;
	}

}
?>
