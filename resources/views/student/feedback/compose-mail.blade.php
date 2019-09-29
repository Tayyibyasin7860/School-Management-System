@extends('layouts.app2')




@section('content')
<div class="col-lg-9 animated fadeInRight">
    <div class="mail-box-header">
        <div class="pull-right tooltip-demo">
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
            <a href="mailbox.html" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
        </div>
        <h2>
            Compse mail
        </h2>
    </div>
    <div class="mail-box">


        <div class="mail-body">

            <form class="form-horizontal" method="get">
                <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                    <div class="col-sm-10"><input type="text" class="form-control" value="alex.smith@corporat.com"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                    <div class="col-sm-10"><input type="text" class="form-control" value=""></div>
                </div>
            </form>

        </div>

        <div class="mail-text h-200">

            <div class="summernote">
                <h3>Hello Jonathan! </h3>
                dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                <br/>
                <br/>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a href="mailbox.html" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a>
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
            <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
        </div>
        <div class="clearfix"></div>



    </div>
</div>
    @endsection
