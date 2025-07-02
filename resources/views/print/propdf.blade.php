{{ trans('cruds.disconnect.fields.data_disconnect') }}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Quotation_{{$pro->pro_ref}}</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src:url('{{ public_path('/SourceSansPro-Regular.ttf') }}') format('truetype');
        }

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #1a009d;
  text-decoration: none;
}

body {
  position: relative;
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family:  Georgia, Times, 'Times New Roman', serif; 
  font-size: 14px; 
  font-family: Georgia;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 5px;
}

#logo img {
  height: 70px;
  width: 110px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #1a009d;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.9em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #1a009d;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 10px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #1a009d;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #1a009d;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #1a009d;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #1a009d;
  font-size: 1.4em;
  border-top: 1px solid #1a009d; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 10px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #1a009d;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
#signature{
        margin-left:80%;
      }

    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ public_path('/enterprises/'.$ent->logo_ent) }}"  />
      </div>
      <div id="company">
        <h2 class="name">{{$ent->name_ent}}</h2>
        <div>{{$ent->address_ent}}</div>
        <div>{{$ent->phone_ent}}</div>
        <div>{{$ent->nc_ent}}</div>
        <div>Bank: {{$ent->bank_ent}}</div>
      </div>
      </div>
    </header>
                    
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">QUOTATION TO:</div>
          <h2 class="name">{{$cl->name_cli}}</h2>
          <div class="address">{{$cl->address_cli}}</div>
          <div class="email"><a href="#">{{$cl->cl_email}}</a></div>
        </div>
        
        <div id="invoice">
          <h1>QUOTATION {{$pro->pro_ref}}</h1>
          <div class="date">Date of Quotation: {{date('j F, Y', strtotime($pro->date_pro))}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach($eps as $i=>$ep)
            <tr>
              <td class="no">{{$i+1}}</td>
              <td class="desc">{{ $ep->ep_lib }}</td>
              <td class="unit">{{ number_format($ep->ep_pu,0) }}</td>
              <td class="qty">{{ $ep->ep_qty }}</td>
              <td class="total">{{ number_format($ep->ep_ttc,0) }}</td>
            </tr>
          @endforeach
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>{{number_format($pro->mht_pro,0)}} XAF</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">DISCOUNT</td>
            <td>{{number_format($pro->reduction,0)}} XAF</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 19,25%</td>
            <td>{{number_format($pro->tva_pro,0)}} XAF</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">CHARGES DEDUCTED</td>
            <td>{{number_format($pro->rs_pro,0)}} XAF </td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2"> TOTAL</td>
            <td>{{number_format($pro->mttc_pro,0)}} XAF</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <p class="notice"><i>This quotation is valid for <b>20 days</b> from the date of establishment.</i></p>
        <div class="notice">Arrested this invoice at the sum of <b>{{number_format($pro->mttc_pro,0)}} XAF</div>
        <p class="notice"><img src="data:image/png;base64,{{ $qrcode }}"></p>
      </div>
      <div id="signature"> 
      <i>The manager</i>
        </div>
    </main>
    <footer>
      <div> Processed by: {{$usr->name}} </div>
      <div>&copy; by KPAB Technologies.</div>
    </footer>
  </body>
</html>
