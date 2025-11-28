{{ trans('cruds.disconnect.fields.data_disconnect') }}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Expense_{{$dep->ref_dep}}</title>
<style>
    .top_rw{ background-color:#f4f4f4; }
	.td_w{ }
	button{ padding:5px 10px; font-size:14px;}
    .invoice-box {
        max-width: 890px;
        margin: auto;
        padding:10px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
		border-bottom: solid 1px #ccc;
    }
    .invoice-box table td {
        padding: 5px;
        vertical-align:middle;
    }
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
		font-size:12px;
    }
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    .rtl table {
        text-align: right;
    }
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>
  </head>
  <body>
<div class="invoice-box">
  <table cellpadding="0" cellspacing="0">
    <tr class="top_rw">
      <td colspan="3">
        <h2 style="margin-bottom: 0px; text-align: center;">{{$ent->name_ent}}</h2>
      </td>
    </tr>
    <tr class="top_rw">
      <td colspan="2">
        <h2 style="margin-bottom: 0px;">Expense #{{$dep->ref_dep}}</h2>
      </td>
      <td style="margin-right: 10px; margin-bottom: 0px;">
        <h3>Date: {{$dep->date_dep}}</h3>
      </td>
    </tr>
    <tr class="top_rw">
      <td colspan="2">
        <strong>Order Number: {{$dep->ref_dep}}</strong>
      </td>
      <td style="margin-right: 10px; margin-bottom: 0px;">
        <strong>Order Date: 17-12-2023</strong>
      </td>
    </tr>
    <tr class="top">
      <td colspan="3">
        <table>
            <tr>
                <td class="text-nowrap">{{ $dep->ref_dep }}</td>
                <td>{{ $dep->label_dep }}</td>
                <td>{{ $dep->amount_dep }}</td>
            </tr>
        </table>
      </td>
    </tr>
    <tr class="information">
      <td colspan="3">
        <table>
          <tr>
            <td colspan="2">
              <b> Shipping Address</b> <br>
              Amy Samson<br>
              KA18 4HE New Cumnock<br>
              United Kingdom<br>
              +44123456789
            </td>
            <td><b>Billing Address</b><br>
              Amy Samson<br>
              KA18 4HE New Cumnock<br>
              United Kingdom<br>
              ssa_digimon_master@live.co.uk
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <td colspan="3">
      <table cellspacing="0px" cellpadding="2px">
        <tr>          
          <th style="width:15%;">
            REF.
          </th>
          <th style="width:35%; text-align: left;">
            PRODUCT
          </th>
          <th style="width:10%; text-align:center;">
            QTY.
          </th>
          <th style="width:10%; text-align:center;">
            UNIT PRICE</br>(EUR)
          </th>
          <th style="width:10%; text-align:center;">
            TAX RATE
          </th>
          <th style="width:10%; text-align:center;">
            TAX AMOUNT</br>(EUR)
          </th>
          <th style="width:10%; text-align: center;">
            TOTAL AMOUNT</br>(EUR)
          </th>
        </tr>
        <tr class="item">       
          <td style="width:15%;">
            AT-15031
          </td>
          <td style="width:35%; text-align: left;">
            Glacier - Matte Dual Sleeves - Standard Size</br>
            HS Code : 3926909790</br>
            Country of Origin: DK
          </td>
          <td style="width:10%; text-align:center;">
            1
          </td>
          <td style="width:10%; text-align:center;">
            11.24
          </td>
          <td style="width:10%; text-align:center;">
            20%
          </td>
          <td style="width:10%; text-align:center;">
            2.25
          </td>
          <td style="width:10%; text-align:center;">
            13.49
          </td>
        </tr>  
        <tr class="item">       
          <td style="width:15%;">
            AT-15057
          </td>
          <td style="width:35%; text-align: left;">
            Wisdom - Dual Matte Sleeves - Standard Size</br>
            HS Code : 3926909790</br>
            Country of Origin: DK
          </td>
          <td style="width:10%; text-align:center;">
            1
          </td>
          <td style="width:10%; text-align:center;">
            11.24
          </td>
          <td style="width:10%; text-align:center;">
            20%
          </td>
          <td style="width:10%; text-align:center;">
            2.25
          </td>
          <td style="width:10%; text-align:center;">
            13.49
          </td>
        </tr>
        <tr class="item">
          <td style="width:80%;" colspan="5"> <b> Sub Total </b> </td>
          <td style="width:10%; text-align:center;">4.5</td>
          <td style="width:10%; text-align:center;">26.98</td>
        </tr>
        <tr class="item">
          <td style="width:60%;" colspan="3"> <b> Shipping and Handling</b> </td>
          <td style="width:10%; text-align:center;">5.80</td>
          <td style="width:10%; text-align:center;">20%</td>
          <td style="width:10%; text-align:center;">1.45</td>
          <td style="width:10%; text-align:center;">7.25</td>
        </tr>
        <tr class="item">
          <td style="width:60%;" colspan="5"> <b> Grand Total </b> </td>
          <td style="width:10%; text-align:center;"><b>5.95</b></td>
          <td style="width:10%; text-align:center;"><b>34.23</b></td>
        </tr>
    </td>
  </table>
  </table>
</div>