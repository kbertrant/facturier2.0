{{ trans('cruds.disconnect.fields.data_disconnect') }}
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('mypages.yp') }} #{{$pro->pro_ref}}</title>
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
    </style>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
              {{$ent->name_ent}}
            </td>
            <td class="w-half">
                <h2>{{ __('mypages.yp') }} #{{$pro->pro_ref}}</h2>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>DE:</h4></div>
                    <div>{{$ent->nc_ent}}</div>
                    <div>{{$ent->phone_ent}}</div>
                    <div>{{$ent->address_ent}}</div>
                </td>
                <td class="w-half">
                    <div><h4>A:</h4></div>
                    <div>{{$cl->name_cli}}</div>
                    <div>{{$cl->raison_sociale}}</div>
                    <div>{{$cl->address_cli}}</div>
                    <div>{{$cl->phone_cli}}</div>
                    <div>{{$cl->cl_email}}</div>
                    <div>{{$cl->cl_rccm}}</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
          <tr>
            <th>#</th>
            <th>Item</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Qty</th>
            <th>Price</th>
          </tr>
          @foreach($eps as $i=>$ep)
          <tr class="items">
              <td>{{$i+1}}</td>
              <td>{{ $ep->name_prod }}</td>
              <td>{{ $ep->desc_prod }}</td>
              <td>{{ number_format($ep->ep_pu,2) }}</td>
              <td>{{ $ep->ep_qty }}</td>
              <td>{{ number_format($ep->ep_ttc,2) }}</td>
            </tr>
          @endforeach
        </table>
    </div>
 
    <div class="total">
      Montant H.T: <b>{{number_format($pro->mht_pro,2)}}</b> XAF
    </div>
    <div class="total">
      Remise : <b>{{number_format($pro->reduction,2)}}</b> XAF
    </div>
    <div class="total">
      Tax(19,25%): <b>{{number_format($pro->tva_pro,2)}}</b> XAF
    </div>
    <div class="total">
        Deducted at source: <b>{{number_format($pro->rs_pro,2)}}</b> XAF
      </div>
    <div class="total">
      Montant TTC: <b>{{number_format($pro->mttc_pro,2)}}</b> XAF
    </div>
    <br><br><br><br><br><br>
    
    <div id="signature"> 
        The manager
    </div>
    <div class="footer margin-top">
        <div>Executé par: {{$usr->name}} </div>
        <div>&copy; Thank you for your business!</div>
    </div>
</body>
</html>
