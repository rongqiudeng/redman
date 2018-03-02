<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-12-14
 * Time: 下午5:24
 */

namespace app\member\controller;

use PHPMailer\PHPMailer\PHPMailer;
use think\Loader;
class Email
{
    public function sendEmail()
    {
        Loader::import('PHPMailer.PHPMailer');               //引入eamail类
        Loader::import('PHPMailer.SMTP');                    //引入smtp类
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.qq.com';                          // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '375170667@qq.com';                 // SMTP username
            $mail->Password = 'avwlurcitdwcbiid';                 // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('375170667@qq.com', 'RongQiu');
            $mail->addAddress('545276146@qq.com', 'Liu Qiangqiang'); // Add a recipient
            //$mail->addAddress('ellen@example.com');                // Name is optional
            $mail->addReplyTo('375170667@qq.com', 'Information');    //回复地址
            $mail->addCC( '357213029@qq.com');                       //抄送
            $mail->addBCC('rongqiudeng@outlook.com');                //暗抄送

           /* //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

}