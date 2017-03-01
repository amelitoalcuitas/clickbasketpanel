<div class="container-fluid">
           <div class="block-header">
               <!-- Basic Examples -->

            <div class="row clearfix">

                <a href="<?= base_url('vendor/viewproduct'); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-blue">
                            <i class="material-icons">shopping_basket</i>
                        </div>
                        <div class="content">
                            <div class="text">PRODUCTS</div>
                            <div class="number count-to" data-from="0" data-to="<?= $orderstoday->ordernum; ?>" data-speed="1000" data-fresh-interval="20">
                                <?= $prodnum->prodnum; ?>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

                <a href="<?= base_url('vendor/viewOrders'); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-red">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">ORDERS TODAY</div>
                            <div class="number count-to" data-from="0" data-to="<?= $orderstoday->ordernum; ?>" data-speed="1000" data-fresh-interval="20">
                                <?= $orderstoday->ordernum; ?>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

                <a href="<?= base_url('vendor/viewOrders'); ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-green">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL ORDERS</div>
                            <div class="number count-to" data-from="0" data-to="<?= $ordersmonth->ordernum; ?>" data-speed="1000" data-fresh-interval="20">
                                <?= $ordersmonth->ordernum; ?>
                            </div>
                        </div>
                    </div>
                </div>
                </a>

            </div>

        <div class="row clearfix">

            <a href="<?= base_url('vendor/addproduct'); ?>">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-blue hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">add</i>
                    </div>
                    <div class="content">
                        <div class="text">PRODUCTS</div>
                        <div class="number">Add Product</div>
                    </div>
                </div>
            </div>
            </a>

        </div>  

           <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                       <div class="header">
                           <h2>
                               MOST ORDERED PRODUCTS
                           </h2>
                       </div>
                       <div class="body">
                         <div class="row">
                           <canvas id="myChart"></canvas>
                         </div>
                             <div style="margin-top:50px;"></div>
                           <div class="row">
                           <div class="col-md-12" style="margin-left:20px;">
                                <div class="col-md-3">
                                    <label>Month</label>
                                    <select class="form-control" id="monthlyOrdersId">
                                        <option> Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-8" style=""> 
                                <canvas id="myLineChart"></canvas>
                                </div>
                           </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <!-- #END# Basic Examples -->
           </div>
       </div>
