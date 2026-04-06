<?php
// Template name: IVF
get_header();
?>
    <style>
        .header {
            background: #ffffffb3;
        }

        .partner img {
            max-width: 90%;
        }

        .partner ul li:before {
            width: 8px;
            height: 8px;
            background: #8777b2;
            position: absolute;
            left: 0;
            top: 16px;
            content: '';
            border-radius: 10px;
        }

        .partner ul li {
            display: block;
            position: relative;
            padding: 10px 15px;
            width: 33%;
        }

        .partner ul {
            display: flex;
            flex-wrap: wrap;
        }

        .partner h2 {
            margin: 0 0 25px;
        }

        .partner h3 {
            margin: 45px 0 30px;
        }

        h1 {
            margin: 0 0 70px;
        }

        .partner .modal_call_btn {
            width: 230px;
            height: 55px;
            background-color: #F8C7B2;
            border-radius: 40px;
            font-weight: bold;
            font-size: 11px;
            line-height: 1;
            cursor: pointer;
            transition: 0.3s;
            display: inline-flex;
            -webkit-box-align: center;
            align-items: center;
            text-align: center;
            justify-content: center;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            position: relative;
            color: #101010;
            border: none;
            margin: 20px 0;
        }

        @media screen and (max-width: 991px) {
            .partner ul li {
                width: 50%;
            }
        }

        @media screen and (max-width: 767px) {
            .partner h2 {
                margin: 30px 0 25px;
            }

            h1 {
                margin: 0 0 30px;
            }

            .partner img {
                max-width: 100%;
            }
        }
    </style>
    <div class="intro_section" style="background: transparent">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php pll_e('Our partners') ?></h1>
                </div>
            </div>

            <div class="partner row" style="margin-bottom: 70px;">
                <div class="col-md-4">
                    <img src="https://embrymama.com/wp-content/uploads/2024/06/nowf2.png" alt="nowf2">
                </div>
                <div class="col-md-8">
                    <h2>NOW-fertility</h2>
                    <p><?php pll_e('We are reimagining fertility care to help you have the family that you want or preserve your
                        fertility. We offer patient-centred, accessible and affordable IVF through a wide choice of
                        partner clinics worldwide, with no waiting time to start your treatment. Our aim is to make your
                        treatment less stressful and more successful') ?></p>
                    <p>
                        <button class="modal_call_btn"
                                onclick="$('.modal_call').show()"><?php pll_e('Получить консультацию') ?></button>
                    </p>
                    <h3>
                        <?php pll_e('Services') ?>
                    </h3>
                    <ul>
                        <li><?php pll_e('IVF / ICSI') ?></li>
                        <li><?php pll_e('IVF for Gender Selection') ?></li>
                        <li><?php pll_e('IVF with Donor Eggs') ?></li>
                        <li><?php pll_e('IVF with Donor Sperm') ?></li>
                        <li><?php pll_e('IVF with Double Donation') ?></li>
                        <li><?php pll_e('IVF for Embryo Banking') ?></li>
                        <li><?php pll_e('IVF Treatment for Single Women') ?></li>
                        <li><?php pll_e('IVF Treatment for Same-Sex Couples') ?></li>
                        <li><?php pll_e('Embryo Donation') ?></li>
                        <li><?php pll_e('Egg Freezing') ?></li>
                        <li><?php pll_e('Sperm Freezing') ?></li>
                        <li><?php pll_e('Embryo Freezing') ?></li>
                        <li><?php pll_e('Frozen Embryo Transfer') ?></li>
                        <li><?php pll_e('Genetic Testing') ?></li>
                    </ul>
                    <h3>
                        <?php pll_e('Additional Services') ?>
                    </h3>
                    <ul>
                        <li><?php pll_e('Egg Bank') ?></li>
                        <li><?php pll_e('Online Pharmacy') ?></li>
                        <li><?php pll_e('Laboratory Services') ?></li>
                        <li><?php pll_e('IVF Refund Guarantee Programme') ?></li>
                        <li><?php pll_e('Credit Facility') ?></li>
                        <li><?php pll_e('Legal Advice') ?></li>
                        <li><?php pll_e('Egg, sperm and embryo transportation') ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();