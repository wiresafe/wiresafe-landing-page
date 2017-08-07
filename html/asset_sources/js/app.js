import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
import Landing from './modules/Landing';
import Nav from './modules/Nav';
import Faq from './modules/Faq';

$(document).ready(() => {
    new Landing();
    new Nav();
    new Faq();
});
