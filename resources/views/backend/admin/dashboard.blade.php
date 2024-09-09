@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')


    <div class="container-fluid">

        <!-- breadcrumb -->

        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Notifications</span>

                </div>

            </div>

        </div>

        <!-- breadcrumb -->

        <!-- row -->

        <form class="form-horizontal needs-validation" method="post" action="{{ route('send_notification') }}" enctype="multipart/form-data" id="sendNotification">
            @csrf
            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card box-shadow-0">
                        <div class="card-header">
                            <h4 class="card-title mb-1">Select Notification Type</h4>
                        </div>
                        <div class="card-body pt-0">

                            <div class="row mg-t-10">
                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <label class="rdiobox">
                                        <input checked name="type" type="radio" value="all"> <span>All User</span>
                                    </label>
                                </div>
                                <div class="col-lg-2">
                                    <label class="rdiobox">
                                        <input name="type" type="radio" value="android_user"> <span>Android User</span>
                                    </label>
                                </div>
                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <label class="rdiobox">
                                        <input name="type" type="radio" value="ios_user"> <span>IOS User</span>
                                    </label>
                                </div>

                                <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                    <label class="rdiobox">
                                        <input name="type" type="radio" value="web_user"> <span>Web User</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card box-shadow-0">
                        <div class="card-header">
                            <h4 class="card-title mb-1">Send NOTIFICATION</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <p class="mg-b-10">Title</p>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-2">
                                <p class="mg-b-10">Body</p>
                                <input type="text" class="form-control" name="body" id="body" placeholder="Body">
                            </div>
                            <div class="form-group mb-0 mt-2">
                                <p class="mg-b-10">Image</p>
                                <input type="file" class="dropify" name="image" data-height="100" id="image">
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-danger" >Send Notification</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('script')

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.select2').select2({--}}
{{--                minimumInputLength: 1,--}}
{{--                allowClear: true,--}}
{{--                multiple: true,--}}
{{--                placeholder: function(){--}}
{{--                    $(this).data('placeholder');--}}
{{--                }--}}

{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            // Initially hide the individual user selection div--}}
{{--            $('#individual_user_select_box').hide();--}}

{{--            // When the user selection dropdown changes--}}
{{--            $('#user_select').on('change', function() {--}}
{{--                var selectedValue = $(this).val();--}}

{{--                if (selectedValue == 'individual_user_select') {--}}
{{--                    $('#individual_user_select_box').show();--}}
{{--                }--}}
{{--                else {--}}
{{--                    $('#individual_user_select_box').hide();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}



{{--<script>--}}
{{--    function validateForm() {--}}
{{--        let isValid = true;--}}

{{--        // Clear previous error messages--}}
{{--        document.getElementById('typeError').textContent = '';--}}
{{--        document.getElementById('individualUserError').textContent = '';--}}
{{--        document.getElementById('titleError').textContent = '';--}}
{{--        document.getElementById('bodyError').textContent = '';--}}
{{--        document.getElementById('imageError').textContent = '';--}}

{{--        // Validate type--}}
{{--        const type = document.getElementById('user_select').value;--}}
{{--        if (type === '') {--}}
{{--            document.getElementById('typeError').textContent = 'The user selection is required.';--}}
{{--            isValid = false;--}}
{{--        }--}}

{{--        // Validate individual user if selected--}}
{{--        if (type === 'individual_user_select') {--}}
{{--            const individualUser = document.querySelector('select[name="individual_user[]"]').value;--}}
{{--            if (individualUser === '') {--}}
{{--                document.getElementById('individualUserError').textContent = 'Please select at least one individual user.';--}}
{{--                isValid = false;--}}
{{--            }--}}
{{--        }--}}

{{--        // Validate title--}}
{{--        const title = document.getElementById('title').value.trim();--}}
{{--        if (title === '') {--}}
{{--            document.getElementById('titleError').textContent = 'The title field is required.';--}}
{{--            isValid = false;--}}
{{--        }--}}

{{--        // Validate body--}}
{{--        const body = document.getElementById('body').value.trim();--}}
{{--        if (body === '') {--}}
{{--            document.getElementById('bodyError').textContent = 'The body field is required.';--}}
{{--            isValid = false;--}}
{{--        }--}}

{{--        // Validate image (optional check for required or specific validation)--}}
{{--        const image = document.getElementById('image').files[0];--}}
{{--        if (image) {--}}
{{--            const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];--}}
{{--            const maxSize = 2 * 1024 * 1024; // 2MB size limit--}}

{{--            if (!allowedExtensions.includes(image.type)) {--}}
{{--                document.getElementById('imageError').textContent = 'Only JPEG, PNG, JPG, or GIF files are allowed.';--}}
{{--                isValid = false;--}}
{{--            } else if (image.size > maxSize) {--}}
{{--                document.getElementById('imageError').textContent = 'The image size must be less than 2MB.';--}}
{{--                isValid = false;--}}
{{--            }--}}
{{--        }--}}

{{--        // Prevent form submission if not valid--}}
{{--        return isValid;--}}
{{--    }--}}
{{--</script>--}}



<!-- Javascript Requirements -->
<script src="{{asset('js-validation/jquery.min.js')}}"></script>
<script src="{{asset('js-validation/bootstrap.min.js')}}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\web\admin\SendNotificationRequest', '#sendNotification'); !!}

@endsection

