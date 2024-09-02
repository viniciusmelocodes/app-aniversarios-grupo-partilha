<?php

$aniversarios = [
    "02/01" => ["Ikaro"],
    "19/01" => ["Júlia"],
    "22/01" => ["Daniel"],
    "12/02" => ["Bia Pastora"],
    "13/02" => ["João Miguel Leão (Rayane)"],
    "16/02" => ["Eloah"],
    "17/02" => ["Mariana (Angelita)"],
    "27/02" => ["Júlia (Bia)"],
    "07/03" => ["Helena (Bia)", "Deborah"],
    "09/03" => ["Vanessa", "Luiz Guilherme (Deborah)"],
    "19/03" => ["Edson Pastor"],
    "22/03" => ["Lucas (Maria Helena)"],
    "26/03" => ["Maria Luiza (Bia)"],
    "03/04" => ["Bianca (Vanessa)"],
    "16/04" => ["Beatriz (Vanessa)"],
    "19/04" => ["Angelita"],
    "08/06" => ["Rodrigo Leão (Rayane)"],
    "11/06" => ["Karla Kristina (Rayane)"],
    "19/06" => ["Vinícius"],
    "12/07" => ["Geovani (Maria Helena)"],
    "26/07" => ["Welson"],
    "22/08" => ["Rayane Mendes"],
    "25/08" => ["Daniel Filho (Angelita)"],
    "28/08" => ["Maria Helena"],
    "30/08" => ["Rodrigo Almeida"],
    "09/09" => ["Fabio Siqueira"],
    "18/09" => ["Dayane"],
    "09/12" => ["Ricardo"],
];

$opcaoAniversariantes = $argv[1];

if ($opcaoAniversariantes == 'hoje') {
    $aniversariantesHoje = [];
    
    foreach ($aniversarios as $data => $nome) {
        if ($data == date("d/m")) {
            $aniversariantesHoje[] = $nome;
        }
    }
    
    if ($aniversariantesHoje) {
        sendMessage('Aniversariantes de hoje (' . date("d/m") . '): ' . implode(', ', $aniversariantesHoje[0]));
    } else {
        sendMessage('Ninguém faz aniversário hoje (' . date("d/m") . ').');
    }
} elseif ($opcaoAniversariantes == 'amanha') {
    $aniversariantesAmanha = [];

    foreach ($aniversarios as $data => $nome) {
        if ($data == date("d/m", strtotime("+1 day"))) {
            $aniversariantesAmanha[] = $nome;
        }
    }

    if ($aniversariantesAmanha) {
        sendMessage('Aniversariantes de amanhã (' . date("d/m", strtotime("+1 day")) . '): ' . implode(', ', $aniversariantesAmanha[0]));
    } else {
        sendMessage('Ninguém faz aniversário amanhã (' . date("d/m", strtotime("+1 day")) . ').');
    }
}

function sendMessage($message)
{
    // Telegram
    $botApiToken = '2055543371:AAEiICiuiYj9xcZ1hIoD-Jb06kGEUIf5sQQ';
    $chatId = '97153814';

    $query = http_build_query([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage?{$query}";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ]);
    curl_exec($curl);
    curl_close($curl);

    // WhatsApp
    $phone = '+556283156636';
    $apikey = '225716';

    $url = 'https://api.callmebot.com/whatsapp.php?source=php&phone=' . $phone . '&text=' . urlencode($message) . '&apikey=' . $apikey;
    return file_get_contents($url);
}
