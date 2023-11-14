<div class="container-fluid fondo">
        <!-- Nav -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary  fixed-top" id="fondo">
            <div class="container-fluid text-ligth">
                <a class="navbar-brand text-white " href="#">
                    <img src="build/img/cafe.jpg" alt="Icono" >
                    Welcome
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/menu">Menu</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active text-white" aria-current="page" href="#productos_destacados">Productos</a>

                        </li>
                        <li class="nav-item">
                          <a class="nav-link active text-white" aria-current="page" href="#sobre-nostros">Acerca de Nosotros</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active text-white" aria-current="page" href="#Contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active text-white" aria-current="page" href="/cita">Reservacion</a>                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active text-white" aria-current="page" href="/">Login</a>                          
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Slider -->
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                
              <div class="carousel-item active">
                <img src="build/img/1.webp" class="d-block   w-100   opacity-75 rounded " alt="No hay intenet" style="height: 550px;" style="width: 500px;" >
              </div>
              <div class="carousel-item">
                <img src="build/img/slider2.jpg" class="d-block w-100 opacity-75 rounded " alt="No hay intenet" style="height: 550px;" style="width: 500px;" >
              </div>
            </div> 
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!-- Boton1 -->
          <div class="container-fluid align-items-end" id="boton1">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-dark custom-animation">Desliza hacía abajo!</button>
            </div>
        </div>
        
        <!-- Cntenedor 2 -->
        <div class="clearfix fw-semibold fs-5 " >
            <img src="build/img/cafe_desde.jpg" class="col-md-5 float-md-end mb-3 ms-md-3 0 opacity-75 rounded" alt="...">
          
            <p class="text-white">
              A paragraph of placeholder text. We're using it here to show the use of the clearfix class. We're adding quite a few meaningless phrases here to demonstrate how the columns interact here with the floated image.
            </p>
          
            <p class="text-white">
              As you can see the paragraphs gracefully wrap around the floated image. Now imagine how this would look with some actual content in here, rather than just this boring placeholder text that goes on and on, but actually conveys no tangible information at. It simply takes up space and should not really be read.
            </p>
          
            <p class="text-white">
              And yet, here you are, still persevering in reading this placeholder text, hoping for some more insights, or some hidden easter egg of content. A joke, perhaps. Unfortunately, there's none of that here.
            </p>
          </div> 
          <!-- Cntenedor 3 -->
          <div class="about-us-container"  id="sobre-nostros">
            <h1 class="about-us-title">About Us</h1>
            <p class="about-us-description">El proyecto "Página Web Coastal Coffee - Sabor y Tradición" tiene como objetivo principal crear una presencia en línea atractiva y funcional para Coastal Coffee, un establecimiento de café con una rica historia y una amplia gama de productos de alta calidad. La página web servirá como una ventana digital que permite a los visitantes explorar la historia auténtica de Coastal Coffee, y acceder fácilmente a su variada oferta de productos, alentándolos a convertirse en clientes regulares y entusiastas de esta experiencia única.</p>
            <button class="learn-more-button custom-animation">Learn More</button>
        </div>

            <!-- Contenedor 4 -->
            <div class="container-fluid p-5" id="productos_destacados">
                <h2 class="text-center text-white" >Productos Destacados</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="build/img/premium.jpg" class="card-img-top" alt="Café 1" style="height: 350px;">
                            <div class="card-body text-bg-secondary">
                                <h5 class="card-title">Café Premium</h5>
                                <p class="card-text">Disfruta de nuestro café premium, tostado a la perfección y lleno de sabor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="build/img/galeria_02.webp" class="card-img-top" alt="Café 2" style="height: 350px;" >
                            <div class="card-body text-bg-secondary ">
                                <h5 class="card-title">Café Orgánico</h5>
                                <p class="card-text">Nuestro café orgánico se cultiva de manera sosteniblecon el medio ambiente.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card text-bg-secondary">
                            <img src="build/img/galeria_01.webp" class="card-img-top" alt="Café 3" style="height: 350px;">
                            <div class="card-body ">
                                <h5 class="card-title">Café Descafeinado</h5>
                                <p class="card-text">Para aquellos que desean disfrutar del sabor del café sin cafeína.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contenedor 5 -->
            <div class="contact-container">
              <h1 class="contact-title" id="Contacto" >Contacto</h1>
              <img class="contact-image" src="build/img/ubicacion.png" alt="Imagen del lugar">
              <p class="contact-address">
                  Priv.De Constituyentes #12 Col. Niños Héroes CP 38800<br>
                  Municipio: Moroleón Gto Estado Guanajuato
              </p>
          </div>


            <!-- footer -->
        <footer class="footer__color">
        <p>&copy; Sabor y tradicion, El café es el abrazo en una taza en un mundo que a veces necesita un momento de calma.</p>
        <div class="footer-images">
            <img src="build/img/cafe-icon.png" alt="Icono de café">
            <img src="build/img/instagram-icon.png" alt="Icono de Instagram">
            <img src="build/img/facebook-icon.png" alt="Icono de Facebook">

        </div>
        <div class="contact-info">
            <p>Dirección: Calle Privada de constituyentes, País Mexico</p>
            <p>Teléfono: +52 1 445 111 2833</p>
            <p>Municipio: Moroleon</p>
            <p>Email: cooastalcofe@gmail.com</p>

        </div>
        
    </footer>

</div>
    
