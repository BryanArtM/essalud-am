<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Ficha Completa - {{ $adulto->nombres }} {{ $adulto->apellidos }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            height: 200mm;
            overflow: hidden;
        }

        /* Primera página - 2 columnas */
        .page-one {
            width: 100%;
            height: 100%;
        }

        .two-columns {
            width: 100%;
            height: 100%;
        }

        .column {
            width: 48%;
            float: left;
            padding: 5px;
            border: 1px solid #ddd;
            height: 185mm;
            overflow: hidden;
            position: relative;
        }

        .column:last-child {
            margin-left: 1%;
        }

        .column:first-child {
            margin-right: 1%;
        }

        /* Segunda página - página completa */
        .page-two {
            width: 100%;
            padding-top: 10px;
            min-height: 200mm;
            page-break-before: always;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #525252;
            padding-bottom: 8px;
            background: white;
        }

        .header h1 {
            margin: 0;
            color: #242424;
            font-size: 16px;
            font-weight: bold;
        }

        .header h2 {
            margin: 4px 0 0 0;
            color: #666;
            font-size: 13px;
            font-weight: normal;
            text-transform: capitalize;
        }

        .section {
            margin-top: 4px;
            margin-bottom: 4px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #969696;
            text-align: center;
            color: white;
            padding: 3px 5px;
            margin: 0 0 6px 0;
            font-weight: bold;
            font-size: 11px;
            border-radius: 2px;
        }

        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 38%;
            padding: 2px 4px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            font-weight: bold;
            vertical-align: top;
            font-size: 9px;
        }

        .info-value {
            display: table-cell;
            width: 62%;
            padding: 2px 4px;
            border: 1px solid #ccc;
            vertical-align: top;
            font-size: 9px;
        }

        .checkbox-grid {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
        }

        .checkbox-row {
            display: table-row;
        }

        .checkbox-cell {
            display: table-cell;
            width: 50%;
            padding: 2px 4px;
            border: 1px solid #ccc;
            vertical-align: top;
            font-size: 9px;
        }

        .checkbox {
            width: 10px;
            height: 10px;
            display: inline-block;
            border: 1px solid #333;
            margin-right: 3px;
            vertical-align: middle;
        }

        .checkbox.checked {
            background-color: #333;
        }

        .list-table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
            font-size: 10px;
        }

        .list-table th {
            background-color: #f0f0f0;
            padding: 2px 2px;
            border: 1px solid #ccc;
            font-weight: bold;
            text-align: left;
            font-size: 10px;
        }

        .list-table td {
            padding: 2px 2px;
            border: 1px solid #ccc;
            font-size: 10px;
        }

        .tabla-horizontal th {
            padding: 5px 2px;
            min-height: 20px;
            height: 20px;
        }

        .tabla-horizontal td {
            padding: 5px 2px;
            min-height: 20px;
            height: 20px;
        }

        .margen {
            margin-right: 10px;
            margin-left: 10px;
        }

        .data-table {
            table-layout: fixed;
            width: 100%;
        }

        .data-table th:first-child,
        .data-table td:first-child {
            width: 16%;
            
        }

        .data-table th:not(:first-child),
        .data-table td:not(:first-child) {
            width: 5.6%;
        }


        .no-data {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 6px;
            font-size: 9px;
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .compact-section {
            margin-bottom: 2px;
        }

        table {
            border-collapse: collapse;
        }

        .info-grid {
            display: table;
        }

        .checkbox-grid {
            display: table;
        }

        .footer {
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #ccc;
            margin-top: 6px;
            background: white;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- PRIMERA PÁGINA - 2 COLUMNAS -->
        <div class="page-one">
            <div class="two-columns clearfix">
                <!-- PRIMERA COLUMNA: CITAS, TRATAMIENTOS, VALORACIONES -->
                <div class="column">
                    <!-- CITAS MÉDICAS -->
                    @if($adulto->citas->count() > 0)
                        <div class="section compact-section">
                            <h3 class="section-title">HISTORIAL DE CITAS MÉDICAS</h3>
                            <table class="list-table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Médico</th>
                                        <th>Enfermera</th>
                                        <th>Registrado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        for ($i = 0; $i < 10; $i++) {
                                            if (isset($adulto->citas[$i])) {
                                                $cita = $adulto->citas[$i];
                                                echo '<tr>';
                                                echo '<td>' . ($cita->fecha ? \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') : 'N/E') . '</td>';
                                                echo '<td>' . ($cita->medico ?? '-') . '</td>';
                                                echo '<td>' . ($cita->enfermera ?? '-') . '</td>';
                                                echo '<td>' . $cita->created_at->format('d/m/Y') . '</td>';
                                                echo '</tr>';
                                            } else {
                                                echo '<tr>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="section compact-section">
                            <h3 class="section-title">HISTORIAL DE CITAS MÉDICAS</h3>
                            <div class="no-data">No se han registrado citas médicas</div>
                        </div>
                    @endif

                    <!-- TRATAMIENTOS -->
                    @if($adulto->tratamientos->count() > 0)
                        <div class="section compact-section">
                            <h3 class="section-title">TRATAMIENTOS</h3>
                            <table class="list-table">
                                <thead>
                                    <tr>
                                        <th>Medicación</th>
                                        <th>Dosis</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        for ($i = 0; $i < 10; $i++) {
                                            if (isset($adulto->tratamientos[$i])) {
                                                $tratamiento = $adulto->tratamientos[$i];
                                                echo '<tr>';
                                                echo '<td>' . ($tratamiento->medicacion ?? 'No especificada') . '</td>';
                                                echo '<td>' . ($tratamiento->dosis ?? '-') . '</td>';
                                                echo '<td>' . $tratamiento->created_at->format('d/m/Y') . '</td>';
                                                echo '</tr>';
                                            } else {
                                                echo '<tr>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '<td>&nbsp;</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="section compact-section">
                            <h3 class="section-title">TRATAMIENTO FARMACOLÓGICO</h3>
                            <div class="no-data">No se han registrado tratamientos</div>
                        </div>
                    @endif

                    <!-- VALORACIONES -->
                    @if($adulto->valoraciones->count() > 0)
                        <div class="section compact-section">
                            <h3 class="section-title">ADULTO MAYOR 75 AÑOS A MÁS</h3>
                            @foreach($adulto->valoraciones as $valoracion)
                                <table class="info-grid">
                                    <tr class="info-row">
                                        <td class="info-label">Autovalente:</td>
                                        <td class="info-value">
                                            @if($valoracion->autovalente === 1)
                                                SÍ
                                            @elseif($valoracion->autovalente === 0)
                                                NO
                                            @else
                                                No evaluado
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="info-row">
                                        <td class="info-label">Test Barber:</td>
                                        <td class="info-value">{{ $valoracion->test_barber ?? 'No registrado' }}</td>
                                    </tr>
                                    <tr class="info-row">
                                        <td class="info-label">Test Barthel:</td>
                                        <td class="info-value">{{ $valoracion->test_barthel ?? 'No registrado' }}</td>
                                    </tr>
                                    <tr class="info-row">
                                        <td class="info-label">Frágil:</td>
                                        <td class="info-value">
                                            @if($valoracion->fragil === 1)
                                                SÍ
                                            @elseif($valoracion->fragil === 0)
                                                NO
                                            @else
                                                No evaluado
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="info-row">
                                        <td class="info-label">Test Lawton Brody:</td>
                                        <td class="info-value">{{ $valoracion->test_lawton_brody ?? 'No registrado' }}</td>
                                    </tr>
                                    <tr class="info-row">
                                        <td class="info-label">Test Katz:</td>
                                        <td class="info-value">{{ $valoracion->test_katz ?? 'No registrado' }}</td>
                                    </tr>
                                </table>

                                <h4 style="margin: 4px 0 2px 0; color: #666; font-size: 9px;">Fechas de Atención:</h4>
                                <table class="checkbox-grid" style="font-size: 8px;">
                                    <tr class="checkbox-row">
                                        <td class="checkbox-cell">
                                            <strong>Enfermería:</strong>
                                            {{ $valoracion->fecha_enfermeria ? \Carbon\Carbon::parse(time: $valoracion->fecha_enfermeria)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                        <td class="checkbox-cell">
                                            <strong>Medicina:</strong>
                                            {{ $valoracion->fecha_medicina ? \Carbon\Carbon::parse($valoracion->fecha_medicina)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                    </tr>
                                    <tr class="checkbox-row">
                                        <td class="checkbox-cell">
                                            <strong>Nutrición:</strong>
                                            {{ $valoracion->fecha_nutricion ? \Carbon\Carbon::parse($valoracion->fecha_nutricion)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                        <td class="checkbox-cell">
                                            <strong>Psicología:</strong>
                                            {{ $valoracion->fecha_psicologia ? \Carbon\Carbon::parse($valoracion->fecha_psicologia)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                    </tr>
                                    <tr class="checkbox-row">
                                        <td class="checkbox-cell">
                                            <strong>Servicio Social:</strong>
                                            {{ $valoracion->fecha_servicio_social ? \Carbon\Carbon::parse($valoracion->fecha_servicio_social)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                        <td class="checkbox-cell">
                                            <strong>Visita Domiciliaria:</strong>
                                            {{ $valoracion->fecha_visita_domiciliaria ? \Carbon\Carbon::parse($valoracion->fecha_visita_domiciliaria)->format('d/m/Y') : 'No registrado' }}
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    @else
                        <div class="section compact-section">
                            <h3 class="section-title">VALORACIONES</h3>
                            <div class="no-data">No se han registrado valoraciones</div>
                        </div>
                    @endif
                    <div class="footer">
                        <p>Generado el {{ date('d/m/Y H:i') }} - Sistema de Gestión de Adultos Mayores - EsSalud</p>
                    </div>
                </div>

                <!-- SEGUNDA COLUMNA: DATOS PERSONALES, ENFERMEDADES, RIESGOS -->
                <div class="column">
                    <div class="header">
                        <h1>FICHA COMPLETA DEL ADULTO MAYOR</h1>
                        <h2 class="capitalize">{{ $adulto->nombres }} {{ $adulto->apellidos }}</h2>
                    </div>
                    <!-- INFORMACIÓN PERSONAL -->
                    <div class="section compact-section">
                        <h3 class="section-title">INFORMACIÓN PERSONAL</h3>
                        <table class="info-grid">
                            <tr class="info-row">
                                <td class="info-label">Número de Ficha:</td>
                                <td class="info-value">{{ $adulto->numero_ficha ?? 'No registrado' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">IPRESS:</td>
                                <td class="info-value">{{ $adulto->ipress ?? 'No registrado' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Nombres:</td>
                                <td class="info-value capitalize">{{ $adulto->nombres }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Apellidos:</td>
                                <td class="info-value capitalize">{{ $adulto->apellidos }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">DNI:</td>
                                <td class="info-value">{{ $adulto->dni ?? 'No registrado' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Teléfono:</td>
                                <td class="info-value">{{ $adulto->telefono ?? 'No registrado' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Dirección:</td>
                                <td class="info-value">{{ $adulto->direccion ?? 'No registrada' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Email:</td>
                                <td class="info-value">{{ $adulto->email ?? 'No registrado' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Fecha de Nacimiento:</td>
                                <td class="info-value">
                                    {{ $adulto->fecha_nacimiento ? \Carbon\Carbon::parse($adulto->fecha_nacimiento)->format('d/m/Y') : 'No registrado' }}
                                    @if($adulto->fecha_nacimiento)
                                        ({{ $edad }} años)
                                    @endif
                                </td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Fecha de Ingreso:</td>
                                <td class="info-value">
                                    {{ $adulto->fecha_ingreso ? \Carbon\Carbon::parse($adulto->fecha_ingreso)->format('d/m/Y') : 'No registrado' }}
                                </td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Alergias:</td>
                                <td class="info-value">{{ $adulto->alergias ?? 'Ninguna registrada' }}</td>
                            </tr>
                            <tr class="info-row">
                                <td class="info-label">Adulto Mayor Frágil:</td>
                                <td class="info-value">
                                    @if($adulto->adulto_mayor_fragil !== null)
                                        N° {{ $adulto->adulto_mayor_fragil }}
                                    @else
                                        No evaluado
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- ENFERMEDADES -->

                    <!-- ENFERMEDADES -->
                    @if($adulto->enfermedad)
                        <div class="section compact-section">
                            <h3 class="section-title">ENFERMEDADES</h3>
                            <table class="checkbox-grid">
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->enfermedad->obesidad ? 'checked' : '' }}"></span>
                                        Obesidad
                                    </td>
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->enfermedad->dislipidemia ? 'checked' : '' }}"></span>
                                        Dislipidemia
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->enfermedad->hipertension_arterial ? 'checked' : '' }}"></span>
                                        Hipertensión Arterial
                                    </td>
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->enfermedad->diabetes_mellitus ? 'checked' : '' }}"></span>
                                        Diabetes Mellitus
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->enfermedad->erc ? 'checked' : '' }}"></span>
                                        ERC
                                    </td>
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->enfermedad->osteoartrosis ? 'checked' : '' }}"></span>
                                        Osteoartrosis
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->enfermedad->asma ? 'checked' : '' }}"></span>
                                        Asma
                                    </td>
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->enfermedad->epoc ? 'checked' : '' }}"></span>
                                        EPOC
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->enfermedad->itg ? 'checked' : '' }}"></span>
                                        ITG
                                    </td>
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->enfermedad->sindrome_metabolico ? 'checked' : '' }}"></span>
                                        Síndrome Metabólico
                                    </td>
                                </tr>
                            </table>

                            <table class="info-grid">
                                <tr class="info-row">
                                    <td class="info-label">Otras Enfermedades:</td>
                                    <td class="info-value">{{ $adulto->enfermedad->otros ?? 'Ninguna registrada' }}</td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">VISARE Número:</td>
                                    <td class="info-value">{{ $adulto->enfermedad->visare_numero ?? 'No registrado' }}</td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">VISARE Fecha:</td>
                                    <td class="info-value">
                                        {{ $adulto->enfermedad->visare_fecha ? \Carbon\Carbon::parse($adulto->enfermedad->visare_fecha)->format('d/m/Y') : 'No registrado' }}
                                    </td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">Estadio 1-3A Numero:</td>
                                    <td class="info-value">
                                        {{ $adulto->enfermedad->estadio_1_3a_numero ?? 'No registrado' }}
                                    </td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">Estadio 1-3A Fecha:</td>
                                    <td class="info-value">
                                        {{ $adulto->enfermedad->estadio_1_3a_fecha ? \Carbon\Carbon::parse($adulto->enfermedad->estadio_1_3a_fecha)->format('d/m/Y') : 'No registrado' }}
                                    </td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">Estadio 3B-5 Numero:</td>
                                    <td class="info-value">{{ $adulto->enfermedad->estadio_3b_5_numero ?? 'No registrado' }}
                                    </td>
                                </tr>
                                <tr class="info-row">
                                    <td class="info-label">Estadio 3B-5 Fecha:</td>
                                    <td class="info-value">
                                        {{ $adulto->enfermedad->estadio_3b_5_fecha ? \Carbon\Carbon::parse($adulto->enfermedad->estadio_3b_5_fecha)->format('d/m/Y') : 'No registrado' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="section compact-section">
                            <h3 class="section-title">ENFERMEDADES</h3>
                            <div class="no-data">No se han registrado enfermedades</div>
                        </div>
                    @endif


                    <!-- FACTORES DE RIESGO -->
                    @if($adulto->riesgo)
                        <div class="section compact-section">
                            <h3 class="section-title">FACTORES DE RIESGO</h3>
                            <table class="checkbox-grid">
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->sobrepeso ? 'checked' : '' }}"></span>
                                        Sobrepeso
                                    </td>
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->sedentarismo ? 'checked' : '' }}"></span>
                                        Sedentarismo
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->tabaco ? 'checked' : '' }}"></span>
                                        Tabaco
                                    </td>
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->alcohol ? 'checked' : '' }}"></span>
                                        Alcohol
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->estres ? 'checked' : '' }}"></span>
                                        Estrés
                                    </td>
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->bajo_peso ? 'checked' : '' }}"></span>
                                        Bajo Peso
                                    </td>
                                </tr>
                                <tr class="checkbox-row">
                                    <td class="checkbox-cell">
                                        <span
                                            class="checkbox {{ $adulto->riesgo->perimetro_abdominal_aumentado ? 'checked' : '' }}"></span>
                                        Perímetro Abd. Aumentado
                                    </td>
                                    <td class="checkbox-cell">
                                        <span class="checkbox {{ $adulto->riesgo->hdl_bajo ? 'checked' : '' }}"></span>
                                        HDL Bajo
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="section compact-section">
                            <h3 class="section-title">FACTORES DE RIESGO</h3>
                            <div class="no-data">No se han registrado factores de riesgo</div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- SEGUNDA PÁGINA - PÁGINA COMPLETA -->
        <div class="page-two">
            <!-- EVALUACIONES MÉDICAS -->
            @if($adulto->evaluaciones->count() > 0)
                <div class="section compact-section margen">
                    <h3 class="section-title">EVALUACIONES MÉDICAS</h3>
                    <p style="margin: 6px 0; font-size: 10px;">
                        <strong>Peso Aceptable (kg):</strong>
                        &nbsp;{{ $adulto->evaluaciones->last()->peso_aceptable ?? '-' }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <strong>Talla (cm):</strong>&nbsp; {{ $adulto->evaluaciones->last()->talla ?? '-' }}
                    </p>

                    <table class="list-table data-table tabla-horizontal">
                        <thead>
                            <tr>
                                <th>EVALUACIONES</th>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        echo '<td>   </td>';
                                    }
                                @endphp
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Peso (kg)</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->peso ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Presión Arterial</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->presion_arterial ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Glucosa</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->glucosa ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>HB Glicosilada (HbA1C%)</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->hb_glicosilada ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>IMC</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->imc ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Perimetro Abdominal</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->perimetro_abdominal ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Evaluación Pie DM </strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->evaluacion_pie_dm ?? '-') : '';
                                        echo '<td style="text-transform: capitalize;">' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Test Morisky Green</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->test_morisky_green ?? '-') : '';
                                        echo '<td style="text-transform: capitalize;">' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Vacuna Influenza</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->evaluaciones[$i - 1])) {
                                            if ($adulto->evaluaciones[$i - 1]->vacuna_influenza === 1) {
                                                $valor = 'SÍ';
                                            } elseif ($adulto->evaluaciones[$i - 1]->vacuna_influenza === 0) {
                                                $valor = 'NO';
                                            } else {
                                                $valor = '-';
                                            }
                                        }
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Vacuna Neumococo</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->evaluaciones[$i - 1])) {
                                            if ($adulto->evaluaciones[$i - 1]->vacuna_neumococo === 1) {
                                                $valor = 'SÍ';
                                            } elseif ($adulto->evaluaciones[$i - 1]->vacuna_neumococo === 0) {
                                                $valor = 'NO';
                                            } else {
                                                $valor = '-';
                                            }
                                        }
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong> PERFIL RENAL: </br> Microalbuminuria</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->microalbuminuria ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Creatinina en sangre</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->creatinina ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Tasa albuminuria/creatinuria</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->tasa_albuminuria_creatinuria ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Tasa Filtración Glomerular estamida ml/min/1.73 m2</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = isset($adulto->evaluaciones[$i - 1]) ? ($adulto->evaluaciones[$i - 1]->tasa_filtracion_glomerular ?? '-') : '';
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Control médico por enfermedad renal (fecha)</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->evaluaciones[$i - 1])) {
                                            $valor = $adulto->evaluaciones[$i - 1]->control_renal_fecha ? \Carbon\Carbon::parse($adulto->evaluaciones[$i - 1]->control_renal_fecha)->format('d/m/Y') : 'No registrado';
                                        }
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="section compact-section margen">
                    <h3 class="section-title">EVALUACIONES MÉDICAS</h3>
                    <div class="no-data">No se han registrado evaluaciones médicas</div>
                </div>
            @endif

            <!-- ACTIVIDADES EDUCATIVAS -->
            @if($adulto->actividadesEducativas->count() > 0)
                <div class="section compact-section margen">
                    <h3 class="section-title">ACTIVIDADES EDUCATIVAS</h3>
                    <table class="list-table data-table tabla-horizontal">
                        <tbody>
                            <tr>
                                <td><strong>Fecha</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->actividadesEducativas[$i - 1])) {
                                            $valor = $adulto->actividadesEducativas[$i - 1]->fecha ? \Carbon\Carbon::parse($adulto->actividadesEducativas[$i - 1]->fecha)->format('d/m/Y') : 'N/E';
                                        }
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Sesión</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->actividadesEducativas[$i - 1])) {
                                            $valor = $adulto->actividadesEducativas[$i - 1]->numero_sesion ?? '-';
                                        }
                                        echo '<td class="text-center">' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                            <tr>
                                <td><strong>Registrado</strong></td>
                                @php
                                    for ($i = 1; $i <= 15; $i++) {
                                        $valor = '';
                                        if (isset($adulto->actividadesEducativas[$i - 1])) {
                                            $valor = $adulto->actividadesEducativas[$i - 1]->created_at->format('d/m/Y');
                                        }
                                        echo '<td>' . $valor . '</td>';
                                    }
                                @endphp
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="section compact-section margen">
                    <h3 class="section-title">ACTIVIDADES EDUCATIVAS</h3>
                    <div class="no-data">No se han registrado actividades educativas</div>
                </div>
            @endif
        </div> <!-- Cierre de page-two -->
    </div> <!-- Cierre de container -->

    <script>
        // Auto-imprimir cuando se carga el PDF
        window.onload = function() {
            // Esperar un momento para que el PDF se renderice completamente
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>

</html>