<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendMail
 *
 * @author Welcome
 */
class SendMail {

    var $params;
    var $emailer;

    //put your code here
    function __construct() {
        $this->params = Yii::app()->params['smtp'];
        $this->emailer = Yii::createComponent('application.extensions.EMailer');
        $this->emailer->IsSMTP();
        $this->emailer->IsHTML(true);
        $this->emailer->SMTPAuth = $this->params['SMTPAuth'];
        $this->emailer->SMTPSecure = $this->params['SMTPSecure'];
        $this->emailer->Host = $this->params['Host'];
        $this->emailer->Port = $this->params['Port']; //465 995
        $this->emailer->Username = $this->params['Username'];
        $this->emailer->Password = $this->params['Password'];
        $this->emailer->CharSet = $this->params['CharSet'];
    }

    /*
     * 
     * send mail
     */

    function send($fromEmail, $fromName, $toEmail, $subject, $body) {
        $this->emailer->From = $fromEmail;
        $this->emailer->FromName = $fromName;
        $this->emailer->AddReplyTo($fromEmail);
        $this->emailer->AddAddress($toEmail);
        $this->emailer->Subject = $subject;
        $this->emailer->Body = $body;
        if ($this->emailer->Send()) {
            //Log::addlog('Toemail '.$toEmail.' <> Form Email : '.$fromEmail,'SendMail.log');
            return true;
        } else {
            // Log::addlog('Toemail '.$toEmail.' <> Form Email : '.$fromEmail,'ErrorSendMail.log');
            return false;
        }
    }

    function getBody($file = 'to_student.txt') {
        $path = Yii::app()->getBasePath() . '/mail_template/' . $file;
        $content = str_replace($this->getSubject($file), '', file_get_contents($path));
        return nl2br($content);
    }

    function getSubject($file = 'to_student.txt') {
        $path = Yii::app()->getBasePath() . '/mail_template/' . $file;
        $handle = @fopen($path, "r");
        $txtSubject = '';
        if ($handle) {
            if (($buffer = fgets($handle, 4096)) !== false) {
                $txtSubject = $buffer;
            }
            fclose($handle);
        }
        return '[' . Yii::app()->name . '] ' . $txtSubject;
    }

}

?>
