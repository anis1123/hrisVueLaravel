<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        html {
                    width:100%
                }
                ::-moz-selection {

                color:#fff;

                }
                ::selection {

                color:#fff;

                }
                body {
                    background-color:#fff;
                    margin:0;
                    padding:0
                }
                .ReadMsgBody {
                    width:100%;
                    background-color:#fff
                }
                .ExternalClass {
                    width:100%;
                    background-color:#fff
                }
                a {
                    color:#fd4326;
                    text-decoration:none;
                    font-weight:400;
                    font-style:normal
                }
                a:hover {
                    color:#262626;
                    text-decoration:none;
                    font-weight:400;
                    font-style:normal
                }
                p, div {
                    margin:0!important
                }
                table {
                    border-collapse:collapse
                }
                @media only screen and (max-width:640px) {
                body {
                width:auto!important
                }
                table table {
                width:100%!important
                }
                td[class=full_width] {
                width:100%!important
                }
                td[class=spacer] {
                width:30px!important
                }
                td[class=spacer_spec] {
                display:none!important
                }
                div[class=div_scale] {
                width:440px!important;
                margin:0 auto!important
                }
                table[class=table_scale] {
                width:440px!important;
                margin:0 auto!important
                }
                td[class=td_scale] {
                width:440px!important;
                margin:0 auto!important
                }
                img[class=img_scale] {
                width:100%!important;
                height:auto!important
                }
                img[class=divider] {
                width:100%!important;
                height:2px!important
                }
                td[class=divider] {
                width:100%!important;
                display:block!important;
                float:left;
                text-align:inherit!important
                }
                }
                @media only screen and (max-width:479px) {
                body {
                width:auto!important
                }
                table table {
                width:100%!important
                }
                td[class=full_width] {
                width:100%!important
                }
                div[class=div_scale] {
                width:280px!important;
                margin:0 auto!important
                }
                table[class=table_scale] {
                width:280px!important;
                margin:0 auto!important
                }
                td[class=td_scale] {
                width:280px!important;
                margin:0 auto!important
                }
                img[class=img_scale] {
                width:100%!important;
                height:auto!important
                }
                img[class=divider] {
                width:100%!important;
                height:2px!important
                }
                td[class=spacer] {
                display:none!important
                }
                td[class=spacer_spec] {
                display:none!important
                }
                td[class=divider] {
                width:100%!important;
                display:block!important;
                float:left;
                text-align:inherit!important
                }
                td[class=center] {
                text-align:center!important
                }
                td[class=subject_line] {
                float:left;
                width:240px;
                display:block!important;
                text-align:left!important;
                padding:15px 20px!important
                }
                td[class=contact] {
                float:left;
                width:240px;
                display:block!important;
                text-align:left!important;
                padding:0 20px 15px!important;
                padding-bottom:20px!important
                }
                td[class=social_left] {
                float:left;
                width:240px;
                display:block!important;
                text-align:center!important;
                padding:20px 20px 0!important
                }
                td[class=social_right] {
                float:left;
                width:240px;
                display:block!important;
                text-align:center!important;
                padding:0 20px!important
                }
                td[class=one_one] {
                width:240px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                padding-right:20px!important;
                text-align:inherit!important
                }
                td[class=one_half] {
                width:240px!important;
                padding-bottom:0!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_half_last] {
                width:240px!important;
                margin-top:40px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important;
                padding-top:0!important
                }
                td[class=one_third_fed] {
                width:240px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_third_fed_sec] {
                width:240px!important;
                margin-top:20px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_third_fed_last] {
                width:240px!important;
                margin-top:20px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_third] {
                width:240px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_third_sec] {
                width:240px!important;
                margin-top:40px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=two_third_last] {
                width:240px!important;
                margin-top:40px!important;
                display:block!important;
                float:left;
                padding-left:20px!important;
                text-align:inherit!important
                }
                td[class=two_third] {
                width:240px!important;
                display:block!important;
                float:left;
                margin-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_third_last] {
                width:240px!important;
                margin-top:40px!important;
                display:block!important;
                float:left;
                margin-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_fourth] {
                width:110px!important;
                display:block!important;
                float:left;
                margin-left:20px!important;
                text-align:inherit!important
                }
                td[class=one_fourth_last] {
                width:110px!important;
                margin-top:20px!important;
                display:block!important;
                float:left;
                margin-left:20px!important;
                text-align:inherit!important
                }
                }


    </style>
</head>
<body style="padding: 45px 170px;">

        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="padding: 10px 50px; margin: 0;">
                <tr>
                        <td class="full_width" align="center" width="100%"  style="text-align:right">

                            <img src="http://kumarijob.com/assets/LOGO-NEW-KUMARIJOB-min.png" width="120" alt="">

                            <h2 style="padding-right:30px;margin:0"><strong> Kumari job </strong></h2>
                            <p style="padding-right:30px;margin:0;font-weight:bold">Tinkune , Subidhanagae</p>
                            <p style="padding-right:30px;margin:0;font-weight:bold">Contact: 01-5199600</p>
                </tr>

                <tr>
                    <td><hr style="border:1px solid #000; margin-top:20px "></td>
                </tr>

                <tr>
                    <td><h2>to verify email <a href="{{route('sendEmailDone',['email'=>$user->email,'verifyToken'=>$user->verifyToken])}}">click</a></h2></td>
                </tr>










        </table>

    </body>
    </html>
