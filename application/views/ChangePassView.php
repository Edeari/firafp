<div class="container">
    <?php if($status) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <div class="status-msg">
                    <h1>Fira F<span style="color:#ffc907">&</span>T 2017</h1>
                    <hr />
                    <h2><i class="fa fa-check"></i> Correcte</h2>
                    <div class="status-details">
                         S'ha canviat la contrasenya correctament.
                    </div>
                    <div class="status-action">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-lg">
                                Iniciar Sessió <i class="fa fa-sign-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>
    <?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <div class="status-msg">
                    <h1>Fira F<span style="color:#ffc907">&</span>T 2017</h1>
                    <hr />
                    <h2><i class="fa fa-exclamation-circle"></i> Error</h2>
                    <div class="status-details">
                        La contrasenya repetida o la contrasenya actual és incorrecta.
                    </div>
                    <div class="status-action">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <a href="<?php echo base_url('admin/centers'); ?>" class="btn btn-primary btn-lg">
                                <i class="fa fa-arrow-left"></i> Tornar a l'administració
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>
    <?php } ?>
</div>
