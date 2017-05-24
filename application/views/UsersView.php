<div class="row" ng-controller="UsersController">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Usuaris del sistema</h2>
                <hr />
            </div>
            <div class="input-group" style="margin-bottom: 2px !important;">
                <span class="input-group-addon" id="basic-addon1" style="background-color: #fff">
                    <i class="fa fa-search"></i>
                </span>
                <input type="search" class="form-control square-input" ng-init="buscarDada=''" placeholder="Buscar usuari per..." ng-model="buscarDada"/>
                <span class="input-group-btn">
                    <button class="btn btn-success square-btn" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Afegir usuari</button>
                </span>
            </div>
            <table class="table">
                <tr>
                    <th>Nom d'usuari</th>
                    <th>Contrasenya</th>
                    <th>Rol</th>
                    <th style="text-align: right">Opcions</th>
                </tr>
                <tr ng-repeat="usuari in usuaris | filter: buscarDada" ng-show="usuari.username != '<?php echo $this->session->username; ?>'">
                    <td>
                        <i class="fa fa-user fa-lg"></i> {{usuari.username}}
                    </td>
                    <td>
                        <span>{{usuari.pass}}</span>
                    </td>
                    <td>
                        <span class="badge custom-badge" ng-show="usuari.level==10">Admin</span>
                        <span class="badge custom-badge" ng-show="usuari.level<10 && usuari.level>=5">Moderador</span>
                        <span class="badge custom-badge" ng-show="usuari.level<5">Estàndard</span>
                    </td>
                    <td style="text-align: right">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="#" class="btn btn-default" ng-class="{'btn btn-primary':hover1, 'btn btn-default':!hover1}" ng-mouseenter="hover1=true" ng-mouseleave="hover1=false" data-toggle="modal" data-target="#editModal" ng-click="setCurrentUser(usuari)">
                                <i class="fa fa-pencil-square-o"></i>
                                Editar usuari
                            </a>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" ng-class="{'btn btn-warning':hover2, 'btn btn-default':!hover2}" ng-mouseenter="hover2=true" ng-mouseleave="hover2=false" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-pencil"></i>
                                    Canviar rol
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a ng-click="setCurrentUser(usuari, 10)" data-toggle="modal" data-target="#rolModal" href="#">Admin</a></li>
                                    <li><a ng-click="setCurrentUser(usuari, 8)" data-toggle="modal" data-target="#rolModal" href="#">Modeador</a></li>
                                    <li><a ng-click="setCurrentUser(usuari, 4)" data-toggle="modal" data-target="#rolModal" href="#">Estàndard</a></li>
                                </ul>
                            </div>
                            <a ng-click="setCurrentUser(usuari)" href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-default" ng-class="{'btn btn-danger':hover3, 'btn btn-default':!hover3}" ng-mouseenter="hover3=true" ng-mouseleave="hover3=false">
                                <i class="fa fa-trash"></i>
                                Eliminar
                            </a>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar usuari</h4>
                </div>

                <form method="post" action="<?php echo base_url('usuaris/delete') ?>">
                <?php //form_open(base_url('usuaris/edit'), 'id="pass_form"') ?>
                <div class="modal-body" style="text-align:center">
                    <input type="hidden" name="username" value="{{currentUser.username}}"/>
                    <h4>
                        Eliminaras a l'usuari <strong>{{currentUser.username}}</strong>, estàs segur?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel·lar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash-o"></i> Eliminar
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rolModal" tabindex="-1" role="dialog" aria-labelledby="rolModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar rol d'usuari</h4>
                </div>

                <form method="post" action="<?php echo base_url('usuaris/editrole') ?>">
                <?php //form_open(base_url('usuaris/edit'), 'id="pass_form"') ?>
                <div class="modal-body" style="text-align:center">
                    <input type="hidden" name="username" value="{{currentUser.username}}"/>
                    <input type="hidden" name="rol" value="{{currentUser.newlevel}}" />
                    <h4>
                        Canviarás el rol de l'usuari <strong>{{currentUser.username}}</strong> a:
                        <span ng-show="currentUser.newlevel==10"><strong>Admin</strong></span>
                        <span ng-show="currentUser.newlevel<10 && currentUser.newlevel>=5"><strong>Moderador</strong></span>
                        <span ng-show="currentUser.newlevel<5"><strong>Estàndard</strong></span>
                        , estàs segur?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel·lar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i> Actualitzar rol
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar usuari</h4>
                </div>

                <form method="post" action="<?php echo base_url('usuaris/edituser') ?>">
                <?php //form_open(base_url('usuaris/edit'), 'id="pass_form"') ?>
                <div class="modal-body">
                    <input type="hidden" name="username" value="{{currentUser.username}}"/>
                    <div class="form-group">
                        <label>Contrasenya</label>
                        <input class="form-control" type="password" name="pass" ng-model="password.pass" ng-change="checkPass()"/>
                    </div>
                    <div class="form-group">
                        <label>Repetir contrasenya</label>
                        <input class="form-control" type="password" name="repass" ng-model="password.repass" ng-change="checkPass()"/>
                    </div>
                    <div class="alert alert-danger" ng-show="!password.check">
                        <i class="fa fa-exclamation-circle"></i>
                        Les contrasenyes no coincideixen o estan buides
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel·lar
                    </button>
                    <button type="submit" class="btn btn-primary" ng-show="password.check">
                        <i class="fa fa-floppy-o"></i> Canviar contrasenya
                    </button>
                    <a class="btn btn-primary disabled" ng-hide="password.check">
                        <i class="fa fa-floppy-o"></i> Canviar contrasenya
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Afegir usuari</h4>
                </div>

                <form method="post" action="<?php echo base_url('usuaris/add') ?>">
                <?php //form_open(base_url('usuaris/add'), 'id="pass_form"'); ?>
                <div class="modal-body">
                    <input type="hidden" name="username" value="{{currentUser.username}}"/>
                    <div class="form-group">
                        <label>Nom d'usuari</label>
                        <input class="form-control" type="text" name="username"/>
                    </div>
                    <div class="form-group">
                        <label>Contrasenya</label>
                        <input class="form-control" type="password" name="pass" ng-model="password.pass" ng-change="checkPass()"/>
                    </div>
                    <div class="form-group">
                        <label>Repetir contrasenya</label>
                        <input class="form-control" type="password" name="repass" ng-model="password.repass" ng-change="checkPass()"/>
                    </div>

                    <div class="alert alert-danger" ng-show="!password.check">
                        <i class="fa fa-exclamation-circle"></i>
                        Les contrasenyes no coincideixen o estan buides
                    </div>

                    <div class="form-group">
                        <label>Seleccionar rol</label>
                        <div class="input-group">
                            <input class="form-control" type="text" ng-model="rolename" readonly="true"/>
                            <input type="hidden" name="role" ng-value="newrole" ng-model="newrole"/>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Seleccionar rol</span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a ng-click="setRole(10); newrole=10;" href="#">Admin</a></li>
                                    <li><a ng-click="setRole(8); newrole=8;" href="#">Modeador</a></li>
                                    <li><a ng-click="setRole(4); newrole=4;" href="#">Estàndard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel·lar
                    </button>
                    <button type="submit" class="btn btn-primary" ng-show="password.check">
                        <i class="fa fa-plus-circle"></i> Afegir usuari
                    </button>
                    <a class="btn btn-primary disabled" ng-hide="password.check">
                        <i class="fa fa-plus-circle"></i> Afegir usuari
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
app.controller('UsersController', function($scope) {
    $scope.usuaris = <?php echo $usuaris; ?>;
    console.log(<?php echo $usuaris; ?>);
    $scope.password = {
        pass: null,
        repass: null,
        check: false
    };
    $scope.currentUser = null;

    $scope.checkPass = function(){
        if($scope.password.pass === $scope.password.repass && $scope.password.pass.length>0 && $scope.password.repass.length>0){
            $scope.password.check = true;
        } else {
            $scope.password.check = false;
        }
    };

    $scope.setCurrentUser = function(user, rol = null){
        $scope.currentUser = user;
        $scope.currentUser.newlevel = rol;
        $scope.password = {
            pass: null,
            repass: null,
            check: false
        };
    };

    $scope.setRole = function(role){
        if(role==10){
            $scope.rolename = 'Admin'
        } else if (role<10 && role>=5) {
            $scope.rolename = 'Moderador'
        } else if (role<5 && role>0) {
            $scope.rolename = 'Estándard'
        }
    };
});
</script>
