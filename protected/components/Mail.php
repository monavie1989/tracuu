<?php

/*
 * Process send mail to users in system
 */

/**
 * Process send mail to users in system
 *
 * @author Khuyennv
 */
class Mail {

    static function sendMail($users, $template, $params = false) {
        $system = Yii::app()->params['system'];
        foreach ($users as $user) {
			$emailer = new SendMail();
			$body = $emailer->getBody($template);
			$subject = $emailer->getSubject($template);
            if ($params) {
                foreach ($params as $key => $value) {
                    $body = str_replace("[" . $key . "]", $value, $body);
					$subject = str_replace("[" . $key . "]", $value, $subject);
                }
            }
            $emailer->send($system['systemMail'], $system['systemMail'], $user, $subject, $body);
        }
    }

    static function sendMailUser($email_user, $template, $params = false) {
        $system = Yii::app()->params['system'];
        $emailer = new SendMail();
        $body = $emailer->getBody($template);
        $subject = $emailer->getSubject($template);
        if ($params) {
            foreach ($params as $key => $value) {
                $body = str_replace("[" . $key . "]", $value, $body);
                $subject = str_replace("[" . $key . "]", $value, $subject);
            }
        }
        $emailer->send($system['systemMail'], $system['systemMail'], $email_user, $subject, $body);
    }
}

?>
