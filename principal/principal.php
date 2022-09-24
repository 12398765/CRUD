    <?php
    session_start();
    if (!isset($_SESSION["autenticado"])) {
    ?>
        <script>
            window.location.href = "../index.html"
        </script>
    <?php
    } else {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bienvenido usuario <?php print $_SESSION["autenticado"] ?></title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="../estilos&img/miestilo.css">
        </head>

        <body>
            <img src="../estilos&img/playa.jpg" alt="fondo_playita" class="img-fluid">
            <h1 class="text-center">Bienvenido <span style="color:red"><?php echo $_SESSION["autenticado"] ?></span></h1>
            <div class="container d-flex justify-content-center align-items-center">
                <!---------------------------------------------------------------------------------------->
                <div class="row mt-3">
                    <div class="col-12 col-md-4">
                        <div class="card" style="background-color: rgba(255,255,255,0.5); border-radius:15px">
                            <h3 class="card-header bg-light text-center" style="border-radius: 10px;">Registro de Productos</h3>
                            <div class="card-body">
                                <form action="" method="post" id="frm">
                                    <div class="form-group">
                                        <label for="" class="form-label">Codigo</label>
                                        <input type="hidden" name="idp" id="idp" value="">
                                        <input type="text" name="codigo" id="codigo" placeholder="Código" class="form-control">
                                        <p class="valid val_codigo"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Producto</label>
                                        <input type="text" name="producto" id="producto" placeholder="Producto" class="form-control">
                                        <p class="valid val_producto"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Precio</label>
                                        <input type="text" name="precio" id="precio" placeholder="Precio" class="form-control">
                                        <p class="valid val_precio"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" placeholder="Código" class="form-control">
                                        <p class="valid val_cantidad"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="button" value="Registrar" id="Registrar" class="mt-3 btn btn-primary btn-block form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <table class="tables">
                            <thead class="bg-secondary">
                                <tr>
                                    <th>ID</th>
                                    <th>CODIGO</th>
                                    <th>DESCRIPCION</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>
                                    <th>ACCIONES</th>
                                    </th>

                                </tr>
                            </thead>

                            <tbody id="resultado" style="position: relative;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
    }
        ?>
        <script src="script.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </body>

        </html>