@extends('resepsionis.layouts.index')

@section('title', 'Data Pelanggan')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pelanggan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">Index</th>
                                    <th>Kode Reservasi</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggans as $index => $pelanggan)
                                    @foreach ($pelanggan->reservasiPelanggan as $reservasiPelanggan)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $reservasiPelanggan->reservasi->kode_reservasi }}</td>
                                            <td>{{ $pelanggan->nama }}</td>
                                            <td>{{ $pelanggan->jenis_kelamin }}</td>
                                            <td>{{ $pelanggan->no_hp }}</td>
                                            <td>
                                                <a href="#" class="btn btn-icon btn-info" data-toggle="modal"
                                                    data-target="#detailPelangganModal" data-id="{{ $pelanggan->id }}"><i
                                                        class="fas fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
    <!-- Modal for detail pelanggan -->
    <div class="modal fade" id="detailPelangganModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Detail Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" id="detailNama" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" id="detailJenisKelamin" readonly>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" id="detailNoHp" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" id="detailAlamat" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="detailEmail" readonly>
                    </div>
                    <div class="form-group">
                        <label>Data Reservasi</label>
                        <div class="scrollable-container" id="detailReservasiContainer"></div>
                    </div>
                    <div class="form-group">
                        <label>Data Kamar</label>
                        <div class="scrollable-container" id="detailKamarContainer"></div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

            // Handle detail button click
            $('#detailPelangganModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');

                $.get('{{ url('pelanggan-resepsionis') }}/' + id, function(data) {
                    console.log('Detail Data:', data);

                    $('#detailNama').val(data.nama);
                    $('#detailJenisKelamin').val(data.jenis_kelamin);
                    $('#detailNoHp').val(data.no_hp);
                    $('#detailAlamat').val(data.alamat);
                    $('#detailEmail').val(data.email);

                    let reservasiData = '';
                    let kamarData = '';

                    if (data.reservasi_pelanggan && data.reservasi_pelanggan.length > 0) {
                        data.reservasi_pelanggan.forEach(function(reservasiPelanggan) {
                            let reservasi = reservasiPelanggan.reservasi;
                            reservasiData += `
                        <p><strong>Kode Reservasi:</strong> ${reservasi.kode_reservasi}</p>
                        <p><strong>Tanggal Check-in:</strong> ${reservasi.tgl_checkin}</p>
                        <p><strong>Tanggal Check-out:</strong> ${reservasi.tgl_checkout}</p>
                        <p><strong>Status:</strong> ${reservasi.status}</p>
                        `;

                            reservasi.reservasi_kamar.forEach(function(reservasiKamar) {
                                kamarData += `
                            <p><strong>Jenis Kamar:</strong> ${reservasiKamar.kamar.jenis_kamar.nama}</p>
                            <p><strong>Nomor Kamar:</strong> ${reservasiKamar.kamar.nomor_kamar}</p>
                            <p><strong>Harga:</strong> ${reservasiKamar.kamar.formatted_harga}</p>
                            `;
                            });
                        });
                    } else {
                        reservasiData = 'Data tidak tersedia';
                        kamarData = 'Data tidak tersedia';
                    }
                    $('#detailReservasiContainer').html(reservasiData);
                    $('#detailKamarContainer').html(kamarData);
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText);
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });
        });
    </script>
@endsection
