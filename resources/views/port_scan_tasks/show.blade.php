@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-columns"></i>
                            <h3>Bordered table</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="hidden-xs">Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td rowspan="2">1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td class="hidden-xs">@mdo</td>
                                </tr>
                                <tr>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td class="hidden-xs">@TwBootstrap</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td class="hidden-xs">@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td colspan="2">Larry the Bird</td>
                                    <td class="hidden-xs">@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-hand-up"></i>
                            <h3>Hover rows</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="hidden-xs">Username</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td class="hidden-xs">@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td class="hidden-xs">@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td colspan="2">Larry the Bird</td>
                                    <td class="hidden-xs">@twitter</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>abc</td>
                                    <td>xyz</td>
                                    <td class="hidden-xs">@mdo</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
