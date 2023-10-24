@extends('layouts.backend-layout')

@section('title')
    Add Message
@endsection

@section('breadcrumb')
    Add Message
@endsection

@section('content')
    @if($getData)
        <h6>You have to wait for next month.</h6>
    @else
        <form method="post" action="{{ route('createMessage') }}" enctype="multipart/form-data"
              class="needs-validation"
              novalidate autocomplete="off">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    <strong>Success -</strong> {{ session('success') }}
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
            @csrf
            <div class="mb-3">
                <label class="form-label" for="validationCustom01">Send to</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Enter title"
                       name="send_to" value="All Members" readonly>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter title.
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="validationCustom03">Schedule Period</label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="Enter schedule period"
                       name="schedule_period" value="Monthly" readonly>

                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter schedule period.
                </div>
            </div>
            <hr/>
            <h6>For Text Message</h6>

            <div class="mb-3">
                <label class="form-label" for="validationCustom02">Test Message</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Enter text message"
                       name="text_message" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter text message.
                </div>
            </div>
            <hr/>
            <h6>For Image Message</h6>

            <div class="mb-3">
                <label class="form-label" for="validationCustom02">Image Message</label>
                <input type="file" class="form-control" id="validationCustom02" placeholder="Enter image message"
                       name="message_url">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter image message.
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="validationCustom02">Image Caption</label>
                <input type="text" class="form-control" id="validationCustom02"
                       placeholder="Enter image message caption"
                       name="message_caption">
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter image message caption.
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Schedule Now</button>
        </form>
    @endif
@endsection
