<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config\Email; // Import Email configuration
use Config\Services;

class NotificationController extends BaseController
{
    protected $sessionData;
    public function __construct()
    {
        if(!$this->checkSession()){
            return redirect()->to(base_url('login'))->send();
        }
        $this->sessionData = session()->get();
    }
    public function sendEmailNotification()
    {
        $config = config('Email');
        $notificationModel = new NotificationModel();

        // Fetch notifications to be sent via email
        $notifications = $notificationModel->where('type', 'email_notification')->findAll();

        if (!$notifications) {
            // No notifications found
            return;
        }

        // Initialize PHP Mailer
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
                // Recipient
                $mailer->addAddress($notification['recipient_email'], $notification['recipient_name']);

                // Content
                $mailer->isHTML(true);
                $mailer->Subject = $notification['subject'];
                $mailer->Body = $notification['message'];

                // Send email
                $mailer->send();

                // Update notification status
                $notificationModel->update($notification['id'], ['is_sent' => true]);
            }

            echo 'Email notification sent successfully.';
        } catch (Exception $e) {
            echo 'Email notification could not be sent. Error: ' . $mailer->ErrorInfo;
        }
    }
}
