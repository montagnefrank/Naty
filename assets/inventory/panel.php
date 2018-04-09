<!-- BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="index.php?panel=index.php">DiRulo</a></li>
    <li id="showmodal">inventario </li>
</ul>
<!-- FIN BREADCRUMB -->
<div class="col-md-12 col-sm-12">
    <h2><span class="fa fa-list-alt"></span> Gestionar la existencia de inventario</h2>
</div>

<?php //<!--INGREDIENTES RESUMEN-->?>
<div class="col-md-12 ingredientes_lista">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title-box">
                <h3>Ingredientes</h3>
                <span>Resumen de inventario</span> <button class="btn btn-info addnew_ing_btn" style="margin-left: 16px;"><i class="fa fa-plus-square fa-lg"></i> Nuevo</button>
            </div>                                    
            <ul class="panel-controls" style="margin-top: 2px;">
                <li><a id="ingredientes_toggle_list" href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>                                 
            </ul>
        </div>
        <div id="ingredientes_botonera_small" class="panel-footer text-center">                                                                                                                                                                                                           
            <div class="btn-group">
                <button id="ingredientes_quitosur_btn" class="btn btn-primary">Quito Sur</button>
                <button id="ingredientes_villaflora_btn" class="btn btn-primary">Villaflora</button>                                                
                <button id="ingredientes_quitonorte_btn" class="btn btn-primary">Quito Norte</button>                                        
            </div>     
        </div> 
        <div id="ingredientes_graph_peq" class="panel-body panel-body-table" >
            <div class="table-responsive" >
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="20%">Producto</th>
                            <th width="10%">Cantidad</th>
                            <th width="10%">Codigo</th>
                            <th width="10%">Precio</th>
                            <th width="10%">Unidad</th>
                            <th width="10%">Estado</th>
                            <th width="20%">Fecha</th>
                            <th width="10%">Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select_ingredientes_list = "SELECT * FROM ingrediente";
                        $result_ingredientes_list = mysqli_query($conn, $select_ingredientes_list);
                        while ($row_ingredientes_list = mysqli_fetch_array($result_ingredientes_list)) {
                            if ($row_ingredientes_list['cantidad1'] <= 24) {
                                $progbar_color = 'danger';
                            } elseif ($row_ingredientes_list['cantidad1'] >= 25 && $row_ingredientes_list['cantidad1'] <= 49) {
                                $progbar_color = 'warning';
                            } elseif ($row_ingredientes_list['cantidad1'] >= 50 && $row_ingredientes_list['cantidad1'] <= 74) {
                                $progbar_color = 'info';
                            } elseif ($row_ingredientes_list['cantidad1'] >= 75 && $row_ingredientes_list['cantidad1'] <= 100) {
                                $progbar_color = 'success';
                            }
                            if ($row_ingredientes_list['estadoIngrediente'] == 1) {
                                $labelEstatus = "success";
                                $texto = "DISPONIBLE";
                            } else {
                                $labelEstatus = "danger";
                                $texto = "NO DISPONIBLE";
                            }
                            echo "<tr class='singleing_row'>
                                    <td class='producto text-bold'>" . $row_ingredientes_list['nombreIngrediente'] . "</td>
                                    <td class='cantidad text-bold'><span id=\"ingredientes_" . $row_ingredientes_list['idIngrediente'] . "_val\" class=\"label label-" . $progbar_color . "\">" . $row_ingredientes_list['cantidad1'] . " " . $row_ingredientes_list['unidadIngrediente'] . "</span></td>
                                    <td class='codigo text-bold'>" . $row_ingredientes_list['codigoIngrediente'] . "</td>
                                    <td class='precio text-bold'>" . $row_ingredientes_list['precioIngrediente'] . "</td>
                                    <td class='unidad text-bold'>" . $row_ingredientes_list['unidadIngrediente'] . "</td>
                                    <td class='estado text-bold'><span class=\"label label-" . $labelEstatus . "\">" . $texto . "</span></td>
                                    <td class='fecha text-bold'>" . $row_ingredientes_list['editadoIngredinete'] . "</td>
                                    <td class='tipo text-bold'>" . $row_ingredientes_list['tipoIngrediente'] . "</td>
                                    <input type='hidden' value='" . $row_ingredientes_list['idIngrediente'] . "'>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>      
    </div>
</div>

<?php //<!-- AGREGAR INGREDIENTE --> ?>
<div class="col-md-8 agregarnuevo_panel" style="display:none;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><i class="fa fa-plus-circle"></i> Nuevo ingrediente</h3>
        </div>
        <div class="panel-body">
            <form role="form" method="post" id="guardarIngrediente" name="guardarIngrediente">
                <div class="form-group col-md-4">
                    <label class="control-label">Nombre</label>
                    <input type="text" class="form-control textinput" id="nombre_new" name="nombre" placeholder="Nombre del ingrediente" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Cantidad</label>
                    <input type="text" class="form-control textinput numonly" id="cantidad_new" name="cantidad" placeholder="Cantidad a modificar" required>
                </div>                                     
                <div class="form-group col-md-4">
                    <label class="control-label">C&oacute;digo</label>
                    <input type="text" class="form-control textinput" id="codigo_new" name="codigo" placeholder="Identifcador " required>
                </div>                          
                <div class="form-group col-md-4">
                    <label class="control-label">Codigo de Barras</label>
                    <input type="text" class="form-control textinput" id="barcode_new" name="barcode" placeholder="Codigo de barras" required>
                </div>                                                                            
                <div class="form-group col-md-4">
                    <label class="control-label">Unidad</label>
                    <select class="form-control select" data-style="btn-primary" id="unidadselect_new">
                        <option value='0'>Seleccione</option>
                        <option value='1'>Unidad</option>
                        <option value='2'>KG</option>
                        <option value='3'>0.25KG</option>
                    </select>
                </div>                                                                          
                <div class="form-group col-md-4">
                    <label class="control-label">Tipo de Ingrediente</label>
                    <select class="form-control select" data-style="btn-primary" id="tiposelect_new">
                        <option value='0'>Grupo del menu</option>
                        <option value='1'>General</option>
                        <option value='2'>Pastas</option>
                        <option value='3'>Carnes</option>
                        <option value='4'>Pizzas</option>
                        <option value='5'>Crepes & Postres</option>
                        <option value='6'>Bebidas</option>
                        <option value='7'>Ensaladas & Bocaditos</option>
                    </select>
                </div>  
                <div class="form-group col-md-4">
                    <label class="control-label">Cuenta contable</label>
                    <input type="text" class="form-control textinput" id="cuneta_new" name="cuneta" placeholder="Cuenta contable del producto" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Detalle</label>
                    <input type="text" class="form-control textinput" id="detalle_new" name="detalle" placeholder="Detalle del producto" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Bodega</label>
                    <input type="text" class="form-control textinput" id="bodega_new" name="bodega" placeholder="Bodega a Almacenar" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Inventario Minimo</label>
                    <input type="text" class="form-control textinput numonly" id="minimo_new" name="minimo" placeholder="Inventario Minimo" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Inventario Maximo</label>
                    <input type="text" class="form-control textinput numonly" id="maximo_new" name="maximo" placeholder="Inventario Maximo" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Precio de Venta</label>
                    <input type="text" class="form-control" id="precioventa_new" name="precioventa" placeholder="Precio de venta" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Precio de Compra</label>
                    <input type="text" class="form-control" id="preciocompra_new" name="preciocompra" placeholder="Precio de Compra" required>
                </div>                                                                          
                <div class="form-group col-md-4">
                    <label class="control-label">Establecimiento</label>
                    <select class="form-control select" data-style="btn-primary" id="estselect_new">
                        <option value='0'>Seleccione</option>
                        <option value='1'>Villaflora</option>
                        <option value='2'>Cotocollao</option>
                        <option value='3'>Quito Sur</option>
                    </select>
                </div> 
                <div class="form-group col-md-4">
                    <label class="control-label">Estado</label>
                    <div class="col-md-12">
                        <label class="switch">
                            <input type="checkbox" class="switch" id="estado_checkbox" name="estado" value="1" checked="">
                            <span></span>
                        </label>     
                    </div>                                         
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <button class="btn btn-info goback_ing_btn" style="margin-left: 16px; margin-bottom: 16px;"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success savenew_btn pull-right" style="margin-left: 16px; margin-bottom: 16px;"><i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
</div>

<?php //<!-- EDITAR INGREDIENTE --> ?>
<div class="col-md-8 editing_panel" style="display:none;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><i class="fa fa-edit"></i> Editar ingrediente</h3>
        </div>
        <div class="panel-body">
            <form role="form" method="post" id="editarIngrediente" name="guardarIngrediente">
                <div class="form-group col-md-4">
                    <label class="control-label">Nombre</label>
                    <input type="text" class="form-control textinput" id="nombre_edit" name="nombre" placeholder="Nombre del ingrediente" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Cantidad</label>
                    <input type="text" class="form-control textinput numonly" id="cantidad_edit" name="cantidad" placeholder="Cantidad a modificar" required>
                </div>                                     
                <div class="form-group col-md-4">
                    <label class="control-label">C&oacute;digo</label>
                    <input type="text" class="form-control textinput" id="codigo_edit" name="codigo" placeholder="Identifcador " required>
                </div>                          
                <div class="form-group col-md-4">
                    <label class="control-label">Codigo de Barras</label>
                    <input type="text" class="form-control textinput" id="barcode_edit" name="barcode" placeholder="Codigo de barras" required>
                </div>                                                                            
                <div class="form-group col-md-4">
                    <label class="control-label">Unidad</label>
                    <select class="form-control select" data-style="btn-primary" id="unidadselect_edit">
                        <option value='0'>Seleccione</option>
                        <option value='1'>Unidad</option>
                        <option value='2'>KG</option>
                        <option value='3'>0.25KG</option>
                    </select>
                </div>                                                                          
                <div class="form-group col-md-4">
                    <label class="control-label">Tipo de Ingrediente</label>
                    <select class="form-control select" data-style="btn-primary" id="tiposelect_edit">
                        <option value='0'>Grupo del menu</option>
                        <option value='1'>General</option>
                        <option value='2'>Pastas</option>
                        <option value='3'>Carnes</option>
                        <option value='4'>Pizzas</option>
                        <option value='5'>Crepes & Postres</option>
                        <option value='6'>Bebidas</option>
                        <option value='7'>Ensaladas & Bocaditos</option>
                    </select>
                </div>  
                <div class="form-group col-md-4">
                    <label class="control-label">Cuenta contable</label>
                    <input type="text" class="form-control textinput" id="cuneta_edit" name="cuneta" placeholder="Cuenta contable del producto" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Detalle</label>
                    <input type="text" class="form-control textinput" id="detalle_edit" name="detalle" placeholder="Detalle del producto" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Bodega</label>
                    <input type="text" class="form-control textinput" id="bodega_edit" name="bodega" placeholder="Bodega a Almacenar" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Inventario Minimo</label>
                    <input type="text" class="form-control textinput numonly" id="minimo_edit" name="minimo" placeholder="Inventario Minimo" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Inventario Maximo</label>
                    <input type="text" class="form-control textinput numonly" id="maximo_edit" name="maximo" placeholder="Inventario Maximo" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Precio de Venta</label>
                    <input type="text" class="form-control" id="precioventa_edit" name="precioventa" placeholder="Precio de venta" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="control-label">Precio de Compra</label>
                    <input type="text" class="form-control" id="preciocompra_edit" name="preciocompra" placeholder="Precio de Compra" required>
                </div>                                                                          
                <div class="form-group col-md-4">
                    <h3 >Establecimiento</h3>
                    <span class="label label-info label-form" > Villaflora</span>
                    <span class="hidethis_force" id="establecimiento_edit"> Villaflora</span>
                </div> 
                <div class="form-group col-md-4">
                    <label class="control-label">Estado</label>
                    <div class="col-md-12">
                        <label class="switch">
                            <input type="checkbox" class="switch" id="estado_checkbox_edit" name="estado" value="1" checked="">
                            <span></span>
                        </label>     
                    </div>                                         
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <button class="btn btn-info goback_ing_btn" style="margin-left: 16px; margin-bottom: 16px;"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success savenew_btn pull-right" style="margin-left: 16px; margin-bottom: 16px;"><i class="fas fa-sync-alt"></i> Actualizar</button>
        </div>
    </div>
</div>

<!--Mostrar el mensaje de si se ingreso al sistema -->
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> Ingresado a Sistema</div>
            <div class="mb-content">
                <p class="succesmessage_mb"></p>
            </div>
            <div class="mb-footer">
            </div>
        </div>
    </div>
</div>
<!--Mostrar el mensaje de que no se ingreso al sistema -->
<div class="message-box message-box-danger animated fadeIn" id="message-box-danger">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> error</div>
            <div class="mb-content">
                <p class="errormessage_mb"></p>
            </div>
            <div class="mb-footer">
            </div>
        </div>
    </div>
</div>