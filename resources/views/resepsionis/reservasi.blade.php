@extends('resepsionis.layouts.index')

@section('title', 'Data Reservasi')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Reservasi</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addReservasiModal">
                        Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">Index</th>
                                    <th>Kode Reservasi</th>
                                    <th>Status</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservasis as $index => $reservasi)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $reservasi->kode_reservasi }}</td>
                                        <td>{{ $reservasi->status }}</td>
                                        <td>{{ $reservasi->tgl_checkin }}</td>
                                        <td>{{ $reservasi->tgl_checkout }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-info" data-toggle="modal"
                                                data-target="#detailReservasiModal"
                                                data-kode_reservasi="{{ $reservasi->kode_reservasi }}"><i
                                                    class="fas fa-info-circle"></i></a>
                                            @if ($reservasi->status == 'Booked')
                                                <a href="#" class="btn btn-icon btn-primary" data-toggle="modal"
                                                    data-target="#editReservasiModal"
                                                    data-kode_reservasi="{{ $reservasi->kode_reservasi }}"><i
                                                        class="far fa-edit"></i></a>
                                                <a href="#" class="btn btn-icon btn-danger"
                                                    data-kode_reservasi="{{ $reservasi->kode_reservasi }}"
                                                    data-action="{{ route('resepsionis.reservasi-resepsionis.destroy', $reservasi->kode_reservasi) }}"><i
                                                        class="fas fa-times"></i></a>
                                                <a href="#" class="btn btn-icon btn-success" data-toggle="modal"
                                                    data-target="#konfirmasiCheckinModal"
                                                    data-kode_reservasi="{{ $reservasi->kode_reservasi }}"><i
                                                        class="fas fa-check"></i></a>
                                            @elseif ($reservasi->status == 'Checkin')
                                                <a href="#" class="btn btn-icon btn-warning" data-toggle="modal"
                                                    data-target="#konfirmasiCheckoutModal"
                                                    data-kode_reservasi="{{ $reservasi->kode_reservasi }}"><i
                                                        class="fas fa-door-open"></i></a>
                                            @endif
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
    <!-- Modal for adding reservasi -->
    <div class="modal fade" id="addReservasiModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Data Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addReservasiForm" action="{{ route('resepsionis.reservasi-resepsionis.store') }}"
                        method="POST">
                        @csrf
                        <div id="pelangganContainer">
                            <div class="pelanggan-item">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" class="form-control" name="pelanggans[0][nama]" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="pelanggans[0][jenis_kelamin]" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" class="form-control" name="pelanggans[0][no_hp]" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="pelanggans[0][alamat]" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="pelanggans[0][email]">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addPelangganButton" class="btn btn-secondary"><i class="fas fa-plus"></i>
                            Tambah Pelanggan</button>
                        <button type="button" id="removePelangganButton" class="btn btn-secondary" disabled><i
                                class="fas fa-minus"></i> Hapus Pelanggan</button>
                        <div class="form-group mt-3">
                            <label>Kamar</label>
                            <div class="multiple-select-container">
                                <div class="row">
                                    @foreach ($kamars as $kamar)
                                        <div class="col-md-2 col-sm-3 col-4">
                                            <div class="form-check">
                                                <input class="form-check-input kamar-checkbox" type="checkbox"
                                                    name="kamars[]" value="{{ $kamar->id }}"
                                                    id="kamar{{ $kamar->id }}">
                                                <label class="form-check-label" for="kamar{{ $kamar->id }}">
                                                    {{ $kamar->nomor_kamar }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Tanggal Check-in</label>
                            <input type="date" class="form-control" name="tgl_checkin" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-out</label>
                            <input type="date" class="form-control" name="tgl_checkout" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing reservasi -->
    <div class="modal fade" id="editReservasiModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Reschedule Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editReservasiForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Check-in</label>
                            <input type="date" class="form-control" name="tgl_checkin" id="editTglCheckin" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-out</label>
                            <input type="date" class="form-control" name="tgl_checkout" id="editTglCheckout"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for detail reservasi -->
    <div class="modal fade" id="detailReservasiModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Detail Data Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Kode Reservasi</label>
                            <input type="text" class="form-control" id="detailKodeReservasi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" id="detailStatus" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-in</label>
                            <input type="date" class="form-control" id="detailTglCheckin" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-out</label>
                            <input type="date" class="form-control" id="detailTglCheckout" readonly>
                        </div>
                        <div class="form-group">
                            <label>Data Pelanggan</label>
                            <div class="scrollable-container" id="detailPelangganContainer"></div>
                        </div>
                        <div class="form-group">
                            <label>Data Kamar</label>
                            <div class="scrollable-container" id="detailKamarContainer"></div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for konfirmasi checkin reservasi -->
    <div class="modal fade" id="konfirmasiCheckinModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Konfirmasi Checkin Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Kode Reservasi</label>
                            <input type="text" class="form-control" id="konfirmasiKodeReservasi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-in</label>
                            <input type="date" class="form-control" id="konfirmasiTglCheckin" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Check-out</label>
                            <input type="date" class="form-control" id="konfirmasiTglCheckout" readonly>
                        </div>
                        <div class="form-group">
                            <label>Data Pelanggan</label>
                            <div class="scrollable-container" id="konfirmasiPelangganContainer"></div>
                        </div>
                        <div class="form-group">
                            <label>Data Kamar</label>
                            <div class="scrollable-container" id="konfirmasiKamarContainer"></div>
                        </div>
                        <div class="form-group">
                            <label>Total Biaya</label>
                            <input type="text" class="form-control" id="konfirmasiTotalBiaya" readonly>
                        </div>
                        <button type="button" id="konfirmasiSudahBayarButton" class="btn btn-success">Sudah
                            Bayar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for konfirmasi checkout reservasi -->
    <div class="modal fade" id="konfirmasiCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Konfirmasi Checkout Reservasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Kode Reservasi</label>
                            <input type="text" class="form-control" id="konfirmasiCheckoutKodeReservasi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Data Pelanggan</label>
                            <div class="scrollable-container" id="konfirmasiCheckoutPelangganContainer"></div>
                        </div>
                        <div class="form-group">
                            <label>Data Kamar</label>
                            <div class="scrollable-container" id="konfirmasiCheckoutKamarContainer"></div>
                        </div>
                        <button type="button" id="konfirmasiCheckoutButton" class="btn btn-success">Ya</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
    <!-- Custom CSS for scrollable container -->
    <style>
        .scrollable-container {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
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

            let pelangganIndex = 1;

            $('#addPelangganButton').on('click', function() {
                $('#pelangganContainer').append(`
                    <div class="pelanggan-item">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" name="pelanggans[${pelangganIndex}][nama]" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="pelanggans[${pelangganIndex}][jenis_kelamin]" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" class="form-control" name="pelanggans[${pelangganIndex}][no_hp]" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="pelanggans[${pelangganIndex}][alamat]" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="pelanggans[${pelangganIndex}][email]">
                        </div>
                    </div>
                `);
                pelangganIndex++;
                updateRemoveButtonState('pelanggan');
            });

            $('#removePelangganButton').on('click', function() {
                if ($('.pelanggan-item').length > 1) {
                    $('.pelanggan-item').last().remove();
                    pelangganIndex--;
                    updateRemoveButtonState('pelanggan');
                }
            });

            function updateRemoveButtonState(type) {
                if (type === 'pelanggan') {
                    if ($('.pelanggan-item').length <= 1) {
                        $('#removePelangganButton').prop('disabled', true);
                    } else {
                        $('#removePelangganButton').prop('disabled', false);
                    }
                }
            }

            updateRemoveButtonState('pelanggan');

            // Handle add reservasi form submission
            $('#addReservasiForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Success:', response);
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
                        console.log('Error:', xhr.responseText);
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
            $('#editReservasiModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let kode_reservasi = button.data('kode_reservasi');

                $.get('{{ url('reservasi-resepsionis') }}/' + kode_reservasi, function(data) {
                    $('#editReservasiForm').attr('action', '{{ url('reservasi-resepsionis') }}/' +
                        kode_reservasi + '/update');
                    $('#editTglCheckin').val(data.tgl_checkin);
                    $('#editTglCheckout').val(data.tgl_checkout);
                });
            });

            // Handle edit reservasi form submission
            $('#editReservasiForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Success:', response);
                        if (response.success) {
                            swal("Berhasil", "Data berhasil diperbarui", "success").then(() => {
                                location.reload();
                            });
                        } else {
                            swal("Error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
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
                let kode_reservasi = $(this).data('kode_reservasi');
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
                            type: 'POST',
                            url: action,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                console.log('Success:', response);
                                if (response.success) {
                                    swal("Berhasil", "Data berhasil dihapus", "success")
                                        .then(() => {
                                            location.reload();
                                        });
                                } else {
                                    swal("Error", response.message, "error");
                                }
                            },
                            error: function(xhr) {
                                console.log('Error:', xhr.responseText);
                                swal("Error", "Terjadi kesalahan saat menghapus data",
                                    "error");
                            }
                        });
                    }
                });
            });

            // Handle detail button click
            $('#detailReservasiModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let kode_reservasi = button.data('kode_reservasi');

                $.get('{{ url('reservasi-resepsionis') }}/' + kode_reservasi, function(data) {
                    console.log('Detail Data:', data); // Log detail data for debugging

                    $('#detailKodeReservasi').val(data.kode_reservasi);
                    $('#detailStatus').val(data.status);
                    $('#detailTglCheckin').val(data.tgl_checkin);
                    $('#detailTglCheckout').val(data.tgl_checkout);

                    let pelangganData = '';
                    if (data.reservasi_pelanggan && data.reservasi_pelanggan.length > 0) {
                        data.reservasi_pelanggan.forEach(function(reservasiPelanggan) {
                            pelangganData += `
                    <div class="pelanggan-item">
                        <p><strong>Nama:</strong> ${reservasiPelanggan.pelanggan.nama}</p>
                        <p><strong>Jenis Kelamin:</strong> ${reservasiPelanggan.pelanggan.jenis_kelamin}</p>
                        <p><strong>No HP:</strong> ${reservasiPelanggan.pelanggan.no_hp}</p>
                        <p><strong>Alamat:</strong> ${reservasiPelanggan.pelanggan.alamat}</p>
                        <p><strong>Email:</strong> ${reservasiPelanggan.pelanggan.email}</p>
                    </div>
                `;
                        });
                    } else {
                        pelangganData = 'Data tidak tersedia';
                    }
                    $('#detailPelangganContainer').html(pelangganData);

                    let kamarData = '';
                    if (data.reservasi_kamar && data.reservasi_kamar.length > 0) {
                        data.reservasi_kamar.forEach(function(reservasiKamar) {
                            kamarData += `
                    <div class="kamar-item">
                        <p><strong>Jenis Kamar:</strong> ${reservasiKamar.kamar.jenis_kamar.nama}</p>
                        <p><strong>Nomor Kamar:</strong> ${reservasiKamar.kamar.nomor_kamar}</p>
                        <p><strong>Harga:</strong> ${reservasiKamar.kamar.formatted_harga}</p>
                    </div>
                `;
                        });
                    } else {
                        kamarData = 'Data tidak tersedia';
                    }
                    $('#detailKamarContainer').html(kamarData);
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText); // Log error response for debugging
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });

            // Handle konfirmasi checkin button click
            $('#konfirmasiCheckinModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let kode_reservasi = button.data('kode_reservasi');

                $.get('{{ url('reservasi-resepsionis') }}/' + kode_reservasi, function(data) {
                    console.log('Detail Data:', data); // Log detail data for debugging

                    $('#konfirmasiKodeReservasi').val(data.kode_reservasi);
                    $('#konfirmasiTglCheckin').val(data.tgl_checkin);
                    $('#konfirmasiTglCheckout').val(data.tgl_checkout);

                    let pelangganData = '';
                    if (data.reservasi_pelanggan && data.reservasi_pelanggan.length > 0) {
                        data.reservasi_pelanggan.forEach(function(reservasiPelanggan) {
                            pelangganData += `
                    <div class="pelanggan-item">
                        <p><strong>Nama:</strong> ${reservasiPelanggan.pelanggan.nama}</p>
                        <p><strong>Jenis Kelamin:</strong> ${reservasiPelanggan.pelanggan.jenis_kelamin}</p>
                        <p><strong>No HP:</strong> ${reservasiPelanggan.pelanggan.no_hp}</p>
                        <p><strong>Alamat:</strong> ${reservasiPelanggan.pelanggan.alamat}</p>
                        <p><strong>Email:</strong> ${reservasiPelanggan.pelanggan.email}</p>
                    </div>
                `;
                        });
                    } else {
                        pelangganData = 'Data tidak tersedia';
                    }
                    $('#konfirmasiPelangganContainer').html(pelangganData);

                    let kamarData = '';
                    let totalBiaya = 0;
                    if (data.reservasi_kamar && data.reservasi_kamar.length > 0) {
                        data.reservasi_kamar.forEach(function(reservasiKamar) {
                            totalBiaya += parseFloat(reservasiKamar.kamar.harga);
                            kamarData += `
                    <div class="kamar-item">
                        <p><strong>Jenis Kamar:</strong> ${reservasiKamar.kamar.jenis_kamar.nama}</p>
                        <p><strong>Nomor Kamar:</strong> ${reservasiKamar.kamar.nomor_kamar}</p>
                        <p><strong>Harga:</strong> ${reservasiKamar.kamar.formatted_harga}</p>
                    </div>
                `;
                        });
                    } else {
                        kamarData = 'Data tidak tersedia';
                    }
                    $('#konfirmasiKamarContainer').html(kamarData);
                    $('#konfirmasiTotalBiaya').val(formatRupiah(totalBiaya));
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText); // Log error response for debugging
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });

            $('#konfirmasiSudahBayarButton').on('click', function() {
                let kode_reservasi = $('#konfirmasiKodeReservasi').val();

                $.post('{{ url('reservasi-resepsionis/konfirmasi-checkin') }}/' + kode_reservasi, {
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    console.log('Success:', response);
                    if (response.success) {
                        swal("Berhasil", "Reservasi telah dikonfirmasi", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Error", response.message, "error");
                    }
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText);
                    swal("Error", "Terjadi kesalahan saat konfirmasi checkin", "error");
                });
            });

            // Handle konfirmasi checkout button click
            $('#konfirmasiCheckoutModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let kode_reservasi = button.data('kode_reservasi');

                $.get('{{ url('reservasi-resepsionis') }}/' + kode_reservasi, function(data) {
                    console.log('Detail Data:', data); // Log detail data for debugging

                    $('#konfirmasiCheckoutKodeReservasi').val(data.kode_reservasi);

                    let pelangganData = '';
                    if (data.reservasi_pelanggan && data.reservasi_pelanggan.length > 0) {
                        data.reservasi_pelanggan.forEach(function(reservasiPelanggan) {
                            pelangganData += `
                                <div class="pelanggan-item">
                                    <p><strong>Nama:</strong> ${reservasiPelanggan.pelanggan.nama}</p>
                                    <p><strong>Jenis Kelamin:</strong> ${reservasiPelanggan.pelanggan.jenis_kelamin}</p>
                                    <p><strong>No HP:</strong> ${reservasiPelanggan.pelanggan.no_hp}</p>
                                    <p><strong>Alamat:</strong> ${reservasiPelanggan.pelanggan.alamat}</p>
                                    <p><strong>Email:</strong> ${reservasiPelanggan.pelanggan.email}</p>
                                </div>
                            `;
                        });
                    } else {
                        pelangganData = 'Data tidak tersedia';
                    }
                    $('#konfirmasiCheckoutPelangganContainer').html(pelangganData);

                    let kamarData = '';
                    if (data.reservasi_kamar && data.reservasi_kamar.length > 0) {
                        data.reservasi_kamar.forEach(function(reservasiKamar) {
                            kamarData += `
                                <div class="kamar-item">
                                    <p><strong>Jenis Kamar:</strong> ${reservasiKamar.kamar.jenis_kamar.nama}</p>
                                    <p><strong>Nomor Kamar:</strong> ${reservasiKamar.kamar.nomor_kamar}</p>
                                    <p><strong>Harga:</strong> ${reservasiKamar.kamar.formatted_harga}</p>
                                </div>
                            `;
                        });
                    } else {
                        kamarData = 'Data tidak tersedia';
                    }
                    $('#konfirmasiCheckoutKamarContainer').html(kamarData);
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText); // Log error response for debugging
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });

            $('#konfirmasiCheckoutButton').on('click', function() {
                let kode_reservasi = $('#konfirmasiCheckoutKodeReservasi').val();

                $.post('{{ url('reservasi-resepsionis/konfirmasi-checkout') }}/' + kode_reservasi, {
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    console.log('Success:', response);
                    if (response.success) {
                        swal("Berhasil", "Reservasi telah di-checkout", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Error", response.message, "error");
                    }
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText);
                    swal("Error", "Terjadi kesalahan saat konfirmasi checkout", "error");
                });
            });

            function formatRupiah(angka, prefix = 'Rp') {
                let numberString = angka.toString().replace(/[^0-9]/g, '');
                let split = numberString.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix + rupiah;
            }
        });
    </script>
@endsection
