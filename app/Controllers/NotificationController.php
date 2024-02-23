<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NotificationController extends BaseController
{
    public function sendEmailNotification()
    {
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
            $mailer->Host = 'smtp.example.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'your@example.com';
            $mailer->Password = 'your_password';
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            // Sender
            $mailer->setFrom('your@example.com', 'Your Name');

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
