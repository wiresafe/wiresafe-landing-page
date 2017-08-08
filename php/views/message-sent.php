<?php
defined('APP') or die();

$pageTitle = 'Thank you';
$bodyClass = 'page__thankyou';

include APP_VIEW_ROOT.'/partial/_header.php';
include APP_VIEW_ROOT.'/modules/header.php';
?>

    <!-- thank you starts -->
    <section class="thank__you">
        <div class="row">
            <div class="columns small-12 medium-10 medium-centered">
                <h3>Thank you for contacting us.</h3>
                <p>You are very important to us, all information received will always remain confidential. We will contact you as soon as we review your message.</p>
            </div>
        </div>
    </section>
    <!-- thank you ends -->

<?php
include APP_VIEW_ROOT.'/modules/footer.php';
include APP_VIEW_ROOT.'/partial/_footer.php';