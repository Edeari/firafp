<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="form-wrap">
                    <?php if(!$error){ ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-warning-sign"></span>
                            L'usuari o la contrasenya son incorrectes
                        </div>
                    <?php } ?>
                    <h1>Fira F<span class="custom-color">&</span>T 2017 | Administració</h1>
                    <form role="form" action="<?php echo base_url('login') ?>" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label><i class="fa fa-user-circle-o fa-lg"></i> Nom d'usuari</label>
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Introduir nom d'usuari">
                        </div>
                        <div class="form-group">
                            <label><i class="fa fa-lock fa-lg"></i> Contrasenya</label>
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Introduir la contrasenya">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Mostrar contrasenya</span>
                        </div>
                        <button type="submit" class="btn btn-custom btn-lg btn-block">
                            <i class="fa fa-sign-in"></i> Iniciar Sessió
                        </button>

                    </form>
                    <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">Has oblidat la teva contrasenya?</a>
                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Tancar</span>
                </button>
                <h4 class="modal-title">Recuperar contrasenya</h4>
            </div>
            <div class="modal-body">
                <p>Introdueix el correu electrònic</p>
                <input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel·lar</button>
                <button type="button" class="btn btn-custom">Recuperar</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>IES Caparrella - 2017</p>
                <p>Creat per <strong><a href="" target="_blank">Carlos Muñoz 2n DAW</a></strong></p>
            </div>
        </div>
    </div>
</footer>
