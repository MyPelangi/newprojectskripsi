<!-- Tombol Aksi -->

<!-- Button Lihat -->
<div class="btn-group" role="group" aria-label="Aksi">
<a href="{{ route('detail.show', $row->id) }}" class="btn btn-sm btn-warning">Lihat
</a>

<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#actionModal-{{ $row->id }}">
    Aksi
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="actionModal-{{ $row->id }}" tabindex="-1" aria-labelledby="actionModalLabel-{{ $row->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="actionModalLabel-{{ $row->id }}">Tindakan Permohonan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <p>Silakan pilih tindakan untuk permohonan ini.</p>
            <!-- Tombol Setujui -->
            <form action="{{ route('penutupan.approve', $row->id) }}" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn btn-success w-100">Setujui Permohonan</button>
            </form>

            <!-- Form Tolak -->
            <form action="{{ route('penutupan.reject', $row->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="keterangan-{{ $row->id }}" class="form-label">Alasan Penolakan</label>
                    <textarea name="keterangan" id="keterangan-{{ $row->id }}" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger w-100">Tolak Permohonan</button>
            </form>
        </div>
    </div>
  </div>
</div>
