@extends('admin.layouts.index')

@section('title', 'Data Profile')

@section('main')
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                aria-selected="false">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="row">
                                <div class="col-md-4 col-6 b-r">
                                    <strong>Nama</strong>
                                    <br>
                                    <p class="text-muted">{{ $admin->nama }}</p>
                                </div>
                                <div class="col-md-4 col-6 b-r">
                                    <strong>Username</strong>
                                    <br>
                                    <p class="text-muted">{{ $admin->username }}</p>
                                </div>
                                <div class="col-md-4 col-6">
                                    <strong>Tanggal Akun Dibuat</strong>
                                    <br>
                                    <p class="text-muted">{{ $admin->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                            <form method="post" action="{{ route('admin.profile.update') }}" class="needs-validation">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama"
                                                value="{{ $admin->nama }}" required>
                                            <div class="invalid-feedback">
                                                Please fill in the name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ $admin->username }}" required>
                                            <div class="invalid-feedback">
                                                Please fill in the username
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password">
                                            <div class="invalid-feedback">
                                                Please fill in the password
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                            <div class="invalid-feedback">
                                                Please confirm the password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/sweetalert/sweetalert.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                console.log('Success session: {{ session('success') }}');
                swal({
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    icon: 'success',
                }).then((value) => {
                    window.location = '{{ route('admin.profile.index') }}';
                });
            @endif

            @if (session('error'))
                console.log('Error session: {{ session('error') }}');
                swal({
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    icon: 'error',
                }).then((value) => {
                    window.location = '{{ route('admin.profile.index') }}';
                });
            @endif
        });
    </script>
@endsection
