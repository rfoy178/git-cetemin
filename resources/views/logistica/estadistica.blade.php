<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span >Presupuesto</span>
                    </h3>
                    <small></small>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-usd"></i>
                </div>
            </div>
            <div class="progress-info">

              @if(($rq->presupuesto==1)&&($rq->aprobacion==0))

                <div class="progress">
                                        <span style="width: 0%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">0% progreso</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title">Progreso
                    </div>
                    <div class="status-number"> 0% </div>
                </div>
            @endif


                  @if(($rq->presupuesto==0)&&($rq->aprobacion==1))

                      <div class="progress">
                                        <span style="width: 50%;" class="progress-bar progress-bar-warning green-sharp">
                                            <span class="sr-only">50% progreso</span>
                                        </span>
                      </div>
                      <div class="status">
                          <div class="status-title">Progreso
                          </div>
                          <div class="status-number"> 50% </div>
                      </div>
                  @endif







            </div>

            <div class="progress-info">

                <div class="status">
                    <div class="status-title"> <code>instalación</code> de video vigilancia para IRQ Perubar</div>
                </div>

            </div>


        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="1349">1349</span>
                    </h3>
                    <small>NEW FEEDBACKS</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>

            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">85% change</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"> change </div>
                    <div class="status-number"> 85% </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="567">567</span>
                    </h3>
                    <small>NEW ORDERS</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"> grow </div>
                    <div class="status-number"> 45% </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">
                        <span data-counter="counterup" data-value="276">276</span>
                    </h3>
                    <small>NEW USERS</small>
                </div>
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"> change </div>
                    <div class="status-number"> 57% </div>
                </div>
            </div>
        </div>
    </div>
</div>
