<?php
###############################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars                      #
#  http://opencart.hostjars.com   	                                      #
###############################################################################

/*
 * This file contains the english version of any static text required by your
 * module in the admin area.
 * If you want to translate your module to another language, the idea is that
 * you can just replace the right hand column below with the changed
 * language, rather than modifying every file in your module.
 * 
 * We will call these language strings through in the controller to make them
 * available in the view. 
 * 
 * For your module, think about any text that you want to display and add it
 * in here. Also replace all the "My Module" text for the name of your module.
 * 
 */

// Example field added (see related part in admin/controller/module/my_module.php)
$_['label_api_key']    = 'API Key';
$_['label_api_url']    = 'API URL';
$_['label_format']     = 'Label Format. PDF or EPL2';
$_['label_max_weight'] = 'Maximum Weight (kg)';
$_['label_max_sizea']  = 'Maximum Size A (cm)';
$_['label_max_sizeb']  = 'Maximum Size B (cm)';
$_['label_max_sizec']  = 'Maximum Size C (cm)';
$_['label_PDF']        = 'PDF';
$_['label_EPL2']       = 'EPL2';

// Error text
$_['label_err_api_key']    = 'API Key must be filled.';
$_['label_err_api_url']    = 'API URL must be filled.';
$_['label_err_max_weight'] = 'Max Weight must be filled.';
$_['label_err_max_sizea']  = 'Max Size A must be filled.';
$_['label_err_max_sizeb']  = 'Max Size B must be filled.';
$_['label_err_max_sizec']  = 'Max Size C must be filled.';
$_['label_err_format']     = 'The format for labels must be picked.';

// Heading Goes here:
$_['heading_title']    = 'InPost Shipping';

// Text
$_['text_module']         = 'Modules';
$_['text_success']        = 'Success: You have modified module InPost Shipping!';
$_['text_edit']        	  = 'Edit InPost module';
$_['text_register']       = 'You will need to have an InPost API Key to continue.';
$_['text_about']       	  = 'The InPost module allows you to send parcels to automated locker machines.';
$_['text_content_top']    = 'Content Top';
$_['text_content_bottom'] = 'Content Bottom';
$_['text_column_left']    = 'Column Left';
$_['text_column_right']   = 'Column Right';
$_['text_order_id']       = 'Order ID';
$_['text_email']          = 'Recipient Email';
$_['text_parcel_status']  = 'Status';
$_['text_parcel_id']      = 'Parcel ID';
$_['text_parcel_detail']  = 'Parcel Details';
$_['text_parcel_machine'] = 'Machine Location';
$_['text_mobile']         = 'Recipient Mobile';
$_['text_size']           = 'Parcel Size';
$_['text_creation_date']  = 'Date Added';

$_['button_cancel']       = 'Cancel';

// Entry
$_['entry_example']       = 'Example Entry:'; // this will be pulled through to the controller, then made available to be displayed in the view.
$_['entry_image']         = 'Image (WxH):';
$_['entry_limit']         = 'Limit:';
$_['entry_layout']        = 'Layout:';
$_['entry_position']      = 'Position:';
$_['entry_status']        = 'Status:';
$_['entry_sort_order']    = 'Sort Order:';
$_['entry_format']        = 'Format:';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify module InPost Shipping!';
?>
