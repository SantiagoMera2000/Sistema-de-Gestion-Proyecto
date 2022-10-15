<!-- Se llama a la BD para establecer conexion -->
<?php include("logic/conexion.php"); ?>
<!-- Se carga el header universal de cada pagina -->
<?php include('includes/header.php'); ?>
<!-- Verifica que el usuario inició sesion, de lo contrario
lo envia de nuevo al login -->
<?php
session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
}
?>
<!-- Estilos requeridos especialmente en esta pagina -->
<link rel="stylesheet" href="css\index.css">

<body>

    <main class="main">
        <div class="row align-items-start">
            <div class="col">
            <input type="text" id="Search" onkeyup="myFunction()" placeholder="Buscar un lugar..." title="Buscador de productos">
            
            <table class="table table-bordered table-hover"> 
                <tbody>
                    <tr>
                    <?php
                    $query = "SELECT * FROM producto";
                    $result_tasks = mysqli_query($conexion, $query);    

                    while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                        <td><?php echo $row['nom_pro']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['precio_venta']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            <!-- Columna derecha -->
            <div class="col">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM task";
                $result_tasks = mysqli_query($conexion, $query);    

                while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                    <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
                </div>
        </div>
    </main>
<?php include('includes/footer.php'); ?>