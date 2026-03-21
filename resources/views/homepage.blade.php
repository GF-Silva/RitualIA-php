<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Embed YouTube</title>
</head>
<body>

  <input type="text" id="musicInput" onchange="getMusicLink()"/>

  <script>

    async function getMusicLink() {
        const name = document.getElementById("musicInput").value;

        const response = await fetch('/get-music-url', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 'name': name })
        });

        const dados = await response.json();
        console.log(dados);

        if ( response.ok ) {
            url = dados["url"];
        
            document.getElementById("player").src = `https://w.soundcloud.com/player/?url=${url}`;

        } else {
            console.log("nao encontrado")
            document.getElementById("player").src = '';
        }
    }

  </script>

  <iframe id="player"
    width="100%" height="166"
    frameborder="0" allow="autoplay">
  </iframe>

</body>
</html>