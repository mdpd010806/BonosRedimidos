<?php include 'template/header.php'?>

<?php
    include_once "model/conexion.php";
    if(!empty($_POST["txtBono"])){
        $bono = $_POST["txtBono"];
        $sentencia = $bd -> prepare("select vv.VLO_Number as BONO_DULCERIA, ss.SIT_Name as MULTICINE, ss.SIT_Address1 as DIRECCION, ss.SIT_Address2 as CIUDAD, vv.VLO_TimeStamp as FECHAYHORA from vva_validationlog vv inner join std_site ss on vv.VLO_SIT_Id = ss.SIT_Id where VLO_Online=1 and VLO_Number = ? ORDER BY VLO_Number DESC");
        $sentencia -> execute([$bono]);
        $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
        //print_r($persona);
    }
?>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 mb-5">
            <div class="card border border-secondary">
                <div class="card-header bg-secondary bg-gradient text-light">
                    Detalles
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                    <form class="p-4" method="POST" action="index.php">
                    <div class="mb-3">
                        <label class="form-label">Bono: </label>
                        <input type="text" class="form-control" name="txtBono" autofocus require>
                    </div>
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </form>
                        <thead>
                            <tr>
                                <th scope="col">BONO</th>
                                <th scope="col">MULTICINE</th>
                                <th scope="col">DIRECCION</th>
                                <th scope="col">CIUDAD</th>
                                <th scope="col">FECHA Y HORA</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            if(!empty($_POST["txtBono"])){
                                foreach($persona as $dato){
                            ?>

                            <tr>
                                <th scope="row"><?php echo $dato->BONO_DULCERIA;?></th>
                                <td><?php echo $dato->MULTICINE;?></td>
                                <td><?php echo $dato->DIRECCION;?></td>
                                <td><?php echo $dato->CIUDAD;?></td>
                                <td><?php echo $dato->FECHAYHORA;?></td>
                            </tr>

                            <?php
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
