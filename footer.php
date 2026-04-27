<div class="footer">
    <!--    <img class="fot_c_logo" alt="logo" src="--><?php //echo get_logo_circle(); 
                                                        ?><!--">-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 footer-first">
                <div class="img">
                    <img src="<?php echo get_logo(); ?>" alt="logo_foot" class="logo_foot">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 footer-menu">
                <?php if (!dynamic_sidebar('Main menu')) : ?><?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 footer-second">
                <?php if (!dynamic_sidebar('Footer menu')) : ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="m2">
    <div class="modal-dialog" role="document">
        <div class="modal_wrp">
            <div class="route">
                <p class="mt1"><?php pll_e('Выберите тему обращения') ?></p>
                <p class="mt2"><?php pll_e('Так мы сможем быстро ответить на ваш вопрос') ?></p>
                <button class="normb"
                    onclick="$(this).parent().hide(); $('#theme').val('Ищу сурмаму'); animateForm()"><?php pll_e('Ищу сурмаму') ?></button>
                <button class="normb color2"
                    onclick="$(this).parent().hide(); $('#theme').val('Xочу стать сурмамой'); animateForm()"><?php pll_e('Xочу стать сурмамой') ?></button>
                <button class="normb color2"
                    onclick="$(this).parent().hide(); $('#theme').val('Xочу стать донором ооцитов'); animateForm()"><?php pll_e('Xочу стать донором ооцитов') ?></button>
            </div>
            <div class="closemod">
                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/closemod.svg" alt="closemod">
            </div>
            <p class="mt1"><?php pll_e('Заполните форму') ?></p>
            <p class="mt2"><?php pll_e('Мы с удовольствием ответим на все Ваши вопросы') ?></p>
            <form class="crm_form" data-id id="crm_form_tj">
                <input type="hidden" name="subj_type" value="Заявка с сайта" style="display:none;">
                <div class="input_item"><input type="text" name="fio"
                        placeholder="<?php pll_e('ФИО') ?>"><span>01</span></div>
                <div class="input_item validate phone"><input type="text" name="phone" id="phone"
                        placeholder="<?php pll_e('Телефон') ?> *"><span>02</span>
                </div>
                <div class="input_item email">
                    <input type="text" name="email" placeholder="E-mail">
                    <span>03</span>
                </div>
                <div class="input_item">
                    <input type="text" name="city"
                        placeholder="<?php pll_e('Ваш город проживания') ?>">
                    <span>04</span>
                </div>
                <input type="hidden" name="theme" id="theme" value="">
                <input type="hidden" name="page"
                    value="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                <button class="normb submit_form" type="button"
                    onclick="submitForm()"><?php pll_e('Отправить') ?></button>
                <p class="pressing pressed"><?php pll_e('Вы даете согласие на обработку своих персональных данных') ?></p>
            </form>
        </div>
    </div>
</div>


<div class="modal_call fade">
    <div class="modal-dialog" role="document">
        <div class="modal_wrp">
            <div class="closemod" onclick="$('.modal_call').hide()">
                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/closemod.svg"
                    alt="closemod"> <?php // /<?php echo glob_lng(); 
                                    ?>
            </div>
            <p class="mt1"><?php pll_e('Заполните форму') ?></p>
            <p class="mt2"><?php pll_e('Мы перезвоним вам в ближайшее время') ?></p>
            <form class="call_form" id="call_form" method="post">
                <div class="input_item"><input type="text" name="fio"
                        placeholder="<?php pll_e('ФИО') ?>"><span>01</span></div>
                <div class="input_item validate"><input type="text" name="phone_call" id="phone_call" class="phone_call"
                        placeholder="<?php pll_e('Телефон') ?> *"><span>02</span>
                </div>
                <input type="hidden" name="page"
                    value="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                <input type="hidden" name="submit" value="submit">
                <button class="normb submit_form" type="button"
                    onclick="submitFormCall()"><?php pll_e('Отправить') ?></button>
                <p class="pressing pressed"><?php pll_e('Вы даете согласие на обработку своих персональных данных') ?></p>
            </form>
        </div>
    </div>
</div>


<!--Успешная отправка-->
<div class="modal fade" id="thanks">
    <div class="modal-dialog" role="document">
        <div class="modal_wrp">
            <div class="closemod">
                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/closemod.svg" alt="closemod">
            </div>
            <p class="thanks_text1"><?php pll_e('Спасибо') ?></p>
            <p class="thanks_text2"><?php pll_e('Ваша заявка отправлена') ?></p>
            <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/sent.svg" alt="sent" class="sent">
            <p class="thanks_text3"><?php pll_e('Мы свяжемся с Вами в ближайшее время и уточним все вопросы') ?></p>
        </div>
    </div>
</div>

<!--Провал отправки-->
<div class="modal fade" id="ouch">
    <div class="modal-dialog" role="document">
        <div class="modal_wrp">
            <div class="closemod">
                <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/closemod.svg" alt="closemod">
            </div>
            <p class="thanks_text1"><?php pll_e('Что-то пошло не так') ?></p>
            <p class="thanks_text2"><?php pll_e('Мы уже устраняем неполадку') ?></p>
            <img src="/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/icon-failed.svg" alt="failed" class="sent">
            <p class="thanks_text3"><?php pll_e('Пожалуйста свяжитесь с нами любым другим, удобным для вас способом. Приносим свои извинения.') ?></p>
        </div>
    </div>
</div>

<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, ({
        autoPlaceholder: "polite",
        formatOnDisplay: true,
        initialCountry: "tj",
    }));

    var input1 = document.querySelector("#phone_call");
    window.intlTelInput(input1, ({
        autoPlaceholder: "polite",
        formatOnDisplay: true,
        initialCountry: "tj",
    }));

    function blockBtn() {
        $('.submit_form').attr('disabled', true)
    }

    function unblockBtn() {
        $('.submit_form').attr('disabled', false)
    }

    function submitFormCall() {
        if ($('input.phone_call').val()?.length > 10) {
            blockBtn()
            var form_data = $("#call_form").serialize();
            console.log(form_data)
            $.ajax({
                type: "POST",
                url: "/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/api/mail_call.php?" + form_data,
                data: form_data,
                success: function(data) {
                    console.log(data)
                    if (data == 1) {
                        $('.modal').hide('fast');
                        setTimeout(function() {
                            $('#thanks').show('fast')
                        }, 300)
                    } else if (data == 2) {
                        $('.modal').hide('fast');
                        setTimeout(function() {
                            $('#ouch').show('fast')
                        }, 300)
                    }
                    unblockBtn()
                },
                error: function() {
                    $('.modal').hide('hide');
                    setTimeout(function() {
                        $('#ouch').show('fast')
                    }, 300)
                    unblockBtn()
                }
            });
        } else {
            $(".validate").addClass('invalid')
        }
    }

    function submitForm() {
        if ($('input[name="phone"]').val().length < 11) {
            $(".phone").addClass('invalid')
        } else {
            blockBtn()
            var form_data = $(".crm_form").serialize();
            $.ajax({
                type: "POST",
                url: "/<?php echo glob_lng(); ?>/wp-content/themes/embrymama/api/mail.php",
                data: form_data,
                success: function(data) {
                    if (data == 1) {
                        $('.modal').hide('fast');
                        setTimeout(function() {
                            $('#thanks').show('fast')
                        }, 300)
                    } else if (data == 2) {
                        $('.modal').hide('fast');
                        setTimeout(function() {
                            $('#ouch').show('fast')
                        }, 300)
                    }
                    unblockBtn()
                },
                error: function() {
                    $('.modal').hide('hide');
                    setTimeout(function() {
                        $('#ouch').show('fast')
                    }, 300)
                    unblockBtn()
                }
            });
        }
    }

    $('input').focus(function() {
        $(this).parent().removeClass('invalid')
        $(this).parent().parent().removeClass('invalid')
    })

    $('.menu-toggle').click(function() {
        $(this).toggleClass("active")
        $('.header-menu').toggle('fast')
        $('.header').toggleClass("opened")
    })

    $('.qu_item').click(function() {
        $(this).toggleClass("qu_opened")
        $(this).find('.qu_answer').toggle("fast")
    })

    $('.modal_contact').click(function() {
        $('#m2').show()
        if ($(this).hasClass('triggerSM')) {
            $('.route').hide();
            $('#theme').val('Xочу стать сурмамой');
            animateForm()
        }
    })

    $('.closemod').click(function() {
        $('#m2, #thanks, #ouch').hide("fast")
        showChoose()
    })

    function animateForm(back = false) {
        $(".modal_wrp").animate({
            maxHeight: back ? '490px' : '10000px'
        }, 500);
    }

    function showChoose() {
        console.log('show choose')
        setTimeout(function() {
            $('.route').show()
            animateForm(true)
        }, 500)
    }

    $(document).mouseup(function(e) {
        var div = $(".modal_wrp");
        if (!div.is(e.target) &&
            div.has(e.target).length === 0) {
            $('#m2, #thanks, #ouch').hide("fast")
            if (!e.target.className.includes('triggerSM')) {
                showChoose()
            }
        }
    });

    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 50) {
            $(".header").css("background", "#fff");
            if ($(window).width() > 991) {
                $(".menu-toggle").css("opacity", 1);
                $(".header-menu").css("display", 'none');
                $('.menu-toggle').removeClass("active")
            }
        } else {
            $(".header").css("background", "transparent");
            if ($(window).width() > 991) {
                $(".menu-toggle").css("opacity", 0);
                $(".header-menu").css("display", 'block');
                $('.menu-toggle').removeClass("active")
            }
        }
    });

    $(document).ready(function() {
        $('.etap_item span').each(function() {
            if ($(this).css('height') == '125px') {
                $(this).parent().find('img').show()
            }
        })
    })

    $('.etap_item img').click(function() {
        var span = $(this).parent().find('span p')
        if (span.css('height') == '125px') {
            span.css('max-height', '1000px')
            $(this).attr('src', '/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/qu_less.svg')
        } else {
            span.css('max-height', '125px')
            $(this).attr('src', '/<?php echo glob_lng(); ?>/wp-content/uploads/2023/08/qu_more.svg')
        }
    })
</script>

<?php wp_footer(); ?>

</body>

</html>