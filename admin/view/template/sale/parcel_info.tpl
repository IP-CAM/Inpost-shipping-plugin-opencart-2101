<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <?php if ($parcel_status == 'Created'): ?>
        <a href="<?php echo $edit; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <?php endif; ?>
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
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $text_order_detail; ?></h3>
          </div>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td><?php echo $text_order_id; ?></td>
                <td>#<?php echo $order_id; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_parcel_id; ?></td>
                <td><?php echo $parcel_id; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_parcel_status; ?></td>
                <td id="order-status"><?php echo $parcel_status; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_parcel_detail; ?></td>
                <td><?php echo $parcel_details; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_size; ?></td>
                <td><?php echo $size; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_parcel_machine; ?></td>
                <td><?php echo $parcel_machine; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_email; ?></td>
                <td><?php echo $email; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_mobile; ?></td>
                <td><?php echo $mobile; ?></td>
              </tr>
              <tr>
                <td><?php echo $text_creation_date; ?></td>
                <td><?php echo $creation_date . ' ' . $creation_time; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
