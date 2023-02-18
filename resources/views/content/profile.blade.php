@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <form id="notebook">
                                <div class="card-header">
                                    <h4>Notebook</h4>
                                </div>
                                <div class="card-body">
                                    <textarea id="note" class="form-control summernote-simple" name="note">{!! auth()->user()->note !!}</textarea>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card profile-widget">
                            <form
                                method="POST"
                                action="{{ route('profile.update', ['profile' => auth()->user()->id_user]) }}"
                                enctype="multipart/form-data"
                                class="needs-validation">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="section" value="profile">
                                <div class="d-flex justify-content-between">
                                    <div class="card-header">
                                        <h4>Edit Profile</h4>
                                    </div>
                                    <div class="mr-5 pr-4 photo-profile">
                                        @if (auth()->user()->profile)
                                        <img alt="image" src="{{ asset('storage/' . auth()->user()->profile) }}" class="rounded-circle profile-widget-picture position-relative change-photo" width='100' height='100'>
                                        @else
                                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture position-relative change-photo" width='100' height='100'>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="nickname">Nickname</label>
                                            <input
                                                id="nickname"
                                                name="nickname"
                                                type="text"
                                                class="form-control"
                                                value="{{ auth()->user()->nickname }}"
                                                required>
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                        <div class="form-group col-2">
                                            <label for="profile">Change Photo</label>
                                            <button class="form-control shadow-none border-1 change-photo"><i class="fas fa-pen"></i></button>
                                            <input
                                                id="profile"
                                                name="profile"
                                                type="file"
                                                hidden>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label for="email">Email</label>
                                            <input
                                                id="email"
                                                type="email"
                                                name="email"
                                                class="form-control"
                                                value="{{ auth()->user()->email }}"
                                                required>
                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label for="username">Username</label>
                                            <input
                                                id="username"
                                                type="text"
                                                name="username"
                                                class="form-control"
                                                value="{{ auth()->user()->username }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bio</label>
                                            <textarea class="form-control summernote-simple" name="bio">{!! auth()->user()->bio !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-danger btn-delete my-2" value="{{auth()->user()->id_user}}">
                                        Delete Account
                                    </button>
                                    <a href="{{route('profile.reset')}}" type="button" class="btn btn-warning mx-2">Reset Password</a>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    <script>
        var display;
        var storedFiles = [];

        function handleFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            filesArr.forEach(function(f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html =
                        '<img src="' +
                        e.target.result +
                        "\" data-file='" +
                        f.name +
                        "' class='rounded-circle profile-widget-picture position-relative change-photo' alt='Image' width='100' height='100'>";
                    display.html(html);
                };
                reader.readAsDataURL(f);
            });
        }

        $(document).ready(function () {
            $('.change-photo').click(function (e) {
                e.preventDefault();
                $('#profile').trigger('click');
            });

            /**
             * Set Preview
             * @return void
             */
            $("#profile").on("change", handleFileSelect)
            display = $(".photo-profile")

            /**
             * Set Notebook
             * @return void
             */
            $('#notebook').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{ route('profile.update', ['profile' => auth()->user()->id_user]) }}",
                    data: {
                        '_method': 'PUT',
                        '_token': token,
                        'section': 'notebook',
                        'note': $("textarea[name='note']").val()
                    },
                    success: function (response) {
                        let setup = {
                            position: 'topCenter',
                            layout: '2',
                            title: response['title'],
                            message: response['message'],
                        }

                        if (response['type'] == 'success') {
                            iziToast.success(setup);
                        } else {
                            iziToast.error(setup);
                        }
                    }
                });
            });

            /**
             * Delete User
             * @return void
             */
            $('.btn-delete').click(function (e) {
                $('.confirmation-title').html('Delete Account');
                $('.confirmation-body').html('Are you sure to delete this account?');
                $('#confirmation').modal('show')
                $('.confirmation').click(function() {
                    if (Boolean($(this).val())) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('profile.destroy', ['profile' => auth()->user()->id_user]) }}",
                            data: {
                                '_method': 'DELETE',
                                '_token': token
                            },
                            success: function (response) {
                                let setup = {
                                    position: 'topCenter',
                                    layout: '2',
                                    title: response['title'],
                                    message: response['message'],
                                }

                                if (response['type'] == 'success') {
                                    iziToast.success(setup);
                                } else {
                                    iziToast.error(setup);
                                }
                            }
                        })
                        $('#confirmation').modal('hide')
                    } else {
                        $('#confirmation').modal('hide')
                    }
                })
            });
        });
    </script>
    <!-- Page Specific JS File -->
@endpush
