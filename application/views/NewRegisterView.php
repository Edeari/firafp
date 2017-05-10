<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >

    <script>
        app.controller('NewDataController', function($scope) {
            $scope.taula = '<?php echo $database; ?>';
            $scope.families = <?php echo $families; ?>;

            $scope.familiaNom = '';
            $scope.familiaCode = '';

            $scope.icones = [
                'video-camera',
                'star',
                'play-circle',
                'trophy',
                'whatsapp',
                'facebook',
                'twitter',
                'instagram',
                'user',
                'bank',
                'at',
                'bicycle',
                'bolt',
                'calendar',
                'camera',
                'commenting'
            ];

            $scope.tipusFamilia = [{
                'name': 'Cicle formatiu de grau mitjà',
                'code': 'fpgm'
            },{
                'name': 'Cicle formatiu de grau superior',
                'code': 'fpgs'
            },{
                'name': 'Règim especial',
                'code': 're'
            }];

            $scope.setType = function(code, name){
                $scope.newTipus = {'name': name, 'code': code};
            }

            $scope.setIcon = function(icon){
                $scope.newIcon = icon;
            }

            $scope.setFamily = function(code, name){
                $scope.familiaNom = name;
                $scope.familiaCode = code;
            }
        });
    </script>

    <div class="modal-dialog" role="document" ng-controller="NewDataController">
        <?php echo form_open(base_url('editar/'.$database.'/new_register'), 'id="edit_form"'); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Afegir registres</h4>
            </div>
            <div class="modal-body">

                <?php
                    foreach ($truecolumnes as $index => $columna){
                    if($index != 0){
                ?>
                    <fieldset>
                        <div class="form-group">
                            <?php if($database=='families' && $columna == 'url') {?>
                                <hr />
                                <div class="alert alert-info">
                                    <span><i class="fa fa-info-circle"></i> En cas de que sigui un estudi de règim especial emplenar els següents camps. En cas contrari deixar en blanc.</span>
                                </div>
                            <?php } ?>
                            <label class="control-label" for="textinput"><?php echo $columnes[$index]; ?></label>
                            <div>
                                <?php if($database == 'diary' && $columnes[$index]=='Observacions' ||
                                        $database == 'contests' && $columnes[$index]=='Descripció' ||
                                        $database == 'families' && $columnes[$index]=='Observacions'){ ?>
                                    <textarea name="<?php echo $columna; ?>" id="markdown"></textarea>
                                <?php } elseif($database=='studies' && $columnes[$index]=='Tipus d\'estudi') { ?>
                                    <div class="input-group">
                                        <div class="input-group-btn" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Escollir tipus
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li ng-click="setType(tipus.code, tipus.name)" ng-repeat='tipus in tipusFamilia'><a href="#">{{tipus.name}}</a></li>
                                            </ul>
                                        </div>
                                        <input class="form-control" type="text" value="{{newTipus.name}}" disabled/>
                                        <input class="form-control" type="hidden" id="familia" value="{{newTipus.code}}" name="<?php echo $columna;?>"/>
                                    </div>
                                <?php } elseif($database=='studies' && $columnes[$index]=='Familia') { ?>
                                    <div class="input-group">
                                        <div class="input-group-btn" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Escollir familia
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <input type='text' class="form-control" placeholder="buscar familia per..." ng-init="newFamilia=''" ng-model="newFamilia"/>
                                                <li ng-click="setFamily(familia.code, familia.name)" ng-repeat='familia in families | filter: newFamilia'><a href="#">{{familia.name}}</a></li>
                                            </ul>
                                        </div>
                                        <input class="form-control" type="text" id="familtype" value="{{familiaNom}}" disabled/>
                                        <input class="form-control" type="hidden" id="familia" value="{{familiaCode}}" name="<?php echo $columna;?>"/>
                                    </div>
                                <?php } elseif($database=='contests' && $columnes[$index]=='Icona') { ?>
                                    <div class="input-group">
                                        <div class="input-group-btn" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Escollir icona
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li ng-click="setIcon(icon)" ng-repeat='icon in icones'>
                                                    <a href="#"><i class="fa fa-{{icon}}"></i> {{icon}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <span class="input-group-addon" id="sizing-addon1">
                                            <i class="fa fa-{{newIcon}}"></i>
                                        </span>
                                        <input class="form-control" type="text" value="{{newIcon}}" disabled/>
                                        <input class="form-control" type="hidden" id="familia" name="<?php echo $columna; ?>" value="{{newIcon}}"/>
                                    </div>
                                <?php } else { ?>
                                    <input id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" type="text" class="form-control">
                                <?php } ?>

                            </div>
                        </div>
                    </fieldset>
                <?php }} ?>
                <script>
                    var simplemde = new SimpleMDE({ element: document.getElementById("markdown") });
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Tancar
                </button>
                <button type="reset" class="btn btn-warning">
                    <i class="fa fa-eraser"></i> Buidar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-floppy-o"></i> Guardar
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
