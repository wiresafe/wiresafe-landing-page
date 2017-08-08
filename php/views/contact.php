<?php
defined('APP') or die();

if(isset($_POST['contact_form_btn']))
{
    // settings
    $form_error = [];
    $allowedField = ['name', 'email', 'phone', 'company_name', 'message'];

    $postedData = sanitize($_POST);
    $postedData = extractOnlyAllowedKeys($postedData, $allowedField);

    // validation
    if(stringLength($postedData['name']) == 0) {
        $form_error['name'] = 'Enter your name';
    }

    if(stringLength($postedData['email']) == 0) {
        $form_error['email'] = 'Please enter a valid email';
    }

    if(stringLength($postedData['phone']) == 0) {
        $form_error['phone'] = 'Enter your phone number';
    }

    if(stringLength($postedData['message']) == 0) {
        $form_error['message'] = 'Enter your message';
    }

    // action
    if( count($form_error) == 0)
    {
        $postedData['message'] = nl2br($postedData['message']);
        $html = '';
        foreach ($postedData as $key => $value) {
            $html .= '<strong>'.$key.'</strong><br>'.$value.'<br><br>';
        }

        sendEmail([
            'to' => $config['mail']['admin']['email'],
            'name' => $config['mail']['admin']['name'],
            'subject' => 'WireSafe: New contact form request',
            'message' => $html,
            'replyTo' => $postedData['email'],
        ]);

        redirect('/message-sent');
    }

}

$pageTitle = 'Contact us';
$bodyClass = 'page__contact';

include APP_VIEW_ROOT.'/partial/_header.php';
include APP_VIEW_ROOT.'/modules/header.php';
?>

<!-- contact starts -->
<section class="contact">
    <figure style="background-image: url('<?= url('/assets/images/contact/bg-header.jpg') ?>')"></figure>

    <div class="contact__form">
        <div class="row">
            <div class="columns small-12 medium-8 large-8 end">
                <h2>Get in touch</h2>
                <h4>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</h4>
            </div>
        </div>

        <div class="row">
            <div class="columns small-12">

                <section class="contact__form__body">
                    <div class="row large-collapse">
                        <div class="columns large-8">

                            <section class="contact__form__body__primary">

                                <form action="<?= url('contact') ?>" method="post" class="form__material">
                                    <div class="row">
                                        <div class="columns small-12">
                                            <h3>Send us a Message <i class="fa fa-envelope-o"></i></h3>
                                        </div>

                                        <?php if(isset($form_error) && count($form_error) > 0) : ?>
                                            <div class="columns small-12">
                                                <div class="errors">
                                                    <?= implode($form_error, '<br>') ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="columns small-12 large-6">
                                            <label for="name">Your name</label>
                                            <input type="text" id="name" name="name" placeholder="Your name here" required>
                                        </div>
                                        <div class="columns small-12 large-6">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" placeholder="Your email address here" required>
                                        </div>
                                        <div class="columns small-12 large-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" id="phone" name="phone" placeholder="(880) 800 - 700 - 900" required>
                                        </div>
                                        <div class="columns small-12 large-6">
                                            <label for="company_name">Business Name (Optional)</label>
                                            <input type="text" id="company_name" name="company_name" placeholder="Your company name">
                                        </div>
                                        <div class="columns small-12 large-12">
                                            <label for="message">Message</label>
                                            <textarea name="message" id="message" required></textarea>
                                        </div>
                                        <div class="columns small-12 end">
                                            <button type="submit" name="contact_form_btn" class="button">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </section>

                        </div>
                        <div class="columns large-4">

                            <aside class="contact__form__body__secondary">
                                <h3>Contact us</h3>
                                <ul>
                                    <li><i class="fa fa-map-marker"></i>
                                        WireSafe, Inc. <br>
                                        3131 Camino Del Rio North Ste. 410 <br>
                                        San Diego, CA 92108
                                    </li>
                                    <li>
                                        <i class="fa fa-mobile"></i>
                                        619-327-2201
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o"></i>
                                        <a href="mailto:info@wiresafe.com">info@wiresafe.com</a>
                                    </li>
                                </ul>
                            </aside>

                        </div>
                    </div>
                </section>

            </div>
        </div>

    </div>
</section>
<!-- contact end -->

<?php
include APP_VIEW_ROOT.'/modules/footer.php';
include APP_VIEW_ROOT.'/partial/_footer.php';