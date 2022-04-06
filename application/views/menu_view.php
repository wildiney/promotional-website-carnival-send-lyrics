<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CARNAVAL <?php echo (isset($title)) ? $title : '' ?></a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <!--li><a href="/" class=""><i class="fa fa-home" aria-hidden="true"></i> INÍCIO</a></li-->
                <li><a href="/regulamento" class=""><i class="fa fa-file-text-o" aria-hidden="true"></i> REGULAMENTO</a></li>
                <?php if ($this->session->userdata('logged')) : ?>
                    <?php if (!$participacao): ?>
                        <li>
                            <a href="/enredo/enviar" class=""><i class="fa fa-upload" aria-hidden="true"></i> ENVIAR COMPOSIÇÃO</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="/enredo/votacao" class=""><i class="fa fa-check-square" aria-hidden="true"></i> VOTAÇÃO</a>
                    </li>
                    <li>
                        <a href="/enredo/ranking" class=""><i class="fa fa-line-chart" aria-hidden="true"></i> RANKING</a>
                    </li>
                    <li>
                        <a href="/login/logout" class=""><i class="fa fa-user-circle-o" aria-hidden="true"></i> LOGOUT</a>
                    </li>
                <?php else: ?>
                    <li>
                            <a href="/enredo" class=""><i class="fa fa-upload" aria-hidden="true"></i> PARTICIPAR</a>
                        </li>
                    <li>
                        <a href="#" class="" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-circle-o" aria-hidden="true"></i> LOGIN</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
