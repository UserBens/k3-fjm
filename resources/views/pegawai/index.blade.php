<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Tenaga Kerja - Sistem K3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 fw-bold">Master Data Tenaga Kerja & Manajemen KIB</h5>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-4">
                        <form action="{{ route('k3.pegawai.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2"
                                placeholder="Cari Nama / Badge..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-primary">Cari</button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Badge / NIK</th>
                                <th>Nama Pegawai</th>
                                <th>Nomor KIB</th>
                                <th>Status KIB</th>
                                <th>Status Akun</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pegawai as $key => $p)
                                <tr>
                                    <td>{{ $pegawai->firstItem() + $key }}</td>
                                    <td><span class="badge bg-secondary">{{ $p->badge ?? '-' }}</span></td>
                                    <td class="fw-semibold">{{ $p->nama }}</td>
                                    <td>{{ $p->nomor_kib ?? 'Belum Diinput' }}</td>
                                    <td>
                                        @if ($p->status_kib == 'Aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @elseif($p->status_kib == 'Expired')
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($p->status_kib == 'Proses')
                                            <span class="badge bg-warning text-dark">Proses</span>
                                        @else
                                            <span class="badge bg-light text-muted border">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $p->is_active ? '<span class="text-success">● Aktif</span>' : '<span class="text-danger">● Non-Aktif</span>' !!}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editKibModal{{ $p->id }}">
                                            Input / Ubah KIB
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editKibModal{{ $p->id }}" $tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Update KIB: {{ $p->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-shadow="none"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('k3.pegawai.update_kib', $p->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Nama Pegawai</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $p->nama }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Badge / NIK</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $p->badge }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nomor_kib" class="form-label fw-semibold">Nomor
                                                            KIB</label>
                                                        <input type="text" name="nomor_kib" class="form-control"
                                                            id="nomor_kib" placeholder="Masukkan nomor KIB dari Excel"
                                                            value="{{ old('nomor_kib', $p->nomor_kib) }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status_kib" class="form-label fw-semibold">Status
                                                            KIB</label>
                                                        <select name="status_kib" class="form-select" id="status_kib"
                                                            required>
                                                            <option value="" disabled selected>-- Pilih Status --
                                                            </option>
                                                            <option value="Aktif"
                                                                {{ $p->status_kib == 'Aktif' ? 'selected' : '' }}>Aktif
                                                            </option>
                                                            <option value="Proses"
                                                                {{ $p->status_kib == 'Proses' ? 'selected' : '' }}>
                                                                Proses Pengajuan</option>
                                                            <option value="Expired"
                                                                {{ $p->status_kib == 'Expired' ? 'selected' : '' }}>
                                                                Expired</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan
                                                        Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Data pegawai tidak ditemukan
                                        atau belum disinkronkan dari API.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $pegawai->links() }}
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
