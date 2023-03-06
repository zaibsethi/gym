{{--@extends('layouts.backend-layout')--}}

{{--@section('styles')--}}


{{--        .search-table {--}}
{{--            padding: 10%;--}}
{{--            margin-top: -6%;--}}
{{--        }--}}

{{--        .search-box {--}}
{{--            background: #c1c1c1;--}}
{{--            border: 1px solid #ababab;--}}
{{--            padding: 3%;--}}
{{--        }--}}

{{--        .search-box input:focus {--}}
{{--            box-shadow: none;--}}
{{--            border: 2px solid #eeeeee;--}}
{{--        }--}}

{{--        .search-list {--}}
{{--            background: #fff;--}}
{{--            border: 1px solid #ababab;--}}
{{--            border-top: none;--}}
{{--        }--}}

{{--        .search-list h3 {--}}
{{--            background: #eee;--}}
{{--            padding: 3%;--}}
{{--            margin-bottom: 0%;--}}
{{--        }--}}

{{--    @endsection--}}

{{--@section('title')--}}
{{--    Members list--}}
{{--@endsection--}}

{{--@section('breadcrumb')--}}
{{--    Members List--}}

{{--@endsection--}}

{{--@section('content')--}}



{{--                        <div class="col-md-6">--}}
{{--                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control"--}}
{{--                                   placeholder="Search all Members">--}}
{{--                            <script>--}}
{{--                    $(document).ready(function () {--}}
{{--                        $("#myInput").on("keyup", function () {--}}
{{--                            var value = $(this).val().toLowerCase();--}}
{{--                            $("#myTable tr").filter(function () {--}}
{{--                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)--}}
{{--                            });--}}
{{--                        });--}}
{{--                    });--}}
{{--                </script>--}}
{{--                        </div>--}}

{{--                        <div class="search-list" style="overflow-y:scroll;height:1200px !important; background: #37404A !important;color: ghostwhite !important;">--}}
{{--                                <div class="search-list" style="overflow-y:hidden; height: 800px !important;">--}}

{{--                            <table class="table" id="myTable" style="background: #37404A !important;color: ghostwhite !important;">--}}

{{--                                <thead>--}}
{{--                                <tr style="background: #37404A !important;color: ghostwhite !important;">--}}


{{--                                    <th>Member ID</th>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th>Phone</th>--}}
{{--                                    <th>Edit</th>--}}

{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}






{{--                                    @foreach($memberData as $membersVar)--}}



{{--                                        <tr style="background: #37404A !important;color: ghostwhite !important;">--}}


{{--                                            <td>{{$membersVar->id}}</td>--}}
{{--                                            <td>{{$membersVar->member_name}}</td>--}}
{{--                                            <td>{{$membersVar->member_phone}}</td>--}}

{{--                                            <td>--}}
{{--                                                @if(\Illuminate\Support\Facades\Auth::user()->type == "owner")--}}

{{--                                                    <a href="{{route('editMember',['id'=>$membersVar->id])}}"--}}
{{--                                                       class="action-icon" > <i class="mdi mdi-pencil"></i></a>--}}
{{--                                                @endif--}}

{{--                                            </td>--}}
{{--                                        </tr>--}}



{{--                                @endforeach--}}
{{--                                    {{ $memberData->links() }}--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                        </div>--}}

{{--    <script>--}}
{{--                    $(document).ready(function () {--}}
{{--                        $("#myInput").on("keyup", function () {--}}
{{--                            var value = $(this).val().toLowerCase();--}}
{{--                            $("#myTable tr").filter(function () {--}}
{{--                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)--}}
{{--                            });--}}
{{--                        });--}}
{{--                    });--}}
{{--                </script>--}}
{{--    <!-- end row-->--}}

{{--@endsection--}}

{{--<<<<<<<<< Seprator>>>>>>>>>>--}}

@extends('layouts.backend-layout')


@section('title')
    Members list
@endsection

@section('breadcrumb')
    Members List

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if(\Illuminate\Support\Facades\Auth::user()->type == "owner")
                <a class="btn btn-success" href="{{route('memberExport')}}">Export Members</a>

                {{--            <form method="post" action="{{route('memberImport')}}" enctype="multipart/form-data">--}}
                {{--                @csrf--}}
                {{--                <input type="file" name="file">--}}
                {{--                <button type="submit">Import</button>--}}

                {{--            </form>--}}

            @endif
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="alt-pagination-preview">
                            <table id="alternative-page-datatable"
                                   class="table table-striped dt-responsive nowrap w-100">

                                <thead>

                                <tr>
                                    <th>Member ID</th>
                                    {{--                                    <th>Picture</th>--}}
                                    {{--                                                                        <th>Mem Qr</th>--}}
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Fee date</th>
                                    <!--<th>B-Group</th>-->
                                    <!--<th>Shift</th>-->
{{--                                    <th>Package Amount</th>--}}
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

                                @foreach($memberData as $memberDataVar)

                                    <tr>
                                        <td>{{$memberDataVar->id}}</td>

                                        {{--                                        <td>--}}
                                        {{--                                            @if($memberDataVar->image == null)--}}
                                        {{--                                                --}}{{--      if there is no pic then default will display--}}

                                        {{--                                                <img class="img-responsive  img-thumbnail"--}}
                                        {{--                                                     style="height: 120px; width: 120px"--}}
                                        {{--                                                     src="{{ asset('backend/images/black_member_profile_picture.jpg') }}"--}}
                                        {{--                                            @else--}}
                                        {{--                                                --}}{{--        if getting pic from database--}}

                                        {{--                                                <img class="img-responsive  img-thumbnail"--}}
                                        {{--                                                     style="height: 120px; width: 120px"--}}
                                        {{--                                                     src="{{asset('/backend/images/member/profile/'.$memberDataVar->image)}}">--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </td>--}}

                                        {{--   https://www.simplesoftware.io/#/docs/simple-qrcode--}}
                                        {{--                               <td>{!! QrCode::generate($memberDataVar->id); !!}--}}

                                        <td>{{$memberDataVar->member_name}}</td>
                                        <td>{{$memberDataVar->member_phone}}</td>
                                        <td>{{$memberDataVar->member_fee_end_date}}</td>
{{--                                    <!--<td>{{$memberDataVar->member_blood_group}}</td>-->--}}
{{--                                    <!--<td>{{$memberDataVar->member_shift}}</td>-->--}}
{{--                                        <td>--}}
{{--                                            --}}{{-- getting data from package table to compare with member selected package--}}
{{--                                            @foreach($packageData as $packageDataVar)--}}

{{--                                                @if($memberDataVar->member_package == $packageDataVar->id)--}}
{{--                                                    {{$packageDataVar->package_amount}}--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}

{{--                                            <br><br>--}}

{{--                                            @if($memberDataVar->trainer != null)--}}
{{--                                                --}}{{-- getting data from employee table to for personal training check --}}
{{--                                                {{"Personal trainer"}}--}}
{{--                                                <br>--}}
{{--                                                <span style="color: red">{{$memberDataVar->trainer}}</span>--}}
{{--                                                <br>--}}
{{--                                                <span>  {{$memberDataVar->trainer_fee}}</span>--}}


{{--                                            @endif--}}
{{--                                        </td>--}}


                                        <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->type == "owner")

                                                <a href="{{route('editMember',['id'=>$memberDataVar->id])}}"
                                                   class="action-icon"> <i class="mdi mdi-pencil"></i></a></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- end row-->

@endsection
