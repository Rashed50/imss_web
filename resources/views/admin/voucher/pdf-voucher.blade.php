<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>
    <style>
        *{
            border:0;
            padding:0;
            margin:0
        }
        body {
        /* background-color: #ede3b9; */
        width: 100%;
        text-align: center;
        border: 1px solid black;
        }
        section{
            width: 80%;
            margin:0 auto;
        }
        .full_width{
            width: 70%;
            min-width: 72%;
            border: 1px solid black;
            margin:0 auto;
        }
        .header{
            margin:0 auto;
            width: 70%;
            text-align: center;
            border: 1px solid
        }
        .customer{
            padding-top: 10px;
            padding-bottom: 20px;
        }

        /* .customer-1st{
            font-size: 18px;
            font-weight: 500;
            text-align: left;
        } */
       

        .table-full{
            width: 70%;
            padding-top: 20px;
            padding-bottom: 20px;
            border: 1px solid;
            margin:0 auto;
        }
        table th .description{
            width: 35%;
        }
        table th .sl_mo{
            width: 10%;
        }
        table, th, td {
        border: 1px solid black;
        text-align: center;
        }
        

        .nested{
            width: 100%;
            border-collapse: collapse;
        }
        .footer{
            padding-top: 100px;
            padding-bottom: 30px;
            align-items: center;
            /* display: inline-flex; */
            display: flex;
            justify-content: center;
            letter-spacing: normal;
            word-spacing: 150px;
            margin:0 auto;
        }
    </style>
</head>

<body>
    <section> 
    <div class="full_width">

    
        <div class="header">
            <h1>Company Name</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <h4>Boro Bazar, Meher pur</h4>
            <p>Lorem ipsum dolor sit amet.</p>

        </div>
        <div class="customer">
            <div class="customer-1st">
                <div class="customer-id">
                    <h6>Payment Id : SL-1234</h6>
                    <h6>Name Id : Md. Name</h6>
                </div>
                <div class="customer-date">
                    <h6>Date : 01/01/2021</h6>
                </div>
            </div>
            <div class="customer-address">
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, itaque!</h6>
            </div>
        </div>
        <table class="table-full">
            <thead>
                <tr>
                    <th class="sl_mo">SL NO. </th>
                    <th class="description">Description</th>
                    <th>Qty</th>
                    <th>Orice</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>TIN.AKS. 10 FT</td>
                    <td>7</td>
                    <td>755.00</td>
                    <td>1234.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>TIN.AKS. 10 FT</td>
                    <td>7</td>
                    <td>755.00</td>
                    <td>1234.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>TIN.AKS. 10 FT</td>
                    <td>7</td>
                    <td>755.00</td>
                    <td>1234.00</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>TIN.AKS. 10 FT</td>
                    <td>7</td>
                    <td>755.00</td>
                    <td>1234.00</td>
                </tr>
                <hr>
                <tr>
                    <tr></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <table class="nested">
                                <tr><td>GR.Total</td></tr>
                                <tr><td>Discount</td></tr>
                                <tr><td>Paid</td></tr>
                                <tr><td>Due</td></tr>
                                <tr><td>Pre due</td></tr>
                                <tr><td>Tot. Due</td> </tr>
                        </table>
                    </td>
                    <td>
                        <table class="nested">
                                <tr><td>19999</td></tr>
                                <tr><td>19999</td></tr>
                                <tr><td>222</td></tr>
                                <tr><td>555</td></tr>
                                <tr><td>000</td></tr>
                                <tr><td>449</td> </tr>
                        </table>
                    </td>
                </tr>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <span><p>Seller Sign</p></span>
            <span><p>Thanks</p></span>
            <span><p>Buyer Sign</p></span> 
        </div>
    </div>
    </section>
</body>
</html>