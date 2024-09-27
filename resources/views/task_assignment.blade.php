<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer İş Dağılımı</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            margin: 0 auto;
            width: 80%;
        }
        .developer-row {
            font-weight: bold;
            background-color: #f1f1f1;
        }
        .table-container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
        }
        .summary {
            margin-top: 30px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Developer İş Dağılımı</h1>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Geliştirici</th>
                        <th>Atanan İşler</th>
                        <th>Toplam Saat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($developerWorkload as $developer => $workload)
                    <tr class="developer-row">
                        <td>{{ $developer }}</td>
                        <td>{{ implode(', ', $workload['tasks']) }}</td>
                        <td>{{ $workload['hours_worked'] }} saat</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="summary">
            Toplam Süre: <strong>{{ $totalWeeks }} hafta</strong>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
