<header>
    <!-- menu de navegacion -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">

        <div class="container">
            <a href="index.php" class="navbar-brand">
                <!-- aqui va la imajen de la cabezera -->
                <img src="imagenes/logo2.jpg" alt="logo"></a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#segundonav"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="segundonav">
                <ul class="navbar-nav m-auto">

                    <li class="nav-item"><a class="nav-link" href="#">Categorias</a></li>

                    <li class="nav-item">
                        <a href="listaCarrito.php" class="nav-link">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            Carrito(<?php echo (empty($_SESSION['carrito'])) ? 0 : count($_SESSION['carrito']); ?>)
                        </a>
                    </li>

                    <li class="nav-item"><a href="login.php" class="nav-link">Login </a></li>

                </ul>
                <form class="form-inline">
                    <input type="text" class="form-control" placeholder="Buscar">
                    <button class="btn btn-outline-success" type="button">Buscar</button>
                </form>
            </div>

        </div>
    </nav>
    <br><br>
</header>