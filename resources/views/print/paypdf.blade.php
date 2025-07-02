  {{ trans('cruds.disconnect.fields.data_disconnect') }}
  <!doctype html>
  <html lang="en">
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Payment_{{$pay->ref_pay}}</title>
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
          text-align: center;
      }
      table.products tr {
          background-color: rgb(96 165 250);
          width: 100%;
          text-align: center;
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
      #advise{
        font-size: 20px;
      }
      body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
      }
      </style>
  </head>
  <body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                {{-- <img src="{{ URL::to('enterprises/'.$ent->logo_ent) }}" style="with:20px;height:60px;" />  --}}
                <h2><b>{{$ent->name_ent}}</b></h2>
            </td>
            <td class="w-half">
                <h3>Payment #{{$pay->ref_pay}}</h3>
                <p class="notice"><img src="data:image/png;base64,{{ $qrcode }}"></p>
            </td>
        </tr>
        <tr>
            <td class="w-half">
            </td>
            <td class="w-half">
                <h4>Douala {{date('j F, Y', strtotime($pay->date_pay))}}</h4>
            </td>
        </tr>
    </table>
      
    <div class="margin-top">
          <table class="w-full">
              <tr>
                  <td class="w-half">
                    <div><b>RCCM:</b> {{$ent->rc_ent}}</div>
                    <div><b>NC:</b> {{$ent->nc_ent}}</div>
                    <div><b>Tel:</b> {{$ent->phone_ent}}</div>
                    <div><b>Addr:</b> {{$ent->address_ent}}</div>
                    <div><b>Bank:</b> {{$ent->bank_ent}}</div>
                  </td>
                  <td class="w-half">
                      <div><h4>To:</h4></div>
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
                <th>Designation(s)</th>
                <th>P.U.</th>
                <th>Quantity</th>
                <th>Price Total</th>
            </tr>
            @foreach($efs as $ef)
            <tr class="items">
                <td>#</td>
                <td>{{ $ef->ef_lib }}</td>
                <td>{{ number_format($ef->ef_pu,0) }}</td>
                <td>{{ $ef->ef_qty }}</td>
                <td>{{ number_format($ef->ef_ttc,0) }}</td>
              </tr>
            @endforeach
          </table>
      </div>
   
      <div class="total">
        Amount H.T: <b>{{number_format($pay->mht_pay,0)}}</b> XAF
      </div>
      <div class="total">
        Tax(19,25%): <b>{{number_format($pay->tva_pay,0)}}</b> XAF
      </div>
      <div class="total">
        RS : <b>{{number_format($pay->rs_pay,0)}}</b> XAF
      </div>
      <div class="total">
        Amount TTC: <b>{{number_format($pay->mttc_pay,0)}}</b> XAF
      </div>
   
      <div class="footer margin-top">
          <div>Processed by : {{$usr->name}} </div>
          <div>&copy; by KPAB Technologies. Thank you for your business!</div>
      </div>
  </body>
  </html>