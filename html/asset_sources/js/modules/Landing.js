class Landing {

    constructor() {
        this.start();
    }

    start() {
        this.overlayMenu();
    }

    overlayMenu() {
        $('html').on('click', '.landing__header__hamburger', function(event) {
            event.preventDefault();

            $('body').addClass('is--menu--open');
        });

        $('html').on('click', '.landing__menu__overlay__content__close', function(event) {
            event.stopPropagation();

            $('body').removeClass('is--menu--open');
        });

        $('.landing__menu__overlay').click(function(event) {
            $('body').removeClass('is--menu--open');
        });
    }
}

export default Landing;
