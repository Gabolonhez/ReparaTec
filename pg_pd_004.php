<?php
include 'includes/conexao.php';
session_start();
$ped_num = $_GET['ped_num'];
$acesso = $_SESSION['acesso'];
$cod = $_SESSION['cod'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bate-papo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
		* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.chat-container {
    width: 100%;
    max-width: 500px;
    height: 600px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

.chat-header {
    padding: 15px;
    background-color: #007bff;
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    text-align: center;
}

.chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}

.message {
    margin-bottom: 15px;
    padding: 10px 15px;
    border-radius: 20px;
    max-width: 80%;
    position: relative;
}

.message.received {
    background-color: #e1e1e1;
    align-self: flex-start;
    margin-bottom: 20px;
}

.message.sent {
    background-color: #007bff;
    color: white;
    align-self: flex-end;
    margin-bottom: 20px;
}

.timestamp {
    font-size: 0.8em;
    color: #888;
    position: absolute;
    bottom: -18px;
    right: 10px;
}

.chat-input {
    padding: 15px;
    background-color: #f4f4f9;
    display: flex;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.chat-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    margin-right: 10px;
}

.chat-input button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.chat-input button:hover {
    background-color: #0056b3;
}

	</style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <h2>Bate-papo</h2>
        </div>
        <div class="chat-messages" id="chat-messages">
            <!-- Mensagens serão carregadas aqui -->
        </div>
        <form id="chat-form">
            <div class="chat-input">
                <input type="text" name="mensagem-enviada" id="mensagem-enviada" placeholder="Digite sua mensagem...">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        var ped_num = '<?php echo $ped_num; ?>'; // Obtendo o valor de ped_num do PHP

        function loadMessages() {
            $.ajax({
                url: 'chat/get_messages.php?ped_num=' + ped_num, // Passando ped_num via GET
                method: 'GET',
                success: function(data) {
                    $('#chat-messages').html(data);
                }
            });
        }

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();
            var mensagem = $('#mensagem-enviada').val();
            if (mensagem !== "") {
                $.ajax({
                    url: 'chat/send_message.php?ped_num=' + ped_num, // Passando ped_num via GET
                    method: 'POST',
                    data: { mensagem_enviada: mensagem },
                    success: function(data) {
                        $('#mensagem-enviada').val('');
                        loadMessages();
                    }
                });
            }
        });

        // Carregar mensagens a cada 2 segundos
        setInterval(loadMessages, 2000);
        loadMessages();
    </script>
</body>

</html>
