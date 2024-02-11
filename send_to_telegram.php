<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // بدل هذا الرابط برابط البوت الخاص بك
    $botToken = '6889028993:AAF6k21E9ZKMZ8SH-WDxVl8P9AHOcljMHmE';
    $chatId = '5694585021';
    
    // بناء الرسالة المراد إرسالها إلى بوت التلجرام
    $telegramMessage = "اسم: $name\n";
    $telegramMessage .= "البريد الإلكتروني: $email\n";
    $telegramMessage .= "الرسالة: $message";
    
    // إرسال الرسالة إلى بوت التلجرام باستخدام API
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
    $telegramParams = [
        'chat_id' => $chatId,
        'text' => $telegramMessage
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $telegramParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $telegramResponse = curl_exec($ch);
    curl_close($ch);
    
    // التحقق من استجابة بوت التلجرام
    if ($telegramResponse === false) {
        echo "حدث خطأ أثناء إرسال الرسالة إلى بوت التلجرام.";
    } else {
        echo "تم إرسال الرسالة إلى بوت التلجرام بنجاح!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>نموذج الاتصال</title>
</head>
<body>
    <h2>نموذج الاتصال</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">الاسم:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">البريد الإلكتروني:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">الرسالة:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="إرسال">
    </form>
</body>
</html>