<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Pedidos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitulo {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
            color: #666;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #444;
            color: #fff;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 6px;
            border-bottom: 1px solid #ccc;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>

    <!-- Título -->
    <h1>📦 Relatório de Pedidos</h1>

    <!-- Período -->
    <div class="subtitulo">
        @if(isset($inicio) && isset($fim))
            Período: {{ \Carbon\Carbon::parse($inicio)->format('d/m/Y') }}
            até
            {{ \Carbon\Carbon::parse($fim)->format('d/m/Y') }}
        @else
            Todos os pedidos
        @endif
    </div>

    <!-- Informações -->
    <div class="info">
        <p><strong>Gerado em:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        <p><strong>Total de pedidos:</strong> {{ $pedidos->count() }}</p>
    </div>

    <!-- Tabela -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Total (R$)</th>
            </tr>
        </thead>

        <tbody>
            @php $soma = 0; @endphp

            @foreach ($pedidos as $pedido)
                @php $soma += $pedido->total; @endphp

                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->user->name }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        Total geral: R$ {{ number_format($soma, 2, ',', '.') }}
    </div>

    <!-- Rodapé -->
    <div class="footer">
        Sistema de Gestão • Gerado automaticamente
    </div>

</body>
</html>