<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ public_path('certificate/pdf.css') }}">
</head>

<body>
    {{-- <h1>Certificate</h1>
    <h3>{{ $data->member->fullname }}</h3>
    <p>Menerima Serifikat</p>
    <h3>{{ $data->certification->title }}</h3>
    <p>Dengan status</p>
    <h4>{{ $data->status === 'approved' ? 'Kompeten' : 'Tidak Kompeten' }}</h4> --}}
    <div class="certificate">
        <header>
            <div class="logos">
                <img src="{{ public_path('images/apmfi_logo.png') }}" alt="APMFI Logo" class="logo">
                <img src="{{ public_path('images/ivfi-pusat_logo.png') }}" alt="IVFI Logo" class="logo">
                <img src="{{ public_path('images/isfi_logo.png') }}" alt="Instansi Logo" class="logo">
            </div>
        </header>

        <main>
            <h1>Daftar Unit Kompetensi</h1>
            <h2 class="subtitle">List of Units of Competency</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Mencatat Kebutuhan Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Menerima Sediaan Farmasi dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Melakukan Pengadaan Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Menerima Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Menyimpan Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Melakukan Penyimpanan Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Melakukan Administrasi Dokumen-Dokumen Sediaan Farmasi Dan Perbekalan Kesehatan</td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Menyiapkan dan meracik sediaan farmasi</td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Menulis etiket dan menempelkannya pada kemasan sediaan farmasi</td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Menulis copy Resep</td>
                    </tr>
                    <tr>
                        <td>11.</td>
                        <td>Membuat sediaan obat guna keperluan/ persediaan obat di apotek</td>
                    </tr>
                    <tr>
                        <td>12.</td>
                        <td>Menghitung/kalkulasi biaya obat dan perbekalan kesehatan</td>
                    </tr>
                    <tr>
                        <td>13.</td>
                        <td>Berkomunikasi dengan orang lain</td>
                    </tr>
                </tbody>
            </table>

            <div class="signatures">
                <div class="location-date">
                    <p>Yogyakarta, 6 Mei 2024</p>
                </div>

                <div class="signature-grid">
                    <div class="signature-box">
                        <p class="title">Ketua Korwil APMFI</p>
                        <p class="region">Kalsel-Teng</p>
                        <div class="sign-line"></div>
                        <p class="name">Indra Maulana,Amd.Farm</p>
                    </div>

                    <div class="signature-box">
                        <p class="title">Ketua Pengurus Daerah IVFI</p>
                        <p class="region">Kalimantan Selatan</p>
                        <div class="sign-line"></div>
                        <p class="name">apt.H.M.Noor Ipansyah,S.Si,MM</p>
                    </div>

                    <div class="signature-box">
                        <p class="title">Kepala Sekolah</p>
                        <p class="region">SMK ISFI Banjarmasin</p>
                        <div class="sign-line"></div>
                        <p class="name">apt.H.M.Noor Ipansyah,S.Si,MM</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
