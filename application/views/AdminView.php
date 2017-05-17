<script>
    app.controller('AdminisController', function($scope) {
        $scope.dades = <?php echo $dades; ?>;
        $scope.pageTitle = '<?php echo $title; ?>';

        $scope.setCurrentDelete = function(currentDel){
            $scope.currentDelete = currentDel;
        }
    });
</script>
<div class="container" ng-controller="AdminisController">

    <div class="col-md-12">
        <h2>{{pageTitle}}</h2>
        <hr />
    </div>
    <div class="input-group" style="margin-bottom: 2px !important;">
        <span class="input-group-addon" id="basic-addon1" style="background-color: #fff">
            <i class="fa fa-search"></i>
        </span>
        <input type="search" class="form-control square-input" ng-init="buscarDada=''" placeholder="Buscar registre per qualsevol de les seves dades..." ng-model="buscarDada"/>
        <span class="input-group-btn">
            <button class="btn btn-success square-btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Afegir registre</button>
        </span>
        <?php if($database=='families') { ?>
            <span class="input-group-btn">
                <a href="<?php echo base_url('fitxes'); ?>" target="_blank" class="btn btn-success square-btn"><i class="fa fa-file-pdf-o"></i> Generar PDF</a>
            </span>
        <?php } ?>
        <?php if($database=='centers') { ?>
            <span class="input-group-btn">
                <a href="<?php echo base_url('fitxa/centres'); ?>" target="_blank" class="btn btn-success square-btn"><i class="fa fa-file-pdf-o"></i> Generar PDF</a>
            </span>
        <?php } ?>
    </div>

    <table class="table table-hover" style="">

        <tr>
            <?php
                foreach ($columnes as $key => $columna) {
                    if($key != '0'){
            ?>
                <th><?php echo $columna; ?></th>
            <?php }} ?>
            <th style="text-align:center" colspan="2">Opcions</th>
        </tr>

        <tr ng-repeat="dada in dades | filter: buscarDada">
			<td ng-repeat="simpledata in dada" ng-hide="$index=='0'">
                <i class="fa fa-{{simpledata}}"></i> <span>{{simpledata | limitTo: 100}}{{simpledata.length > 100 ? '...' : ''}}</span>
				<div style="background-color: #f4f4f4; width:100%; height:100%; text-align:center" ng-show="!simpledata">-</div>
            </td>

            <td style="text-align:right;">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bars"></i> <i class="fa fa-caret-down"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-right custom-menu" aria-labelledby="dropdownMenu1">
                        <li style="border-left: solid 3px #FA8D45;">
                            <a href="<?php echo base_url('editar/'.$database.'/{{dada.id}}'); ?>">
                                <i class="fa fa-pencil-square-o"></i> Editar
                            </a>
                        </li>
                        <?php if($database=='families') { ?>
                            <li style="border-left: solid 3px #C581F0;">
                                <a href="<?php echo base_url('fitxa/{{dada.code}}');?>" target="_blank">
                                    <i class="fa fa-file-pdf-o"></i> Generar PDF
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($database=='centers') { ?>
                            <li style="border-left: solid 3px #65C9E5;">
                                <a href="<?php echo base_url('centres_estudis/{{dada.id}}'); ?>">
                                    <i class="fa fa-graduation-cap"></i> Administrar estudis
                                </a>
                            </li>
                            <li style="border-left: solid 3px #C581F0;">
                                <a href="<?php echo base_url('fitxa/{{dada.codicentre}}');?>" target="_blank">
                                    <i class="fa fa-file-pdf-o"></i> Generar PDF
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($database=='studies') { ?>
                            <li style="border-left: solid 3px #65C9E5;">
                                <a href="<?php echo base_url('estudis_centres/{{dada.id}}'); ?>">
                                    <i class="fa fa-university"></i> Administrar centres
                                </a>
                            </li>
                        <?php } ?>
                        <li style="border-left: solid 3px #FA3D53;">
                            <a ng-click="setCurrentDelete(dada)" data-toggle="modal" data-target="#deleteModal" href="#">
                                <i class="fa fa-trash"></i> Eliminar
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                </div>
                <div class="modal-body">
                    <span>¿Desea eliminar el registro "<strong>{{currentDelete.name}}{{currentDelete.title}}</strong>"?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel·lar
                    </button>
                    <a href="<?php echo base_url('admin/delete/'.$database.'/{{currentDelete.id}}'); ?>" class="btn btn-danger">
                        <i class="fa fa-trash-o"></i> Eliminar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
