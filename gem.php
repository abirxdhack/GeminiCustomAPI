<?php
// Configuration
define('GEMINI_API_KEY', 'YourGeminiAPIKeyHere');
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . GEMINI_API_KEY);

// Function to send user input to Gemini API and return the AI response
function chat_with_ai($user_input) {
    $payload = json_encode([
        'contents' => [['role' => 'user', 'parts' => [['text' => $user_input]]]],
        'generationConfig' => [
            'temperature' => 1,
            'topP' => 0.95,
            'topK' => 40,
            'maxOutputTokens' => 1024
        ]
    ]);
    $headers = [
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, GEMINI_API_URL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $response_data = json_decode($response, true);
        $ai_response = $response_data['candidates'][0]['content']['parts'][0]['text'];
        return substr($ai_response, 0, 3000);  // Limit response to 3000 characters
    } else {
        return "API Error $http_code: $response";
    }
}

// Get the user input from the query parameter
if (isset($_GET['prompt'])) {
    $user_input = $_GET['prompt'];
    $ai_response = chat_with_ai($user_input);
    $response = [
        'response' => $ai_response,
        'developer' => 'Developer @abirxdhackz'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $error_response = [
        'error' => "Please provide a prompt using the 'prompt' query parameter.",
        'developer' => 'Developer @abirxdhackz'
    ];
    header('Content-Type: application/json');
    echo json_encode($error_response);
}
?>
