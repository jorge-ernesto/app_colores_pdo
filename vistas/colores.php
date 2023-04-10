<?php
include_once '../conexion/conexion.php';
$ncl = new NuclearFactory();

//LEER
$sql = "SELECT * FROM colores;";
$dataAgentes = $ncl->query($sql);
// echo "<pre>";
// print_r($dataAgentes);
// echo "</pre>";

//BUSCAR
$id = isset($_GET['id']) ? $_GET['id'] : '';
if($id){
    $sql = "SELECT * FROM colores WHERE id = '$id';";
    $dataAgente = $ncl->query_by_id($sql);
    // echo "<pre>";
    // print_r($dataAgente);
    // echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Angular</title>
    <?php include 'layout/head.php'; ?>
</head>
<body>    
    <!-- <?php include 'layout/header.php'; ?> --> <!-- Se comento porque se ve mal -->

    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <?php foreach ($dataAgentes as $key => $color) { ?>
                    <div class="alert alert-<?php echo $color['color'] ?>" role="alert">
                        <?php echo $color['descripcion']; ?>

                        <a href="../controlador/controladorColores.php?id_eliminar=<?php echo $color['id'] ?>" class="float-right">
                            <i class="fas fa-trash-alt"></i>
                        </a>

                        <a href="colores.php?id=<?php echo $color['id'] ?>" class="float-right mr-2">
                            <i class="fas fa-pencil-alt"></i>
                        </a>                        
                    </div>
                <?php } ?>
            </div>  

            <div class="col-md-6">
                
                <?php if(!$id){ ?>
                    <h2>Agregar colores</h2>
                    <form method="POST" action="../controlador/controladorColores.php">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="color" value="" id="color" class="form-control" placeholder="Color" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="descripcion" value="" id="descripcion" class="form-control" placeholder="Descripción" required>
                            </div>
                        </div>
                        <h4>
                            <button type="submit" id="crear" class="btn btn-primary">Agregar</button>
                        </h4>

                        <input type="hidden" name="id" value="" id="id" class="form-control">
                    </form>
                <?php } ?>

                <?php if($id){ ?>
                    <h2>Editar colores</h2>
                    <form method="GET" action="../controlador/controladorColores.php">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="color" value="<?php echo $dataAgente['color'] ?>" id="color" class="form-control" placeholder="Color" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="descripcion" value="<?php echo $dataAgente['descripcion'] ?>" id="descripcion" class="form-control" placeholder="Descripción" required>
                            </div>
                        </div>
                        <h4>
                            <button type="submit" id="crear" class="btn btn-primary">Editar</button>
                            <a class="btn btn-secondary" href="colores.php">Atrás</a>
                        </h4>

                        <input type="hidden" name="id" value="<?php echo $dataAgente['id'] ?>" id="id" class="form-control">
                    </form>
                <?php } ?>

            </div>  

            <div class="col-md-12">
                <?php include 'layout/footer.php'; ?>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>    
</body>
</html>
