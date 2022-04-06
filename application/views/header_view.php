<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
        Carnaval <?php echo date("Y"); ?> <?php echo (isset($title))? " / " . $title : ""; ?>
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <?php 
        echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        echo link_tag('vendor/twbs/bootstrap/dist/css/bootstrap.min.css');
        echo link_tag('assets/css/styles.css');
        echo script_tag('vendor/components/jquery/jquery.min.js');
        echo script_tag('vendor/twbs/bootstrap/dist/js/bootstrap.min.js');
        ?>
        <?php echo (isset($scripts))? $scripts : ""; ?>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="alert alert-warning">Você está usando um navegador <strong>desatualizado</strong>. Por favor, <a href="http://browsehappy.com/">atualize seu browser</a> para melhorar a sua experiência e segurança.</p>
        <![endif]-->
        


