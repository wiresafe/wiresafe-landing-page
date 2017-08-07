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
                <img src="assets/images/thank-you/book.jpg" alt="Book">
                <h4>Thank you for requesting our whitepaper report:</h4>
                <h3>REDUCING THE RISKS OF WIRE FRAUD.</h3>
                <p>Please check your email for the PDF copy of the report or download from below.</p>

                <a href="<?= url('attachments/wiresafe_whitepaper_report.pdf') ?>" class="button__large">Download the report <i class="fa fa-download"></i></a>
            </div>
        </div>
    </section>
    <!-- thank you ends -->

<?php
include APP_VIEW_ROOT.'/modules/footer.php';
include APP_VIEW_ROOT.'/partial/_footer.php';