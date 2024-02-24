<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="font-family: Arial, sans-serif; color: #333; text-align: center;">
    <table style="max-width: 950px; width: 100%; margin: auto;">
        <tr>
            <td>
                <img style="width: 100%; height: auto; display: block; margin: 0; padding: 0;"
                    src="{{ asset('assets/mailing/mailing-header.jpg') }}" alt="Mailing Header">
                <div
                    style="font-size: 14px; line-height: 1.5; height: 100%; margin: 0; padding: 40px; text-align: center; background-color: #f0f0f0; color: #0a0541;">
                    <h1
                        style="font-size: 28px; font-family: 'Elephant', serif; font-style: normal; font-weight: 300; text-transform: uppercase; margin: 0; padding: 0;">
                        {!! $title !!}</h1>
                    <p
                        style="font-size: 19px; font-family: Helvetica, Arial, sans-serif; margin: 0; margin-top: 20px; padding: 0;">
                        {!! $body !!}
                    </p>
                </div>
                <a href="http://budpass.co" target="_blank" rel="noopener noreferrer"><img
                        style="width: 100%; height: auto; display: block; margin: 0; padding: 0;"
                        src="{{ asset('assets/mailing/mailing-body.jpg') }}" alt="Mailing Body"></a>
                <img style="width: 100%; height: auto; display: block; margin: 0; padding: 0;"
                    src="{{ asset('assets/mailing/mailing-footer.jpg') }}" alt="Mailing Footer">
            </td>
        </tr>
    </table>
</body>

</html>
