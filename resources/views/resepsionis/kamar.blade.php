@extends('resepsionis.layouts.index')

@section('title', 'Data Kamar')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Kamar</h4>
                </div>
                <div class="card-body">
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
                                        <td>{{ $kamar->status_display }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-info" data-toggle="modal"
                                                data-target="#detailKamarModal"
                                                data-nomor_kamar="{{ $kamar->nomor_kamar }}"><i
                                                    class="fas fa-info-circle"></i></a>
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
                            <label>Fasilitas</label>
                            <textarea class="form-control" id="detailFasilitas" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" id="detailDeskripsi" readonly></textarea>
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

            // Handle detail button click
            $('#detailKamarModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let nomor_kamar = button.data('nomor_kamar');

                $.get('{{ url('kamar-resepsionis') }}/' + nomor_kamar, function(data) {
                    $('#detailIdJenisKamar').val(data.jenis_kamar ? data.jenis_kamar.nama : 'N/A');
                    $('#detailFasilitas').val(data.jenis_kamar ? data.jenis_kamar.fasilitas :
                    'N/A');
                    $('#detailDeskripsi').val(data.jenis_kamar ? data.jenis_kamar.deskripsi :
                    'N/A');
                    $('#detailNomorKamar').val(data.nomor_kamar);
                    $('#detailHarga').val(formatRupiah(data.harga));
                    $('#detailStatus').val(data.status_display);
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
