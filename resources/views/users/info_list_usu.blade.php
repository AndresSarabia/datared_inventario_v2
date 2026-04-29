<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
    <style type="text/css">
        #titulo {
            text-align: center;
        }

        #det_list_usu {
            width: 100%;
            margin: auto;
            font-size: 12px;
        }

        #det_list_usu tr th {
            font-size: 12px;
            text-align: left;
        }

        #tod {
            float: left;
            font-size: 12px;
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
            <h3 id="titulo">LISTA DE USUARIOS</h3>
        </div>
        <hr id="lin_ar">
        <div class="sub">
            <div id="tod"><b><span>Usuario: </span> </b>TODOS</div>
            <div id="log"><b><span>Reporte Usu.: </span></b>{{ $usu_log }}</div><br>
        </div>
    </header>
    <hr>
    <table class="table table-bordered" id="det_list_usu">
        <thead>
            <tr>
                <th style="width: 50px;">Perfil</th>
                <th style="width: 60px;">Nombre</th>
                <th style="width: 100px;">Apellidos</th>
                <th style="width: 60px;">C.I.</th>
                <th style="width: 150px;">Email</th>
                <th style="width: 100px;">Cargo</th>
                <th style="width: 60px;">Estado</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($usuarios as $usu)
                <tr>
                    <td>
                        @if ($usu->perfil === 'administrador')
                            Administrador
                        @elseif ($usu->perfil === 'supervisor')
                            Supervisor
                        @elseif ($usu->perfil === 'tecnico')
                            Técnico
                        @else
                            {{ ucfirst($usu->perfil) }}
                        @endif
                    </td>
                    <td>{{ $usu->nombre }}</td>
                    <td>{{ $usu->apellidos }}</td>

                    <td>{{ $usu->ci }}</td>
                    <td>{{ $usu->email }}</td>
                    <td>{{ $usu->cargo }}</td>
                    <td>
                        {{ $usu->estado == '1' ? 'Habilitado' : 'Deshabilitado' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
