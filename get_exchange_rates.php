<?php

$apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';


$ch = curl_init();

// Setarea opțiunilor cURL
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);


$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo json_encode(['success' => false, 'error' => 'Eroare cURL: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

$data = json_decode($response, true);


if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Eroare la decodarea răspunsului JSON. Răspuns primit: ' . $response]);
    exit;
}


if (!isset($data['rates'])) {
    echo json_encode(['success' => false, 'error' => 'Datele de schimb valutar lipsesc din răspuns.']);
    exit;
}

echo json_encode(['success' => true, 'rates' => $data['rates']]);
?>
