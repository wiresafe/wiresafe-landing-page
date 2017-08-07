class Faq {

    constructor() {
        this.start();
    }

    start() {
        this.menuTrigger();
        this.navTrigger();
    }

    menuTrigger() {
        $('html').on('click', '.content__faq ol li h4', function(event) {
            event.preventDefault();

            // $('.content__faq ol li').removeClass('active');
            $(this).closest('li').toggleClass('active');

            if($(this).closest('li').hasClass('active')) {
                $(this).closest('li').find('p').show();
            }
            else {
                $(this).closest('li').find('p').hide();
            }

        });
    }

    navTrigger() {
        $('html').on('click', '.content__faq ul li a', function(event) {
            event.preventDefault();

            $('.content__faq ul li').removeClass('active');
            $(this).closest('li').toggleClass('active');

            $('.content__faq section').removeClass('active');
            $($(this).attr('href')).addClass('active');
        });
    }
}

export default Faq;
