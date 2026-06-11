<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kasir</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">- Pilih Kasir -</option>
                                @foreach($user as $u)
                                    <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-user_id" class="error-text text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pembeli</label>
                            <input type="text" name="pembeli" class="form-control" required>
                            <small id="error-pembeli" class="error-text text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Penjualan</label>
                            <input type="date" name="penjualan_tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                            <small id="error-penjualan_tanggal" class="error-text text-danger"></small>
                        </div>
                    </div>
                </div>

                <hr>
                <h5>Detail Barang</h5>
                <div id="detail-barang">
                    <div class="row mb-2" id="barang-1">
                        <div class="col-md-5">
                            <select name="barang_id[]" class="form-control barang-select" required>
                                <option value="">- Pilih Barang -</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="harga[]" class="form-control harga" placeholder="Harga" readonly>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" id="tambah-barang" class="btn btn-sm btn-primary">Tambah Barang</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
let barangCount = 1;

$(document).ready(function() {
    // Event untuk memilih barang
    $(document).on('change', '.barang-select', function() {
        let harga = $(this).find(':selected').data('harga');
        $(this).closest('.row').find('.harga').val(harga);
    });

    // Tambah barang
    $('#tambah-barang').click(function() {
        barangCount++;
        let newRow = `
            <div class="row mb-2" id="barang-${barangCount}">
                <div class="col-md-5">
                    <select name="barang_id[]" class="form-control barang-select" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="harga[]" class="form-control harga" placeholder="Harga" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                </div>
            </div>
        `;
        $('#detail-barang').append(newRow);
    });

    // Hapus barang
    $(document).on('click', '.btn-remove', function() {
        $(this).closest('.row').remove();
    });

    // Validasi form
    $("#form-tambah").validate({
        rules: {
            user_id: { required: true, number: true },
            pembeli: { required: true, maxlength: 100 },
            penjualan_tanggal: { required: true, date: true },
            'barang_id[]': { required: true },
            'jumlah[]': { required: true, number: true, min: 1 },
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                        $('#table-penjualan').DataTable().ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
                    }
                }
            });
            return false;
        }
    });
});
</script>