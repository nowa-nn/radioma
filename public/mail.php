<?php
/**
 * Обработчик отправки заявок с сайта radioma.ru
 * Получатель: office@radioma.ru
 * Совместимость: PHP 5.3+
 */

// Заголовки ответа
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

// Ответ на preflight OPTIONS запрос
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    echo json_encode(array('status' => 'ok'));
    exit;
}

// Принимаем только POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(array(
        'success' => false,
        'error' => 'Метод не поддерживается. Разрешен только POST.'
    ));
    exit;
}

// Устанавливаем часовой пояс Москвы
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Europe/Moscow');
}

// Получаем входные данные (JSON или POST)
$rawInput = file_get_contents('php://input');
$data = array();

if (!empty($rawInput)) {
    $decoded = json_decode($rawInput, true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}

if (empty($data) && !empty($_POST)) {
    $data = $_POST;
}

// 1. Проверка honeypot (защита от ботов)
if (!empty($data['honeypot']) || !empty($data['b_field']) || !empty($data['website'])) {
    // Боты заполнили скрытое поле — возвращаем фейковый успех без отправки
    echo json_encode(array(
        'success' => true,
        'message' => 'Заявка принята'
    ));
    exit;
}

// 2. Извлечение и санитайзинг полей
$name = isset($data['name']) ? trim(strip_tags((string)$data['name'])) : '';
$phone = isset($data['phone']) ? trim(strip_tags((string)$data['phone'])) : '';
$subject = isset($data['subject']) ? trim(strip_tags((string)$data['subject'])) : 'Заявка с сайта';
$pageUrl = isset($data['pageUrl']) ? trim(strip_tags((string)$data['pageUrl'])) : '';

// Защита от инъекций заголовков (CRLF injection)
$name = str_replace(array("\r", "\n", "%0a", "%0d"), ' ', $name);
$phone = str_replace(array("\r", "\n", "%0a", "%0d"), ' ', $phone);
$subject = str_replace(array("\r", "\n", "%0a", "%0d"), ' ', $subject);

// 3. Валидация полей
if (mb_strlen($name, 'UTF-8') < 2) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array(
        'success' => false,
        'error' => 'Пожалуйста, укажите ваше имя (не менее 2 символов).'
    ));
    exit;
}

// Проверка телефона: должно быть минимум 10 цифр
$phoneDigits = preg_replace('/\D/', '', $phone);
if (strlen($phoneDigits) < 10) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array(
        'success' => false,
        'error' => 'Пожалуйста, укажите корректный номер телефона.'
    ));
    exit;
}

// 4. Определение IP и параметров запроса
$clientIp = 'Не определен';
if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $clientIp = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $clientIp = trim($ips[0]);
} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
    $clientIp = $_SERVER['REMOTE_ADDR'];
}
$clientIp = htmlspecialchars(strip_tags($clientIp), ENT_QUOTES, 'UTF-8');

$datetime = date('d.m.Y H:i:s') . ' (МСК)';
$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$safePhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$safePageUrl = htmlspecialchars($pageUrl, ENT_QUOTES, 'UTF-8');

// 5. Формирование темы и заголовков письма
$to = 'office@radioma.ru';
$mailSubject = 'Новая заявка с сайта radioma.ru: ' . $subject;
$mailSubjectEncoded = '=?UTF-8?B?' . base64_encode($mailSubject) . '?=';

$fromName = 'Сайт РАДИОМА';
$fromEmail = 'no-reply@radioma.ru';
$fromEncoded = '=?UTF-8?B?' . base64_encode($fromName) . '?= <' . $fromEmail . '>';

$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/html; charset=UTF-8';
$headers[] = 'Content-Transfer-Encoding: 8bit';
$headers[] = 'From: ' . $fromEncoded;
$headers[] = 'Reply-To: ' . $fromEmail;
$headers[] = 'X-Mailer: PHP/' . phpversion();

$headerStr = implode("\r\n", $headers);

// 6. Формирование HTML-тела письма
$body = '
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Новая заявка с сайта radioma.ru</title>
</head>
<body style="margin:0; padding:24px 12px; background-color:#f1f5f9; font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif; color:#0f172a; line-height:1.5;">
  <div style="max-width:620px; margin:0 auto; background-color:#ffffff; border:1px solid #e2e8f0; border-radius:4px; overflow:hidden; box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
    
    <!-- Шапка письма -->
    <div style="background-color:#0f172a; padding:22px 28px; border-bottom:3px solid #0093cb;">
      <h1 style="margin:0; color:#ffffff; font-size:18px; font-weight:700; letter-spacing:0.5px;">
        РАДИОМА &bull; Заявка с сайта
      </h1>
      <p style="margin:4px 0 0 0; color:#94a3b8; font-size:12px;">
        Официальный сайт radioma.ru
      </p>
    </div>

    <!-- Основное содержимое -->
    <div style="padding:28px;">
      <h2 style="margin:0 0 18px 0; color:#0f172a; font-size:16px; font-weight:700; border-bottom:1px solid #f1f5f9; padding-bottom:12px;">
        Данные контактного лица
      </h2>

      <table style="width:100%; border-collapse:collapse; font-size:14px;">
        <tr>
          <td style="padding:10px 0; color:#64748b; width:150px; font-weight:600; vertical-align:top;">Имя клиента:</td>
          <td style="padding:10px 0; color:#0f172a; font-weight:700; font-size:15px;">' . $safeName . '</td>
        </tr>
        <tr>
          <td style="padding:10px 0; color:#64748b; font-weight:600; vertical-align:top; border-top:1px solid #f8fafc;">Телефон:</td>
          <td style="padding:10px 0; border-top:1px solid #f8fafc;">
            <a href="tel:' . preg_replace('/[^\d+]/', '', $phone) . '" style="color:#0093cb; text-decoration:none; font-weight:700; font-family:monospace; font-size:16px;">
              ' . $safePhone . '
            </a>
          </td>
        </tr>
        <tr>
          <td style="padding:10px 0; color:#64748b; font-weight:600; vertical-align:top; border-top:1px solid #f8fafc;">Тема / Направление:</td>
          <td style="padding:10px 0; color:#334155; font-weight:600; border-top:1px solid #f8fafc;">' . $safeSubject . '</td>
        </tr>
        <tr>
          <td style="padding:10px 0; color:#64748b; font-weight:600; vertical-align:top; border-top:1px solid #f8fafc;">Страница отправки:</td>
          <td style="padding:10px 0; color:#64748b; font-size:12px; border-top:1px solid #f8fafc; word-break:break-all;">
            ' . (!empty($safePageUrl) ? '<a href="' . $safePageUrl . '" target="_blank" style="color:#0093cb; text-decoration:underline;">' . $safePageUrl . '</a>' : 'Главная страница') . '
          </td>
        </tr>
        <tr>
          <td style="padding:10px 0; color:#64748b; font-weight:600; vertical-align:top; border-top:1px solid #f8fafc;">Дата и время:</td>
          <td style="padding:10px 0; color:#64748b; font-size:13px; border-top:1px solid #f8fafc;">' . $datetime . '</td>
        </tr>
        <tr>
          <td style="padding:10px 0; color:#64748b; font-weight:600; vertical-align:top; border-top:1px solid #f8fafc;">IP адрес:</td>
          <td style="padding:10px 0; color:#94a3b8; font-size:12px; font-family:monospace; border-top:1px solid #f8fafc;">' . $clientIp . '</td>
        </tr>
      </table>

      <!-- Блок быстрого действия -->
      <div style="margin-top:24px; padding:16px; background-color:#f8fafc; border:1px solid #e2e8f0; border-radius:4px; text-align:center;">
        <span style="font-size:12px; color:#64748b; display:block; margin-bottom:8px;">Быстрый звонок клиенту:</span>
        <a href="tel:' . preg_replace('/[^\d+]/', '', $phone) . '" style="display:inline-block; background-color:#0093cb; color:#ffffff; font-weight:700; font-size:14px; text-decoration:none; padding:10px 22px; border-radius:3px;">
          Позвонить ' . $safePhone . '
        </a>
      </div>
    </div>

    <!-- Подвал письма -->
    <div style="background-color:#f8fafc; padding:16px 28px; border-top:1px solid #e2e8f0; font-size:11px; color:#94a3b8; line-height:1.4;">
      Это автоматическое уведомление сайта <a href="http://radioma.ru" style="color:#64748b; text-decoration:none;">radioma.ru</a> о поступившей заявке. Отвечать на это письмо не требуется.
    </div>

  </div>
</body>
</html>
';

// 7. Отправка письма
$sent = @mail($to, $mailSubjectEncoded, $body, $headerStr);

if ($sent) {
    header('HTTP/1.1 200 OK');
    echo json_encode(array(
        'success' => true,
        'message' => 'Заявка успешно отправлена!'
    ));
} else {
    // В случае ошибки отправки почтовой службы сервера
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array(
        'success' => false,
        'error' => 'Не удалось отправить заявку через почтовую службу. Пожалуйста, позвоните нам по телефону +7 (495) 725-6006.'
    ));
}
