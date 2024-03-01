<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\NotificationModel;


class NotificationController extends BaseController
{
    protected $sessionData;
    public function __construct()
    {
    }
    public function sendEmailNotification()
    {
        $config = config('Email');
        $notificationModel = new NotificationModel();

        try {
            
            $notifications = $notificationModel->where('status', 'pending')->limit(100)->findAll();
            if (!$notifications) {
                echo "No New Notification!";
                return;
            }

            $mailer = new PHPMailer(true);

            // Server settings
            $mailer->isSMTP();
            $mailer->Host = $config->SMTPHost;
            $mailer->SMTPAuth = true;
            $mailer->Username = $config->SMTPUser;
            $mailer->Password = $config->SMTPPass;
            $mailer->SMTPSecure = $config->SMTPCrypto;
            $mailer->Port = $config->SMTPPort;

            $mailer->setFrom("auction@roundcircle.tech", 'The Auction');

            foreach ($notifications as $notification) {
                $mailer->addAddress($notification['recipient_email']);
                $mailer->isHTML(true);
                
                $mailer->Subject = $notification['subject'];
                $mailer->Body = $notification['message'];
                $mailer->send();

                // Update notification status
                $notificationModel->update($notification['id'], [
                    'status' => 'sent',
                ]);
            }
            echo "Mail sent successfully!!";exit;
        } catch (Exception $e) {
            // Log error or handle as needed
            echo 'Email notification could not be sent. Error: ' . $e->getMessage();
        }
    }

}
