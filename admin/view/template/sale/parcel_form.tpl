<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-return" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-parcel" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_order_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="order_id" id="order_id" value="<?php echo $order_id; ?>" class="form-control" readonly />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_parcel_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="parcel_id" id="parcel_id" value="<?php echo $parcel_id; ?>" class="form-control" readonly />
               <input type="hidden" name="parcel_id" value="<?php echo $parcel_id; ?>" />
          </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="machine_id"><?php echo $entry_target_machine_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="machine_id" id="machine_id" value="<?php echo $target_machine_id; ?>" class="form-control" maxlength="20" />
		<a href="#" onClick="openMap(); return false;">Map</a>
                <?php if ($error_target_machine_id) { ?>
                <span class="error"><?php echo $error_target_machine_id; ?></span>
                <?php } ?>
            </div>
          </div>
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $text_email; ?></label>
            <div class="col-sm-10">
              <input type="text" name="email" id="input-email" value="<?php echo $email; ?>" class="form-control" />
                <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
                <?php } ?>
            </div>
          </div>
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-mobile"><?php echo $text_mobile; ?> (07)</label>
            <div class="col-sm-10">
              <input type="text" name="mobile" id="input-mobile" value="<?php echo $mobile; ?>" class="form-control" maxlength="9" />
                <?php if ($error_mobile) { ?>
                <span class="error"><?php echo $error_mobile; ?></span>
                <?php } ?>
            </div>
          </div>
        <div class="form-group required">
            <label for="input-size" class="col-sm-2 control-label"><?php echo $text_size; ?></label>
            <div class="col-sm-10">
                <select name="size" id="input-size" class="form-control">
                  <option value="">Please Select</option>
                  <?php foreach ($parcel_sizes as $key => $parcel_size) { ?>
                  <?php if ($size == $parcel_size) { ?>
                  <option value="<?php echo $key; ?>" selected="selected"><?php echo $parcel_size; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $key; ?>"><?php echo $parcel_size; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_size) { ?>
                <span class="error"><?php echo $error_size; ?></span>
                <?php } ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript" src="https://geowidget.inpost.co.uk/dropdown.php?field_to_update=machine_id&user_function=user_function"></script>
<script type="text/javascript"><!--
///
// user_function function
//
// @param value mixed string
// @return none
//
function user_function(value)
{
        //document.getElementById('inpost_data').value=value;
}
--></script>
<?php echo $footer; ?>
