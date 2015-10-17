@import 'bootstrap/bootstrap';

@import 'variables';
@import 'bootswatch';
@import 'animate';

@font-family-sans-serif: 'Source Sans Pro', sans-serif;

@orange: #faaf40;
@brand-warning: @orange;
@pagination-bg: #000;
@pagination-color: #fff;
@pagination-hover-color: @brand-warning;
@pagination-border: #000;
@pagination-active-border: #000;
@pagination-hover-border: #000;
@pagination-active-bg: @orange;

.error {
    border-color: @brand-danger;
    box-shadow-color: @brand-danger;
}

body {
    background: white;
    overflow-x: hidden;
}

a {
    text-decoration: none;
}

table {
    vertical-align: middle !important;
    
    tr,td,th {
        vertical-align: middle !important;
    }

}

#top-section {
    .animated;
    .fadeIn;
    //-webkit-animation-duration: .3s;
    //-webkit-animation-delay: 1s;
}

.image-container {
    .animated;
    .fadeIn;
    -webkit-animation-duration: .6s;
    -webkit-animation-delay: 1s;
}

.social-toggle {
    position: absolute;
    bottom: 25px; 
    left: 15px;
}
.modal {
    .modal-header {
        background: #333;
        color: white;
        text-transform: uppercase;
        font-weight: 700;

        .close {
            color: white;
            opacity: 1;
        }
    }


}

.top-alert {
    .alert {
        margin: 0;
        border-radius: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border: 0;
    }
}

header {
    background: #333;
    padding: 0px 0;
    height: 50px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1030;

    .header-col {
        .make-sm-column(12);
    }
    .logo {
        font-size: 25px;
        text-transform: uppercase;
        float: left;
        font-weight: 700;
        padding: 0;
        margin: 0;
        line-height: 50px;

        a {
            display: block;
            color: white;
            height: 50px;
            padding: 0px 0 2px 45px;
            background: url(../images/logo-large.png) no-repeat left center;
            background-size: 40px 40px;

            strong {
                color: @orange;
            }

            &:hover {
                text-decoration: none;
                color: @orange;
            }
        }
    }

    .navigation {
        float: right;

        .text {
            float: left;
            margin: 0 30px 0 0;
            padding: 0;
            border-left: 1px solid lighten(#333,20%);
            li {
                display: block;
                padding: 0px;
                line-height: 50px;
                float: left;

                &.active {
                    a {
                        background: lighten(#333,20%);
                        color:  @orange;
                    }
                }
                a {
                    display: block;
                    border-right: 1px solid lighten(#333,20%);
                    color: white;
                    height: 50px;
                    padding: 0 15px;
                    font-weight: 300;
                    text-transform: uppercase;

                    &:hover {
                        background: lighten(#333,20%);
                        color:  @orange;
                        text-decoration: none;
                    }
                }
            }

        }

        .btns {
            float: right;
            margin-top: 8px;
            text-transform: uppercase;
            
            a {font-weight: 300;}
        }

        .mobile-nav {
            display: none;
            color: white;
        }

    }
}

img {
    max-width: 100%;
}

#content {
    padding-top: 50px;
}

#home-container {
    position: relative; 
    z-index: 2;
}

#pageheader,.pageheader {
    font-weight: 300;
    text-transform: uppercase;
    text-align: center;
    padding: 15px 0;
    margin: 0;
    background: white;
    font-size: 40px;

    small {
        display: block;
    }

    i {
        color: @brand-danger;
    }
}

#form-signin {
    padding: 60px 0 150px;
}

/* This is the home page feed */
#feed {
    left: 0;
    width: 100%;

    .feed-item {
        position: relative;
        z-index: 1;
        h2 {
            position: absolute;
            bottom: 5px;
            right: 5px;
            font-size: 12px;
            color: white;
            padding: 0;
            margin: 0;
            font-weight: 300;

            small {
                font-size: 9px;
                color: white;
                font-weight: 300;
                padding-left: 10px;
            }
        }

    

        .position {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    }
}

.popover {
    border-radius: 0;
    border: 0;
    box-shadow: 0;
    padding: 0;
    &.left>.arrow {
        right: -10px;
    }

    .popover-title {
        background: #333;
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 0;
        border-bottom: 0;
        i { 
            color: @brand-warning;

        }
    }
}


/* This is a feed item on all other feed pages */
.index-item {
    position: relative;
    margin: 200px 0;

    &.first,&:first-child {
        margin-top: 25px;
    }

    &.first {
        margin-bottom: 20px;
    }

    img.main {
        min-width: 100%;
    }


    .info {
        padding: 21px 0;
        text-align: center;

        a {
            color: black;
            &:hover {
                color: @orange;
                text-decoration: none;
            }
        }
        h1,h2 {
            margin: 0;
            padding: 0;
            font-weight: 300;
            font-size: 21px;

            a {
                color: black;

                &:hover {
                    text-decoration: none;
                    color: @orange;
                }
            }
        }

        ul {
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: black;

            li {

                i {
                    margin-right: 5px;
                }
            }
        }
    }
}

#account-form {
    background: white;
    padding: 30px 0;
    h3 {
        color: @brand-warning;
    }

    hr {
        
    }
    
}

.like {
    position: absolute;
    bottom: 25px;
    right: 15px;
    background: fadeout(#000,30%);
    padding: 0px 10px;
    overflow: hidden;
    line-height: 40px;

    i {
        position: relative;
        top: 4px;
    }
    .fa-camera {
        color: orange;
        font-size: 18px;
        top: 1px;
    }

    .fa-spinner {
        display: none;
        color: white;
        font-size: 18px;
        top: 3px;
    }


    .fa-heart {
        color: white;
        font-size: 25px;
        padding: 0 5px;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .2s ease;

        &.active {
            color: @brand-danger;
            font-size: 30px;
        }
    }

    &.liked {
        .fa-heart {
            color: @brand-danger;

            &.active {
                font-size: 25px;
            }
        }   
    }

    .like-count {
        color: white;
        font-weight: 700;
        font-size: 15px;
        lie-height: 25px;
    }
}

.like-trigger {
    position: absolute;
    height: 100%;
    width: 50%;
    text-indent: -9999px;
    z-index: 5;
    top: 0;
    right: 0;
    display: block;

    &.demo {
        background: fadeout(black,50%);
    }
}

.paging {
    a,span{
        color: white;

        &:hover {
            background: black !important;
            color: @orange;
        }
    }
}

#welcome-box {
    background: fadeout(#000,30%);
    color: white;
    padding: 20px;
    position: relative;
    width: 600px;
    position: fixed;
    left: 50%;
    margin-left: -300px;
    top: 150px;
    z-index: 2;
    .icon {
        color: @orange;
    }

    h1 {
        font-weight: 600;
        font-size: 30px;
        padding: 5px 0 15px 0;
        line-height: 35px;
        margin: 0 0 10px 0;
    }

    p {
        font-family: 'Droid Serif';
        font-size: 17px;
        line-height: 30px;
    }

    .line {
        display: block;
        color: @orange;
        position: relative;

        span {
            background: #f1f0ef;
            position: relative;
            z-index: 5;
            padding: 0 25px;
        }

        &:before {
            border-color: white;
        }
    }

    .btn {
        font-weight: 300;
        text-transform: uppercase;
    }

    .btn-view {
        color: white;
        &:hover {
            color: @brand-danger;
        }
    }
}

body.login {
    background: #333;
}

#login {
    background: #333;
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

        font-size: 25px;
        text-transform: uppercase;
        text-align: center;
        font-weight: 700;
        padding: 0;
        margin: 0;
        line-height: 50px;

        a {
            display: block;
            color: white;
            padding: 30px 0px 0px 0px;
            background: url(../images/logo-large.png) no-repeat top center;
            background-size: 40px 40px;

            &:hover {
                text-decoration: none;
                color: @orange;
            }
        }
    }

    #lostpasswordform,#loginform,#resetpassform {
        width: 400px;
        margin: 25px auto 5px;

        p {
            .form-group;
        }

        label {
            display: block;
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
        width: 500px;
        margin: auto;
    }
}

#submit-content {
    background: white;
    padding: 45px 0 100px;

}

.panel-default {
    margin-top: 50px;
}

footer {
    background: none;
    color: #333;
    font-size: 12px;

    ul {
        margin: 0;
        padding: 0;
        li {
            display: inline-block;
            padding: 15px 10px;
        }
    }

    a {
        color: #333;
        &:hover {
            text-decoration: none;
            color: @orange;
        }
    }

    .footer-logo {
        padding-left: 17px;
        background: url(../images/logo-large.png) no-repeat left center;
        background-size: 15px 15px;
    }

    p {
        margin: 0;
        padding: 15px 0;
    }
}

@media(max-width: @screen-md) {
    header {

        .logo {

             span {
                display: none;
             }
        }

    }
}

@media(max-width: @screen-sm) {

    #pageheader, .pageheader {
        font-size: 30px;
    }
    #feed {
        display: none;
    }

    body {
        //background: url(../images/mobile-bg.jpg) no-repeat top center fixed;
        //background-size: cover;
    }

    #welcome-box {
        background: fadeout(#000,30%);
        color: white;
        width: 95%;
        position: relative;
        top: 0;
        left: 0;
        margin: 30px auto;
        z-index: 2;
        
        .icon {
            i {
                font-size: 28px;
            }
        }

        h1 {
            font-weight: 600;
            font-size: 24px;
            padding: 5px 0 15px 0;
            line-height: 30px;
            margin: 0 0 10px 0;
        }

        p {
            font-family: 'Droid Serif';
            font-size: 14px;
            line-height: 27px;
        }

        .line {
            display: block;
            color: @orange;
            position: relative;

            span {
                background: #f1f0ef;
                position: relative;
                z-index: 5;
                padding: 0 25px;
            }

            &:before {
                border-color: white;
            }
        }

        .btn {
            font-weight: 300;
            text-transform: uppercase;
        }

        .btn-view {
            color: white;
            &:hover {
                color: @brand-danger;
            }
        }
    }

    header {
        position: absolute;
        .navigation {
            .text {
                background: #333;
                position: absolute;
                z-index: 20;
                display: block;
                top: 50px;
                left: 0;
                width: 100%;
                display: none;
                margin: 0 0px 0 0;
                padding: 0;
                overflow: hidden;
                border-left: 0;
                border-top: 1px solid lighten(#333,20%);
                border-right: 0;
                li {
                    display: block;
                    padding: 0px;
                    line-height: 50px;
                    float: none;
                    border-right: 0;

                    &.active {
                        a {
                            background: lighten(#333,20%);
                            color:  @orange;

                        }
                    }
                    a {
                        border-right: 0;
                        border-bottom: 1px solid lighten(#333,20%);
                        height: 50px;
                        padding: 0 15px;
                        font-weight: 300;
                        text-transform: uppercase;

                        &:hover {
                            background: lighten(#333,20%);
                            color:  @orange;
                            text-decoration: none;
                        }
                    }
                }
            }


            .mobile-nav {
                display: inline-block;
                border: 1px solid white;
                margin-right: 5px;
            }
        }
    }

    .index-item {
        //border: 0;


        .btn-trending {
            .btn-xs;

        }

        .btn-delete {
            display: none;
        }
        .info {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 10px 20px;

            a {
                color: white;
                &:hover {
                    color: @orange;
                    text-decoration: none;
                }
            }
            h1,h2 {
                font-size: 18px;
                line-height: 22px;
            
            }

            ul {
        
                font-size: 11px;
                

                li {
                    padding-left: 0;
                    
                }
            }
        }
    }

}

@media(max-width: @screen-xs) {


    .social,.social-toggle {
        display: none;
    }
    .index-item {

        border: 0;


        .info {
            position: relative;
            display: block;
            background: black;
            top: 0;
            left: 0;
        }

        .btn-trending {
            display: none;
        }
    }
}