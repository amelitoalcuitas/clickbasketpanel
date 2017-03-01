   <?php
    if($this->session->flashdata('success') == true){
      echo "<script> swal('Success!','Coupon successfully set!','success'); </script>";
    }
  ?>
 
 <div class="container-fluid">
            <div class="block-header">
                <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                COUPON LIST
                            </h2>
                            <div style="float:right; margin-top:-28px;">
                                <button data-target="#addCoupon" data-toggle="modal" name="" class="btn btn-primary"><i class="material-icons">add</i></button>
                            </div>

                        </div>
                        <div class="body">
                            <table id="couponTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th> SEASON </th>
                                        <th>COUPON CODE</th>
                                        <th>USES LEFT</th>
                                        <th>DISCOUNT</th>
                                        <th> DATE START </th>
                                        <th> DATE END </th>
                                        <th width="40px">EDIT</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <?php if (isset($coupons)){
                                      foreach($coupons as $row)
                                          { ?>
                                          <tr id="coupon_<?php echo $row->coupons_id; ?>" name="<?php echo $row->coupons_description; ?>">
                                            <td><?= $row->coupons_description ?></td>
                                            <td><?= $row->coupons_id ?></td>
                                            <td><?= $row->uses ?> / <?= $row->coupons_max ?></td>
                                            <td><?= ($row->coupondiscount_type == 'percentage' ? floor($row->coupons_discount).' %' :'Php '.$row->coupons_discount) ?></td>
                                            <td><?= $row->date_start ?></td>
                                            <td><?= $row->date_end ?></td>
                                            <td>
                                                <input type="hidden" id="ctype_<?php echo $row->coupons_id; ?>" value="<?= $row->coupondiscount_type ?>">
                                                <input type="hidden" id="cdisc_<?php echo $row->coupons_id; ?>" value="<?= $row->coupons_discount ?>">
                                                <input type="hidden" id="cmax_<?php echo $row->coupons_id; ?>" value="<?= $row->coupons_max ?>">
                                                <button onclick="editCoupon('<?php echo $row->coupons_id; ?>')" name="<?php echo $row->coupons_id; ?>" class="btn btn-success"><i class="material-icons">edit</i></button>
                                            </td>
                                          </tr>
                                    <?php }
                                      } else {

                                      }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
            </div>
</div>
