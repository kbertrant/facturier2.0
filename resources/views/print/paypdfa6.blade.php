{{ trans('cruds.disconnect.fields.data_disconnect') }}
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment_{{$pay->ref_pay}}</title>
    <style>
      #invoice-POS{
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding:2mm;
        margin: 0 auto;
        width: 80mm;
        background: #FFF;
        
        
        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #1e1a1a;}
        h1{
        font-size: 1.2em;
        color: #270158;
        }
        h2{font-size: .9em;}
        h3{
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
        }
        p{
        font-size: .7em;
        color: #270158;
        line-height: 1.2em;
        }
        
        #top, #mid,#bot{ /* Targets all id with 'col-' */
        border-bottom: 1px solid #fffcfc;
        }

        #top{min-height: 100px;}
        #mid{min-height: 80px;} 
        #bot{ min-height: 50px;}

        #top .logo{
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }
        .clientlogo{
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        .info{
            display: block;
            float:left;
            margin-left: 0;
        }
        .title{
            float: right;
        }
        .title p{text-align: right;} 
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
            padding: 5px 0 5px 15px;
            border: 1px solid #ffffff
        }
        .tabletitle{
            padding: 5px;
            font-size: .5em;
            background: #100770;
        }
        .service{border-bottom: 1px solid #000000;}
        .item{width: 24mm;}
        .itemtext{font-size: .5em;}

        #legalcopy{
            margin-top: 5mm;
        }    
    }
    </style>
</head>
<body>
    <div id="invoice-POS">
        <center id="top">
            <div class="logo"></div>
            <div class="info"> 
            <h1>{{$ent->name_ent}}</h1>
            </div><!--End Info-->
        </center><!--End InvoiceTop-->
        <div id="mid">
          <div class="info">
            <p> 
                Payment #{{$pay->ref_pay}}</br>
                Address : {{$ent->address_ent}}</br>
                Phone   : {{$ent->phone_ent}}</br>
                Email   : info@facturier20.com</br>
            </p>
          </div>
        </div><!--End Invoice Mid-->
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                <tr class="tabletitle">
                                    <td>#</td>
                                    <td class="item"><h2>Designations</h2></td>
                                    <td class="Hours"><h2>P.U.</h2></td>
                                    <td class="Hours"><h2>Qty</h2></td>
                                    <td class="Rate"><h2>Sub Total</h2></td>
                                </tr>
                                @foreach($efs as $i=>$ef)
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">{{$i+1}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{ $ef->name_prod }} - {{ $ef->desc_prod }}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{ number_format($ef->ef_pu,2) }}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{ $ef->ef_qty }}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{ number_format($ef->ef_ttc,2) }}</p></td>
                                </tr>
                                @endforeach
    
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate"><h2>Tax :</h2></td>
                                    <td class="payment"><h2>{{number_format($pay->tva_pay,2)}}</h2></td>
                                </tr>
    
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate"><h2>Total: </h2></td>
                                    <td class="payment"><h2> {{number_format($pay->mttc_pay,2)}}</h2></td>
                                </tr>
    
                            </table>
                        </div><!--End Table-->
    
                        <div id="legalcopy">
                            <p class="legal"><strong>Thank you for your business!</strong>  
                            </p>
                        </div>
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
</body>
</html>