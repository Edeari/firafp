<div class="container" ng-controller="CentresEstudis">
    <div class="col-md-12">
        <a href="<?php echo base_url('admin/studies'); ?>" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Tornar a l'administració
        </a>
    </div>

    <div class="col-md-12">
        <h2>Editant centres de l'estudi: <strong><?php echo $nomestudi['name']; ?></strong> </h2>
        <hr />
    </div>

    <div class="col-md-12">
        {{editCurrent.name}}
    </div>


    <div class="col-md-6">
        <div class="list-group">
            <h3>Centres fent aquest estudi</h3>
            <h4 ng-show="centres.length==0">No hi ha estudis</h4>
            <input ng-hide="centres.length==0" type="search" class="form-control square-input" ng-init="buscarEstudi=''" placeholder="Buscar centre per..." ng-model="buscarEstudi"/>

            <a ng-click="editCurrentStudy(estud);" href="#" data-toggle="modal" data-target="#currentModal" class="list-group-item" ng-repeat="estud in estudis | filter: buscarEstudi | orderBy:['estudis.name','estudis.type']">
                {{estud.name}}
                <span class="badge">{{estud.location}}</span>
                <span ng-show="estud.dual==1" class="badge" style="background:#73428B">Dual</span>

            </a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="list-group">
            <h3>Llistat de centres disponibles</h3>
            <h4 ng-show="estudis.length==0">No hi ha estudis</h4>
            <input ng-change="resetValues2();" ng-hide="estudis.length==0" type="search" class="form-control square-input" ng-init="buscarSegEstudi=''" placeholder="Buscar centre per..." ng-model="buscarSegEstudi"/>

            <div class="btn-group btn-group-justified" role="group">
                <div class="btn-group" role="group">
                    <button ng-show="inici2>0" class="btn btn-default" ng-click="lessValues2();">
                        <span class="glyphicon glyphicon-chevron-left"></span> Menys
                    </button>
                    <button ng-hide="inici2>0" class="btn btn-default" ng-click="lessValues2();" disabled>
                        <span class="glyphicon glyphicon-chevron-left"></span> Menys
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button ng-show="final2<centres.length" class="btn btn-default" ng-click="addValues2();">
                        Més <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <button ng-hide="final2<centres.length" class="btn btn-default" ng-click="addValues2();" disabled>
                        Més <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>

            <div ng-repeat="cent in centres | filter: buscarSegEstudi">
                <button ng-show="$index>=inici2 && $index<=final2" ng-click="addCenterList(cent)" class="list-group-item" >
                    {{cent.name}}
                    <span class="badge">{{cent.location}}</span>
                </button>
            </div>

            <div class="panel panel-default" style="margin-top: 10px;" ng-show="centersToPush.length>0">
                <div class="panel-heading">
                    <span><strong>Llista d'estudis a afegir</strong></span>
                </div>
                <div class="panel-body">
                    <span class="badge custom-badge" ng-repeat="center in centersToPush" id="center.id">
                        {{center.name}}
                        <i ng-click="removeCenterList(center)" class="fa fa-times-circle fa-lg link-cursor"></i>
                    </span>
                </div>
                <div class="panel-footer">
                    <button ng-click="resetCenters();" class="btn btn-default">
                        <i class="fa fa-times"></i>
                        Cancel·lar
                    </button>
                    <button ng-click="pushCenters();" id="save_button" data-toggle="modal" data-target="#addCentersModal" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        Afegir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="currentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <?php echo form_open(base_url('estudis_centres/modify/'.$estudi), 'id="edit_form"'); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        {{editCurrent.name}}
                        <span class="badge">{{editCurrent.location}}</span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="idcentre" value="{{editCurrent.id}}"/>
                        <input type="hidden" name="idestudi" value="<?php echo $estudi ?>"/>
                        <input type="hidden" id="currentObservation" value="{{editCurrent.observation}}" />
                        <label>Observacions</label>

                        <textarea id="markdown" name="observation"></textarea>

                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="primary">Estudi opció dual</button>
                            <input type="checkbox" class="hidden" name="dual"/>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Tancar
                    </button>
                    <a class="btn btn-danger" href="<?php echo base_url('estudis_centres/delete/'.$estudi.'/{{editCurrent.id}}'); ?>">
                        <i class="fa fa-trash-o"></i> Eliminar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="modal fade" id="addCentersModal" tabindex="-2" role="dialog" aria-labelledby="addCentersModal">
        <?php echo form_open(base_url('estudis_centres/addCenters/'.$estudi), 'id="add_centers"'); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        Desitja afegir els centres?
                    </h4>
                </div>
                <div class="modal-body">
                    <h4>Afegiràs els següents centres als estudis "<strong><?php echo $nomestudi['name']; ?></strong>", estàs segur?</h4>
                    <hr />
                    <strong>Llistat d'estudis a afegir</strong>
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="centers in centersToPush">
                            <span class="badge">{{centers.location}}</span>
                            {{centers.name}}
                        </li>
                    </ul>
                    <input type="hidden" name="centers" value="{{centersToPushString}}" />
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">
                        <i class="fa fa-times"></i>
                        Cancel·lar
                    </button>
                    <button id="save_button" name="save_button" class="btn btn-primary" type="submit">
                        <i class="fa fa-plus-circle"></i>
                        Afegir
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>


<script>
app.controller('CentresEstudis', function($scope) {
    $scope.editCurrent = null;
    $scope.estudis = <?php echo $dades; ?>;
    $scope.centres = <?php echo $centres; ?>;
    $scope.centersToPush = [];

    $scope.inici2 = 0;
    $scope.final2 = 7;

    $scope.simplemde = new SimpleMDE({ element: document.getElementById("markdown")});

    $scope.resetValues2 = function(){
        $scope.inici2 = 0;
        $scope.final2 = 7;
    };

    $scope.lessValues2 = function(){
        if($scope.inici2>0){
            $scope.inici2 -= 8;
            $scope.final2 -= 8;
        }
    };

    $scope.addValues2 = function(){
        if($scope.final2<$scope.centres.length){
            $scope.inici2 += 8;
            $scope.final2 += 8;
        }
    };

    $scope.editCurrentStudy = function(current){
        $scope.editCurrent = current;
        $scope.simplemde.value($scope.editCurrent.observation);
    };

    $scope.addCenterList = function(center){
        if($scope.centersToPush.indexOf(center) === -1){
            $scope.centersToPush.push(center);
        }
    };

    $scope.removeCenterList = function(center){
        $scope.centersToPush.splice($scope.centersToPush.indexOf(center), 1);
    };

    $scope.pushCenters = function(){
        $scope.centersToPushString = '';
        angular.forEach($scope.centersToPush, function(center, key){
            $scope.centersToPushString += center.id+"-";
        });
    };

    $scope.resetCenters = function(){
        $scope.centersToPush = [];
    };

});
</script>
