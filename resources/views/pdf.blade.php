<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ public_path('certificate/pdf.css') }}">

    <style>
        #first {
            height: 100%;
            max-height: 100vh;
            background-image: url("{{ public_path('images/background.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        #second {
            height: 100%;
            max-height: 100vh;
            background-image: url("{{ public_path('images/background-second.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
            /* padding: 3rem; */
            page-break-before: always
        }
    </style>

</head>

<body>
    <div class="certificate" id="first">
        <div class="content">
            <header style="padding-top: 3rem;">
                <table class="logo-table">
                    <tr>
                        <td class="logo-box">
                            <img src="{{ public_path('images/apmfi_logo.png') }}" alt="APMFI Logo" class="logo">
                        </td>
                        <td class="logo-box">
                            <img src="{{ public_path('images/ivfi-pusat_logo.png') }}" alt="IVFI Logo" class="logo">
                        </td>
                        <td class="logo-box">
                            <img src="{{ public_path('images/isfi_logo.png') }}" alt="Instansi Logo" class="logo">
                        </td>
                    </tr>
                </table>
            </header>


            <div class="title">
                <h1>SERTIFIKAT KOMPETENSI</h1>
                <h2>Certificate of Competency</h2>
            </div>

            <div class="certificate-number">
                <p>Nomor : 001/PDIVFI-KALSEL/Serkom/VI/2024</p>
            </div>

            <div class="subtitle-title">UJI KOMPETENSI KEAHLIAN</div>
            <div class="subtitle-en">SKILLS COMPETENCE TEST</div>

            <div class="recipient-intro">Dengan ini menyatakan bahwa,</div>
            <div class="recipient-intro-en">this is to certifity that,</div>

            <div class="recipient-name">{{ $data->member->fullname }}</div>

            <div class="institution-label">Dari</div>
            <div class="institution-label-en">From</div>

            <div class="institution-name">SMK ISFI BANJARMASIN</div>

            <div class="achievement-text">Telah mengikuti Uji Kompetensi Keahlian</div>
            <div class="achievement-text-en">has taken the competency test</div>

            <div class="competency-field">{{ $data->certification->title }}</div>
            <div class="competency-field-en">Skill competency of clinical and community pharmacy</div>

            <div class="achievement-level">dengan Predikat :
                {{ $data->status === 'approved' ? 'Kompeten' : 'Tidak Kompeten' }}</div>
            <div class="achievement-level-en">with achievement :
                {{ $data->status === 'approved' ? 'Competent' : 'Not Competent' }}</div>

            <div class="date">Yogyakarta, 6 Mei 2024</div>

            <table class="signatures-table">
                <tr>
                    <td class="signature">
                        <div class="signature-title">Ketua Umum</div>
                        <div class="signature-org">Asosiasi Pendidikan Menengah Farmasi Indonesia</div>
                        <div class="logo">
                            <img src="{{ public_path('images/apmfi_logo.png') }}" alt="APMFI Logo">
                        </div>
                        <div class="signature-line"><img src="{{ public_path('images/sign_leonov.png') }}"
                                alt=""></div>
                        <div class="signature-name">apt. Leonov Rianto, S.Si, M.Farm</div>
                    </td>
                    <td class="signature">
                        <div class="signature-title">Ketua Umum</div>
                        <div class="signature-org">Ikatan Vokasi Farmasi Indonesia</div>
                        <div class="logo">
                            <img src="{{ public_path('images/ivfi-pusat_logo.png') }}" alt="IVFI Logo"
                                style="padding-left: 40px;">
                        </div>
                        <div class="signature-line"><img src="{{ public_path('images/sign_ipansyah.png') }}"
                                alt=""></div>
                        <div class="signature-name">apt. H.M. Noor Ipansyah, S.Si., MM</div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="certificate" id="second">
        <header style="padding-top: 3rem;">
            <table class="logo-table">
                <tr>
                    <td class="logo-box">
                        <img src="{{ public_path('images/apmfi_logo.png') }}" alt="APMFI Logo" class="logo">
                    </td>
                    <td class="logo-box">
                        <img src="{{ public_path('images/ivfi-pusat_logo.png') }}" alt="IVFI Logo" class="logo">
                    </td>
                    <td class="logo-box">
                        <img src="{{ public_path('images/isfi_logo.png') }}" alt="Instansi Logo" class="logo">
                    </td>
                </tr>
            </table>
        </header>

        <main style="padding: 3rem 3rem 0 3rem;">
            <h1>Daftar Unit Kompetensi</h1>
            <h2 class="subtitle">List of Units of Competency</h2>

            <table class="competency-table">
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

                <table class="signature-table">
                    <tr>
                        <td class="signature-box">
                            <p class="title">Ketua Korwil APMFI</p>
                            <p class="region">Kalsel-Teng</p>
                            <div class="logo">
                                <img src="{{ public_path('images/apmfi_logo.png') }}" alt="IVFI Logo">
                            </div>
                            <div class="signature-line"><img src="{{ public_path('images/sign_ipansyah.png') }}"
                                    alt=""></div>
                            <div class="signature-name">apt. H.M. Noor Ipansyah, S.Si., MM</div>
                        </td>
                        <td class="signature-box">
                            <p class="title">Ketua Pengurus Daerah IVFI</p>
                            <p class="region">Kalimantan Selatan</p>
                            <div class="logo">
                                <img src="{{ public_path('images/ivfi-pusat_logo.png') }}" alt="IVFI Logo">
                            </div>
                            <div class="signature-line"><img src="{{ public_path('images/ghost-sign.png') }}"
                                    alt=""></div>
                            <p class="name">Indra Maulana, Amd.Farm</p>
                        </td>
                        <td class="signature-box">
                            <p class="title">Kepala Sekolah</p>
                            <p class="region">SMK ISFI Banjarmasin</p>
                            <div class="logo">
                                <img src="{{ public_path('images/isfi_logo.png') }}" alt="IVFI Logo">
                            </div>
                            <div class="signature-line"><img src="{{ public_path('images/sign_ipansyah.png') }}"
                                    alt=""></div>
                            <div class="signature-name">apt. H.M. Noor Ipansyah, S.Si., MM</div>
                        </td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
