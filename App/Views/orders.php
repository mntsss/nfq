<?php require_once('top.php'); ?>


<div class="modal" tabindex="-1" role="dialog" id="order_info_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order shipping information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
            <div class="row">
                <div class="col-sm-5">
                    Order quantity
                </div>
                <div class="col-sm-7" id="order_info_modal_quantity">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Shipping address
                </div>
                <div class="col-sm-7" id="order_info_modal_address">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    City
                </div>
                <div class="col-sm-7" id="order_info_modal_city">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Country
                </div>
                <div class="col-sm-7" id="order_info_modal_country">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Post code (ZIP)
                </div>
                <div class="col-sm-7" id="order_info_modal_post">

                </div>
            </div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-warning">Payment received</button>
        <button type="button" class="btn btn-outline-success" data-dismiss="modal">Order shipped</button>
      </div>
    </div>
  </div>
</div>


<div class="container">
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="search_by_user" class="col-sm-2 col-form-label h6">Search</label>
                <div class="col-sm-9">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search by client..." id="search_by_user" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button"><span class="fas fa-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="result_per_page" class="col-sm-3 col-form-label h6">Rows per page</label>
                <div class="col-sm-9">
                    <select class="form-control" id="result_per_page">
                      <option>15</option>
                      <option>25</option>
                      <option>50</option>
                      <option>75</option>
                      <option>100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <table class="table" id="orders_table" data-sorted-by="id" data-sort-direction = "ASC" data-page="1">
  <thead class="thead-dark" >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client</th>
      <th scope="col">Added on</th>
      <th scope="col">Payment received</th>
      <th scope="col">Order shipped</th>
    </tr>
  </thead>
  <tbody id = "orders_table_body">

  </tbody>
</table>
    </div>
</div>
<script src="js/orders.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native-v4.min.js"></script>
