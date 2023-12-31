@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-10">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="d-grid gap-2">
                    <a href="{{ url('create') }}" class="btn btn-secondary">Tambah Data</a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="table-responsive border p-4 rounded-3">
            @if (session('status'))
                <h4 class="alert alert-warning mb-2">{{ session('status') }}</h4>
            @endif

            <table class="table table-bordered table-hover table-striped" id="articleTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        {{-- <th>QR Code</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fdata)
                        @forelse ($fdata as $key => $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['keterangan'] }}</td>
                                {{-- <td>{{ $item['QRCode'] }}</td> --}}
                                <td>@include('firebase.actions')</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">tidak ada data</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5" class="text-center">tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
