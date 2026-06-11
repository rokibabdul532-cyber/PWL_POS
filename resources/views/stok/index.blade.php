@extends('layouts.template')

@section('title', 'Data Stok')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Stok</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover" id="table-stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>User Input</th>
                    <th>Jumlah Stok</th>
                    <th>Tanggal Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection

@push('js')
<script>
function modalAction(url = '') {
    $('#myModal').load(url, function() {
        $('#myModal').modal('show');
    });
}

$(document).ready(function() {
    // Cek apakah DataTable sudah terinisialisasi
    if ($.fn.dataTable.isDataTable('#table-stok')) {
        $('#table-stok').DataTable().destroy();
    }
    
    $('#table-stok').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('stok/list') }}",
            type: "POST",
            data: function(d) {
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "nama_barang", orderable: true, searchable: true },
            { data: "nama_user", orderable: true, searchable: true },
            { data: "stok_jumlah", className: "text-center", orderable: true, searchable: false },
            { data: "stok_tanggal", className: "text-center", orderable: true, searchable: false },
            { data: "aksi", orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush