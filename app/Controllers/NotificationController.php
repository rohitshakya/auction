<?php

namespace App\Controllers;

use App\Models\EmailTemplateModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class NotificationController extends BaseController
{
    protected $sessionData;
    public function __construct()
    {
    }
    public function sendEmailNotification()
    {
        $config = config('Email');
        $emailTemplateModel = new EmailTemplateModel();
        $template = $emailTemplateModel->findTemplateById(1);
        $notifications[0]=array("recipient_email"=>"rohit.rkshakya@gmail.com","recipient_name"=>"Rohit Shakya","subject"=>"testsubject","message"=>$template['html_content']);
        if (!$notifications) {
            return;
        }

        $mailer = new PHPMailer(true);

        try {
            // Server settings
            $mailer->isSMTP();
            $mailer->Host = $config->SMTPHost; // Use values from Email config
            $mailer->SMTPAuth = true;
            $mailer->Username = $config->SMTPUser; // Use values from Email config
            $mailer->Password = $config->SMTPPass; // Use values from Email config
            $mailer->SMTPSecure = $config->SMTPCrypto; // Use values from Email config
            $mailer->Port = $config->SMTPPort; // Use values from Email config

            // Sender
            $mailer->setFrom("auction@roundcircle.tech", 'The Auction'); // Use values from Email config

            foreach ($notifications as $notification) {
                $mailer->addAddress($notification['recipient_email'], $notification['recipient_name']);
                $mailer->isHTML(true);
                $mailer->Subject = $template['subject'];
                $mailer->Body = $notification['message'];
                $mailer->send();
                //$notificationModel->update($notification['id'], ['is_sent' => true]);
            }
        } catch (Exception $e) {
            echo 'Email notification could not be sent. Error: ' . $mailer->ErrorInfo;
        }
    }
}
