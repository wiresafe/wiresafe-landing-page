<?php
defined('APP') or die();

$pageTitle = 'Home';
$bodyClass = 'page__home';

if(isset($_POST['white_paper']))
{
    // settings
    $form_error = [];
    $allowedField = ['email'];

    $postedData = sanitize($_POST);
    $postedData = extractOnlyAllowedKeys($postedData, $allowedField);

    // validation
    if(stringLength($postedData['email']) == 0) {
        $form_error['email'] = 'Please enter a valid email';
    }

    // action
    if( count($form_error) == 0)
    {
        sendEmail([
            'to' => $postedData['email'],
            'name' => null,
            'subject' => 'WireSafe: Whitepaper report',
            'message' => 'FREE WHITEPAPER REPORT: REDUCING THE RISKS OF WIRE FRAUD',
            'attachment' => [
                'path' => APP_ATTACHMENT_ROOT.'/wiresafe_whitepaper_report.pdf',
                'name' => 'wiresafe_whitepaper_report.pdf',
            ],
        ]);

        redirect('/thank-you');
    }

}

include APP_VIEW_ROOT.'/partial/_header.php';
include APP_VIEW_ROOT.'/modules/header.php';
?>

    <!-- hero starts -->
    <section class="hero">
        <div class="row">
            <div class="columns small-10 small-offset-1 end">
                <h2>Trusted. <b>Secured.</b> Insured.</h2>
                <h4>The only guaranteed way to safely exchange wiring instructions</h4>

                <p>Since 2013, cyber criminals have defrauded over <strong>40,642</strong> victims and stolen over $<strong id="stolen-amount">0</strong> via wire fraud. Is your client next? </p>

                <small>Source: <a href="#">FBI Internet Crime Complaint Center, May 4, 2017</a></small>

                <ul>
                    <li><a href="#" class="button__large is--dark">Learn more</a></li>
                    <li><a href="#" class="button__large">Sign up</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- hero ends -->

    <!-- content video starts -->
    <section class="content__video">
        <div class="row">
            <div class="columns small-12">
                <h3>Learn how WireSafe works</h3>
                <a href="">
                    <i class="fa fa-play-circle"></i>
                    <p>Watch video</p>
                </a>
            </div>
        </div>
    </section>
    <!-- content video ends -->

    <!-- content intro starts -->
    <section class="content__intro" id="about-wiresafe">
        <div class="row">
            <div class="columns large-10 large-centered">
                <h2>What is <b>WireSafe</b></h2>
                <p>Wiresafe is an invitation only encrypted messaging platform for securely exchanging wiring instructions between you and your clients. <br><br>Through dual authentication, blockchain, encryption and insurance to protect you in the event of any loss, we guarantee the authenticity of wiring instructions exchanged between you and your client.</p>
            </div>
        </div>
    </section>
    <!-- content intro ends -->

    <!-- content step starts -->
    <section class="content__step">
        <div class="row">
            <div class="columns small-12">
                <h3>In order to understand how WireSafe secures the transmission of wiring instructions its important to understand how these cyberattacks are occurring in the first place.</h3>

                <div class="row">
                    <div class="columns medium-6 large-3">
                        <aside class="content__step__primary">
                            <b>1</b>
                            <p>Hackers search social media accounts to find someone who is buying or selling a home. </p>
                            <img src="assets/images/step/1.jpg" alt="">
                        </aside>
                    </div>
                    <div class="columns medium-6 large-3">
                        <aside class="content__step__secondary">
                            <b>2</b>
                            <p>They hack into the victims email account and intercept emails with wiring instructions </p>
                            <img src="assets/images/step/2.jpg" alt="">
                        </aside>
                    </div>
                    <div class="columns medium-6 large-3">
                        <aside class="content__step__primary">
                            <b>3</b>
                            <p>They tamper with and change the wiring instructions in the email </p>
                            <img src="assets/images/step/3.jpg" alt="">
                        </aside>
                    </div>
                    <div class="columns medium-6 large-3">
                        <aside class="content__step__secondary">
                            <b>4</b>
                            <p>They impersonate the victim and send an email with the “new” wiring instructions and funds are then re-directed to the hackers account never to be seen again.</p>
                            <img src="assets/images/step/4.jpg" alt="">
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content step ends -->


    <!-- content keynote starts -->
    <section class="content__keynote" id="how-it-works">
        <div class="row">
            <div class="columns small-12">
                <h3>How WireSafe Protects Your Wiring Information</h3>
                <h6>WireSafe secures the transmission of wiring instructions through 4 layers of security</h6>

                <div>
                    <img src="assets/images/keynote/mobile.png" alt="Mobile">
                    <ul>
                        <li>
                            <i class="fa fa-cube"></i>
                            <h5>Private</h5>
                            <p>Information is sent across private network, eliminating the opportunity for interception.</p>
                        </li>
                        <li>
                            <i class="fa fa-database"></i>
                            <h5>Encrypted</h5>
                            <p>Information is encrypted, eliminating the opportunity for tampering.</p>
                        </li>
                        <li>
                            <i class="fa fa-unlock-alt"></i>
                            <h5>Dual Authenticated</h5>
                            <p>Wiresafe dual authenticates the Sender and Receiver, eliminating the opportunity for impersonation.</p>
                        </li>
                        <li>
                            <i class="fa fa-shield"></i>
                            <h5>Validated</h5>
                            <p>Bank routing numbers are validated to ensure funds are transmitting to the proper institution, eliminating the possibility of misdirected funds.</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <!-- content keynote ends -->


    <!-- content guarantee starts -->
    <section class="content__guarantee" id="our-guarantee">
        <div class="row">
            <div class="columns small-12">
                <h3>OUR Million Dollar Guarantee</h3>
                <p>We guarantee the wire and banking information exchanged through our platform has not been tampered with or altered by any unauthorized source. Our exclusive Million Dollar Guarantee protects you and your client in the event of any breach. WireSafe was built to ensure the safe exchange of your wiring instructions, and we guarantee it.</p>

                <img src="assets/images/guarantee/icon.png" alt="guarantee">
                <h4>Stolen Funds Reimbursment</h4>
                <mark>If a breech ever occurs causing a loss WireSafe will reimburse the entire amount of any lost funds up to $1,000,000 per occurrence.</mark>
            </div>
        </div>
    </section>
    <!-- content guarantee ends -->


    <!-- pricing starts -->
    <section class="pricing" id="pricing">
        <div class="row">
            <div class="columns small-12">
                <h3>Simple Affordable Pricing Plans</h3>

                <div class="row">
                    <div class="columns medium-4">
                        <aside>
                            <header>
                                <h5>Small team</h5>
                                <span><b>$49.99</b> / user</span>
                                <a href="" class="button">Sign up</a>
                            </header>
                            <section>
                                <ol>
                                    <li><i class="fa fa-check"></i> 1-10 Users</li>
                                    <li><i class="fa fa-check"></i> $15 per channel</li>
                                    <li><i class="fa fa-check"></i> $150 Set Up Fee</li>
                                </ol>
                            </section>
                            <footer>
                                <a href="">Show Details  <i class="fa fa-angle-double-right"></i></a>
                            </footer>
                        </aside>
                    </div>
                    <div class="columns medium-4">
                        <aside>
                            <header>
                                <h5>Medium team</h5>
                                <span><b>$39.99</b> / user</span>
                                <a href="" class="button">Sign up</a>
                            </header>
                            <section>
                                <ol>
                                    <li><i class="fa fa-check"></i> 11-10 Users</li>
                                    <li><i class="fa fa-check"></i> $10 per channel</li>
                                    <li><i class="fa fa-check"></i> $99 Set Up Fee</li>
                                </ol>
                            </section>
                            <footer>
                                <a href="">Show Details  <i class="fa fa-angle-double-right"></i></a>
                            </footer>
                        </aside>
                    </div>
                    <div class="columns medium-4">
                        <aside class="pricing__hero">
                            <header>
                                <h5>Large team</h5>
                                <span><b>$29.99</b> / user</span>
                                <a href="" class="button">Sign up</a>
                            </header>
                            <section>
                                <ol>
                                    <li><i class="fa fa-check"></i> 50+ Users</li>
                                    <li><i class="fa fa-check"></i> $8 per channel</li>
                                    <li><i class="fa fa-check"></i> Set up fee <b>free</b></li>
                                </ol>
                            </section>
                            <footer>
                                <a href="">Show Details  <i class="fa fa-angle-double-right"></i></a>
                            </footer>
                        </aside>
                    </div>
                </div>


                <form action="./" method="post">
                    <input type="text" placeholder="Promo Code (Optional)">
                    <button type="submit">Apply</button>
                </form>

                <div class="clear"></div>
            </div>
        </div>
    </section>
    <!-- pricing ends -->

    <!-- content signup starts -->
    <section class="content__signup">
        <img src="assets/images/signup/bg.jpg" alt="signup">
        <div class="row">
            <div class="columns small-12">
                <h3>It only takes minutes to sign up</h3>
                <a href="" class="button__large">SIGN UP</a>
            </div>
        </div>
    </section>
    <!-- content signup ends -->

    <!-- guide starts -->
    <section class="guide">
        <div class="row">
            <div class="columns small-12">

                <h3>Free Whitepaper Report: Reducing the Risks of Wire Fraud</h3>

                <div class="row">
                    <div class="columns large-6">
                        <img src="assets/images/guide/books.jpg" alt="books">
                    </div>
                    <div class="columns large-6">
                        <form action="./" method="post">
                            <input type="email" name="email" placeholder="Your email address" required>
                            <button type="submit" name="white_paper">Submit</button>
                        </form>

                        <small>** We use the information you provide in accordance with our privacy policy.</small>

                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- guide ends -->

<?php
$scripts = [
    '/assets/js/jquery.animateNumber.min.js',
    '/assets/js/animateNumber.js',
];
include APP_VIEW_ROOT.'/modules/footer.php';
include APP_VIEW_ROOT.'/partial/_footer.php';