@import "bootstrap/bootstrap";

@import "plugins/lesshat";
@import "plugins/animation";
@import "plugins/datepicker";
@import "plugins/datatable";
@import "plugins/bootswatch";
@import "plugins/highlight-js/darkula";

@import "_variables";
@import "_mixins";

@import "widgets/dropdown";
@import "widgets/testimonials";
@import "widgets/timeline";
@import "widgets/modal";

@import "global/header-footer";

@import "pages/about-us";
@import "pages/home";
@import "pages/inner-content";
@import "pages/portfolio";
@import "pages/blog";

.typed-cursor{
    opacity: 1;
    -webkit-animation: blink 0.7s infinite;
    -moz-animation: blink 0.7s infinite;
    animation: blink 0.7s infinite;
}
@keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}
@-webkit-keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}
@-moz-keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}

body {
    background-image: url(../images/featured1-blur.jpg);
    background-repeat: no-repeat;
    background-position: top center;
    background-attachment: fixed;
    background-size: 100% auto;
}

.btn-dark {
    background: @black;
    color: white;
    border-color: #000;
}






@media (max-width: @screen-md) {

}

@media (max-width: @screen-xs) {

}