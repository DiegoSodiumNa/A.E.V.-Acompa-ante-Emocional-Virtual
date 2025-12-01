<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reconoce lo que sientes</title>
  <style>
    body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 2rem;
      background-color: #fafafa;
      color: #222;
      line-height: 1.6;
    }

    .container {
      max-width: 700px;
      margin: 0 auto;
    }

    h1, h2 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-top: 2rem;
      margin-bottom: 1rem;
    }

    .card {
      background-color: #f9f9e9;
      border: 1px solid #f1f1d3;
      border-radius: 8px;
      padding: 1rem 1.5rem;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    ul {
      margin: 0;
      padding-left: 1.2rem;
    }

    li {
      margin-bottom: 0.8rem;
    }

    em {
      font-style: italic;
    }

    /* Estilo del botón "atrás" (flecha) */
    .back {
      font-size: 1.5rem;
      text-decoration: none;
      color: #333;
      display: inline-block;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <a href=""{{ route('chatbot.index') }}" class="back">←</a>

    <h1>1. Reconoce lo que sientes</h1>
    <div class="card">
      <ul>
        <li>Haz una pausa y ponle nombre a la emoción: “Estoy frustrado”, “me siento triste”, “tengo miedo”, “siento alegría”.</li>
        <li>Nombrar la emoción activa partes racionales del cerebro (como la corteza prefrontal), ayudando a calmar la respuesta emocional. Puedes decirte: <em>“Esto que siento es enojo, y está bien sentirlo.”</em></li>
      </ul>
    </div>

    <h2>2. Permítete sentir sin juzgar</h2>
    <div class="card">
      <ul>
        <li>Las emociones no son buenas ni malas, solo informan algo sobre tus necesidades.</li>
        <li>Ejemplo: el enojo puede indicar que alguien cruzó un límite; la tristeza puede señalar una pérdida; el miedo, una amenaza. Aceptar la emoción es el primer paso para procesarla.</li>
      </ul>
    </div>

    <h2>3. Regula tu cuerpo</h2>
    <div class="card">
      Las emociones se viven en el cuerpo. Si no lo calmas, la mente sigue alterada. Prueba técnicas de regulación fisiológica:
      <ul>
        <li>Respirar profundamente (4 segundos inhalar, 6 exhalar)</li>
        <li>Salir a caminar o moverte</li>
        <li>Estirarte o tomar agua</li>
        <li>Dormir bien</li>
    </div>

    <h2>4. Expresa la emoción de forma segura</h2>
    <div class="card">
      Busca una vía de expresión:
      <ul>
        <li>Hablar con alguien de confianza</li>
        <li>Escribir lo que sientes</li>
        <li>Dibujar, tocar música, hacer ejercicio</li>
    </div>

    <h2>5. Identifica la causa y la necesidad</h2>
    <div class="card">
      Pregúntate:
      <ul>
        <li>¿Qué la provocó realmente?</li>
        <li>¿Qué necesito o qué valor mío se vio afectado?</li>
      </ul>
      “Me enojé porque siento que no me escuchan.”
      <br>
      Entonces la necesidad podría ser ser tomado en cuenta.
    </div>

    <h2>6. Responde conscientemente</h2>
    <div class="card">
      Una vez calmado y con claridad, puedes decidir qué hacer:
      <ul>
        <li>Establecer límites</li>
        <li>Comunicar tus sentimientos de forma asertiva</li>
        <li>Cambiar algo que depende de ti</li>
        <li>O simplemente aceptar que no puedes controlar ciertas cosas</li>
    </div>

    <h2>7. Practica hábitos que fortalecen tu equilibrio emocional</h2>
    <div class="card">
      <ul>
        <li>Dormir bien</li>
        <li>Alimentarte adecuadamente</li>
        <li>Hacer ejercicio regularmente</li>
        <li>Meditar o practicar mindfulness</li>
        <li>Evitar saturarte de redes o noticias negativas</li>
    </div>
  </div>

</body>
</html>
