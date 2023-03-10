@extends('layouts.backend-layout')

@section('title')
    Create Gym
@endsection

@section('breadcrumb')
    Create Gym
@endsection

@section('content')


    @if(session()->has('success'))

        <div class="alert alert-success" role="alert">
            <strong>Success - </strong> {{session('success')}}

        </div>
    @endif

    <form method="post" action="{{ route('createGym')}}" autocomplete="off"
          enctype="multipart/form-data">
        @csrf

        <label class="form-label">Gym Id:</label>

        <input class="form-control" type="text" readonly value="{{$id+1}}" name="gym_id">
        <br>

        {{--                            <input class="form-control" type="text" readonly value="1" name="gym_id">--}}

        <div class="mb-3">
            <label class="form-label">Gym Name</label>
            <input class="form-control" type="text" required=""
                   placeholder="Enter  Gym Name" name="gym_name">
        </div>

        <div class="mb-3">
            <label class="form-label">Gym Logo</label>
            <input class="form-control" type="file"
                   placeholder="Gym Logo" name="gym_logo">
        </div>

        <label class="form-label">Gender</label>


        <div class="mb-3">
            <label class="form-label">Gym package</label>
            <select class="form-select mb-3" name="gym_package" required>
                <option selected value="">Select package</option>
                <option value="free">Free</option>
                <option value="paid">Paid</option>

            </select>

        </div>
        <div class="mb-3">
            <label class="form-label">Package start</label>
            <input class="form-control" type="date"
                   placeholder="Gym package start date" name="gym_package_start_date">
        </div>
        <div class="mb-3">
            <label class="form-label">Package end</label>
            <input class="form-control" type="date"
                   placeholder="Gym package end date" name="gym_package_end_date">
        </div>
        <div class="mb-3">
            <label class="form-label">Gym City</label>
            <select class="form-select mb-3" name="gym_city" required>
                <option selected value="">Select city</option>
                <option value="lahore">Lahore</option>

            </select>

            <input type="text" name="gym_title" hidden>
            <input type="text" name="gym_slug" hidden>
        </div>
        <div class="mb-3">
            <label class="form-label">Gym Area</label>
            <select class="form-select mb-3" name="gym_area" required>
                <option selected value="">Select Area</option>
                <option value="garhiShahu">Garhi Shahu</option>
            </select>
        </div>
        <hr>
        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center mt-0 fw-bold">User Data</h4>
        </div>
        <hr>
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input class="form-control" type="text" required=""
                   placeholder="Enter your User Name" name="name">
        </div>

        {{--                            <div class="mb-3">--}}
        {{--                                <label class="form-label">Email</label>--}}
        {{--                                <input class="form-control" type="email" required=""--}}
        {{--                                       placeholder="User email" name="email">--}}
        {{--                            </div>--}}

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input class="form-control" type="number" required=""
                   placeholder="User phone" name="phone">
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input class="form-control" type="password"
                   placeholder="User password" name="password">
        </div>


        <div class="mb-3">
            <label class="form-label">Type</label>
            <input class="form-control" type="text"
                   placeholder="User Type" name="type" value="owner" readonly>
        </div>

        <input name="belong_to_gym" hidden>

        <hr>
        <div class="mb-3 mb-0 text-center">
            <button class="btn btn-primary" type="submit"> Sign Up</button>
        </div>

    </form>


@endsection
