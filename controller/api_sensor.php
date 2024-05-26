<?php
    function isConnected() {
        $connected = @fsockopen("www.google.com", 80); 
        if ($connected){
            fclose($connected);
            return true;
        }
        return false;
    }

    if(isConnected()) {
        $api_key = "W030R0LZO5GEVOQM";
        $url = "https://api.thingspeak.com/channels/2538413/feed.json?api_key=" . $api_key . "&results=1";
        $response = file_get_contents($url);
        $data = json_decode($response);

        if ($data !== false && isset($data->feeds[0])) {
            $umidade = $data->feeds[0]->field1;
            echo "<div class='progress-bar' id='progress-bar'>
                    <div class='progress-bar-inner' id='progress-bar-inner'></div>
                    <div class='progress-value' id='progress-value'></div>
                  </div>";
            echo "<div class='value'>Umidade do Solo: " . $umidade . "%</div>";
        } else {
            echo "<div class='value'>Não foi possível obter os dados.</div>";
        }
    } else {
        echo "<div class='value'>Falha na conexão</div>";
    }
?>