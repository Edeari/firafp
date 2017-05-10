<?php $index = 1; ?>
<div class="container">
    <script>
        app.controller('EditController', function($scope) {
            $scope.families = <?php echo $families; ?>;

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
                'name': 'Re',
                'code': 're'
            }];

            $scope.setType = function(code, name){
                $scope.newTipus = {'name': name, 'code': code};
            }

            $scope.setIcon = function(icon){
                $scope.newIcon = icon;
            }
        });
    </script>

    <div class="row" ng-controller="EditController">

        <?php if($dades === TRUE){ ?>
            <div class="centered-box">
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check"></i> Registre actualitzat amb èxit
                </div>
                <a href="<?php echo base_url('admin/'.$table); ?>" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Tornar <?php echo $nomactual; ?>
                </a>
            </div>
        <?php } else { ?>
            <?php foreach ($dades as $dada){ ?>
            <?php echo form_open(base_url('editar/'.$table.'/save_register'), 'id="edit_form"'); ?>
                <fieldset>

                    <legend>Editar dades de:
                        <strong>
                        <?php if(isset($dada['name'])) echo $dada['name']; ?>
                        <?php if(isset($dada['title'])) echo $dada['title']; ?>
                        </strong>
                    </legend>

                    <input name="id" type="hidden" value="<?php echo $dada['id']; ?>">
                    <!-- Form Name -->
                    <?php foreach ($dada as $key => $value):
                        if($key != 'id'){
                        ?>
                        <?php if($table=='families' && $key == 'url') {?>
                            <hr />
                            <div class="alert alert-info">
                                <span><i class="fa fa-info-circle"></i> En cas de que sigui un estudi de règim especial emplenar els següents camps. En cas contrari deixar en blanc.</span>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label><?php echo $columns[$index]; ?></label>
                            <div>
                                <?php if(($table == 'diary' && $columns[$index]=='Observacions') || ($table =='families' && $key=='observation') || ($table=='contests' && $key=='description')){ ?>
                                    <textarea name="<?php echo $key; ?>" id="markdown"></textarea>
                                    <script>
                                        var textareaValue = `<?php echo $value; ?>`;
                                    </script>
                                    <?php } elseif($table=='studies' && $columns[$index]=='Tipus d\'estudi') { ?>
                                        <div class="input-group" ng-init="newTipus.name='<?php echo $value; ?>'; newTipus.code='<?php echo $value; ?>'">
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
                                            <input class="form-control" type="hidden" id="<?php echo $key; ?>" value="{{newTipus.code}}" name="<?php echo $key;?>"/>
                                        </div>
                                    <?php } elseif($table=='contests' && $columns[$index]=='Icona') { ?>
                                        <div class="input-group" ng-init="newIcon='<?php echo $value; ?>'">
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
                                            <input class="form-control" type="hidden" id="familia" name="<?php echo $key; ?>" value="{{newIcon}}"/>
                                        </div>
                                    <?php } else { ?>
                                    <input id="<?php echo $key; ?>" name="<?php echo $key; ?>" type="text" class="form-control" value="<?php echo $value; ?>">
                                <?php } ?>
                            </div>
                        </div>
                    <?php
                        $index++;
                        }
                        endforeach;
                    ?>
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <a href="<?php echo base_url('admin/'.$table); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Tornar <?php echo $nomactual; ?>
                            </a>
                            <button id="save_button" name="save_button" class="btn btn-primary" type="submit">
                                <i class="fa fa-floppy-o"></i> Guardar
                            </button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<script>
    var simplemde = new SimpleMDE({ element: document.getElementById("markdown") });
    simplemde.value(textareaValue);

    function setType(type){
        $('#type').val(type);
    }
</script>
