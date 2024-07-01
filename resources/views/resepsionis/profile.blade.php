@extends('resepsionis.layouts.index')

@section('title', 'Data Profile')

@section('main')
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ session('errors') ? '' : 'active' }}" id="home-tab2" data-toggle="tab"
                                href="#about" role="tab" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ session('errors') ? 'active' : '' }}" id="profile-tab2" data-toggle="tab"
                                href="#settings" role="tab" aria-selected="false">Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <div class="tab-pane fade {{ session('errors') ? '' : 'show active' }}" id="about"
                            role="tabpanel" aria-labelledby="home-tab2">
                            <div class="row">
                                <div class="col-md-4 col-6 b-r">
                                    <strong>Nama</strong>
                                    <br>
                                    <p class="text-muted">{{ $resepsionis->nama }}</p>
                                </div>
                                <div class="col-md-4 col-6 b-r">
                                    <strong>Jenis Kelamin</strong>
                                    <br>
                                    <p class="text-muted">{{ $resepsionis->jenis_kelamin }}</p>
                                </div>
                                <div class="col-md-4 col-6">
                                    <strong>No HP</strong>
                                    <br>
                                    <p class="text-muted">{{ $resepsionis->no_hp }}</p>
                                </div>
                                <div class="col-md-4 col-6">
                                    <strong>Alamat</strong>
                                    <br>
                                    <p class="text-muted">{{ $resepsionis->alamat }}</p>
                                </div>
                                <div class="col-md-4 col-6 b-r">
                                    <strong>Username</strong>
                                    <br>
                                    <p class="text-muted">{{ $user->username }}</p>
                                </div>
                                <div class="col-md-4 col-6">
                                    <strong>Tanggal Akun Dibuat</strong>
                                    <br>
                                    <p class="text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ session('errors') ? 'show active' : '' }}" id="settings"
                            role="tabpanel" aria-labelledby="profile-tab2">
                            <form method="post" action="{{ route('resepsionis.profile.update') }}"
                                class="needs-validation" id="profileForm">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                name="nama" value="{{ old('nama', $resepsionis->nama) }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>No HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                name="no_hp" value="{{ old('no_hp', $resepsionis->no_hp) }}" required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" id="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                name="alamat" value="{{ old('alamat', $resepsionis->alamat) }}" required>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary" id="saveButton">Save Changes</button>
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
@endsection

@section('js')
    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                swal('Berhasil', '{{ session('success') }}', 'success');
            @endif

            @if (session('error'))
                swal('Gagal', '{{ session('error') }}', 'error');
            @endif

            // Custom validation for password and confirm password
            document.getElementById('profileForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const form = event.target;
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;

                if ((password && !passwordConfirmation) || (!password && passwordConfirmation)) {
                    swal('Gagal', 'Password dan Confirm Password harus diisi bersamaan.', 'error');
                    return;
                }

                const formData = new FormData(form);
                const url = form.action;
                const method = form.method;

                fetch(url, {
                        method: method,
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            swal('Berhasil', data.message, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal('Gagal', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal('Gagal', 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                    });
            });
        });
    </script>
@endsection
