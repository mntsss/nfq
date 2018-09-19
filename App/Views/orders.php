<?php require_once('top.php'); ?>


<div class="modal" tabindex="-1" role="dialog" id="order_info_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Užsakymo siuntimo informacija</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
            <div class="row">
                <div class="col-sm-5">
                    Užsakymo kiekis
                </div>
                <div class="col-sm-7" id="order_info_modal_quantity">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Siuntimo adresas
                </div>
                <div class="col-sm-7" id="order_info_modal_address">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Miestas
                </div>
                <div class="col-sm-7" id="order_info_modal_city">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Valstybė
                </div>
                <div class="col-sm-7" id="order_info_modal_country">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    Pašto kodas (ZIP)
                </div>
                <div class="col-sm-7" id="order_info_modal_post">

                </div>
            </div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-warning" onclick="orderPaid()">Apmokėta</button>
        <button type="button" class="btn btn-outline-success" onclick="orderShipped()">Išsiųsta</button>
      </div>
    </div>
  </div>
</div>


<div class="container mt-5">
    <div class="row mt-3">
        <div class="col-md-5">
            <div class="form-group row">
                <label for="search_by_user" class="col-sm-2 col-form-label h6">Paieška</label>
                <div class="col-sm-9">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ieškoti pagal užsakovą..." id="search_input" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="populateOrdersTable()"><span class="fas fa-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group row">
                <label for="result_per_page" class="col-sm-3 col-form-label h6">Įrašų skaičius puslapyje</label>
                <div class="col-sm-9">
                    <select class="form-control" id="result_per_page" onchange="changePerPage()">
                      <option>15</option>
                      <option>25</option>
                      <option>50</option>
                      <option>75</option>
                      <option>100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-dark" onclick="seedDatabase()">+ 5 DB Įrašai</button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table" id="orders_table" data-sorted-by="id" data-sort-direction = "ASC" data-page="1">
              <thead class="thead-dark" >
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" onclick="sortBy('client_name',this)" class="cursor-pointer">Užsakovas</th>
                  <th scope="col" onclick="sortBy('created_at',this)" class="cursor-pointer">Užsakymo data</th>
                  <th scope="col" onclick="sortBy('payment_received',this)" class="cursor-pointer">Apmokėta</th>
                  <th scope="col" onclick="sortBy('order_shipped',this)" class="cursor-pointer">Užsakymas išsiųstas</th>
                </tr>
              </thead>
              <tbody id = "orders_table_body">

              </tbody>
          </table>
      </div>
    </div>
    <div class="row justify-content-center">
        <nav>
          <ul class="pagination">
            <li class="page-item bg-dark text-light">
              <a class="page-link bg-dark text-light " onclick="previousPage()"><span class="fas fa-angle-left px-2"></span>Ankstesnis</a>
            </li>
            <span id="orders_pagination" style="display:inherit"></span>
            <li class="page-item">
              <a class="page-link bg-dark text-light" onclick="nextPage()">Sekantis<span class="fas fa-angle-right px-2"></span></a>
            </li>
          </ul>
        </nav>
    </div>
</div>
<script src="js/orders.js"></script>
<?php require_once("footer.php"); ?>
