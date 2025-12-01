<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.P.V - Aquí estoy si me necesitas</title>

    <style>
        body {
            margin: 0;
            font-family: "Arial", sans-serif;
            background: #f7f7f7;
            color: #333;
        }

        /* ---- NAVBAR SUPERIOR ---- */
        .navbar {
            background: #cda669;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            color: #000;
            font-size: 18px;
        }

        .navbar .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar img {
            height: 22px;
        }

        /* ---- CONTENIDO ---- */
        .container {
            max-width: 900px;
            margin: 60px auto;
            text-align: center;
            padding: 0 20px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 25px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* ---- BOTÓN ---- */
        .btn {
            background: #d2b075;
            color: #fff;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: #b89455;
        }

        /* ---- NOTA FINAL ---- */
        .footer-note {
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="left">
            <img src="https://img.icons8.com/material-rounded/24/speech-bubble.png" alt="icon">
            <span>A.P.V</span>
        </div>
        <span>Números de ayuda</span>
    </div>

    <!-- CONTENIDO -->
    <div class="container">
        <h1>Aquí estoy si me necesitas...</h1>

        <p>
            Expresarse emocionalmente es importante porque te ayuda a liberar lo que llevas 
            dentro, entender mejor lo que sientes y evitar que todo se acumule hasta explotar.
        </p>

        <p>
            Cuando dices lo que te pasa, te sientes más ligero, conectas mejor con los demás 
            y puedes recibir apoyo cuando lo necesitas. Además, hablar de tus emociones te 
            permite conocerte más y manejar las situaciones con más calma y claridad.
        </p>

        <a href="{{ route('chatbot.index') }}">
          <button class="btn">Quiero saber mas</button>
        </a>

        <div class="footer-note">
            El asistente no intenta ni puede reemplazar a un psicólogo o psiquiatra.<br>
            Recuerda que siempre la mejor atención vendrá de un profesional.
        </div>
    </div>

</body>
</html>
