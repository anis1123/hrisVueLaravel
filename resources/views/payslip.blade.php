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
                   <td style="text-align:center"> <h2 style="margin:0; padding-top:10px">Payslip</h2></td>
                </tr>
                <tr>
                <td style="text-align:center;margin:0"> <h2 style="margin:0">Salary Month: {{$salary_month}}</h2></td>
                     </tr>


                     <tr>

                            <td style="display:flex;margin-top:20px">
                            <p style="margin-right:23%!important"> Employee ID:{{$employee_id}}</p>
                            <p style="margin-right:30%!important"> Name: {{$firstname}} {{$lastname}}</p>
                            {{-- <p> Marital Status: {{$marital_status}}</p>

                             </td> --}}
                         </tr>

{{--
                         <tr>

                                <td style="display:flex;margin-top:20px">
                                <p style="margin-right:23%!important"> Department: </p>
                                            <p style="margin-right:30%!important"> Designation:</p>
                                            <p> Email:</p>

                                 </td>

                             </tr> --}}

                             <tr>
                                <td style="padding-top:20px">
                                    <div style="display:flex">
                                    <div style="text-align:center;width:49%">
                                    <div style="border:1px solid;padding: 10px 0;background:#f4f4f4">Payment Type</div>
                                <div style="display:flex">
                                    <div style="border:1px solid;padding-left:10px;width:50%;text-align:left"><strong>Pay Type</strong></div>
                                    <div style="border:1px solid;padding-right:10px;text-align:right;width:50%"><strong>Amount</strong></div>
                                </div>
                                <div style="display:flex">
                                        <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Salary</div>
                                        <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$basic_salary}}</div>
                                </div>

                                <div style="display:flex">
                                        <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">KPI</div>
                                        <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$kpi}}</div>
                                </div>
                                <div style="display:flex">
                                        <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Incentive</div>
                                <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">@if($insentive == '') 0 @else {{$insentive}} @endif</div>
                                </div>
                                <div style="display:flex">
                                        <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Allowance</div>
                                        <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">@if($allowance == '') 0  @else {{$allowance}} @endif</div>
                                </div>


                                </div>
                                &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<div style="text-align:center;width:49%">
                                        <div style="border:1px solid;padding: 10px 0;background:#f4f4f4">Deductions</div>
                                    <div style="display:flex">
                                        <div style="border:1px solid;padding-left:10px;width:50%;text-align:left"><strong>Type</strong></div>
                                        <div style="border:1px solid;padding-right:10px;text-align:right;width:50%"><strong>Amount</strong></div>
                                    </div>

                                    <div style="display:flex">
                                            <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">PF</div>
                                    <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$pf}}</div>
                                    </div>

                                    <div style="display:flex">
                                            <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Gratuity</div>
                                    <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$gratuity}}</div>
                                    </div>

                                    <div style="display:flex">
                                            <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Tax</div>
                                    <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$tax}}</div>
                                    </div>

                                    <div style="display:flex">
                                            <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">SST</div>
                                    <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">{{$sst}}</div>
                                    </div>
                                    </div>
                                </div>
                                </td>



                             </tr>

                             <tr>
                                <td style="padding-top:40px;    text-align: -webkit-right;">
                                    <p style="    text-align: -webkit-center;padding-left:60px"> <strong>Total</strong></p>
                                    <div style="text-align:center;width:49%">

                                        {{-- <div style="display:flex">
                                            <div style="border:1px solid;padding-left:10px;width:50%;text-align:left">Total Allowance</div>
                                            <div style="border:1px solid;padding-right:10px;text-align:right;width:50%">1000</div>
                                        </div> --}}
{{--
                                        <div style="display:flex">
                                                <div style="padding-left:10px;border:1px solid;width:50%;text-align:left">Total deduction</div>
                                                <div style="padding-right:10px;border:1px solid;text-align:right;width:50%">1000</div>
                                            </div> --}}

                                            <div style="display:flex">
                                                    <div style="padding-left:10px;border:1px solid;width:50%;text-align:left;background:#f4f4f4">Net Salary</div>
                                            <div style="padding-right:10px;border:1px solid;text-align:right;width:50%;background:#f4f4f4">{{$total}}</div>
                                                </div>
                                        </div>


                                    </td>
                             </tr>

                                {{-- <tr>
                                    <td>
                                            to verify email <a href="{{route('sendEmailDone',['email'=>$user->email,'verifyToken'=>$user->verifyToken])}}">click</a>
                                    </td>
                                </tr> --}}








        </table>

</body>
</html>
