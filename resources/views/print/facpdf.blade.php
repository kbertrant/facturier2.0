{{ trans('cruds.disconnect.fields.data_disconnect') }}
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice_{{$fac->ref_fac}}</title>
    <style>
      h4 {
        margin: 0;
      }
      .w-full {
          width: 100%;
      }
      .w-half {
          width: 50%;
      }
      .margin-top {
          margin-top: 1.25rem;
          width: 100%;
      }
      .signature {
          margin-right: 50px;
          left:  0;
      }
      .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 2.5rem;   
        font-size: 0.875rem;
        padding: 1rem;
        background-color: rgb(241 245 249);
      }
      table {
          width: 100%;
          border-spacing: 0;
      }
      table.products {
          font-size: 0.875rem;
      }
      table.products tr {
          background-color: rgb(96 165 250);
          width: 100%;
      }
      table.products th {
          color: #ffffff;
          padding: 0.5rem;
          width: 100%;
      }
      table tr.items {
          background-color: rgb(241 245 249);
      }
      table tr.items td {
          padding: 0.5rem;
      }
      .total {
          text-align: right;
          margin-top: 1rem;
          font-size: 0.875rem;
      }
      #signature{
        margin-left:80%;
      }
    </style>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2>{{$ent->name_ent}}</h2>
            </td>
            <td class="w-half">
                <h3>Invoice #{{$fac->ref_fac}}</h3>
            </td>
        </tr>
        <tr>
            <td class="w-half">
            </td>
            <td class="w-half">
                <h4>Douala {{date('j F, Y', strtotime($fac->date_fac))}}</h4>
            </td>
        </tr>
    </table>
    <div class="">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>For :</h4></div>
                    <div>{{$ent->rc_ent}}</div>
                    <div>{{$ent->nc_ent}}</div>
                    <div>{{$ent->phone_ent}}</div>
                    <div>{{$ent->address_ent}}</div>
                    <div>{{$ent->bank_ent}}</div>
                </td>
                <td class="w-half">
                    <div><h4>To :</h4></div>
                    <div>{{$cl->name_cli}}</div>
                    <div>{{$cl->address_cli}}</div>
                    <div>{{$cl->phone_cli}}</div>
                    <div>{{$cl->cl_email}}</div>
                    <div>{{$cl->cl_rccm}}</div>
                </td>
            </tr>
        </table>
    </div>
    <br><br>
    <div class="margin-top">
        <table class="products">
          <tr>
            <th>#</th>
            <th>Designations</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Price HT</th>
          </tr>
          @foreach($efs as $i=>$ef)
            <tr class="items">
              <td>{{$i+1}}</td>
              <td>{{ $ef->name_prod }}</td>
              <td>{{ number_format($ef->ef_pu,2) }}</td>
              <td>{{ $ef->ef_qty }}</td>
              <td>{{ number_format($ef->ef_ttc,2) }}</td>
            </tr>
          @endforeach
        </table>
    </div>
    <br>
    <div class="total">
       H.T: <b>{{$fac->mht_fac}} XAF</b>
    </div>
    <div class="total">
      Discount : <b>{{number_format($fac->reduction,2)}} XAF</b>
    </div>
    <div class="total">
      Tax (19,25%): <b>{{number_format($fac->tva_fac,2)}} XAF</b>
    </div>
    <div class="total">
        Deducted at source: <b>{{number_format($fac->rs_fac,2)}} XAF</b>
      </div>
    <div class="total">
    TTC: <b>{{$fac->mttc_fac}} XAF</b>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <p class="">Arrested this invoice at the sum of <b>{{number_format($fac->mttc_fac,2)}} XAF</b></p>
    </div>
    <br><br><br><br><br><br>
    
    <div id="signature"> 
        The manager
    </div>
    <div class="footer margin-bottom">
        <div>Executé par: {{$usr->name}} </div>
        <div>&copy; Thank you for your business!</div>
    </div>
</body>
</html>