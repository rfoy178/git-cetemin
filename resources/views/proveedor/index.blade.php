@extends('layout.app4')

@section('cabecera')


    <link href="{{asset("assets/pages/css/search.min.css")}}" rel="stylesheet" type="text/css" />



@endsection


@section('main-content')
    <div class="search-page search-content-4">
        <div class="search-bar bordered">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nombre proveedor...">
                        <span class="input-group-btn">
                                            <button class="btn green-soft uppercase bold" type="button">Buscar</button>
                                        </span>
                    </div>
                </div>

            </div>
        </div>
      <!--  <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead class="bg-blue">
                <tr>
                    <th>
                        <a href="javascript:;">Status</a>
                    </th>
                    <th>
                        <a href="javascript:;">Date</a>
                    </th>
                    <th>
                        <a href="javascript:;">Title &amp; Author</a>
                    </th>
                    <th>
                        <a href="javascript:;">Description</a>
                    </th>
                    <th>
                        <a href="javascript:;">Download</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 17, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Admin Reborn</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 17, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Lorem ipsum dolor</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-check font-grey"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 15, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Typi non habent</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 12, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Admin Search Result</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 11, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Mirum est notare</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-check font-grey"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 9, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Admin Reborn</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-check font-grey"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 9, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Admin Reborn</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 6, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Admin Reborn Progress</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="table-status">
                        <a href="javascript:;">
                            <i class="icon-arrow-right font-blue"></i>
                        </a>
                    </td>
                    <td class="table-date font-blue">
                        <a href="javascript:;">October 3, 2015</a>
                    </td>
                    <td class="table-title">
                        <h3>
                            <a href="javascript:;">Metronic Search Page 5</a>
                        </h3>
                        <p>Last Activity:
                            <a href="javascript:;">Bob Robson</a> -
                            <span class="font-grey-cascade">25 mins ago</span>
                        </p>
                    </td>
                    <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                    <td class="table-download">
                        <a href="javascript:;">
                            <i class="icon-doc font-green-soft"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="search-pagination pagination-rounded">
            <ul class="pagination">
                <li class="page-active">
                    <a href="javascript:;"> 1 </a>
                </li>
                <li>
                    <a href="javascript:;"> 2 </a>
                </li>
                <li>
                    <a href="javascript:;"> 3 </a>
                </li>
                <li>
                    <a href="javascript:;"> 4 </a>
                </li>
            </ul>
        </div>
   -->
    </div>
@endsection
@section ('script')


@endsection