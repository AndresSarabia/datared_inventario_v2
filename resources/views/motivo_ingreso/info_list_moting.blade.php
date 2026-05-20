<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listado de motings</title>
    <style type="text/css">
        .page-break {
            page-break-after: always;
            position: relative;
        }

        #titulo {
            text-align: center;
        }

        #det_list_moting {
            width: 650px;
            margin: auto;
            font-size: 12px;
        }

        #det_list_moting tr th {
            font-size: 12px;
            text-align: left;
        }

        #tod {
            float: left;
            margin-left: 40px;
            font-size: 12px;
        }

        #fot {
            margin-top: 200px;
            font-size: 10px;
        }

        #log {
            float: right;
            margin-right: 40px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="page-break">
        <header class="cabecera">
            <div id="logo">
            </div>
            <div>
                <h3 id="titulo">LISTA DE MOTIVOS INGRESO</h3>
            </div>
            <hr id="lin_ar">
            <div class="sub">
                <div id="tod"><b><span>Motivo Ingreso: </span> </b>TODOS</div>
                <div id="log"><b><span>Reporte Usu.: </span></b>{{ $usu_log }}</div><br>
            </div>
        </header>
        <hr>
        <table class="table table-bordered" id="det_list_moting">
            <thead>
                <tr>
                    <th style="width: 200px;">Descripción</th>
                    <th style="width: 200px;">Observación</th>
                    <th style="width: 50px;">Estado</th>
                </tr>
            </thead>
            <br>
            <tbody>
                @foreach ($motings as $moti)
                    <tr>
                        <td>{{ $moti->descripcion }}</td>
                        <td>{{ $moti->obsv }}</td>
                        <td>
                            @if ($moti->estado == 1)
                                Habilitado
                            @else
                                Deshabilitado
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
