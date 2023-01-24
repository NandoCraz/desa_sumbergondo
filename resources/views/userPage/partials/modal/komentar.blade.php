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
                    @if (isset($komentarUser))
                        <label>Komentar Anda :</label>
                        <textarea name="komentar" id="komentar" class="form-control w-100" rows="5" style="resize:none;" disabled>{{ $komentarUser->komentar }}</textarea>
                    @else
                        <label>Komentar Anda :</label>
                        <textarea name="komentar" id="komentar" class="form-control w-100" rows="5" style="resize:none;"></textarea>
                    @endif
            </div>
            <div class="modal-footer">
                @if (!isset($komentarUser))
                    <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                @endif
                </form>
            </div>
        </div>
    </div>
</div>
