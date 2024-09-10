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
    "09/09" => ["Fábio Siqueira"],
    "18/09" => ["Dayane"],
    "09/12" => ["Ricardo"],
];

$aniversariosOvelhasMarielly = [
    "01/01" => ["Renato"],
    "05/01" => ["Adrian - Renato"],
    "07/01" => ["Analuze"],
    "29/01" => ["Divilmar"],
    "16/02" => ["José Miguel do Reiner"],
    "27/02" => ["David do Divilmar"],
    "13/03" => ["Marielly"],
    "24/03" => ["Paulo Ricardo"],
    "27/03" => ["Mariane do Marcos"],
    "29/03" => ["Ariella do Elton"],
    "08/04" => ["Jéssica"],
    "20/04" => ["Andréia"],
    "22/04" => ["Matias do Elto"],
    "03/05" => ["Pedro Victor do Marcos"],
    "07/05" => ["Thiago"],
    "13/05" => ["Maria Júlia do Katatau"],
    "15/05" => ["Valney (Katatau)"],
    "09/06" => ["Aurora do Vinicius"],
    "10/06" => ["Miguel do Tiago"],
    "11/06" => ["Marcela", "Pricila"],
    "13/06" => ["Letícia"],
    "19/06" => ["Alice Hellena do Renato"],
    "30/06" => ["Robson", "Marcos M. Diniz"],
    "22/07" => ["Vinicius"],
    "23/07" => ["Marcos"],
    "25/07" => ["Miguel (Andréia e Robson)"],
    "31/07" => ["Elton"],
    "16/08" => ["Ana Júlia do Divilmar"],
    "30/08" => ["Laura"],
    "13/09" => ["Paulo Ricardo"],
    "14/09" => ["Messias"],
    "15/09" => ["Davi do Katatau"],
    "16/09" => ["Lívia", "Cleo Augusto"],
    "21/09" => ["Aline"],
    "30/09" => ["Nathallia Aguiar"],
    "04/10" => ["Angela"],
    "18/10" => ["Karlene"],
    "25/11" => ["Reiner", "Maria Sophia do Elton"],
    "12/12" => ["Djalma Neto do Elton"],
    "13/12" => ["Nathalia"],
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
        sendMessage('Aniversariante(s) de hoje (' . date("d/m") . '): ' . implode(', ', $aniversariantesHoje[0]));
    } else {
        sendMessage('Ninguém faz aniversário hoje (' . date("d/m") . ').');
    }

    // Ovelhas Marielly
    $aniversariantesHoje = [];

    foreach ($aniversariosOvelhasMarielly as $data => $nome) {
        if ($data == date("d/m")) {
            $aniversariantesHoje[] = $nome;
        }
    }

    if ($aniversariantesHoje) {
        sendMessage('Aniversariante(s) de hoje (' . date("d/m") . '): ' . implode(', ', $aniversariantesHoje[0]), 2);
    } else {
        sendMessage('Ninguém faz aniversário hoje (' . date("d/m") . ').', 2);
    }
} elseif ($opcaoAniversariantes == 'amanha') {
    $aniversariantesAmanha = [];

    foreach ($aniversarios as $data => $nome) {
        if ($data == date("d/m", strtotime("+1 day"))) {
            $aniversariantesAmanha[] = $nome;
        }
    }

    if ($aniversariantesAmanha) {
        sendMessage('Aniversariante(s) de amanhã (' . date("d/m", strtotime("+1 day")) . '): ' . implode(', ', $aniversariantesAmanha[0]));
    } else {
        sendMessage('Ninguém fará aniversário amanhã (' . date("d/m", strtotime("+1 day")) . ').');
    }

    // Ovelhas Marielly
    $aniversariantesAmanha = [];

    foreach ($aniversariosOvelhasMarielly as $data => $nome) {
        if ($data == date("d/m", strtotime("+1 day"))) {
            $aniversariantesAmanha[] = $nome;
        }
    }

    if ($aniversariantesAmanha) {
        sendMessage('Aniversariante(s) de amanhã (' . date("d/m", strtotime("+1 day")) . '): ' . implode(', ', $aniversariantesAmanha[0]), 2);
    } else {
        sendMessage('Ninguém fará aniversário amanhã (' . date("d/m", strtotime("+1 day")) . ').', 2);
    }
}

function sendMessage($message, $pastora = 1)
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
    // Vinícius
    $phone = '+556283156636';
    $apikey = '225716';

    $url = 'https://api.callmebot.com/whatsapp.php?source=php&phone=' . $phone . '&text=' . urlencode($message) . '&apikey=' . $apikey;
    file_get_contents($url);

    switch ($pastora) {
        case 1:
            // Fábio Siqueira
            $phone = '+556292189216';
            $apikey = '2769676';

            $url = 'https://api.callmebot.com/whatsapp.php?source=php&phone=' . $phone . '&text=' . urlencode($message) . '&apikey=' . $apikey;
            file_get_contents($url);

            break;

        case 2:
            // Marielly
            $phone = '+556283156636';
            $apikey = '225716';

            $url = 'https://api.callmebot.com/whatsapp.php?source=php&phone=' . $phone . '&text=' . urlencode($message) . '&apikey=' . $apikey;
            file_get_contents($url);

            break;

        default:
            break;
    }
}
