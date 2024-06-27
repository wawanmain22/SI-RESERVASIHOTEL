@extends('admin.layouts.index')

@section('title', 'Data Kamar')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Kamar</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addKamarModal">
                        Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">Index</th>
                                    <th>Nomor Kamar</th>
                                    <th>Jenis Kamar</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamars as $index => $kamar)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $kamar->nomor_kamar }}</td>
                                        <td>{{ $kamar->jenisKamar->nama }}</td>
                                        <td>{{ formatRupiah($kamar->harga) }}</td>
                                        <td>{{ $kamar->status }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-info" data-toggle="modal"
                                                data-target="#detailKamarModal"
                                                data-nomor_kamar="{{ $kamar->nomor_kamar }}"><i
                                                    class="fas fa-info-circle"></i></a>
                                            <a href="#" class="btn btn-icon btn-primary" data-toggle="modal"
                                                data-target="#editKamarModal"
                                                data-nomor_kamar="{{ $kamar->nomor_kamar }}"><i class="far fa-edit"></i></a>
                                            <a href="#" class="btn btn-icon btn-danger"
                                                data-nomor_kamar="{{ $kamar->nomor_kamar }}"
                                                data-action="{{ route('admin.kamar.destroy', $kamar->nomor_kamar) }}"><i
                                                    class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal for adding kamar -->
    <div class="modal fade" id="addKamarModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Data Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addKamarForm" action="{{ route('admin.kamar.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Jenis Kamar</label>
                            <select class="form-control" name="id_jeniskamar" id="addIdJenisKamar" required>
                                <option value="" disabled selected>Pilih Jenis Kamar</option>
                                @foreach ($jenisKamars as $jenisKamar)
                                    <option value="{{ $jenisKamar->id }}">{{ $jenisKamar->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Kamar</label>
                            <input type="text" class="form-control" placeholder="Nomor Kamar" name="nomor_kamar"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" placeholder="Harga" name="harga" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing kamar -->
    <div class="modal fade" id="editKamarModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Data Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editKamarForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Jenis Kamar</label>
                            <select class="form-control" name="id_jeniskamar" id="editIdJenisKamar" required>
                                <option value="" disabled>Pilih Jenis Kamar</option>
                                @foreach ($jenisKamars as $jenisKamar)
                                    <option value="{{ $jenisKamar->id }}">{{ $jenisKamar->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Kamar</label>
                            <input type="text" class="form-control" placeholder="Nomor Kamar" name="nomor_kamar"
                                id="editNomorKamar" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" class="form-control" placeholder="Harga" name="harga"
                                id="editHarga" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for detail kamar -->
    <div class="modal fade" id="detailKamarModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Detail Data Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Jenis Kamar</label>
                            <input type="text" class="form-control" id="detailIdJenisKamar" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nomor Kamar</label>
                            <input type="text" class="form-control" id="detailNomorKamar" readonly>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" id="detailHarga" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" id="detailStatus" readonly>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <!-- Prism CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">
@endsection

@section('js')
    <!-- DataTables JS -->
    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Prism JS -->
    <script src="{{ asset('assets/bundles/prism/prism.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
@endsection

@section('script')
    <!-- DataTables Initialization -->
    <script src="{{ asset('assets/js/page/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();

            // Handle add kamar form submission
            $('#addKamarForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            swal("Berhasil", "Data berhasil ditambahkan", "success").then(
                                () => {
                                    location.reload();
                                });
                        } else {
                            swal("Error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        swal("Error", errorMessage, "error");
                    }
                });
            });

            // Handle edit button click
            $('#editKamarModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let nomor_kamar = button.data('nomor_kamar');

                $.get('/kamar/' + nomor_kamar, function(data) {
                    $('#editKamarForm').attr('action', '/kamar/' + nomor_kamar);
                    $('#editIdJenisKamar').val(data.id_jeniskamar);
                    $('#editNomorKamar').val(data.nomor_kamar);
                    $('#editHarga').val(data.harga);
                });
            });

            // Handle edit kamar form submission
            $('#editKamarForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'PUT',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            swal("Berhasil", "Data berhasil diperbarui", "success").then(() => {
                                location.reload();
                            });
                        } else {
                            swal("Error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let key in errors) {
                            errorMessage += errors[key][0] + '\n';
                        }
                        swal("Error", errorMessage, "error");
                    }
                });
            });

            // Handle delete button click
            $('.btn-danger').on('click', function() {
                let nomor_kamar = $(this).data('nomor_kamar');
                let action = $(this).data('action');

                swal({
                    title: "Penghapusan Data",
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: action,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    swal("Berhasil", "Data berhasil dihapus", "success")
                                        .then(() => {
                                            location.reload();
                                        });
                                } else {
                                    swal("Error", response.message, "error");
                                }
                            }
                        });
                    }
                });
            });

            // Handle detail button click
            $('#detailKamarModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let nomor_kamar = button.data('nomor_kamar');

                $.get('/kamar/' + nomor_kamar, function(data) {
                    $('#detailIdJenisKamar').val(data.jenis_kamar ? data.jenis_kamar.nama : 'N/A');
                    $('#detailNomorKamar').val(data.nomor_kamar);
                    $('#detailHarga').val(formatRupiah(data.harga));
                    $('#detailStatus').val(data.status);
                }).fail(function() {
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });

            function formatRupiah(angka) {
                var numberString = angka.toString(),
                    sisa = numberString.length % 3,
                    rupiah = numberString.substr(0, sisa),
                    ribuan = numberString.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return 'Rp' + rupiah;
            }
        });
    </script>
@endsection
