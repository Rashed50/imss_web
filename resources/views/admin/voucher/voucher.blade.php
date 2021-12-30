<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pdf Or Print</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			outline: 0;
		}
		ul ol {
			list-style-type:  none;
		}
		a{
			text-decoration: none;
		}
		.main_wrap{
			width: 80%;
			margin: 0 auto;
			padding: 50px;
			background: #f1f1f1;
		}

		.table{
			width: 100%;
		}
		.table, th,td{
			border: 1px solid #333;
  			border-collapse: collapse;
  			text-align: center;
		}

		.table th,td{
			padding: 5px;
		}

		pre {
		  background-color: #dedede;
		  padding: 5px;
		  color: #00ab8e;
		  overflow-x: auto;
		}

		.img-report-file-result {
		  border-top: 1px solid #d5d5d5;
		  margin-top: 3em;
		}
		.header{
			text-align:  center;
			margin-bottom: 10px;
		}
		@media print{
			.print-button{
				display: none;
			}
		}
	</style>
</head>
<body>

	<div class="main_wrap">
		<a style="cursor:pointer" onclick="window.print()" class="print-button">PDF Or Pirnt</a>
		<div class="header">
			<h2>name</h2>
			<p> <span>012345678</span> <span>0123456789</span></p>
			<address>Address</address>
		</div>
		<div class="mdl-grid">
			<div class="mdl-cell--12 col" >
				<div id="img-report-summary">
					<h1 style="margin-bottom:10px">Report 2</h1>
					<table class="table mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
						<thead>
							<th class="mdl-data-table__cell--non-numeric">S.N</th>
                            <th class="mdl-data-table__cell--non-numeric">Category</th>
                            <th class="mdl-data-table__cell--non-numeric">Brand</th>
                            <th class="mdl-data-table__cell--non-numeric">Size</th>
                            <th class="mdl-data-table__cell--non-numeric">Thickness</th>
                            <th class="mdl-data-table__cell--non-numeric">Quantity</th>
                            <th class="mdl-data-table__cell--non-numeric">Labour Cost</th>
                            <th class="mdl-data-table__cell--non-numeric">Amount</th>
						</tr>
					</thead>
					<tbody>
                         @foreach($sellRecord as $key=>$record)
						<tr>
                            <th class="mdl-data-table__cell--non-numeric">{{ $key+1}}</th>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->CateId}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->BranId}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->SizeId}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->ThicId}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->Quantity}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->LabourCost}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{ $record->Amount}}</td>
						</tr>
                        @endforeach
                       
						<tr>
							<td colspan="5"><strong style="display: block; margin-right: 30px; text-align:right">Total:</strong></td>
							<td>1234</td>
							<td>0000</td>
							<td>0000</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
</body>
</html>