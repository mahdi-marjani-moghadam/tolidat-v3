<?php

require_once ROOT_DIR . 'component/emailEngine/admin/model/Email.php';
require_once ROOT_DIR . 'common/PHPMailer-master/PHPMailerAutoload.php';

class EmailEngineController
{
    /*
     * We need a method to send an email and keep tracking of the emails
     * so we will run this method until the send column in the data
     * equals to 1, if the send column sets to 1 then remove the
     * row from data base.
    */

    private $email = '';
    private $from = 'تولیدات';
    private $subject = '';
    private $company_id = 1;
    private $body = '';
    private $bcc = 'info@tolidat.ir';


    public function __Construct($contact = [])
    {
        $this->email = $contact['email'];
        $this->subject = $contact['subject'];
        $this->body = $contact['body'];
        $this->company_id = $contact['company_id'];

        if (! empty($contact['from'])) {
            $this->from = $contact['from'];
        }

        if (! empty($contact['bcc'])) {
            $this->bcc = $contact['bcc'];
        }
    }

    public function setFields($contact)
    {
        if($contact['email'] != '' && ! empty($contact['email']) && isset($contact['email'])) {
            $this->email = $contact['email'];
            $result = 1;
        } else {
            $result['error'][] = 'Email Field is Empty';
        }

        if (! empty($contact['subject']) && isset($contact['subject'])) {
            $this->subject = $contact['subject'];
            $result = 1;
        } else {
            $result['error'][] = 'Subject Field is Empty';
        }

        if (! empty($contact['company_id']) && isset($contact['company_id'])) {
            $this->company_id = $contact['company_id'];
            $result = 1;
        } else {
            $result['error'][] = 'company_id Field is Empty';
        }

        if (! empty($contact['body']) && isset($contact['body'])) {

            if (is_array($contact['body'])) {
                $this->body = $this->renderHtml(
                    $contact['body']['path'],
                    $contact['body']['data']
                );
            } else {
                $this->body = $contact['body'];
            }
            $result = 1;
        } else {
            $result['error'][] = 'Body Field is Empty';
        }

        if (! empty($contact['from']) && isset($contact['from'])) {
            $this->from = $contact['from'];
        }

        if (! empty($contact['bcc']) && isset($contact['bcc'])) {
            $this->bcc = $contact['bcc'];
        }

        return $result;
    }

    /**
     * if wanna send an html page that has php variables in it to get
     * proper results we have to render that html page with php in
     * some way so we wont miss the values. this is it.
     *
     * @param $path
     * @param $data
     * @return string
     *
     */
    private function renderHtml($path, $data = [])
    {
        extract($data);
        ob_start();
        include $path;
        $email_html = ob_get_contents();
        ob_clean();
        flush();
        return $email_html;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    private function send()
    {
        //set_time_limit(3000);
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "$header\r\n" . "Reply-To: " . SMTP_USERNAME . "\r\n" . "X-Mailer: PHP/" . phpversion();

        $mail = new PHPMailer;
        // $mail->SMTPDebug = 4;
        $mail->IsSMTP();
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $mail->Host = SMTP_SERVER;
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        // $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->From = SMTP_USERNAME;
        $mail->CharSet = "utf-8";
        $mail->FromName = $this->from;
        $mail->IsHTML(true);
        $mail->SetLanguage("fa", ROOT_DIR . "common/PHPMailer-master/");
        $mail->Subject = $this->subject;
        $mail->Body = $this->body;
        // $mail->ClearAddresses();
        $mail->AddAddress($this->email);
        $mail->AddBCC($this->bcc);
        if (! $mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function forceSend($contact)
    {
        // dd($contact);
        $self = new EmailEngineController();
        $result = $self->setFields($contact);
        
        if (isset($result['error'])) {
            return $result['error'];
        }
        // echo 'c';
        // $result = $self->send();
        $result = 1;
        // echo 'd';
        if (! $result) {
            $self->saveEmailInToDataBase();
            // $result = $self->send();
            // dd(1);
        }
        
        return $result;
    }

    public static function sendToAll()
    {
        $contacts = Email::getBy_subscribed_and_send(0, 0)->getList();
        $self = new EmailEngineController();
        foreach ($contacts['export']['list'] as $contact) {
            $self->setFields($contact);
            if(! $self->send()) {
                $result[]['email'] = $contact['email'];
                $result[]['subject'] = $contact['subject'];
                $result[]['body'] = $contact['body'];
                $result[]['from'] = $contact['from'];
                $result[]['bcc'] = $contact['bcc'];
            } else {
                $result = 1;
            }
        }
        return $result;
    }

    /**
     * saves the emails that has been not send to the company or user
     * into the to the database so we can send the emails later to
     * the missing ones from this list.
     *
     * @param $contacts
     *
     * @return int 1, int 0
     **/
    public function saveEmailInToDataBase()
    {
        $emailObject = new Email;
        $result = $emailObject->setFields(
            [
                'email' => $this->email,
                'subject' => $this->subject,
                'body' => $this->body,
                'company_id' => $this->company_id,
                'branch_id' => 0
            ]
        );
        // echo "e";
        if ($result['result'] == 1) {

            $result = $emailObject->save();
            // echo "f";
            if ($result['result'] == 1) {
                return 1;
            }
        }

        return 0;
    }

    /**
     * send the emails to those companies that email engine failed to
     * send email to them for a server problem or other reasons so,
     * we send an email to him again to notify him from missing
     * actions that has been happened in website recently.
     *
     * @return int 1
     **/
    public function sendFailedEmailsInfinity()
    {
        $flag = true;
        while ($flag == true) {
            $emailList = Email::getAll()->get();

            if (is_object($emailList)) {
                foreach ($emailList as $email) {
                    $result = $this->send();

                    if ($result == 1) {
                        $email->remove();
                    }

                }
            } else {
                $flag = false;
            }
        }
        return 1;
    }

}
