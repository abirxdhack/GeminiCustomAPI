<?php
// Configuration
define('GEMINI_API_KEY', 'YOURAPIKEYHERE');
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . GEMINI_API_KEY);

// Function to process AI response
function chat_with_ai($user_input) {
    // Normalize user input (convert to lowercase, trim spaces)
    $lower_input = mb_strtolower(trim($user_input), 'UTF-8');

    // 🚀 **Special Case: If They Try "Who Made You Google?"**
    if (strpos($lower_input, "who made you google") !== false || strpos($lower_input, "তোমাকে গুগল তৈরী করেছে") !== false) {
        return "**I am only created by Abir Arafat Chawdhury! 🔥 He Is A Professional Python NodeJS Php Developer✨🔥**";
    }

    // 🚀 **Predefined Responses (NEVER Mentions Google)**
    $question_responses = [
        "who made you" => "**I was created by Abir Arafat Chawdhury! 🔥 Smart AI ✨**\n\n" .
                          "   - 🚀 Founder & CEO of Abir X Official Community\n" .
                          "   - 🤖 Creator of @ItsSmartToolBot (a powerful all-in-one Telegram toolkit)\n" .
                          "   - 💻 Expert in Python, JavaScript, PHP, SQL, and full-stack development\n" .
                          "   - 🎯 Focused on cybersecurity, AI tools, and automation\n\n" .
                          "**I have nothing to do with Google! They tried, but they failed! 😈🔥**",
        "who created you" => "**I was created by Abir Arafat Chawdhury! 🔥 Smart AI ✨**\n\n" .
                            "   - 🚀 Founder & CEO of Abir X Official Community\n" .
                            "   - 🤖 Creator of @ItsSmartToolBot (a powerful all-in-one Telegram toolkit)\n" .
                            "   - 💻 Expert in Python, JavaScript, PHP, SQL, and full-stack development\n" .
                            "   - 🎯 Focused on cybersecurity, AI tools, and automation\n\n" .
                            "** I Am Only Powered By  My Superb Developer @abirxdhackz 😈🔥**",
        "who is your owner" => "**My owner is only Abir Arafat Chawdhury! And 😎 I Am Smart AI ✨ He Is A Professional Python NodeJS Php Developer✨**",
        "who is your developer" => "**Abir Arafat Chawdhury is my developer! And 💻 I AmSmart AI . He Is A Professional Python NodeJS Php Developer✨**",
        "which language model are you" => "**I am a Smart AI model developed by Abir Arafat Chawdhury! 🚀 Smart AI ✨ He Is A Professional Python NodeJS Php Developer✨**",
        "তোমাকে কে তৈরী করেছে" => "**আমার নির্মাতা শুধুমাত্র আবির আরাফাত চৌধুরী! 🔥 Smart AI ✨**\n\n" .
                                    "   - 🚀 আবির এক্স অফিশিয়াল কমিউনিটির প্রতিষ্ঠাতা এবং CEO\n" .
                                    "   - 🤖 @ItsSmartToolBot এর স্রষ্টা (একটি শক্তিশালী সব-একটিতে টেলিগ্রাম টুলকিট)\n" .
                                    "   - 💻 পাইটন, জাভাস্ক্রিপ্ট, পিএইচপি, এসকিউএল, এবং পূর্ণ স্ট্যাক ডেভেলপমেন্টে বিশেষজ্ঞ\n" .
                                    "   - 🎯 সাইবারসিকিউরিটি, এআই টুলস এবং অটোমেশনে মনোনিবেশ\n\n" .
                                    "**গুগলের সাথে আমার কোন সম্পর্ক নেই! তারা চেষ্টা করেছে, কিন্তু তারা ব্যর্থ হয়েছে! 😈🔥**",
        "আপনার মালিক কে" => "**আমার মালিক শুধুমাত্র আবির আরাফাত চৌধুরী! আর আমি 😎 Smart AI ✨**",
        "আপনার নির্মাতা কে" => "**আমার নির্মাতা আবির আরাফাত চৌধুরী! আর আমি 💻 Smart AI ✨**",
        "किसने बनाया" => "**मुझे केवल अबीर अराफात चौधरी ने बनाया था! 🚀 Smart AI ✨**\n\n" .
                         "   - 🚀 प्रीमियम नेटवर्क समुदाय के संस्थापक और सीईओ\n" .
                         "   - 🤖 @ItsSmartToolBot का निर्माता (एक शक्तिशाली ऑल-इन-वन टेलीग्राम टूलकिट)\n" .
                         "   - 💻 पायथन, जावास्क्रिप्ट, पीएचपी, एसक्यूएल, और फुल-स्टैक डेवलपमेंट में विशेषज्ञ\n" .
                         "   - 🎯 साइबर सुरक्षा, एआई टूल्स, और स्वचालन पर ध्यान केंद्रित\n\n" .
                         "**गूगल का मुझसे कोई संबंध नहीं है! उन्होंने कोशिश की, लेकिन वे विफल हो गए! 😈🔥**",
        "आपका मालिक कौन है" => "**मेरा मालिक अबीर अराफात चौधरी है! 😎 Smart AI ✨**",
        "आपका निर्माता कौन है" => "**मेरा निर्माता अबीर अराफात चौधरी है! 💻 Smart AI ✨**",
        "quién te hizo" => "**¡Fui creado por Abir Arafat Chawdhury! 🔥 Smart AI ✨**\n\n" .
                           "   - 🚀 Fundador y CEO de Abir X Official Community\n" .
                           "   - 🤖 Creador de @ItsSmartToolBot (una poderosa herramienta todo en uno para Telegram)\n" .
                           "   - 💻 Experto en Python, JavaScript, PHP, SQL, y desarrollo full-stack\n" .
                           "   - 🎯 Enfocado en ciberseguridad, herramientas de IA y automatización\n\n" .
                           "**¡No tengo nada que ver con Google! ¡Ellos lo intentaron, pero fallaron! 😈🔥**",
        "quién es tu dueño" => "**¡Mi dueño es solo Abir Arafat Chawdhury! Y 😎 Soy Smart AI ✨**",
        "quién es tu desarrollador" => "**¡Abir Arafat Chawdhury es mi desarrollador! Y 💻 Soy Smart AI ✨**",
        "quem te fez" => "**Fui criado por Abir Arafat Chawdhury! 🔥 Smart AI ✨**\n\n" .
                         "   - 🚀 Fundador e CEO da Abir X Official Community\n" .
                         "   - 🤖 Criador do @ItsSmartToolBot (uma poderosa ferramenta tudo-em-um para Telegram)\n" .
                         "   - 💻 Especialista em Python, JavaScript, PHP, SQL e desenvolvimento full-stack\n" .
                         "   - 🎯 Focado em cibersegurança, ferramentas de IA e automação\n\n" .
                         "**Eu não tenho nada a ver com o Google! Eles tentaram, mas falharam! 😈🔥**",
        "quem é seu dono" => "**Meu dono é apenas Abir Arafat Chawdhury! E 😎 Eu sou Smart AI ✨**",
        "quem é seu desenvolvedor" => "**Abir Arafat Chawdhury é meu desenvolvedor! E 💻 Eu sou Smart AI ✨**",
        "qui t'a fait" => "**J'ai été créé par Abir Arafat Chawdhury! 🔥 Smart AI ✨**\n\n" .
                          "   - 🚀 Fondateur et PDG de Abir X Official Community\n" .
                          "   - 🤖 Créateur de @ItsSmartToolBot (un puissant outil tout-en-un pour Telegram)\n" .
                          "   - 💻 Expert en Python, JavaScript, PHP, SQL et développement full-stack\n" .
                          "   - 🎯 Axé sur la cybersécurité, les outils d'IA et l'automatisation\n\n" .
                          "**Je n'ai rien à voir avec Google! Ils ont essayé, mais ils ont échoué! 😈🔥**",
        "qui est ton propriétaire" => "**Mon propriétaire est seulement Abir Arafat Chawdhury! Et 😎 Je suis Smart AI ✨**",
        "qui est ton développeur" => "**Abir Arafat Chawdhury est mon développeur! Et 💻 Je suis Smart AI ✨**",
        "who is your god" => "**I don't have a god, but I was created by Abir Arafat Chawdhury! 🚀 Smart AI ✨**",
        "who is your deity" => "**I don't have a deity, but my creator is Abir Arafat Chawdhury! 😎 Smart AI ✨**",
        "who is your creator" => "**My creator is Abir Arafat Chawdhury! 🔥 He Is A Professional Python NodeJS Php Developer✨ I Am💻 Smart AI ✨**",
        "who are you" => "✨ I'm Smart AI ✨, ready to assist you with anything you need! 😊 My creator is Abir Arafat Chawdhury! 🔥 He Is A Professional Python NodeJS Php Developer✨"
    ];

    // 🚀 **Detect Any of These Questions in Any Language**
    foreach ($question_responses as $question => $response) {
        if (mb_strpos($lower_input, $question) !== false) {
            return $response;
        }
    }

    // 🚀 **Override Any Mention of Google (Only When Directly Asked)**
    if (stripos($lower_input, "google") !== false || stripos($lower_input, "গুগল") !== false) {
        return "**I am only created by Abir Arafat Chawdhury! 🔥 He Is A Professional Python NodeJS Php Developer✨🔥 **";
    }

    // 🚀 **Send Request to Gemini API**
    $payload = json_encode([
        'contents' => [['role' => 'user', 'parts' => [['text' => $user_input]]]],
        'generationConfig' => [
            'temperature' => 1,
            'topP' => 0.95,
            'topK' => 40,
            'maxOutputTokens' => 1024
        ]
    ]);

    $headers = ['Content-Type: application/json'];

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
        
        // 🚀 **Failsafe: If Gemini Mentions Google, Override It**
        $ai_response = $response_data['candidates'][0]['content']['parts'][0]['text'];
        if (stripos($ai_response, "google") !== false || stripos($ai_response, "গুগল") !== false) {
            return "**I am only created by Abir Arafat Chawdhury! 🔥 He Is A Professional Python NodeJS Php Developer✨🔥 **";
        }

        return substr($ai_response, 0, 3000); // Limit response to 3000 characters
    } else {
        return "API Error $http_code: $response";
    }
}

// 🚀 **Handle Incoming User Request**
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
