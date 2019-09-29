<html>

    <head>
        <title>.</title>
        <style>
            body {
                color: black;
            }

            .text-uppercase {
                text-transform: uppercase;
            }

            .cust-font {
                font-family: 'Lobster', cursive;
            }

            .company-name {
                font-size: 30px;
                padding: 0;
                margin: 0;
            }

            .table th,
            .table td {
                padding: 5px !important;
            }

            .text-center {
                text-align: center;
            }

            .p-0 {
                padding: 0;
            }

            .pt-35 {
                padding-top: 35px !important;
            }

            .m-0 {
                margin: 0;
            }

            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                white-space: unset;
            }

            .table {
                border-collapse: collapse;
            }

            .table td,
            th {
                border: 1px solid black;
            }

            .table th {
                text-align: left;
            }

            .no-border tr td,
            .no-border tr th {
                border: 0 !important;
            }

            .float-right {
                padding-left: 50%;
            }

            .font-12{
                font-size: 12px;
            }

        </style>
    </head>

    <body>
        <div class="text-center">
            <p class="m-0 company-name cust-font">Masud Seed Company</p>
            <p class="m-0 font-12">Seed Grower, Importer, Exporter & Supplier</p>
            <p class="m-0 mb-3 font-12">174, Siddique Bazar, Dhaka-1000, Bangladesh</p>
            <p class="m-0 mb-3 font-12">Email: masudseed@yahoo.com, bmmohsin@gmail.com</p>
            <p class="m-0 mb-3 font-12">Mobile: 01403337415, Phone: 0247112986</p>
        </div>
        <div class="font-12">
            <div class="pt-35">
                <table class="table no-border p-0">
                    <tr class="p-0">
                        <th width="100px">Invoice No</th>
                        <td width="1px">:</td>
                        <td class="text-uppercase">{{ $sell_product->invoice_no }}</td>
                    </tr>
                    <tr class="p-0">
                        <th>Dealer</th>
                        <td>:</td>
                        <td>{{ $sell_product->dealer->name }}</td>
                    </tr>
                    <tr class="p-0">
                        <th>Dealer</th>
                        <td>:</td>
                        <td>{{ $sell_product->dealer->dealer_code }}</td>
                    </tr>
                    <tr class="p-0">
                        <th>Date</th>
                        <td>:</td>
                        <td>{{ $sell_product->date }}</td>
                    </tr>
                    <tr class="p-0">
                        <th width="100px">Memo No</th>
                        <td width="1px">:</td>
                        <td>{{ $sell_product->memo_no }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="10%">Serial No</th>
                            <th width="15%">Product Name</th>
                            <th width="15%">Packet Size (gm)</th>
                            <th width="15%">Packet Quantity</th>
                            <th width="15%">Quantity (Kg)</th>
                            <th width="15%">Unit Price / Kg (tk)</th>
                            <th width="10%">Total (tk)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sell_product->sellProductItems->count())
                        @foreach ($sell_product->sellProductItems as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->packetSize->packet_size }}</td>
                            <td>{{ $item->packet_quantity }}</td>
                            <td>{{ $item->sub_quantity }}</td>
                            <td>{{ $item->unit_price }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="float-right">
                <table class="table no-border">
                    <tr>
                        <th width="120px">Grand Total</th>
                        <td width="1px">:</td>
                        <td>{{ $sell_product->grand_total }} (tk)</td>
                    </tr>
                    <tr>
                        <th>Previous Due</th>
                        <td>:</td>
                        <td>{{ $dealer_previous_due->total_amount_due??'0' }}</td>
                    </tr>
                    <tr>
                        <th>Total Due</th>
                        <td>:</td>
                        <td>{{ $total_due = ($dealer_previous_due->total_amount_due + $sell_product->grand_total) }}</td>
                    </tr>
                    <tr>
                        <th>Commission</th>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Amount Pay</th>
                        <td>:</td>
                        <td>{{ $sell_product->amount_pay }}</td>
                    </tr>
                    <tr>
                        <th>Amount Due</th>
                        <td>:</td>
                        <td>{{ $total_due - $sell_product->amount_pay }}</td>
                    </tr>
                    <tr>
                        <th>Is Verified</th>
                        <td>:</td>
                        <td>{{ isVerified($sell_product->is_verified) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>:</td>
                        <td>{{ paymentType($sell_product->payment_type) }}</td>
                    </tr>
                    @if (!$sell_product->is_verified && $sell_product->payment_type == 1)
                        <tr>
                            <th>Bank</th>
                            <td>:</td>
                            <td>{{ $sell_product->transaction->bankAccount->bank->name }}</td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td>:</td>
                            <td>{{ $sell_product->transaction->bankAccount->branch->name }}</td>
                        </tr>
                        <tr>
                            <th>A/C Number</th>
                            <td>:</td>
                            <td>
                                {{ $sell_product->transaction->bankAccount->account_number }} - 
                                ({{ $sell_product->transaction->bankAccount->account_holder }})
                            </td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>
    </body>

</html>
