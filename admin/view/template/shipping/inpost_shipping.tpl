<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-inpost" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-inpost" class="form-horizontal">
          <div class="row">
            <div class="col-sm-10">
                  <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo $entry_display_weight; ?><span data-toggle="tooltip" title="<?php echo $help_display_weight; ?>"</span></label>
              <div class="col-sm-10">
              <label class="radio-inline">
                <?php if ($inpost_shipping_display_weight) { ?>
                <input type="radio" name="inpost_shipping_display_weight" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="inpost_shipping_display_weight" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
                </label>
                <label class="radio-inline">
                <?php if (!$inpost_shipping_display_weight) { ?>
                <input type="radio" name="inpost_shipping_display_weight" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="inpost_shipping_display_weight" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
                </div>
              </div>
              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-weight-class"><?php echo $entry_weight_class; ?></label>
                <div class="col-sm-10">
                  <select name="inpost_shipping_weight_class_id" id="input-weight-class" class="form-control">
                  <?php foreach ($weight_classes as $weight_class) { ?>
                  <?php if ($weight_class['weight_class_id'] == $inpost_shipping_weight_class_id) { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tax-class"><?php echo $entry_tax_class; ?></label>
                <div class="col-sm-10">
                <select name="inpost_shipping_tax_class_id" id="input-tax-class" class="form-control">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $inpost_shipping_tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
              <select name="inpost_shipping_geo_zone_id" id="input-geo-zone" class="form-control">
                  <option value="0"><?php echo $text_all_zones; ?></option>
                  <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php if ($geo_zone['geo_zone_id'] == $inpost_shipping_geo_zone_id) { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                </div>
              </div>

              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-standard-rate"><?php echo $entry_rate; ?></label>
                <div class="col-sm-10">
              <input type="text" name="inpost_shipping_standard_parcels_rate" value="<?php echo $inpost_shipping_standard_parcels_rate; ?>" size="5" class="form-control" id="input-standard-rate" />
                </div>
              </div>

              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-shipping-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
              <select name="inpost_shipping_status" id="input-shipping-status" class="form-control">
                  <?php if ($inpost_shipping_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>

              <div class="form-group">
              <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
              <input type="text" name="inpost_shipping_sort_order" value="<?php echo $inpost_shipping_sort_order; ?>" size="1" id="input-sort-order" class="form-control" />
                </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 
