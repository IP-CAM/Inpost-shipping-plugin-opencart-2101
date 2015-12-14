<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> <?php echo $text_about; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $text_register; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-apikey"><?php echo $label_api_key; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_api_key" placeholder="Your Unique API Key" value="<?php echo $inpost_api_key;?>" size="50" id="input-apikey" class="form-control" >
	      <?php if ($error_api_key): ?>
              <div class="text-danger"><?php echo $error_api_key; ?></div>
	      <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-apiurl"><?php echo $label_api_url; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_api_url" placeholder="Normally http://api-uk.easypack24.net/" value="<?php echo $inpost_api_url;?>" size="50" id="input-apiurl" class="form-control" >
	      <?php if($error_api_url) echo '<div class="text-danger">' . $error_api_url . '</div>'; ?>
            </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-maxweight"><?php echo $label_max_weight; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_max_weight" placeholder="Max Weight (15kg)" value="<?php echo $inpost_max_weight;?>" id="input-maxweight" class="form-control" >
	      <?php if($error_max_weight) echo '<div class="text-danger">' . $error_max_weight . '</div>'; ?>
            </div>
          </div>
          <div class="form-group">
          <label class="col-sm-2 control-label" for="input-sizea"><?php echo $label_max_sizea; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_max_sizea" placeholder="Usually 8x38x64" value="<?php echo $inpost_max_sizea;?>" id="input-sizea" class="form-control" >
	      <?php if($error_max_sizea) echo '<div class="text-danger">' . $error_max_sizea . '</div>'; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sizeb"><?php echo $label_max_sizeb; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_max_sizeb" placeholder="Usually 19x38x64" value="<?php echo $inpost_max_sizeb;?>" id="input-sizeb" class="form-control" >
	      <?php if($error_max_sizeb) echo '<div class="text-danger">' . $error_max_sizeb . '</div>'; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sizec"><?php echo $label_max_sizec; ?></label>
            <div class="col-sm-10">
              <input type="text" name="inpost_max_sizec" placeholder="Usually 41x38x64" value="<?php echo $inpost_max_sizec;?>" id="input-sizec" class="form-control" >
	      <?php if($error_max_sizec) echo '<div class="text-danger">' . $error_max_sizec . '</div>'; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-format"><?php echo $label_format; ?></label>
            <div class="col-sm-10">
              <select name="inpost_format" id="input-format" class="form-control">
                <option value="">Please select</option>
                <?php if ($inpost_format == "Pdf") : ?>
                <option value="Pdf" selected="selected"><?php echo $label_PDF; ?></option>
                <?php else: ?>
                <option value="Pdf"><?php echo $label_PDF; ?></option>
                <?php endif; ?>
                <?php if ($inpost_format == "Epl2") : ?>
                <option value="Epl2" selected="selected"><?php echo $label_EPL2; ?></option>
                <?php else: ?>
                <option value="Epl2"><?php echo $label_EPL2; ?></option>
                <?php endif; ?>
              </select>
	      <?php if($error_format) echo '<div class="text-danger">' . $error_format . '</div>'; ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
//--></script>
<?php echo $footer; ?>
