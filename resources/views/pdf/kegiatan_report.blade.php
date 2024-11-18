<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan Kegiatan Diakonia GKI Efrata Wosi Manokwari</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .border {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td style="width: 80%;">
                    <h1>Laporan Kegiatan Diakonia GKI Efrata Wosi Manokwari</h1>
                </td>
                <td style="20%;">
                    <img src="{{ public_path('assets/img/logo.png') }}" alt="Logo"
                        style="width: 100px; height: auto; display:inline-block;">
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="border">No</th>
                <th class="border">Tanggal Pelaksanaan</th>
                <th class="border">Nama Kegiatan</th>
                <th class="border">Nama Proker</th>
                <th class="border">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($kegiatans as $index => $kegiatan)
            @php
                $total+=$kegiatan->kegiatan_nominal;
            @endphp
                <tr>
                    <td class="border">{{ $index + 1 }}</td>
                    <td class="border">{{ date('d-m-Y', strtotime($kegiatan->kegiatan_tanggal)) }}</td>
                    <td class="border">{{ $kegiatan->kegiatan_name }}</td>
                    <td class="border">{{ $kegiatan->proker->proker_name }}</td>
                    <td class="border">{{ number_format($kegiatan->kegiatan_nominal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="border"></td>
                <td class="border" colspan="3"><span >Total</span></td>
                <td class="border">{{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 20px;">
        Downloaded at {{ now()->format('d-m-Y H:i') }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
