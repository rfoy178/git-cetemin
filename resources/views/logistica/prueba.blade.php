@extends('layout.app4')

@section('cabecera')


<style >

    .mt-element-step .row {
        margin: 0
    }

    .mt-element-step .step-default .mt-step-col {
        padding-top: 30px;
        padding-bottom: 30px;
        text-align: center
    }

    .mt-element-step .step-default .mt-step-number {
        font-size: 26px;
        border-radius: 50%!important;
        display: inline-block;
        margin: auto auto 20px;
        padding: 3px 14px
    }

    .mt-element-step .step-default .mt-step-title {
        font-size: 30px;
        font-weight: 100
    }

    .mt-element-step .step-default .active {
        background-color: #32c5d2!important
    }

    .mt-element-step .step-default .active .mt-step-number {
        color: #32c5d2!important
    }

    .mt-element-step .step-default .active .mt-step-content,
    .mt-element-step .step-default .active .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-default .done {
        background-color: #26C281!important
    }

    .mt-element-step .step-default .done .mt-step-number {
        color: #26C281!important
    }

    .mt-element-step .step-default .done .mt-step-content,
    .mt-element-step .step-default .done .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-default .error {
        background-color: #E7505A!important
    }

    .mt-element-step .step-default .error .mt-step-number {
        color: #E7505A!important
    }

    .mt-element-step .step-default .error .mt-step-content,
    .mt-element-step .step-default .error .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-thin .mt-step-col {
        padding-top: 10px;
        padding-bottom: 10px
    }

    .mt-element-step .step-thin .mt-step-number {
        font-size: 26px;
        border-radius: 50%!important;
        float: left;
        margin: auto;
        padding: 3px 14px
    }

    .mt-element-step .step-thin .mt-step-title {
        font-size: 24px;
        font-weight: 100;
        padding-left: 60px;
        margin-top: -4px
    }

    .mt-element-step .step-thin .mt-step-content {
        padding-left: 60px;
        margin-top: -5px
    }

    .mt-element-step .step-thin .active {
        background-color: #32c5d2!important
    }

    .mt-element-step .step-thin .active .mt-step-number {
        color: #32c5d2!important
    }

    .mt-element-step .step-thin .active .mt-step-content,
    .mt-element-step .step-thin .active .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-thin .done {
        background-color: #26C281!important
    }

    .mt-element-step .step-thin .done .mt-step-number {
        color: #26C281!important
    }

    .mt-element-step .step-thin .done .mt-step-content,
    .mt-element-step .step-thin .done .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-thin .error {
        background-color: #E7505A!important
    }

    .mt-element-step .step-thin .error .mt-step-number {
        color: #E7505A!important
    }

    .mt-element-step .step-thin .error .mt-step-content,
    .mt-element-step .step-thin .error .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background .mt-step-col {
        padding-top: 30px;
        padding-bottom: 30px;
        text-align: center;
        height: 160px
    }

    .mt-element-step .step-background .mt-step-number {
        font-size: 200px;
        position: absolute;
        bottom: 0;
        right: 0;
        line-height: .79em;
        color: #dae1e4;
        z-index: 4
    }

    .mt-element-step .step-background .mt-step-content,
    .mt-element-step .step-background .mt-step-title {
        text-align: right;
        z-index: 5;
        position: relative;
        padding-right: 25%
    }

    .mt-element-step .step-background .mt-step-title {
        font-size: 30px;
        font-weight: 100
    }

    .mt-element-step .step-background .active {
        background-color: #32c5d2!important
    }

    .mt-element-step .step-background .active .mt-step-number {
        color: #2ab4c0!important
    }

    .mt-element-step .step-background .active .mt-step-content,
    .mt-element-step .step-background .active .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background .done {
        background-color: #26C281!important
    }

    .mt-element-step .step-background .done .mt-step-number {
        color: #22ad73!important
    }

    .mt-element-step .step-background .done .mt-step-content,
    .mt-element-step .step-background .done .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background .error {
        background-color: #E7505A!important
    }

    .mt-element-step .step-background .error .mt-step-number {
        color: #e43a45!important
    }

    .mt-element-step .step-background .error .mt-step-content,
    .mt-element-step .step-background .error .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background-thin .mt-step-col {
        padding-top: 15px;
        padding-bottom: 15px;
        text-align: center
    }

    .mt-element-step .step-background-thin .mt-step-number {
        font-size: 120px;
        position: absolute;
        bottom: 0;
        right: 0;
        line-height: .79em;
        color: #dae1e4;
        z-index: 4
    }

    .mt-element-step .step-background-thin .mt-step-title {
        font-size: 30px;
        font-weight: 100;
        text-align: right;
        padding-right: 25%;
        z-index: 5;
        position: relative
    }

    .mt-element-step .step-background-thin .mt-step-content {
        text-align: right;
        position: relative;
        padding-right: 25%;
        z-index: 5
    }

    .mt-element-step .step-background-thin .active {
        background-color: #32c5d2!important
    }

    .mt-element-step .step-background-thin .active .mt-step-number {
        color: #2ab4c0!important
    }

    .mt-element-step .step-background-thin .active .mt-step-content,
    .mt-element-step .step-background-thin .active .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background-thin .done {
        background-color: #26C281!important
    }

    .mt-element-step .step-background-thin .done .mt-step-number {
        color: #22ad73!important
    }

    .mt-element-step .step-background-thin .done .mt-step-content,
    .mt-element-step .step-background-thin .done .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-background-thin .error {
        background-color: #E7505A!important
    }

    .mt-element-step .step-background-thin .error .mt-step-number {
        color: #e43a45!important
    }

    .mt-element-step .step-background-thin .error .mt-step-content,
    .mt-element-step .step-background-thin .error .mt-step-title {
        color: #fff!important
    }

    .mt-element-step .step-no-background .mt-step-col {
        padding-top: 30px;
        padding-bottom: 30px;
        text-align: center
    }

    .mt-element-step .step-no-background .mt-step-number {
        font-size: 26px;
        border-radius: 50%!important;
        display: inline-block;
        margin: auto auto 20px;
        padding: 3px 14px;
        border: 1px solid #e5e5e5
    }

    .mt-element-step .step-no-background .mt-step-title {
        font-size: 30px;
        font-weight: 100
    }

    .mt-element-step .step-no-background .active .mt-step-number {
        color: #32c5d2!important;
        border-color: #32c5d2!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background .active .mt-step-content,
    .mt-element-step .step-no-background .active .mt-step-title {
        color: #32c5d2!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background .done .mt-step-number {
        color: #26C281!important;
        border-color: #26C281!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background .done .mt-step-content,
    .mt-element-step .step-no-background .done .mt-step-title {
        color: #26C281!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background .error .mt-step-number {
        color: #E7505A!important;
        border-color: #E7505A!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background .error .mt-step-content,
    .mt-element-step .step-no-background .error .mt-step-title {
        color: #E7505A!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .mt-step-col {
        padding-top: 10px;
        padding-bottom: 10px
    }

    .mt-element-step .step-no-background-thin .mt-step-number {
        font-size: 26px;
        border-radius: 50%!important;
        float: left;
        margin: auto;
        padding: 3px 14px;
        border: 1px solid #e5e5e5
    }

    .mt-element-step .step-no-background-thin .mt-step-title {
        font-size: 24px;
        font-weight: 100;
        padding-left: 60px;
        margin-top: -4px
    }

    .mt-element-step .step-no-background-thin .mt-step-content {
        padding-left: 60px;
        margin-top: -5px
    }

    .mt-element-step .step-no-background-thin .active .mt-step-number {
        color: #32c5d2!important;
        border-color: #32c5d2!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .active .mt-step-content,
    .mt-element-step .step-no-background-thin .active .mt-step-title {
        color: #32c5d2!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .done .mt-step-number {
        color: #26C281!important;
        border-color: #26C281!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .done .mt-step-content,
    .mt-element-step .step-no-background-thin .done .mt-step-title {
        color: #26C281!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .error .mt-step-number {
        color: #E7505A!important;
        border-color: #E7505A!important;
        font-weight: 700
    }

    .mt-element-step .step-no-background-thin .error .mt-step-content,
    .mt-element-step .step-no-background-thin .error .mt-step-title {
        color: #E7505A!important;
        font-weight: 700
    }

    .mt-element-step .step-line .mt-step-col {
        padding: 30px 0;
        text-align: center
    }

    .mt-element-step .step-line .mt-step-number {
        font-size: 26px;
        border-radius: 50%!important;
        display: inline-block;
        margin: auto auto 5px;
        padding: 9px;
        border: 3px solid #e5e5e5;
        position: relative;
        z-index: 5;
        height: 60px;
        width: 60px;
        text-align: center
    }

    .mt-element-step .step-line .mt-step-number>i {
        position: relative;
        top: 50%;
        transform: translateY(-120%)
    }

    .mt-element-step .step-line .mt-step-title {
        font-size: 20px;
        font-weight: 400;
        position: relative
    }

    .mt-element-step .step-line .mt-step-title:after,
    .mt-element-step .step-line .mt-step-title:before {
        content: '';
        height: 3px;
        width: 50%;
        position: absolute;
        background-color: #e5e5e5;
        top: -32px;
        z-index: 4;
        transform: translateY(-100%)
    }

    .mt-element-step .step-line .mt-step-title:after {
        left: 50%
    }

    .mt-element-step .step-line .mt-step-title:before {
        right: 50%
    }

    .mt-element-step .step-line .first .mt-step-title:before,
    .mt-element-step .step-line .last .mt-step-title:after {
        content: none
    }

    .mt-element-step .step-line .active .mt-step-number {
        color: #32c5d2!important;
        border-color: #32c5d2!important
    }

    .mt-element-step .step-line .active .mt-step-content,
    .mt-element-step .step-line .active .mt-step-title {
        color: #32c5d2!important
    }

    .mt-element-step .step-line .active .mt-step-title:after,
    .mt-element-step .step-line .active .mt-step-title:before {
        background-color: #32c5d2
    }

    .mt-element-step .step-line .done .mt-step-number {
        color: #26C281!important;
        border-color: #26C281!important
    }

    .mt-element-step .step-line .done .mt-step-content,
    .mt-element-step .step-line .done .mt-step-title {
        color: #26C281!important
    }

    .mt-element-step .step-line .done .mt-step-title:after,
    .mt-element-step .step-line .done .mt-step-title:before {
        background-color: #26C281
    }

    .mt-element-step .step-line .error .mt-step-number {
        color: #E7505A!important;
        border-color: #E7505A!important
    }

    .mt-element-step .step-line .error .mt-step-content,
    .mt-element-step .step-line .error .mt-step-title {
        color: #E7505A!important
    }

    .mt-element-step .step-line .error .mt-step-title:after,
    .mt-element-step .step-line .error .mt-step-title:before {
        background-color: #E7505A
    }
</style>
@endsection


@section('main-content')

    <div class="row">
        <div class="col-lg-4 white">
            <div class="mt-element-list">
                <div class="mt-list-head list-default green-haze">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="list-head-title-container">
                                <h3 class="list-title uppercase sbold">Cotizaciones</h3>
                             </div>
                        </div>
                     </div>
                </div>
                <div class="mt-list-container list-default bg-white-opacity">

                    <ul>
                        @foreach($cot as $item)
                        <li class="mt-list-item">
                            <div class="list-icon-container done ">
                                <a href="javascript:;">
                                    <i class="icon-doc"></i>
                                </a>
                            </div>
                            <div class="list-datetime"> {{ Carbon\Carbon::parse($item["DocDate"])->format('d-m') }}
                                </div>
                            <div class="list-item-content">
                                <h3 class="uppercase bold">
                                    <a href="javascript:;">{{$item["CardName"]}}</a>
                                </h3>

                                 <p>Oferta <b>{{$item["Cotizacion"]}}</b></p>
                            </div>
                        </li>
                            @endforeach

                    </ul>
                </div>
            </div>

        </div>

    </div>


@endsection
@section ('script')


@endsection