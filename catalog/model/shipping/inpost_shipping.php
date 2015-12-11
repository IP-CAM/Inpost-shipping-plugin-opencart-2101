<?php
class ModelShippingInpostShipping extends Model
{
	///
	// getQuote function
	//
	function getQuote($address)
	{
		$this->load->language('shipping/inpost_shipping');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX .
			"zone_to_geo_zone WHERE geo_zone_id = '" .
			(int)$this->config->get('inpost_shipping_geo_zone_id') .
			"' AND country_id = '" . (int)$address['country_id'] .
			"' AND (zone_id = '" . (int)$address['zone_id'] .
			"' OR zone_id = '0')");
	
		if (!$this->config->get('inpost_shipping_geo_zone_id'))
		{
			$this->log->write('Config->get worked.');

			$status = true;
		}
		elseif ($query->num_rows)
		{
			$this->log->write('num_rows worked.');
			$status = true;
		}
		else
		{
			$this->log->write('status being set to false.');
			$status = false;
		}

		$quote_data = array();
	
		if ($status)
		{
			$max_weight = $this->config->get('inpost_max_weight');

			// The weight is converted into kg by the ystem.
			$weight = $this->cart->getWeight();
			$sub_total = $this->cart->getSubTotal();

			//$this->log->write('Weight = ' . $weight);

			if($weight > $max_weight)
			{
				// Total weight too high, can't use InPost
				$this->log->write('Weight is TOO high.');
				return array();
			}

			// Only allow shipping within the UK
			if ($address['iso_code_2'] == 'GB')
			{
				$cost        = 0;
				$parcel_size = 'A';

				// Check the Dimensions
				if(!$this->dimensions_ok($parcel_size))
				{
					$this->log->write('Parcel is TOO large.');
					return array();
				}

				$cost = $this->config->get('inpost_shipping_standard_parcels_rate');

				if ((string)$cost != '')
				{
					$title = $this->language->get('text_standard_parcels');
					
					if ($this->config->get('inpost_shipping_display_weight')) {
						$title .= ' (' . $this->language->get('text_weight') . ' ' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . ')';
					}

					$quote_data['standard_parcels'] = array(
						'code'         => 'inpost_shipping.standard_parcels',
						'title'        => $title,
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('inpost_shipping_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('inpost_shipping_tax_class_id'), $this->config->get('config_tax'))),
						'parcel_size'  => $parcel_size,
					);
				}
			}
		}

		$method_data = array();
		
		if ($quote_data)
		{
			$method_data = array(
				'code'       => 'inpost_shipping',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('inpost_shipping_sort_order'),
				'error'      => false
			);
		}
			
		return $method_data;
	}

	///
	// dimensions_ok function
	//
	// @brief go through the cart items and sum the size of the items.
	// @return true if dimensions OK, otherwise false
	//
	private function dimensions_ok(&$parcel_size)
	{
		// Defaults used at the end.
		$parcelSize   = 'A';
		$is_dimension = true;

		// Get the shipping method's configuration data.
		$maxDimensionFromConfigSizeA = explode('x', $this->config->get('inpost_max_sizea'));
		$maxDimensionFromConfigSizeB = explode('x', $this->config->get('inpost_max_sizeb'));
		$maxDimensionFromConfigSizeC = explode('x', $this->config->get('inpost_max_sizec'));

		// Process the various possible product sizes.
		$maxWidthFromConfigSizeA = (float)trim(@$maxDimensionFromConfigSizeA[0]);
		$maxHeightFromConfigSizeA = (float)trim(@$maxDimensionFromConfigSizeA[1]);
		$maxDepthFromConfigSizeA = (float)trim(@$maxDimensionFromConfigSizeA[2]);
    
		// flattening to one dimension
		$maxSumDimensionFromConfigSizeA = $maxWidthFromConfigSizeA +
			$maxHeightFromConfigSizeA + $maxDepthFromConfigSizeA;

		$maxWidthFromConfigSizeB = (float)trim(@$maxDimensionFromConfigSizeB[0]);
		$maxHeightFromConfigSizeB = (float)trim(@$maxDimensionFromConfigSizeB[1]);
		$maxDepthFromConfigSizeB = (float)trim(@$maxDimensionFromConfigSizeB[2]);
		// flattening to one dimension
		$maxSumDimensionFromConfigSizeB = $maxWidthFromConfigSizeB +
			$maxHeightFromConfigSizeB + $maxDepthFromConfigSizeB;
		
		$maxWidthFromConfigSizeC = (float)trim(@$maxDimensionFromConfigSizeC[0]);
		$maxHeightFromConfigSizeC = (float)trim(@$maxDimensionFromConfigSizeC[1]);
		$maxDepthFromConfigSizeC = (float)trim(@$maxDimensionFromConfigSizeC[2]);
		
		// flattening to one dimension
		$maxSumDimensionFromConfigSizeC = $maxWidthFromConfigSizeC +
			$maxHeightFromConfigSizeC + $maxDepthFromConfigSizeC;

		// Check if any of the dimensions are not set up correctly.
		if($maxWidthFromConfigSizeA == 0 ||
			$maxHeightFromConfigSizeA == 0 ||
		       	$maxDepthFromConfigSizeA  == 0 ||
			$maxWidthFromConfigSizeB  == 0 ||
			$maxHeightFromConfigSizeB == 0 ||
			$maxDepthFromConfigSizeB  == 0 ||
			$maxWidthFromConfigSizeC  == 0 ||
			$maxHeightFromConfigSizeC == 0 ||
			$maxDepthFromConfigSizeC  == 0)
		{
			// bad format in admin configuration
			$is_dimension = false;
		}
    
		$maxSumDimensionsFromProducts = 0;

		// Go through the products and check their dimensions
		// size=10 x 20 x 10 cm
		foreach ($this->cart->getProducts() as $product)
		{
			// $product['quantity'] is the order quantity.
			// The product weight is auto converted into kg but the length
			// is left as is. We run the values through the converter to get
			// back to cm.

			if ( $product['quantity'] > 0 && $product['shipping'] )
			{
				$width  = $this->length->convert($product['width'],
					$product['length_class_id'],
					$this->config->get('config_length_class_id'));
				$height = $this->length->convert($product['height'],
					$product['length_class_id'],
					$this->config->get('config_length_class_id'));
				$depth  = $this->length->convert($product['length'],
					$product['length_class_id'],
					$this->config->get('config_length_class_id'));

				if($width == 0 || $height == 0 || $depth == 0)
				{
					// empty dimension for product
					continue;
				}

				$calc_width  = $width  * $product['quantity'];
				$calc_height = $height * $product['quantity'];
				$calc_depth  = $depth  * $product['quantity'];

				if( $calc_width > $maxWidthFromConfigSizeC ||
					$calc_height > $maxHeightFromConfigSizeC ||
					$calc_depth  > $maxDepthFromConfigSizeC)
				{
					$is_dimension = false;
				}
				$maxSumDimensionsFromProducts += $width + $height + $depth;
				if($maxSumDimensionsFromProducts > $maxSumDimensionFromConfigSizeC)
				{
					$is_dimension = false;
				}
			}
		}
		
		if($maxSumDimensionsFromProducts <= $maxDimensionFromConfigSizeA)
		{
			$parcelSize = 'A';
		}
		elseif($maxSumDimensionsFromProducts <= $maxDimensionFromConfigSizeB)
		{
			$parcelSize = 'B';
		}
		elseif($maxSumDimensionsFromProducts <= $maxDimensionFromConfigSizeC)
		{
			$parcelSize = 'C';
		}

		// Save the parcel size to the session for retreival later
		$parcel_size = $parcelSize;

		return $is_dimension;
	}
}
?>
