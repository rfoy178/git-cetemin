<div class="row hidden-print ">

    <div class="mt-element-step">
        <div class="row step-no-background-thin">
            <div class="col-lg-3 mt-step-col                 @if($rq->estado==1) active @endif">
                <div class="mt-step-number first bg-white font-grey">1</div>
                <div class="mt-step-title uppercase font-grey-cascade">Solicitud</div>
                @if($rq->estado==1)
                <div class="mt-step-content font-grey-cascade">Esperando aprobación</div>
                @endif
            </div>
            <div class="col-lg-3 mt-step-col  @if($rq->estado==8) active @endif ">
                <div class="mt-step-number bg-white font-grey">2</div>
                <div class="mt-step-title uppercase font-grey-cascade">Tesoreria</div>
                @if($rq->estado==8)
                    <div class="mt-step-content font-grey-cascade">Esperando deposito</div>
                @endif            </div>

            <div class="col-lg-3 mt-step-col  @if($rq->estado==9) active @endif ">
                <div class="mt-step-number bg-white font-grey">3</div>
                <div class="mt-step-title uppercase font-grey-cascade">Rendir</div>
                <div class="mt-step-content font-grey-cascade">Sustentar el gasto</div>
            </div>

            <div class="col-lg-3 mt-step-col  @if($rq->estado==10) active @endif ">
                <div class="mt-step-number bg-white font-grey">4</div>
                <div class="mt-step-title uppercase font-grey-cascade">Contabilidad</div>
                <div class="mt-step-content font-grey-cascade">Validación contable</div>
            </div>

    </div>
    </div>
</div>