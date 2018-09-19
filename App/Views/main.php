<?php require_once('top.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide h-70" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                 <div class="carousel-item active">
                  <img class="d-block w-100" src="/media/slide2.jpg" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h3>Išlaisvink užslėptą potencialą</h3>
                      <p><h4>su <b class="text-danger">GT COILOVERS</b></h4> </p>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="/media/slide1.jpg" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h3><b class="text-danger">AUKŠČIAUSIOS</b> kokybės produkcija</h3>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="/media/slide3.jpg" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                      <h3><b class="text-danger">UNIVERSALI</b> pakabos sistema</h>
                      <p><h3>atitinka<b class="text-danger">VISUS STANDARTUS</b></h3></p>
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

        <div class="row mt-4 pt-4 pb-4">
            <div class="col-md-6">
               <p class="h4 p-4">Reguliuojami amortizatoriai (automanams žinomi kaip "coiloveriai") yra neatsiejama automobilių sporto dalis, tačiau plačiai juos sutiksi ir tarp įvairaus plauko automobilių entuziastų. Šių amortizatorių pagalba galima automobilio pakabą pritaikyti savo individualiems poreikiams - žemas vasarą, bet pravažus žiemą? Kietas "Kačerginėje", bet minkštas nelygiuose užmiesčio keliuose? Be problemų!
                </p>
                <button class="btn btn-outline-danger m-3" onclick="window.scrollTo(0,document.body.scrollHeight);">Užsisakykite dabar!</button>
            </div>
            <div class="col-md-6">
                <img src = "media/info_logo.png" alt = "logo" class="info-logo" />
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-dark text-light h3 border-radius-top-15">
                        Aukščio reguliavimas
                    </div>
                    <div class="card-body p-0">
                        <img src = "media/heigth.png" alt = "heigth" class="w-100">

                        <div class="p-2 h5">
                            Atlaisvinus per vidurį amortizatoriaus esančias dvi veržles galėsite lengvai sureguliuoti automobilio aukštį.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-dark text-light h3 border-radius-top-15">
                        Kietumo reguliavimas
                    </div>
                    <div class="card-body p-0">
                        <img src = "media/stiffness.png" alt = "stiffness" class="w-100"/>
                        <div class="p-2 h5">
                            Visi Mūsų siūlomi reguliuojami amortizatoriai išorinėje dalyje turi varžtą, kurį sukiojant galima nusistatyti pageidaujamą automobilio "kietumą".
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-dark text-light h3 border-radius-top-15">
                        Stabilumas
                    </div>
                    <div class="card-body p-0">
                        <img src = "media/stability.png" alt = "stability" class="w-100">
                        <div class="p-2 h5">
                            Visi reguliuojami amortizatoriai turi spyruokles, parinktas idealiai tikti prie amortizatorių - tai vienas iš esminių faktorių nulemiantis nepriekaištinga automobilio stabilumą tiek kelyje, tiek lenktynių žiede
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="card px-0 col-12">
                    <div class="card-header bg-dark text-light">
                        UŽSISAKYKITE DABAR!
                    </div>
                    <div class="card-body">
                      <div class="mt-2 mb-2" id="order_alert_container">

                      </div>
                        <form>
                            <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_name">Vardas, pavardė</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_name" name="name" placeholder="Įrašykite pilną vardą">
                                        </div>
                                    </div>
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_address">Adresas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-building"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_address" name="address" placeholder="Įrašykite siuntimo adresą">
                                        </div>
                                    </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_city">Miestas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_city" name="city" placeholder="Įrašykite miestą">
                                        </div>
                                    </div>

                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_county">Valstybė</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map-marker-alt"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_country" name="country" placeholder="Įrašykite valstybę">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_post">Pašto kodas (ZIP)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-map-pin"></span></div>
                                            </div>
                                            <input type="text" class="form-control" id="order_form_post" name="post" placeholder="Įrašykite pašto kodą">
                                        </div>
                                    </div>
                                    <div class="form-group col-6 px-4">
                                        <label for="order_form_quantity">Užsakymo kiekis (1 vnt. - pilnas komplektas automobiliui)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><span class="fas fa-hashtag"></span></div>
                                            </div>
                                            <input type="number" class="form-control" id="order_form_quantity" name="quantity" placeholder="Kiekis" min="1" max="99" step="1" />
                                        </div>
                                    </div>
                                </div>
                            <div class="row justify-content-center mt-3">
                                <button  type="button" id="order_form_submit" class="btn btn-outline-dark pa-2" onclick="createOrder()"><span class="fas fa-shipping-fast mx-2"></span>Išsaugoti užsakymą!</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

    </div>
    <!-- Scripts -->
    <script src="js/main.js"></script>

<?php require_once("footer.php"); ?>
