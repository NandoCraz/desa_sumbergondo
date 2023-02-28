<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/daftar-alamat" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Alamat</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_penerima" class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Provinsi</label>
                        <select class="form-select" id="provinsi_id" name="provinsi_id" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Kota</label>
                        <select class="form-select" name="kota_id" id="kota_id" required>
                            <option value="">-- Pilih Kota --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script>
    $('#provinsi_id').on('change', function(e) {
        const inp = $('#kota_id')
        inp.prop("disabled", true);
        $.ajax({
            url: "{{ route('checkout.get_data') }}?provinsi=" + e.target.value,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                inp.empty()
                inp.append(new Option('-- Pilih Kota --', ''))
                data.forEach(el => inp.append(new Option(el.nama_kab_kota, el.id)))
                inp.prop("disabled", false);
            }
        })
    });
</script>
