<!-- DELETED PRODUCTS LIST -->

<div class="container-fluid">
           <div class="block-header">
               <!-- Basic Examples -->
           <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                       <div class="header">
                           <h2>
                               DELETED PRODUCT LIST
                           </h2>
                       </div>
                       <div class="body">
                           <table id="delproductTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                               <thead>
                                   <tr>
                                       <th >PRODUCT NAME</th>
                                       <th width="115px">CATEGORY</th>
                                       <th width="115px">SUB-CATEGORY</th>
                                       <th width="30px">QTY</th>
                                       <th width="80px">PRICE</th>
                                       <th width="50px"></th>
                                   </tr>
                               </thead>

                               <tbody>
                                 <?php if (isset($delproductlist)){
                                     foreach($delproductlist as $row)
                                         { ?>
                                         <tr id="product_<?php echo $row->prod_id; ?>" name="<?php echo $row->prod_name; ?>">
                                         <td><?php echo $row->prod_name; ?></td>
                                         <td id="selectedcat_<?php echo $row->prod_id; ?>" value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></td>
                                         <td id="selectedsubcat_<?php echo $row->prod_id; ?>" value="<?php echo $row->subcategory_id;?>"><?php echo $row->subcategory_name;?></td>
                                         <td><?php echo $row->inventory_stock;?></td>
                                         <td>Php <?php echo $row->storeprod_price;?></td>
                                         <td>
                                            <button onclick="restoreProduct(<?php echo $row->prod_id; ?>)" class="btn btn-danger"><i class="material-icons">undoshopping_basket</i></button>
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
