<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pegawai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
        }

        #customers th,
        td {}

        #customers tr:nth-child(even) {}

        #customers tr:hover {}
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <h2 style="text-align: center;">Laporan Kinerja Pegawai</h2>

        <table style="width: 100%;" class="table">
            <tr>
                <td style="width: 50%; padding: 5px;"><strong>Nama Pegawai:</strong> {{ $pegawai->nama }}</td>
                <td style="width: 50%; padding: 5px;"><strong>NIP:</strong> {{ $pegawai->nip }}</td>
            </tr>
            <tr>
                <td style="width: 50%; padding: 5px;"><strong>Jabatan:</strong> {{ $pegawai->jabatan->jabatan }}</td>
                <td style="width: 50%; padding: 5px;"><strong>Pangkat:</strong> {{ $pegawai->pangkat->pangkat }}</td>
            </tr>
        </table>

        <h3>Data Kriteria & Himpunan</h3>
        <table style="width: 100%" class="table">
            <thead>
                <tr class="text-center">
                    <th>Nama Kriteria</th>
                    <th>Himpunan</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawai->klasifikasi as $k)
                <tr>
                    <td>{{ $k->himpunan->kriteria->nama_kriteria }}</td>
                    <td>{{ $k->himpunan->nama }}</td>
                    <td class="text-center">{{ $k->himpunan->nilai }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

</body>

</html>