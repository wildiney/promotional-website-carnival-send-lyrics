<?php
/**
 *  Footer View 
 */
?>
<footer class="footer navbar-fixed-bottom">
    <div class="row">
        <div class="col-sm-12 text-center">
            &copy <?php echo date("Y"); ?> - <a href="http://www.carnaval.com/pt-br/">carnaval.com</a>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">LOGIN</h4>
            </div>
            <div class="modal-body">
                <form action="/login" method="POST">
                    <div class="form-group">
                        <label for="matricula">Matrícula</label>
                        <input type="number" class="form-control" id="matricula" name="matricula" placeholder="MATRÍCULA" required="required" novalidate>
                    </div>
                    <div class="form-group">
                        <label for="data-de-nascimento">Data de Nascimento</label>
                        <input type="text" class="form-control" id="data-de-nascimento" name="data-de-nascimento" placeholder="00/00/0000" required="required" novalidate>
                    </div>
                    <input type="submit" id="btn_login" name="login" class="btn btn-primary" value="login">
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>vendor/components/modernizr/modernizr.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js" type="text/javascript"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-92197459-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>
