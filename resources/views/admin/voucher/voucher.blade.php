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
			width: 800px;
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

		}
		.descrip{

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
			padding: 10px;
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
	</style>
	<!-- style -->
</head>
<body>
	<div class="pdf__wrap">
		<!-- header part -->
		<section class="header__part">
		 	<p class="sub__title">ক্যাশ মেমো</p>
		 	<h1 class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit </h1>
		 	<p class="descrip">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, perferendis!</p>
		 	<p class="address">Lorem ipsum, dolor sit amet.</p>
		 	<p class="phone"> <strong>lorem</strong> Lorem39339 <strong>lorem</strong> Lorem39339 </p>
		</section>
		<!-- body part -->
		<section class="body__part">
			<!-- customer info -->
			<div class="cust__info">
				<!-- customer info left -->
				<div class="cust__info__left">
					<ul>
						<li> <strong>Payment Id:</strong> Lorem, ipsum dolor. </li>
						<li> <strong>Payment Id:</strong> Lorem, ipsum dolor. </li>
						<li> <strong>Payment Id:</strong> Lorem, ipsum dolor. </li>
					</ul>
				</div>
				<!-- customer info right -->
				<div class="cust__info__right">
					<ul>
						<li> <strong>Date:</strong> Lorem, ipsum dolor. </li>
						<li> <strong>Date:</strong> Lorem, ipsum dolor. </li>
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
						<tr>
							<td>1</td>
							<td>
								Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor, deleniti?
							</td>
							<td>3</td>
							<td>8944</td>
							<td>34039409</td>
						</tr>
						<!-- non loop -->
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>8944</td>
							<td>34039409</td>
						</tr>
					</tbody>
				</table>				
			</div>
			<!-- end section -->
		</section>
		<!-- footer part -->
		<section class="footer__part">
			<div class="ft__part__content">
				<p>lorem</p>
				<p> <span> &larr; </span> lorem <span> &larr; </span> </p>
				<p>lorem</p>
			</div>
		</section>
	</div>
</body>
</html>