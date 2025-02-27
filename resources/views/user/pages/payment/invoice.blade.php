@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}">
@endpush
@extends('layouts.user')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payment-histories.index') }}">Riwayat Pembayaran</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
        </ol>
    </nav>
@endsection

@section('page-heading')
    <div class="row">
        <div class="order-last col-12 col-md-6 order-md-1">
            <h3>Invoice</h3>
            <p class="text-subtitle text-muted">
                Detail invoice pembayaran sertifikat.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="divider divider-center">
                        <span class="divider-text h4">Informasi Pembayaran</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Nomor Invoice</p>
                                <h6 class="font-bold">{{ $payment->id }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Tanggal Invoice</p>
                                <h6 class="font-bold">{{ $payment->date->format('d-m-Y') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Jenis Sertifikat</p>
                                <h6 class="font-bold">{{ $certification->title ?? '-' }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Total Anggota</p>
                                <h6 class="font-bold">{{ $payment->members->count() }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Harga</p>
                                <h6 class="font-bold">Rp. {{ number_format($certification->price, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-4">
                                <p class="text-muted">Total Pembayaran</p>
                                <h6 class="font-bold">Rp. {{ number_format($payment->total_amount, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="gap-2 mt-5 d-grid">
                            <a href="{{ route('payment-histories.index') }}" class="btn btn-outline-secondary">Cek Riwayat
                                Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Status Pembayaran -->
        <div class="col-12 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <div class="divider divider-center">
                        <span class="divider-text h4">Status Pembayaran</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p class="text-muted">Status :
                            @if ($payment->status == 'paid')
                                <span class="badge text-bg-success">Lunas</span>
                            @else
                                <span class="badge text-bg-warning">Belum Lunas</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="text-muted">Batas Pembayaran</p>
                        <h6 class="font-bold">
                            {{ $payment->due_date ? \Carbon\Carbon::parse($payment->due_date)->format('d F Y') : '-' }}
                        </h6>
                    </div>
                    <div class="mb-4">
                        <p class="text-muted">Bukti Pembayaran</p>
                        <form action="{{ route('payment.upload-proof', $payment->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="filepond--root image-preview-filepond filepond--hopper"
                                data-style-button-remove-item-position="left"
                                data-style-button-process-item-position="right" data-style-load-indicator-position="right"
                                data-style-progress-indicator-position="right" data-style-button-remove-item-align="false"
                                style="height: 76px;"><input class="filepond--browser" type="file"
                                    id="filepond--browser-956xbvmtz" name="proof"
                                    aria-controls="filepond--assistant-956xbvmtz"
                                    aria-labelledby="filepond--drop-label-956xbvmtz"
                                    accept="image/png,image/jpg,image/jpeg">
                                <div class="filepond--drop-label"
                                    style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label
                                        for="filepond--browser-956xbvmtz" id="filepond--drop-label-956xbvmtz"
                                        aria-hidden="true">Seret &amp;
                                        Lepaskan file Anda atau <span class="filepond--label-action"
                                            tabindex="0">Pilih</span></label></div>
                                <div class="filepond--list-scroller" style="transform: translate3d(0px, 0px, 0px);">
                                    <ul class="filepond--list" role="list"></ul>
                                </div>
                                <div class="filepond--panel filepond--panel-root" data-scalable="true">
                                    <div class="filepond--panel-top filepond--panel-root"></div>
                                    <div class="filepond--panel-center filepond--panel-root"
                                        style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);">
                                    </div>
                                    <div class="filepond--panel-bottom filepond--panel-root"
                                        style="transform: translate3d(0px, 68px, 0px);"></div>
                                </div><span class="filepond--assistant" id="filepond--assistant-956xbvmtz" role="status"
                                    aria-live="polite" aria-relevant="additions"></span>
                                <fieldset class="filepond--data"></fieldset>
                                <div class="filepond--drip"></div>
                            </div>
                            <!-- Tombol Pembayaran -->
                            <div class="gap-2 mt-4 d-grid">
                                <button class="btn btn-primary">Kirim Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script
        src="{{ asset('assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script
        src="{{ asset('assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}">
    </script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>
@endpush
