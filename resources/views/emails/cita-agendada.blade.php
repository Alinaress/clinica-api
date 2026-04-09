<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto;">

    <div style="background-color: #2d6a9f; padding: 20px; text-align: center;">
        <h1 style="color: white; margin: 0;">Clínica</h1>
    </div>

    <div style="padding: 30px;">
        <h2>✅ Cita Agendada Exitosamente</h2>
        <p>Hola <strong>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</strong>,</p>
        <p>Tu cita ha sido agendada con los siguientes detalles:</p>

        <table style="border-collapse: collapse; width: 100%; margin-top: 15px;">
            <tr style="background-color: #f2f2f2;">
                <td style="padding: 10px; border: 1px solid #ddd;"><strong>Doctor</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    Dr. {{ $cita->doctor->nombre }} {{ $cita->doctor->apellido }}
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;"><strong>Fecha y hora</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $cita->fecha_hora }}</td>
            </tr>
            <tr style="background-color: #f2f2f2;">
                <td style="padding: 10px; border: 1px solid #ddd;"><strong>Motivo</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $cita->motivo }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;"><strong>Duración</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $cita->duracion_min }} minutos</td>
            </tr>
        </table>

        <p style="margin-top: 25px;">Si tienes alguna duda no dudes en contactarnos.</p>
        <p><em>Equipo de la Clínica</em></p>
    </div>

    <div style="background-color: #f2f2f2; padding: 15px; text-align: center; font-size: 12px; color: #999;">
        Este es un correo automático, por favor no responder.
    </div>

</body>
</html>