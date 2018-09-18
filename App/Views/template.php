<?php require_once('top.php'); ?>

    <div class="container">
        <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide h-70" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="/media/slide1.jpg" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h4>Recommended to <b class="text-danger">Professionals</b></h4>
                      <!-- <p class = "h4">Recomended by <b class="text-danger">PROFESSIONALS</b></p> -->
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="/media/slide2.jpg" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h3>Unleash hidden performance</h3>
                      <p><h4>with <b class="text-danger">GT COILOVERS</b></h4> </p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="/media/slide3.jpg" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h3>The <b class="text-danger">PERFECT</b> suspention system</h>
                      <p><h3>for <b class="text-danger">EVERY DEMAND</b></h3></p>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>

        <div class="row">
            There are many ways to modify and upgrade your suspension, but the best one would be to add a coilover system.
            The two are very different and there are many factors that determine what would be best for you. Some considerations would be comfort vs performance, longevity, adjust-ability and price.
            Some customers also do not want to lower their car, but just want to tighten up the suspension and give them added adjustability.
        </div>
        <div class="row">
                <div class="card px-0 col-12">
                    <div class="card-header bg-dark text-light">
                        ORDER NOW
                    </div>
                    <div class="card-body">
                      <div class="mt-2 mb-2" id="order_alert_container">

                      </div>
                        <form>
                            <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_name">Full name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_name" name="name" placeholder="Enter full name">
                                        </div>
                                    </div>
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_address">Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-building"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_address" name="address" placeholder="Enter shipping address">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_city">City</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_city" name="city" placeholder="Enter city">
                                        </div>
                                    </div>

                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_county">Country</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_country" name="country" placeholder="Enter county">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_post">Post code (ZIP)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map-pin"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_post" name="post" placeholder="Enter post code">
                                        </div>
                                    </div>
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_quantity">Order quantity</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-hashtag"></span></div>
                                            </div>
                                            <input type="number" class="form-control" id="order_form_quantity" name="quantity" placeholder="Enter quantity" min="1" max="99" step="1" />
                                        </div>
                                    </div>
                                </div>
                            <div class="row justify-content-center mt-3">
                                <button  type="button" id="order_form_submit" class="btn btn-outline-dark pa-2" onclick="createOrder()"><span class="fas fa-shipping-fast mx-2"></span>Order NOW!</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

    </div>
    <!-- Scripts -->
    <script src="js/app.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native-v4.min.js"></script>
  </body>
</html>
