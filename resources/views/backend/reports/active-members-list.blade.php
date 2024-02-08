@extends('layouts.backend-layout')


@section('title')

    Active Members List
@endsection
@section('breadcrumb')

    Active Members List
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
                                    <th>Member ID</th>
                                    <th>Member Name</th>
                                    <th>Fee Date</th>
{{--                                    <th>Package</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($activeMembers as $activeMemberVar)
                                    <tr>
                                        <td>
                                            {{$activeMemberVar->roll_no}}
                                        </td>
                                        <td class="table-user">
                                            {{$activeMemberVar->member_name}}
                                        </td>
                                        <td>                {{$activeMemberVar->member_fee_end_date}}
                                        </td>
{{--                                        <td>                <a href="{{route('packagesList')}}" target="_blank">{{$activeMemberVar->member_package}}</a>--}}
{{--                                        </td>--}}

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
                        {{--                        </div> <!-- end preview code-->--}}
                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>



@endsection
