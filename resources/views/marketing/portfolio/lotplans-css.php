@import 'custom/footer';
@import 'custom/cart';
@import 'custom/master-design';
@import 'custom/admin';


@brand-primary: #1cbbb4;
@brand-secondary: #f9af56;
@brand-danger: #d54a4a;
@darkgray: #3c424b;
@font-family-sans-serif: 'Montserrat';
@font-family-serif: 'Merriweather';

@brand-white: #fff;

@input-border-focus: @brand-primary;

body {
    overflow-x: hidden;
}

@best-price-size: 75px;
.best-price-guarantee {

    width: @best-price-size;
    height: @best-price-size;
    background: url(/images/best-price.png);
    background-size: @best-price-size;
    position: absolute;
    top: 300px;
    left: 5px;

}

.ssl {
    display: block;
    width: 200px;
    height: 52px;
    text-indent: -9999px;
    background-image: url(/images/ssl.png);
    background-repeat: no-repeat;
    background-size: 200px 52px;
}

.text-block {
    font-size: 13px;
    margin-top: -10px;
    .text-muted;
}

.select2-hidden-accessible {
    display: none !important;
}

.align-middle {

    vertical-align: middle !important;

    tr,td,th {
        vertical-align: middle !important;
    }

}

.alert {
    border-radius: none;
    margin: 0;
}

.help-block {
    background: @brand-danger !important;
    color: white !important;
    padding: 5px !important;
}

#modal-contact {
    z-index: 10000;

    i {
        color: @brand-secondary;
        margin-top: 20px;
    }

    h5 {
        font-family: @font-family-serif;
        font-size: 17px;
        line-height: 30px;
    }

    .modal-header {
        background: @brand-primary;
        color: white;
        text-transform: uppercase;
    }
}


.popover {
    border-radius: 0;
    position: relative;
    left: 2px;
    border: none;
    padding: 0;
    //box-shadow: none;

    .arrow {
        //border: none;
        margin-right: 1px;
    }
    .popover-title {
        background: @brand-primary;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 0;
        border: none;
    }
}

p {
    //font-family: @font-family-serif;  
}

.col-xs-15,
.col-sm-15,
.col-md-15,
.col-lg-15 {
    position: relative;
    min-height: 1px;
    padding-right: 10px;
    padding-left: 10px;
}

.btn-default {
    background: 0;
    border: 2px solid @brand-primary;
    color: white;
    .btn-sm;
}

@media(max-width: @screen-md) {

    .container {
        width: 95%;
    }

}

.col-xs-15 {
    width: 20%;
    float: left;
}
@media (min-width: @screen-sm-min) {
    .col-sm-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: @screen-md-min) {
    .col-md-15 {
        width: 20%;
        float: left;
    }
}
@media (min-width: @screen-lg-min) {
    .col-lg-15 {
        width: 20%;
        float: left;
    }
}