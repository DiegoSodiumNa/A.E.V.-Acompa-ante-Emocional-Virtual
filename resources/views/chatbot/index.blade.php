<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de Apoyo Emocional</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Helvetica Neue', Arial, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f9f8f1; color: #333; }

        /* PANEL IZQUIERDO */
        .sidebar {
    width: 230px;
    background-color: #f6f3d9;
    border-right: 1px solid #ddd;
    display: flex;
    flex-direction: column;
    height: 100vh;              /* Asegura que la sidebar ocupa toda la pantalla */
    overflow: hidden;           /* Evita scroll doble */
}

/* Contenedor scrollable interno */
.sidebar-content {
    overflow-y: auto;
    padding-bottom: 20px;
}


        .sidebar h3 {
            background-color: #c9a86a;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-weight: bold;
        }

        .sidebar ul { list-style: none; padding: 0 10px; }
        .sidebar li {
            margin: 8px 0;
            font-size: 14px;
            cursor: pointer;
            color: #333;
            display: flex;
            align-items: center;
            transition: background 0.2s;
            padding: 6px;
            border-radius: 5px;
        }
        .sidebar li:hover { background-color: #ece9cf; }

        .sidebar .footer {
            font-size: 10px;
            color: #666;
            text-align: center;
            padding: 10px;
        }

        /* SECCIÓN PRINCIPAL */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fdfcf7;
            padding: 40px;
        }

        .main h2 {
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .input-box {
            background-color: #f7f7e7;
            border: 1px solid #e0dcb8;
            border-radius: 8px;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .input-box p { color: #777; font-size: 16px; }

        #chat-box {
            display: {{ isset($activeChat) ? 'block' : 'none' }};
            border: 1px solid #ccc;
            background: #fff;
            padding: 10px;
            width: 80%;
            max-width: 600px;
            height: 300px;
            overflow-y: scroll;
            margin-top: 20px;
            border-radius: 8px;
        }

        .user { color: #2a62d3; }
        .bot { color: #000; }

        form {
            display: flex;
            width: 80%;
            max-width: 600px;
            margin-top: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px 0 0 8px;
            outline: none;
        }

        button {
            padding: 10px 20px;
            background-color: #c9a86a;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 0 8px 8px 0;
        }
        button:hover { background-color: #b58f53; }
        a.chat-link { display: block; padding: 5px 10px; color: #333; text-decoration: none; border-radius: 4px; }
        a.chat-link.active { background: #ece9cf; font-weight: bold; }

        /* POPUP estilo tarjeta centrada como en la imagen */
.help-popup {
    position: absolute;
    top: 120px;
    left: 300px;
    background: #e6d9a3;
    width: 60%;
    max-width: 700px;
    padding: 25px;
    border-radius: 6px;
    border: 1px solid #c9b97a;
    display: none;
    font-size: 16px;
    color: #222;
}

.help-popup h3 {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 12px;
    font-size: 18px;
    font-weight: bold;
}

.help-popup-close {
    position: absolute;
    top: 10px;
    right: 12px;
    font-size: 20px;
    cursor: pointer;
}

.help-popup ul {
    margin-left: 20px;
    margin-bottom: 15px;
}

.help-popup strong {
    font-weight: bold;
}

    </style>
</head>
<body>

    <!-- PANEL IZQUIERDO -->
    <div class="sidebar">
    <div class="sidebar-content">

        <h3><a href="{{ route('chatbot.index') }}" class="chat-link">💬 Nueva sesión</a></h3>

        <ul>
            <li><strong>Sesiones</strong></li>
            @foreach ($chats as $chat)
                <li>
                    <a href="{{ route('chatbot.index', $chat->id) }}" 
                       class="chat-link {{ isset($activeChat) && $activeChat->id === $chat->id ? 'active' : '' }}">
                        {{ $chat->title ?? 'Sin título' }}
                    </a>
                </li>
            @endforeach
        </ul>

        <ul>
            <li><strong>Herramientas</strong></li>
            <li><a href="{{ route('herramientas.emociones') }}" class="chat-link">Manejo de emociones</a></li>
            <li><a href="{{ route('herramientas.respiracion') }}" class="chat-link">Ejercicios de respiración</a></li>
            <li><a class="help-btn" onclick="openModal()">☎ Números de ayuda</a></li>
        </ul>

    </div>

    <div class="footer">
        Recuerda que siempre la mejor atención vendrá de un profesional.<br>
        El asistente no intenta ni puede reemplazar a un psicólogo o psiquiatra.
    </div>
</div>

    <!-- PARTE PRINCIPAL -->
    <div class="main">
        <h2>¿De qué quieres hablar hoy?</h2>

        <div class="input-box" id="input-placeholder" style="{{ isset($activeChat) ? 'display:none;' : '' }}">
            <p>Te escucho</p>
        </div>

        <div id="chat-box">
            @if(isset($activeChat))
                @foreach($activeChat->messages as $msg)
                    <p class="{{ $msg['role'] === 'user' ? 'user' : 'bot' }}">
                        <strong>{{ $msg['role'] === 'user' ? 'Tú:' : 'Asistente:' }}</strong>
                        {{ $msg['content'] }}
                    </p>
                @endforeach
            @endif
        </div>

        <form id="chat-form">
            <input type="hidden" id="chat_id" value="{{ $activeChat->id ?? '' }}">
            <input type="text" id="message" placeholder="Escribe tu mensaje..." required>
            <button type="submit">Enviar</button>
        </form>
    </div>

  <!-- MODAL -->
  <div class="help-popup" id="helpPopup">
    <span class="help-popup-close" onclick="closePopup()">✕</span>

    <h3>📞 Líneas de apoyo emocional</h3>

    <ul>
        <li>SAPTEL (crisis y apoyo emocional): 55 5259-8121</li>
        <li>SAPTEL (línea gratuita nacional): 800 472-7835</li>
        <li>Línea de la Vida (salud mental / adicciones): 800 911-2000</li>
        <li>LOCATEL (asesoría psicológica 24 h): 55 5658-1111</li>
        <li>Línea de Ayuda Origen: 800 015-1617</li>
    </ul>

    <p><strong>⚠️ Si estás en crisis urgente (riesgo para ti o alguien más), llama al 911.</strong></p>
</div>



    <script>
        function openModal() {
    document.getElementById("helpPopup").style.display = "block";
}

function closePopup() {
    document.getElementById("helpPopup").style.display = "none";
}



        const chatBox = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        const messageInput = document.getElementById('message');
        const placeholderBox = document.getElementById('input-placeholder');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = messageInput.value.trim();
            if (!message) return;

            // Mostrar chatbox y ocultar placeholder
            placeholderBox.style.display = 'none';
            chatBox.style.display = 'block';

            chatBox.innerHTML += `<p class="user"><strong>Tú:</strong> ${message}</p>`;
            messageInput.value = '';

            const chatId = document.getElementById('chat_id').value;

            try {
                const response = await fetch("{{ route('chatbot.hablar') }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message, chat_id: chatId })
                });

                const data = await response.json();

                if (data.reply) {
                    chatBox.innerHTML += `<p class="bot"><strong>Asistente:</strong> ${data.reply}</p>`;
                    if (!chatId && data.chat_id) {
                        window.location.href = `/chatbot/${data.chat_id}`;
                    }
                } else {
                    chatBox.innerHTML += `<p class="bot" style="color:red;"><strong>Error:</strong> ${data.error}</p>`;
                }

            } catch (err) {
                chatBox.innerHTML += `<p class="bot" style="color:red;"><strong>Error:</strong> No se pudo conectar con el servidor.</p>`;
            }

            chatBox.scrollTop = chatBox.scrollHeight;
        });
    </script>
</body>
</html>