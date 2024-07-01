@extends('resepsionis.layouts.index')

@section('title', 'Data Transaksi')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">Index</th>
                                    <th>Kode Reservasi</th>
                                    <th>Total Biaya</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $index => $transaksi)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $transaksi->reservasi->kode_reservasi }}</td>
                                        <td>{{ formatRupiah($transaksi->total_biaya) }}</td>
                                        <td>{{ $transaksi->tgl_transaksi }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-info" data-toggle="modal"
                                                data-target="#detailTransaksiModal" data-id="{{ $transaksi->id }}"><i
                                                    class="fas fa-info-circle"></i></a>
                                        </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal for detail transaksi -->
    <div class="modal fade" id="detailTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Detail Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Reservasi</label>
                        <input type="text" class="form-control" id="detailKodeReservasi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Total Biaya</label>
                        <input type="text" class="form-control" id="detailTotalBiaya" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" class="form-control" id="detailTglTransaksi" readonly>
                    </div>
                    <div class="form-group">
                        <label>Data Reservasi</label>
                        <div class="scrollable-container" id="detailReservasiContainer"></div>
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
            $('#detailTransaksiModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');

                $.get('{{ url('transaksi-resepsionis') }}/' + id, function(data) {
                    console.log('Detail Data:', data);

                    $('#detailKodeReservasi').val(data.reservasi.kode_reservasi);
                    $('#detailTotalBiaya').val(formatRupiah(data.total_biaya));
                    $('#detailTglTransaksi').val(data.tgl_transaksi);

                    let reservasiData = '';
                    if (data.reservasi) {
                        reservasiData += `
                        <p><strong>Kode Reservasi:</strong> ${data.reservasi.kode_reservasi}</p>
                        <p><strong>Tanggal Check-in:</strong> ${data.reservasi.tgl_checkin}</p>
                        <p><strong>Tanggal Check-out:</strong> ${data.reservasi.tgl_checkout}</p>
                        <p><strong>Status:</strong> ${data.reservasi.status}</p>
                    `;

                        data.reservasi.reservasi_pelanggan.forEach(function(reservasiPelanggan) {
                            reservasiData += `
                            <p><strong>Nama Pelanggan:</strong> ${reservasiPelanggan.pelanggan.nama}</p>
                            <p><strong>Jenis Kelamin:</strong> ${reservasiPelanggan.pelanggan.jenis_kelamin}</p>
                            <p><strong>No HP:</strong> ${reservasiPelanggan.pelanggan.no_hp}</p>
                            <p><strong>Alamat:</strong> ${reservasiPelanggan.pelanggan.alamat}</p>
                            <p><strong>Email:</strong> ${reservasiPelanggan.pelanggan.email}</p>
                        `;
                        });
                    } else {
                        reservasiData = 'Data tidak tersedia';
                    }

                    $('#detailReservasiContainer').html(reservasiData);
                }).fail(function(xhr) {
                    console.log('Error:', xhr.responseText);
                    swal("Error", "Data tidak ditemukan atau terjadi kesalahan", "error");
                });
            });

            function formatRupiah(angka, prefix = 'Rp') {
                let numberString = angka.toString().replace(/[^,\d]/g, '');
                let split = numberString.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
            }
        });
    </script>
@endsection
