<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Listado de Almacenes</title>
    <style type="text/css">
        #titulo {
            text-align: center;
        }

        #det_list_alm {
            width: 650px;
            margin: auto;
            font-size: 12px;
        }

        #det_list_alm tr th {
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
            font-size: 10px;
        }
    </style>
</head>

<body>
    <header class="cabecera">
        <div id="logo">
        </div>
        <div>
            <h3 id="titulo">LISTA DE ALMACENES</h3>
        </div>
        <hr id="lin_ar">
        <div class="sub">
            <div id="tod"><b><span>Almacén: </span> </b>TODOS</div>
            <div id="log"><b><span>Reporte Usu.: </span></b>{{ $usu_log }}</div><br>
        </div>
    </header>
    <hr>
    <table class="table table-bordered" id="det_list_alm">
        <thead>
            <tr>
                <th style="width: 40px;">Código</th>
                <th style="width: 200px;">Descripción</th>
                <th style="width: 50px;">Estado</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($almacenes as $alm)
                <tr>
                    <td>{{ $alm->codigo }}</td>
                    <td>{{ $alm->descripcion }}</td>
                    <td>
                        @if ($alm->estado == 1)
                            Habilitado
                        @else
                            Deshabilitado
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
