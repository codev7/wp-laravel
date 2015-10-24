@import 'bootstrap/bootstrap';
@import 'datepicker';

@blue: #68cef6;
@red: #f76262;
@dark: #2d2d2d;

@brand-danger: @red;
@brand-primary: @blue;
@brand-info: @dark;

@container-sm: 95%;
.museo {
    font-family: 'museo-sans';
}

.mini {max-width: 87%; display: block; margin: auto;}

iframe[name='google_conversion_frame'] { 
    height: 0 !important;
    width: 0 !important; 
    line-height: 0 !important; 
    font-size: 0 !important;
    margin-top: -13px;
    float: left;
}
.error {
    background: lighten(@brand-danger, 10%);
}

body{
    padding:0;
    margin:0;
    color: @dark;
    .museo;
}


h1,h2,h3,h4,h5,h6 {
    font-family: 'nunito', Arial,sans-serif;
}

p,label,.btn,input,li {
    .museo;
}


/*Header*/
header{
    padding: 20px 10px;
    background: @dark;
    width:100%;
    top:0;
    left:0;
    z-index:1000;
    color:#ffffff;

    &.inner {
        position: relative;
    }

    .header-col-left {
        .make-sm-column(4);
    }

    .mobile-btn {
        display: none;
    }

    .logo {
        float: left;
        width: 100%;
        height: 39px;
        margin: 0 0 0 0px;
        max-width: 300px;

        a {
            width: 100%;
            height: 39px;
            background: url(../images/logo.png) no-repeat left center;
            background-size: 100% auto;
            text-indent: -9999px;
            display: block;
        }
        
    }

    nav {
        .make-sm-column(8);
        .text-right;
        text-decoration: none;

        ul {
            float: right;
            margin: 0;
        }
        li {
            display: block;
            float: left;
            font-size: 12px;
            text-transform:uppercase;
            padding: 0 17px;


            &.active a {
                color: @brand-primary;

                i {
                    color: #fff;
                }
            }

            a {
                text-decoration: none;
                color: #ffffff;
                display: block;
                
                line-height: 39px;
                position: relative;

                &:hover,&.active {
                    color: @blue;
                    text-decoration: none;
                }

                i {
                    margin-right:5px;
                    color: @blue;
                }
            }

            &.cta {
                margin-left: 8px;
                a {
                    i {
                        color: white;
                    }

                    &:hover {
                        color: white;
                    }
                }
            }

        }
    }
}


#contact-table {
    tr,td {
        vertical-align: middle;
    }

    i {
        color: @brand-danger;
    }
}

#account {
    padding: 30px 0;
    min-height: 400px;

    .promo-added {
        margin-top: 10px;
    }
}


#create-account {
    //background: @dark;
    //color: white;
    padding: 40px 0;
    .well {
        color: @dark;
    }
    .logo {
        width: 300px;
        height: 39px;
        margin: 50px auto;

        a {
            width: 300px;
            height: 39px;
            background: url(../images/logo.png) no-repeat;
            background-size: 300px 39px;
            text-indent: -9999px;
            display: block;
        }
        
    }

    .pricing-box {
        background: #f3f3f4;

        .top-padding {
            padding: 17px 20px 10px;
        }

        .dark {
            background: darken(@brand-primary,50%);

            padding: 15px;

            table {

                @bord-color: fadeout(#fff, 50%);
                color: white;
                border-bottom: 4px solid @bord-color;
                margin-bottom: 10px;
                font-family: 'museo-sans';
                text-transform: uppercase;

                tr,td,th {
                    border: 0;
                    vertical-align: middle;
                }

                tr.bord {
                    border-bottom: 1px solid @bord-color;
                }

                select {
                    background: none;
                    color: white;
                    border: 0;
                }

                td {
                    .text-right;
                }

                h4 {
                    margin: 0;
                    padding: 0;
                }

                tr.total {
                    border-top: 3px solid @bord-color;
                }
                tbody {
                    background: none;
                }
            }
        }
    }

    .big {
        font-size: 17px;
        line-height: 25px;
        padding: 0px 0 14px 0;
    }

    
    table {
        margin-bottom: 5px;
        tr,td {
            vertical-align: middle;
        }

        tbody {
            background: white;
        }
    }

}

.whys {
    .text-center;

    h5 {

        color: @brand-danger;
        font-size: 18px;

        i {
            display: block;
            color: @dark;
            margin: 0 0 10px 0;
        }
    }

    p {
        margin-bottom: 30px;
    }

}

#blog {
    padding: 50px 0;
    .blog-col {
        .make-sm-column(8);

        .meta {
            .text-muted;
            font-size: 12px;
            margin: 0 0 20px 0;
            padding: 0;

            .fa-user {
                margin-left: 10px;
            }
        }

        .blog-post {
            margin: 0 0 40px 0;
        }

        .thumb {
            img {
                .img-thumbnail;
                width: 250px;
                float: left;
                margin: 0 20px 5px 0;
            }
        }


        h2 {
            a {
                color: @brand-primary;
                &:hover {
                    text-decoration: none;
                    color: darken(@brand-primary,20%);
                }
            }
        }
        p,li {
            font-size: 18px;
            line-height: 28px;
            font-weight: 300;
            margin: 0 0 20px 0;
            a {
                font-weight: 500;
            }

            &.read-more {
                .text-right;
            }
        }
    }

    .sidebar {
        padding-top: 35px;
        .make-sm-column(4);

        .jenny {
            width: 80px;
            .img-thumbnail;
            .img-circle;
            .pull-left;
            margin: 0 10px 2px 0;
        }

        .well {
            border: 0;
            //-moz-border-radius: 0;
            //-webkit-border-radius: 0;
            //-border-radius: 0;
            background: @dark;

            h3 {
                .text-center;
                color: @brand-primary;
                padding: 0;
                margin: 0 0 5px 0;
            }

            p {
                color: white;
                font-size: 16px;
            }
        }

        p {
            font-weight: 300;
            font-size: 14px;
            color: @dark;
            line-height: 23px;

            a {
                font-weight: 500;
            }

            .big {
                font-weight: 500;
            }

        }
    }
}

/*Teaser*/
#teaser{
    padding-bottom:0;
    color:#ffffff;
    background:url(../images/austin-healy.jpg) no-repeat #fafafa;
    background-size: cover;
    text-align:center;

    .overlay {
        background: none repeat scroll 0 0 rgba(45, 45, 45, 0.75);
    }

    .container {
        padding-top: 150px;
        padding-bottom: 150px;
    }

    h1 {
        font-size:40px;
        text-transform:uppercase;
        position:relative;

        span {
            color: @blue;
            font-weight: bold;
        }
    }

    h2{
        font-size:21px;
        position:relative;
        .museo;
        font-weight: bold;

    }
}

/** Pricing Page */
#pricing{
    padding: 0;
    color:#ffffff;
    background:url(../images/austin-healy.jpg) no-repeat fixed #fafafa;
    background-size: 100%;

    .overlay {
        background: none repeat scroll 0 0 rgba(45, 45, 45, 0.75);
    }

    .table-noborder {
        tr,td,th {
            border: 0;
        }
    }

    .pricing-col {
        .make-lg-column(10);
        .make-lg-column-offset(1);

        .left-col {
            .make-md-column(8);
        }

        .right-col {
            .make-md-column(4);
        }

    }
    .prices {
        padding: 20px 0 0 0;
    }

    .well-dark {
        background: fadeout(#000, 50%);
        border: 0;
    }


    h1 {
        text-align: center;
        position: relative;

    }


    .panel {
        color: @dark;
        position: relative;

        li {
            .museo;
        }
    }

    .price {
        font-size: 20px;
        .month {
            .text-muted;
            font-size: 10px;
        }
    }

    .panel2 {
        z-index: 2;

        .panel-heading {
            font-size: 24px;
        }

        .price {
            font-size: 30px;
        }

        li {
            font-size: 16px;
            padding: 14px 0;
        }
    }

    .panel1,.panel3 {
        margin-top: 12px;
        
    }

    .panel1 {
        left: 40px;
    }

    .panel3 {
        right: 40px;
        z-index: 1;
    }

    #zip-pricing {
        padding: 0 10px;

        label {
            font-size: 12px;
        }
    }
}


/*Universale rules*/

.intro {
    margin: 40px auto 30px;
    text-align: center;

        p{
            position:relative;
            font-size:13px;
            margin-top:12px;
            line-height:22px;
            color:#888888;
        }


        h3{
            text-transform:uppercase;
            color:#2d2d2d;
            margin: auto;
            font-size:24px;
            position:relative;
            line-height:34px;
            margin-bottom:26px;

        
        }
}

/*About section*/

#how-it-works {
    overflow: hidden;


    .how-col {
        .make-sm-column(4);
        .text-center;
    }

    #car-gallery {
        float: right;
        margin: 0;
        padding: 0;
        width: 100%;
        overflow: hidden;

        li {
            float: left;
            width: 20%;
            height: auto;
            margin: 0;
            padding: 0;
            list-style: none;

            img {
                width: 100%;
            
            }
        }

    }

    p {
        color: #999999;
        font-size: 15px;
        line-height: 22px;
    }


    .ico-row {
        .text-center;
        .make-sm-column(6);
        margin-top: 30px;
    }

    .ico {
        background:  #FAFAFA;
        border-bottom: 3px solid #ECEAEA;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        color: @red;
        font-size: 35px;
        line-height: 65px;
        height: 65px;
        width: 65px;
        margin: auto;
        padding: 0px;
        text-align: center;
    }



    .features{
        margin-top:30px;
        float: left;
        width: 50%;
    }


    .innerIntro{
        margin:0 auto;
    }


    .innerIntro h1 {
        color: #2d2d2d;
        font-size: 20px;
        text-transform:uppercase;
        margin-bottom:10px;
    }

    .features {

        li {
            position: relative;
            padding: 0 100px 0 60px;
            margin: 0 0 40px 100px;

            &:last-child {
                margin-bottom: 0;
            }
        }

        .ico {
            font-size: 25px;
            line-height: 45px;
            height: 45px;
            width: 45px;
            position: absolute;
            top: 0;
            left: 0;
        }

        h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 5px 0;
            padding: 0;
        }
    }

}

body.login {
    background: #333;
}
#login {
    padding: 100px 0 0 0;
    
    .message {
        .alert;
        .alert-success;
        width: 400px;
        margin: 25px auto 5px;

        br {
            display: none;
        }
    }

    h1 {

        text-indent: -999px;
        width: 300px;
        margin: 0 auto;
        padding: 0;
        a {
            display: block;
            color: white;
            width: 300px;
            margin: 0;
            padding: 0;
            background: url(../images/logo.png) no-repeat top center;
            background-size: 300px auto;

            &:hover {
                text-decoration: none;
                color: @brand-primary;
            }
        }
    }

    #lostpasswordform,#loginform,#resetpassform {

        p {
            .form-group;
        }

        label {
            display: block;
            color: @dark !important;
        }

        input.input {
            .form-control;
            display: block;
        }

        label {
            color: white;
        }

        .button {
            .btn;
            .btn-warning;
            .btn-block;
        }

        .description {
            color: white;
        }
    }

    #nav,#backtoblog{
            text-align: center;

            a {
                color: white;
            }
        }

    #login_error {
        .alert;
        .alert-danger;
        margin: auto;
    }
}

#call-to-action {
    background: lighten(@dark,20%);
    padding: 40px 0;

    h3 {
        color: white;
        margin: 0;
        padding: 12px 0 0 0;
    }

    .cta-left {
        .make-sm-column(8);
    }

    .cta-right {
        .make-sm-column(4);
    }
}

.modal {
    color: @dark;
    .modal-header {
        background: @dark;
        color: @brand-primary;
        font-weight: 500;
    }

    .close {
        color: white;
        opacity: .9;
    }

    p,li {
        font-size: 15px;
        line-height: 22px;
        margin: 0 0 20px 0;
    }

    .nav {

        li {
            margin-bottom: 0;
        }
    }
}

/*Footer*/

#footer{
    padding: 15px 0;
    color:#ffffff;
    background: @dark;
    text-align:center;
    .museo;
    .text-muted;
}


#footer p {
    font-size:12px;
    padding: 0;
    margin: 0;
    font-weight: normal;
}

@media(max-width: @screen-lg) {
    #pricing {
        .pricing-col {
            .make-md-column(12);
        }
    }
}

@media(max-width: @screen-md) {
    header {
        padding: 10px 5px;

        .header-col-left {
            .make-sm-column(3);
        }

        nav {
            .make-sm-column(9);

            ul {
                li {
                    padding: 0 7px;
                    font-size: 12px;
                }
            }
        }
    }

    #teaser {
        .container {
            padding-top: 75px;
            padding-bottom: 75px;
        }
    }

    #blog {
        .container {
            .container-fluid;
        }
        .blog-col {
            .make-sm-column(7);
        }
    
        .sidebar {
            .make-sm-column(5);
        }
    }
    #pricing{
    
        background-size: cover;
        background-position: top center;

        .left-col {
            .make-sm-column(7);
        }

        .right-col {
            .make-sm-column(5);
        }

        .btn-group {
            .btn {
                .btn-sm;

                &:first-child {
                    -moz-border-bottom-right-radius: 0;
                    -webkit-border-bottom-right-radius: 0;
                    border-bottom-right-radius: 0;
                    -moz-border-top-right-radius: 0;
                    -webkit-border-top-right-radius: 0;
                    border-top-right-radius: 0;
                }

                &:last-child {
                    -moz-border-bottom-left-radius: 0;
                    -webkit-border-bottom-left-radius: 0;
                    border-bottom-left-radius: 0;
                    -moz-border-top-left-radius: 0;
                    -webkit-border-top-left-radius: 0;
                    border-top-left-radius: 0;
                }
            }
        }

        .panel1 {
            left: 0px;
        }

        .panel3 {
            right: 0px;
        }
    }
}

@media(max-width: @screen-sm) {
    header {
        overflow: hidden;

        .logo {
            width: 80%;
        }
        nav {
            display: none;
            clear: both;
            width: 100%;
            margin: 0;
            padding: 30px 0 0 0;
            float: none;
            top: 0px;
            left: 0px;
            ul {
                display: block;
                margin: 0;
                padding: 0;
                float: none;
                width: 100%;


                li {
                    display: block;
                    float: none;
                    width: 100%;
                    text-align: center;
                }
            }
        }

        .mobile-btn {
            display: block;
            position: absolute;
            top: 21px;
            right: 21px;
            z-index: 100;
        }
    }

    #call-to-action {
        padding: 20px 0;
        h3 {
            padding: 0;
            margin-bottom: 15px;
        }
        .text-center;
    }

    #how-it-works {
        #car-gallery {
            li {
                width: 50%;
            }
        }
    }
}

@media(max-width: @screen-xs) {
    #teaser {
        background-position: center center;
    }
    .input-group {
        display: block;
        .form-control {
            display: block;
            float: none;
            .form-control;
            .input-lg;
            border-radius: 4px !important;
            -moz-border-radius: 4px !important;
            -webkit-border-radius: 4px !important;
        }

        .btn {
            .btn-block;
            .btn-danger;
            margin-top: 7px;
            display: block;
            width: 100% !important;
            border-radius: 4px !important;
            -moz-border-radius: 4px !important;
            -webkit-border-radius: 4px !important;
        }
    }
}



#flyerbg {background: lighten(@dark, 20%);}
#flyer {
    width: 550px;
    height: 850px;
    background: @dark;
    margin: auto;

    .logo {
        width: 400px;
        background: url(../images/logo.png) no-repeat bottom left;
        background-size: 400px 52px;
        display: block;
        margin: 0px auto 15px;
        height: 82px;
        //padding: 30px 0 0 0;
    }

    h2 {
        color: white;
        .text-center;
        padding: 10px 0px 2px 0;
        font-size: 23px;
        line-height: 26px;
        margin: 0;
    }

    h3 {
        color: @brand-danger;
        .text-center;
        padding: 7px 0px;
        font-size: 26px;
        margin: 0;
        font-weight: 700;
        line-height: 26px;

        strong {
            display: block;
            color: white;
            font-size: 27px;
            margin: 10px 0 5px;
        }

        &#noblock {
            color: white;
            margin: 15px 0 0 0;
            padding: 0;
            strong {
                display: inline;
                margin: 9;
                font-size: 26px;
            }
        }
    }

    h4 {
        background: @brand-primary;
        color: white;
        padding: 8px 0px;
        display: block;
        margin: auto;
        width: 90%;
        border-radius: 2px;
        .text-center;
    }

    .boxed {
        border: 1px dotted white;
        padding: 30px 5px 5px;
        color: white;
        position: relative;
        border-radius: 2px;

        h4 {
            position: absolute;
            top: -15px;
            left: 5%;
        }

        ul {
            margin: 0;
            padding: 0 0 0 0px;
            //.text-center;

            li {
                margin: 0 0 5px 0;
                padding: 0;
                line-height: 30px;
                font-size: 15px;
                font-family: 'museo-sans';
                i {
                    //display: block;
                    width: 60px;
                    .text-center;
                    position: relative;
                    top: 4px;
                    color: @brand-primary;
                }
            }
        }
    }

    .discount {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        background: lighten(@dark, 10%);
        margin: auto;
        .text-center;
        padding: 0px 0 0 0;

        h5 {
            color: white;
            margin: 0;
            padding: 0;
            font-size: 20px;
        }

        h6 {
            color: @brand-primary;
            margin: 0;
            padding: 0;
            font-size: 40px;

            small {
                color: @brand-primary;
                font-size: 15px;
            }
        }

        .padding {
            padding: 21px 0 0 0;
        }
    }

    .coupon {
        color: white;
        font-size: 13px;
        .text-center;
        font-weight: 500;
        margin-top: 5px;
    }

    #ferrari {
        margin: 0px 0 0px -15px;
        width: 350px;
        float: left;
    }

    .bottom-col {

        h3 {
            .text-left; 
            margin-top: 10px;
        }

        p {
            color: white;
        }
        
    }

    .custarrow {

        h3 {
            font-size: 18px;
            line-height: 21px;
            margin-top: 20px;
        }

        i {
            color: @brand-danger;
            margin: 0 auto 10px;
            display: block;
            .text-center;
            position: relative;
            left: -30px;


        }

        p {
            color: white;
            font-size: 11px;
            .text-center;
            font-style: italic;
        }
    }

    .cust {
        width: 33.33333%;
        float: left;
    }
}

.side {
    position: absolute;
    top: 5px;
    left: 5px; 
}