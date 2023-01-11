<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Парсер ссыки на видео</title>
    <h1>Парсер ссыки на видео</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<input type="text" id="url" placeholder="Введите url">
<button style="background-color: green" onclick="sendUrl()">Распарсить</button>
<br><br>
<div id="resultPars">

</div>
</body>
</html>

<script>
    function sendUrl(){
        var input = $('#url');
        var resultDiv = $('#resultPars');
        var url = input.val().trim();

        if(url.length > 0) {
            resultDiv.empty();
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: {'URL': url},
                dataType: "json",
                success: function (data) {
                    if(data.ERROR.length > 0){
                        resultDiv.append(data.ERROR);
                    }else{
                        resultDiv.append('Название видеохостинга: <b>' + data.NAME_HOST + '</b>');
                        resultDiv.append('<br>ID видео: <b>' + data.VIDEO_ID + '</b>');
                        resultDiv.append('<br>' + data.HTML_FRAME);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('error ajax');
                }
            });
        }
        else{
            $('#resultPars').append('Url не введен');
        }
    }
</script>
