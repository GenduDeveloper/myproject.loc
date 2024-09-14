<?php

namespace MyProject\Services;

use MyProject\Exceptions\EmailServiceException;
use MyProject\Models\Users\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailSender
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $emailOptions = (require __DIR__ . '/../../settings.php')['email_sending'];

        $this->mailer = new PHPMailer(true);

        try {
            $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
            $this->mailer->isSMTP();
            $this->mailer->Host = $emailOptions['host'];
            $this->mailer->SMTPAuth = $emailOptions['auth'];
            $this->mailer->Username = $emailOptions['username'];
            $this->mailer->Password = $emailOptions['password'];
            $this->mailer->SMTPSecure = $emailOptions['secure'];
            $this->mailer->Port = $emailOptions['port'];
            $this->mailer->CharSet = $emailOptions['charset'];
        } catch (Exception $e) {
            throw new EmailServiceException('Неудачное подключение. Ошибка:' . $e->getMessage());
        }
    }

    public function send(
        User   $receiver,
        string $subject,
        string $templateName,
        array  $templateVars = []
    ): void
    {
        extract($templateVars);

        ob_start();
        require __DIR__ . '/../../../templates/mail/' . $templateName;
        $body = ob_get_contents();
        ob_end_clean();

        try {
            $this->mailer->addAddress($receiver->getEmail());
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->isHTML(true);
            $this->mailer->send();
        } catch (Exception $e) {
            throw new EmailServiceException('Сообщение не может быть отправлено. Ошибка: ' . $e->getMessage());
        }
    }

}