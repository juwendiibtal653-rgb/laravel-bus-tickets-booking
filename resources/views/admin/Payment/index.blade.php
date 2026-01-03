@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Riwayat Pembayaran
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Penumpang
                        </th>
                        <th>
                            Rute
                        </th>
                        <th>
                            Jumlah
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data Dummy --}}
                    <tr>
                        <td></td>
                        <td>1</td>
                        <td>Budi Santoso</td>
                        <td>Jakarta - Bandung</td>
                        <td>Rp 150.000</td>
                        <td><span class="badge badge-success">Lunas</span></td>
                        <td>2023-12-25 10:00</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="#">Lihat</a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2</td>
                        <td>Siti Aminah</td>
                        <td>Surabaya - Malang</td>
                        <td>Rp 100.000</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>2023-12-26 14:30</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="#">Lihat</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
