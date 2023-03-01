@extends('layouts.backend-layout')


@section('title')
    Inventory list
@endsection

@section('breadcrumb')
    Inventory List

@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="alt-pagination-preview">
                            <table id="alternative-page-datatable"
                                   class="table table-striped dt-responsive nowrap w-100">

                                <thead>

                                <tr>
                                    <th>Title</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @if(session()->has('success'))

                                    <div class="alert alert-success" role="alert">
                                        <strong>Success - </strong> {{session('success')}}

                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @foreach($inventoryData as $inventoryDataVar)

                                    <tr>

                                        <td>{{$inventoryDataVar->inventory_title}}</td>
                                        <td>{{$inventoryDataVar->inventory_quantity}}</td>
                                        <td>{{$inventoryDataVar->inventory_unit_price}}</td>
                                        <td>{{$inventoryDataVar->inventory_description}}</td>
                                        <td>{{$inventoryDataVar->inventory_amount}}</td>
                                        <td><a href="{{route('editInventory',['id'=>$inventoryDataVar->id])}}"
                                               class="action-icon"> <i class="mdi mdi-pencil"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
{{--                        <div class="tab-pane" id="alt-pagination-code">--}}
{{--                                                <pre class="mb-0">--}}
{{--                                                    <span class="html escape">--}}
{{--                                                        &lt;table id=&quot;alternative-page-datatable&quot; class=&quot;table dt-responsive nowrap w-100&quot;&gt;--}}
{{--                                                            &lt;thead&gt;--}}
{{--                                                                &lt;tr&gt;--}}
{{--                                                                    &lt;th&gt;Name&lt;/th&gt;--}}
{{--                                                                    &lt;th&gt;Position&lt;/th&gt;--}}
{{--                                                                    &lt;th&gt;Office&lt;/th&gt;--}}
{{--                                                                    &lt;th&gt;Age&lt;/th&gt;--}}
{{--                                                                    &lt;th&gt;Start date&lt;/th&gt;--}}
{{--                                                                    &lt;th&gt;Salary&lt;/th&gt;--}}
{{--                                                                &lt;/tr&gt;--}}
{{--                                                            &lt;/thead&gt;--}}

{{--                                                            &lt;tbody&gt;--}}
{{--                                                                &lt;tr&gt;--}}
{{--                                                                    &lt;td&gt;Tiger Nixon&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;System Architect&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;Edinburgh&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;61&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;2011/04/25&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;$320,800&lt;/td&gt;--}}
{{--                                                                &lt;/tr&gt;--}}
{{--                                                                &lt;tr&gt;--}}
{{--                                                                    &lt;td&gt;Garrett Winters&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;Accountant&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;Tokyo&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;63&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;2011/07/25&lt;/td&gt;--}}
{{--                                                                    &lt;td&gt;$170,750&lt;/td&gt;--}}
{{--                                                                &lt;/tr&gt;--}}
{{--                                                            &lt;/tbody&gt;--}}
{{--                                                        &lt;/table&gt;--}}
{{--                                                    </span>--}}
{{--                                                </pre> <!-- end highlight-->--}}
{{--                        </div>--}}
                        <!-- end preview code-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- end row-->


@endsection
