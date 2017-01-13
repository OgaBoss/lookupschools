@extends('layouts.school-dashboard-layout')
@section('content')
<section class="content-header">
    <h1>
        Invoice
    </h1>
    <ol class="breadcrumb">
        <li><a href="/school/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoice</li>
    </ol>
</section>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> LookUpSchools
                <small class="pull-right">{{ date('F jS, Y') }}</small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>LookUpSchools</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: +23412345678<br/>
                Email: admin@lookupschools.com
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{ Sentry::getUser()->first_name. " " .Sentry::getUser()->last_name }}</strong><br>
                Email: {{ Sentry::getUser()->email }}
            </address>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>School Name</th>
                    <th>Payments</th>
                    <th>Duration</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                </tr>
                </thead>
                <tbody>
                @forelse($bills as $bill)
                    <tr>
                        <td>{{ $bill->qty }}</td>
                        <td>{{ $bill->advert_name }}</td>
                        <td>{{ ucfirst($bill->school_slug) }}</td>
                        <td>#{{ $bill->payments }}</td>
                        <td>{{ $bill->duration }}</td>
                        <td>{{ date_format($bill->created_at, 'Y-m-d'); }}</td>
                        <td>{{ $bill->date_end }}</td>
                        {{--<td>{{ date("F jS, Y", $bill->created_at) }}</td>--}}
                    </tr>
                @empty
                    <tr><td colspan="7">No Subscription</td></tr>
                @endforelse

                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        {{--<div class="col-xs-6">--}}
            {{--<p class="lead">Payment Methods:</p>--}}
            {{--{{ HTML::image('/img/visa.png', 'User Image', array('class' => '')) }}--}}
            {{--{{ HTML::image('/img/mastercard.png', 'User Image', array('class' => '')) }}--}}
            {{--{{ HTML::image('/img/american-express.png', 'User Image', array('class' => '')) }}--}}
            {{--{{ HTML::image('/img/paypal2.png', 'User Image', array('class' => '')) }}--}}
        {{--</div><!-- /.col -->--}}
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    {{--<div class="row no-print">--}}
        {{--<div class="col-xs-12">--}}
            {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
            {{--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>--}}
            {{--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>--}}
        {{--</div>--}}
    {{--</div>--}}
</section><!-- /.content -->
<div class="clearfix"></div>
@stop