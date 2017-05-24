<div class="container" ng-controller="CentresEstudis">
    <div class="col-md-12">
        <a href="<?php echo base_url('admin/centers'); ?>" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Tornar a l'administració
        </a>
    </div>

    <div class="col-md-12">
        <h2>Editant estudis del centre: <strong><?php echo $nomcentre['name']; ?></strong> </h2>
        <hr />
    </div>


    <div class="col-md-6">
        <div class="list-group">
            <h3>Estudis del centre</h3>
            <h4 ng-show="centres.length==0">No hi ha estudis</h4>
            <input ng-hide="centres.length==0" type="search" class="form-control square-input" ng-init="buscarEstudi=''" placeholder="Buscar estudi per..." ng-model="buscarEstudi"/>

            <a ng-click="editCurrentStudy(estudis);" href="#" data-toggle="modal" data-target="#currentModal" class="list-group-item" ng-repeat="estudis in centres | filter: buscarEstudi | orderBy:['estudis.name','estudis.type']">
                {{estudis.name}}
                <span ng-show="estudis.observation.length>0" class="badge" style="background:#6d6d6d">*</span>
                <span ng-show="estudis.type=='fpgm'" class="badge" style="background:#E44646">CFGM</span>
                <span ng-show="estudis.type=='fpgs'" class="badge" style="background:#5AB4DD">CFGS</span>
                <span ng-show="estudis.type=='re'" class="badge" style="background:#E9DA53">RE</span>
                <span ng-show="estudis.dual==1" class="badge" style="background:#73428B">Dual</span>

            </a>
        </div>
    </div>

    <div class="col-md-6">
        <div class="list-group">
            <h3>Llistat d'estudis disponibles per al centre</h3>
            <h4 ng-show="estudis.length==0">No hi ha estudis</h4>
            <input ng-change="resetValues2();" ng-hide="estudis.length==0" type="search" class="form-control square-input" ng-init="buscarSegEstudi=''" placeholder="Buscar estudi per..." ng-model="buscarSegEstudi"/>

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
                    <button ng-show="final2<estudis.length" class="btn btn-default" ng-click="addValues2();">
                        Més <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <button ng-hide="final2<estudis.length" class="btn btn-default" ng-click="addValues2();" disabled>
                        Més <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>

            <div ng-repeat="estud in estudis | filter: buscarSegEstudi | orderBy:['estud.type','estud.name']">
                <button ng-show="$index>=inici2 && $index<=final2" ng-click="addCenterList(estud)" href="#" class="list-group-item" >
                    {{estud.name}}
                    <span ng-show="estud.type=='fpgm'" class="badge" style="background:#E44646">CFGM</span>
                    <span ng-show="estud.type=='fpgs'" class="badge" style="background:#5AB4DD">CFGS</span>
                    <span ng-show="estud.type=='re'" class="badge" style="background:#E9DA53">RE</span>
                </button>
            </div>

            <div class="panel panel-default" style="margin-top: 10px;" ng-show="studiesToPush.length>0">
                <div class="panel-heading">
                    <span><strong>Llista d'estudis a afegir</strong></span>
                </div>
                <div class="panel-body">
                    <span class="badge custom-badge" ng-repeat="study in studiesToPush" id="study.id">
                        {{study.name | limitTo: 55}}{{study.name.length > 55 ? '...' : ''}}
                        <i ng-click="removeStudyList(study)" class="fa fa-times-circle fa-lg link-cursor"></i>
                    </span>
                </div>
                <div class="panel-footer">
                    <button ng-click="resetCenters();" class="btn btn-default">
                        <i class="fa fa-times"></i>
                        Cancel·lar
                    </button>
                    <button ng-click="pushStudies();" id="save_button" data-toggle="modal" data-target="#addStudiesModal" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        Afegir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStudiesModal" tabindex="-2" role="dialog" aria-labelledby="addStudiesModal">
        <?php echo form_open(base_url('centres_estudis/addStudies/'.$centre), 'id="add_studies"'); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        Desitja afegir els centres?
                    </h4>
                </div>
                <div class="modal-body">
                    <h4>Afegiràs els següents centres als estudis "<strong><?php echo $nomcentre['name']; ?></strong>", estàs segur?</h4>
                    <hr />
                    <strong>Llistat d'estudis a afegir</strong>
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="study in studiesToPush">
                            <span ng-show="study.type=='fpgm'" class="badge" style="background:#E44646">CFGM</span>
                            <span ng-show="study.type=='fpgs'" class="badge" style="background:#5AB4DD">CFGS</span>
                            <span ng-show="study.type=='re'" class="badge" style="background:#E9DA53">RE</span>
                            {{study.name}}
                        </li>
                    </ul>
                    <input type="hidden" name="studies" value="{{studiesToPushString}}" />
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

    <div class="modal fade" id="currentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <?php echo form_open(base_url('centres_estudis/modify/'.$centre), 'id="edit_form"'); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        {{editCurrent.name}}
                        <span ng-show="editCurrent.type=='fpgm'" class="badge" style="background:#E44646">CFGM</span>
                        <span ng-show="editCurrent.type=='fpgs'" class="badge" style="background:#5AB4DD">CFGS</span>
                        <span ng-show="editCurrent.type=='re'" class="badge" style="background:#E9DA53">RE</span>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="idcentre" value="<?php echo $centre ?>"/>
                        <input type="hidden" name="idestudi" value="{{editCurrent.id}}"/>
                        <input type="hidden" id="currentObservation" value="{{editCurrent.observation}}" />
                        <label>Observacions</label>
                        <textarea id="markdown" name="observation"></textarea>
                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="primary">Estudi opció dual</button>
                            <input type="checkbox" class="hidden" name="dual" />
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Tancar
                    </button>
                    <a class="btn btn-danger" href="<?php echo base_url('centres_estudis/delete/'.$centre.'/{{editCurrent.id}}'); ?>">
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
</div>


</div>

<script>
app.controller('CentresEstudis', function($scope) {
    $scope.centres = <?php echo $dades; ?>;
    $scope.estudis = <?php echo $estudis; ?>;
    $scope.studiesToPush = [];

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
        if($scope.final2<$scope.estudis.length){
            $scope.inici2 += 8;
            $scope.final2 += 8;
        }
    };

    $scope.editCurrentStudy = function(current){
        $scope.editCurrent = current;
        $scope.simplemde.value($scope.editCurrent.observation);
    };

    $scope.addCenterList = function(study){
        if($scope.studiesToPush.indexOf(study) === -1){
            $scope.studiesToPush.push(study);
        }
    };

    $scope.removeStudyList = function(study){
        $scope.studiesToPush.splice($scope.studiesToPush.indexOf(study), 1);
    };

    $scope.pushStudies = function(){
        $scope.studiesToPushString = '';
        angular.forEach($scope.studiesToPush, function(study, key){
            $scope.studiesToPushString += study.id+"-";
        });
    };

    $scope.resetCenters = function(){
        $scope.studiesToPush = [];
    };

});
</script>
