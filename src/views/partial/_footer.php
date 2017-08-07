
<script src="<?= url('/assets/js/app.min.js?v='.buildNumber()) ?>"></script>
<?php
if(isset($scripts) && count($scripts) > 0) :
    foreach($scripts as $script) :
        echo '<script src="'.url($script).'"></script>'."\n";
    endforeach;
endif;
?>

</body>
</html>