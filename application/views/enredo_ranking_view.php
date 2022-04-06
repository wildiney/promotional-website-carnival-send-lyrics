
<div id="votacao">
    <div class="overlay">
        <div class="container votacao">

            <div class="row enredos">
                <div class="col-sm-12">
                    <table class="table table-hover table-bordered table-striped">
                        <tr>
                            <th class="text-center">&nbsp;</th>
                            <th>Título</th>
                            <th>Compositor</th>
                            <th>Cidade</th>
                            <th class="text-center">Votos</th>
                        </tr>
                        <?php foreach ($resultados as $item): ?>
                            <tr>
                                <td valign="middle" style="display: table-cell; vertical-align: middle;"><div style="margin:0 auto; border:1px solid gray; border-radius:5px; height:30px; width:30px; background: url(<?php echo (isset($item->imagem))? base_url() . $item->imagem:'/assets/img/thumbnail.jpg'; ?>) no-repeat center center; background-size:cover"></div></td>
                                <td valign="middle" style="display: table-cell; vertical-align: middle;"><a href="#" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="<?php echo str_replace('"',"'",nl2br($item->e_enredo, true)); ?>"><?php echo $item->e_tituloEnredo; ?></a></td>
                                <td valign="middle" style="display: table-cell; vertical-align: middle;"><?php echo $item->e_compositor; ?></td>
                                <td valign="middle" style="display: table-cell; vertical-align: middle;"><?php echo $item->u_cidade; ?></td>
                                <td valign="middle" style="display: table-cell; vertical-align: middle; text-align: center;"><?php echo $item->total; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>