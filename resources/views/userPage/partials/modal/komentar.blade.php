<div class="modal fade" id="komentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beri Komentar Pada Kami 😃</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/komentar" method="post">
                    @csrf
                    <textarea name="komentar" id="komentar" class="form-control w-100" rows="5" style="resize:none;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                </form>
            </div>
        </div>
    </div>
</div>
