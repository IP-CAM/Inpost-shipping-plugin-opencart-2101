<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
         <button type="submit" form="form-parcel" id="button-create" formtarget="_self" formaction="<?php echo $create; ?>" data-toggle="tooltip" title="<?php echo $button_create; ?>" class="btn btn-info"><?php echo $button_create; ?></button>
         <button type="submit" id="button-labels" form="form-parcel" formtarget="_blank" formaction="<?php echo $labels; ?>" data-toggle="tooltip" title="<?php echo $button_labels; ?>" class="btn btn-info"><?php echo $button_labels; ?></button>
         <button type="submit" id="button-cancel" form="form-parcel" formtarget="_self" formaction="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-danger"><?php echo $button_cancel; ?></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" id="input-order-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-machine-id"><?php echo $entry_machine_id; ?></label>
                <input type="text" name="filter_target_machine_id" value="<?php echo $filter_target_machine_id; ?>" placeholder="<?php echo $entry_machine_id; ?>" data-date-format="YYYY-MM-DD" id="input-machine-id" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-parcel-id"><?php echo $entry_parcel_id; ?></label>
                <input type="text" name="filter_parcel_id" value="<?php echo $filter_parcel_id; ?>" placeholder="<?php echo $entry_parcel_id; ?>" id="input-parcel-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-parcel-status"><?php echo $entry_parcel_status; ?></label>
                <select name="filter_parcel_status" id="input-parcel-status" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($select_parcel_status as $key => $order_status) { ?>
                  <?php if ($key == $filter_parcel_status) { ?>
                  <option value="<?php echo $order_status; ?>" selected="selected"><?php echo $order_status; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status; ?>"><?php echo $order_status; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-creation-date"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_creation_date" value="<?php echo $filter_creation_date; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-creation-date" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-sticker-date"><?php echo $entry_sticker_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_sticker_date" value="<?php echo $filter_sticker_creation_date; ?>" placeholder="<?php echo $entry_sticker_date; ?>" data-date-format="YYYY-MM-DD" id="input-sticker-date" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" target="_blank" id="form-parcel">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                  <td class="text-right"><?php if ($sort == 'order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'parcel_id') { ?>
                    <a href="<?php echo $sort_parcel_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_parcel_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_parcel_id; ?>"><?php echo $column_parcel_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'parcel_status') { ?>
                    <a href="<?php echo $sort_parcel_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_parcel_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_parcel_status; ?>"><?php echo $column_parcel_status; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'target_machine_id') { ?>
                    <a href="<?php echo $sort_target_machine_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_machine_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_target_machine_id; ?>"><?php echo $column_target_machine_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'creation_date') { ?>
                    <a href="<?php echo $sort_creation_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_creation_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_creation_date; ?>"><?php echo $column_creation_date; ?></a>
                    <?php } ?></td>
		  <td class="text-left"> <?php echo $column_file_name; ?> </td>
                  <td class="text-left"><?php if ($sort == 'sticker_creation_date') { ?>
                    <a href="<?php echo $sort_sticker_creation_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sticker_creation_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sticker_creation_date; ?>"><?php echo $column_sticker_creation_date; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($orders) && $orders) { ?>
                <?php foreach ($orders as $order) { ?>
                <tr>
                  <td class="text-center"><?php if ($order['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-right"><?php echo $order['order_id']; ?></td>
                  <td class="text-left"><?php echo $order['parcel_id']; ?></td>
                  <td class="text-left"><?php echo $order['parcel_status']; ?></td>
                  <td class="text-left"><?php echo $order['parcel_target_machine_id']; ?></td>
                  <td class="text-left"><?php echo $order['creation_date']; ?></td>
                  <td class="text-left"><?php echo $order['file_name']; ?></td>
                  <td class="text-left"><?php echo $order['sticker_creation_date']; ?></td>
                  <td class="text-right">
                    <a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                    <?php if ($order['parcel_status'] == 'Created') : ?>
                    <a href="<?php echo $order['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    <?php else: ?>
                    <a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary disabled"><i class="fa fa-pencil"></i></a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/inpost_parcel&token=<?php echo $token; ?>';

	var filter_order_id = $('input[name=\'filter_order_id\']').val();

	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	var filter_parcel_id = $('input[name=\'filter_parcel_id\']').val();

	if (filter_parcel_id) {
		url += '&filter_parcel_id=' + encodeURIComponent(filter_parcel_id);
	}
	var filter_target_machine_id = $('input[name=\'filter_target_machine_id\']').val();

	if (filter_target_machine_id) {
		url += '&filter_target_machine_id=' + encodeURIComponent(filter_target_machine_id);
	}

	var filter_parcel_status = $('select[name=\'filter_parcel_status\']').val();

	if (filter_parcel_status != '*') {
		url += '&filter_parcel_status=' + encodeURIComponent(filter_parcel_status);
	}

	var filter_creation_date = $('input[name=\'filter_creation_date\']').val();

	if (filter_creation_date) {
		url += '&filter_creation_date=' + encodeURIComponent(filter_creation_date);
	}
	var filter_sticker_date = $('input[name=\'filter_sticker_date\']').val();

	if (filter_sticker_date) {
		url += '&filter_sticker_creation_date=' + encodeURIComponent(filter_sticker_date);
	}

	location = url;
});
//--></script>  
  <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script>
<?php echo $footer; ?>
