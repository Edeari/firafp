<nav class="navbar navbar-default" data-spy="affix" data-offset-top="197">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Fira F<span style="color:#ffc907">&</span>T 2017</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-tasks"></i> Administració <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admin/families') ?>">Families</a></li>
                        <li><a href="<?php echo base_url('admin/centers') ?>">Centres</a></li>
                        <li><a href="<?php echo base_url('admin/studies') ?>">Estudis</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url('admin/diary') ?>">Agenda</a></li>
                        <li><a href="<?php echo base_url('admin/contests') ?>">Concursos</a></li>
                        <li><a href="<?php echo base_url('admin/news') ?>">Notícies</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url('admin/families') ?>"><i class="fa fa-user"></i>  Usuaris</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Benvingut, <span class="glyphicon glyphicon-user"></span> <strong><?php echo $this->session->userdata('username'); ?></strong></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#changePass"><i class="fa fa-key"></i> Canviar contrasenya</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> Tancar sessió</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tancar sessió</h4>
            </div>
            <div class="modal-body">
                Vols tancar la sessió?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel·lar</button>
                <a class="btn btn-warning" href="<?php echo base_url('login/out') ?>"><i class="fa fa-sign-out"></i> Tancar sessió</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="changePass">
    <div class="modal-dialog" role="document">
        <?php echo form_open(base_url('changePass'), 'id="change_pass_form"'); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Canvi de contrasenya</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <div class="form-group">
                        <label class="form-label">Nova contrasenya</label>
                        <input class="form-control" type="text" placeholder="Introduiu la nova contrasenya" name="newpass"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Repetir nova contrasenya</label>
                        <input class="form-control" type="text" placeholder="Repetiu la nova contrasenya" name="newpass2"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contrasenya antiga</label>
                        <input class="form-control" type="text" placeholder="Introduiu la contrasenya anterior" name="actualpass"/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel·lar</button>
                <button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#confirm"><i class="fa fa-key"></i> Canviar contrasenya</button>
            </div>
            <div id="confirm" class="modal-footer collapse" style="text-align:center!important">
                <h4>Segur que vols canviar la contrasenya?</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                <button type="submit" class="btn btn-warning"><i class="fa fa-check"></i> Sí</button>
            </div>
        </div>
        </form>
    </div>
</div>
