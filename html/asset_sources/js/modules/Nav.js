class Nav {

    constructor() {
        this.start();
    }

    start() {
        this.mobileNavTrigger();
        this.goToDiv();
    }

    mobileNavTrigger() {
        $('html').on('click', '.hamburger', function(event) {
            event.preventDefault();

            $(this).toggleClass('is-active');
            $('.header__nav__mobile').stop().slideToggle();
        });
    }

    goToDiv() {
        $('html').on('click', 'a', function(event) {
            let link = $(this).attr('href');
            if(link.charAt(0) === '#' && $(link).length > 0) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(link).offset().top - 120 }, 'slow');
            }
            else {
                if(BASE_URL) {
                    window.location.href = BASE_URL + link;
                }
            }
        });

        if(window.location.hash) {
            $('a[href="'+ window.location.hash +'"]').trigger('click');
        }
    }
}

export default Nav;
