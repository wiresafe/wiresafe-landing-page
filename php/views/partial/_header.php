<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= isset($pageTitle) ? $pageTitle .' - WireSafe' : 'WireSafe' ?></title>
    <link rel="stylesheet" href="<?= url('/assets/css/style.min.css?v='.buildNumber()) ?>">

    <?php
    if(isset($stylesheets) && count($stylesheets) > 0) :
        foreach($stylesheets as $stylesheet) :
            echo '<link rel="stylesheet" href="'.url($stylesheet).'?v='.buildNumber().'">'."\n";
        endforeach;
    endif;
    ?>

    <script>var BASE_URL = '<?= $config['base_url'] ?>';</script>
</head>
<body class="has--sticky<?= isset($bodyClass) ? ' '.$bodyClass : null ?>">