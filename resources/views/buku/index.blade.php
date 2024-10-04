@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Buku</h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Buku
    </a>
    <table id="bukuTable" class="table table-bordered table-striped table-hover responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->kategori ? $buku->kategori->nama : 'Kategori Tidak Ada' }}</td> <!-- Relasi kategori -->
                    <td>{{ $buku->penulis }}</td>
                    <td style="text-align: center; white-space: nowrap;">
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Apakah Anda yakin?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                            onclick="showDetail('{{ $buku->judul }}', '{{ $buku->kategori ? $buku->kategori->nama : 'Kategori Tidak Ada' }}', '{{ $buku->penulis }}')">
                            <i class="fas fa-info-circle"></i> Detail
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Judul:</strong> <span id="modal-judul"></span></p>
          <p><strong>Kategori:</strong> <span id="modal-kategori"></span></p>
          <p><strong>Penulis:</strong> <span id="modal-penulis"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#bukuTable').DataTable();
    });

    function showDetail(judul, kategori, penulis) {
        // Set nilai ke modal
        $('#modal-judul').text(judul);
        $('#modal-kategori').text(kategori);
        $('#modal-penulis').text(penulis);
    }
</script>
@endsection
