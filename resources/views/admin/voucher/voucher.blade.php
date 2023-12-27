<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><--::..PDF..::--></title>
	<!-- style -->
	<style>
		*{
			padding: 0;
			margin: 0;
			outline: 0;
			overflow: hidden;
		}
		ul{
			list-style: none;
		}
		a{
			text-decoration: none;
		}
		.pdf__wrap{
			width: 600px;
			margin:  10px auto;
			border: 1px solid #333;

		}
		/* header part */
		.header__part{
			border-bottom: 1px solid #333;
			padding: 20px;
			text-align: center;
		}
		.sub__title{

		}
		.title{
			font-size: 40px;
			font-weight: bold;
			padding: 0px;
			margin: 5px;
		}
		.descrip {
			padding: 0px 20px;
		}
		.address{
			font-size: 18px;
			font-weight: 600;
		}
		.phone{

		}
		/* body part */
		.body__part{
			padding: 20px;
		}
		.cust__info{
			margin:  0px 20px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 10px;

		}
		.cust__info__left{

		}
		.cust__info__left ul{}
		.cust__info__left ul li{}
		.cust__info__left ul li strong{}

		.cust__info__right ul{}
		.cust__info__right ul li{
			margin-right: 70px;
		}
		.cust__info__right ul li strong{}
		/* customer details */
		.cust__details__table{}
		.cust__details__table table,th,td{
			border: 1px solid #333;
			border-collapse: collapse;
			padding: 2px 10px;
		}
		.cust__details__table table{
			width: 95%;
			margin: 0 auto;
		}
		.cust__details__table table thead{}
		.cust__details__table table thead tr{}
		.cust__details__table table thead tr th{}

		.cust__details__table table tbody{}
		.cust__details__table table tbody tr{}
		.cust__details__table table tbody tr td{}

		/* footer part */
		.footer__part{
			padding: 20px;
		}
		.footer__part .ft__part__content{
			width: 90%;
			margin: 0 auto;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.footer__part .ft__part__content p{
			font-weight: bold;
			font-size: 18px;
		}
		.footer__part .ft__part__content p span{
			font-size: 20px;
			font-weight: 900;
		}
		.print__menu{
			text-align: center;
		}
		.print__menu a {
			background: #ddd;
			padding: 5px 15px;
			display: inline-block;
			font-weight: 700;
			cursor: pointer;
		}
		  /* @media print{
			.print__menu{
				display: none;
			}
		}   */

		@media print {
            .container {
                max-width: 98%;
                margin: 5 auto ;
            }

            @page {
                size: A4 portrait;
                margin: 15mm 5mm 10mm 15mm;
                /* top, right,bottom, left */

            }

            .print__button {
                visibility: hidden;
            }

            table { page-break-after:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            td    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }

        }
	
       



	</style>
	<!-- style -->
</head>
<body>
	<div class="print__menu">
		<a onclick="window.print()">Print Or Pdf</a>
	</div>
	<div class="pdf__wrap">
		<!-- header part -->
		<section class="header__part">
		 	<p class="sub__title">ক্যাশ মেমো</p>
		 	<h1 class="title">{{$company[0]->BengleName}}</h1>
		 	<p class="descrip">{{$company[0]->InvoiceDescriptionBl}}</p>
		 	<p class="address">{{$company[0]->CompAddress}}</p>
		 	<p class="phone"> <strong>Mobile</strong> {{$company[0]->InvoiceMobile1}},{{$company[0]->InvoiceMobile2}}, {{$company[0]->InvoiceMobile3}}</p>
		</section>
		<!-- body part -->
		<section class="body__part">
			<!-- customer info -->
			<div class="cust__info">
				<!-- customer info left -->
				<div class="cust__info__left">
					<ul>
						<li> <strong>Payment Id: </strong> {{$sellInfo->VoucharNo}}</li>
						<li> <strong>Name: </strong> {{$sellInfo->Customer->CustName}}</li>
						<li> <strong>Address: </strong> {{$sellInfo->Customer->Address}}</li>
					</ul>
				</div>
				<!-- customer info right -->
				<div class="cust__info__right">
					<ul>
						<li> <strong>Date:</strong> {{$sellInfo->SellingDate}}</li>
						<li> <strong>Mobile:</strong> {{$sellInfo->Customer->ContactNumber}}</li>
					</ul>
				</div>
			</div>
			<!-- customer details in table-->
			<div class="cust__details__table">
				<table>
					<thead>
						<tr>
							<th>SL.No</th>
							<th>Description</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					</thead>
					<!-- tbody -->
					<tbody>
						<!-- loop -->
						@foreach($sellRecord as $key=>$record)
						<tr>
							<td>{{$key+1}}</td>
							<td>
								{{$record->Category->CateName.', '.
									$record->Brand->BranName.', '.
									$record->Size->SizeName.', '.
									$record->Thickness->ThicName}}
							</td>
							<td style="text-align:right">{{$record->Quantity}}</td>
							<td style="text-align:right">{{$record->Amount}}</td>
							<td style="text-align:right">{{$record->Quantity*$record->Amount}}</td>
						</tr>
					  @endforeach
					  <tr>
							<td></td>
							<td colspan="1" > Labour Cost + Carrying Bill ({{$sellInfo->LabourCost}} + {{$sellInfo->CarryingCost}}) </td>
							<td style="text-align:right">-</td>
							<td style="text-align:right">-</td>
							<td style="text-align:right">{{$sellInfo->LabourCost + $sellInfo->CarryingCost}}</td>
						</tr>
						<!-- non loop -->
						<tr>
							<td rowspan="6" colspan="3"></td>
							<th style="text-align:right">GR.Total</th>
							<td style="text-align:right">{{$sellInfo->TotalAmount}}</td>
						</tr>
						<tr>
							<th style="text-align:right">Discount</th>
							<td style="text-align:right">{{$sellInfo->Commission}}</td>
						</tr>
						<tr>
							<th style="text-align:right">Paid</th>
							<td style="text-align:right">{{$sellInfo->PaidAmount}}</td>
						</tr>
						<tr>
							<th style="text-align:right">Due</th>
							<td style="text-align:right">{{$sellInfo->DueAmount}}</td>
						</tr>
						<tr>
							<th style="text-align:right">Pre Due</th>
							<td style="text-align:right">{{$oldDue ?? ''}}</td>
						</tr>
						<tr>
							<th style="text-align:right">Tot.Due</th>
							<td style="text-align:right">{{$oldDue+$sellInfo->DueAmount ?? $sellInfo->DueAmount}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- end section -->
		</section>
		<!-- footer part -->
		<section class="footer__part">
			<div class="ft__part__content">
			  	<p>ক্রেতার স্বাক্ষর</p>
					<p> <span> &larr; </span> ধন্যবাদ <span> &larr; </span> </p>
					<p>বিক্রেতার স্বাক্ষর</p>
			</div>
		</section>


</body>
</html>
