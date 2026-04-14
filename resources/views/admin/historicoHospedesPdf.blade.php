<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Histórico de Hóspedes</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .name {
            font-size: 16px;
            font-weight: bold;
        }

        .info {
            margin-top: 5px;
            color: #555;
        }

        .status {
            font-weight: bold;
            color: red;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>

    <h1>📜 Histórico de Hóspedes</h1>

    @foreach ($hospedes as $hospede)
        <div class="card">

            <div class="row">
                <div>
                    <div class="name">
                        {{ $hospede->name }}
                    </div>

                    <div class="info">
                        Entrada: {{ \Carbon\Carbon::parse($hospede->created_at)->format('d/m/Y') }}
                    </div>

                    <div class="info">
                        Saída: {{ \Carbon\Carbon::parse($hospede->data_saida)->format('d/m/Y') }}
                    </div>
                </div>

                <div class="status">
                    Finalizado
                </div>
            </div>

        </div>
    @endforeach

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>