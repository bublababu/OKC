<?php 

function SMTP_info()
{
    $CI =& get_instance();
    $CI->load->model('common_model');
    $email_settings = $CI->common_model->getRecord('email_settings','*');
    return $email_settings;
}

function email_send($to,$email_template_id,$findArr = '',$replaceArr = '')
{
    $CI =& get_instance();
    $CI->load->model('common_model');
    
    $where = array('id' => $email_template_id);
    $email_template = $CI->common_model->getRecord('email_template','*',$where);
    
    $subject = str_replace($findArr,$replaceArr,$email_template['subject']);
    $message = str_replace($findArr,$replaceArr,$email_template['body']);
     print("<pre>".print_r($subject,true)."</pre>");
     print("<pre>".print_r($message,true)."</pre>");
    // $smpt_info = SMTP_info();
    // $CI->email->from($smpt_info['email'],'WFEC Bids');
    // $CI->email->to($to);
    // $CI->email->subject($subject);
    // $CI->email->message($message);
    // $CI->email->send();
    

    $ci = get_instance();
$ci->load->library('email');
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "sportsmanshuntingclub@gmail.com"; 
$config['smtp_pass'] = "%ShcP01aWor";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";

$ci->email->initialize($config);

$ci->email->from('sportsmanshuntingclub@gmail.com', 'Blabla');
$list = array('pbdigit@gmail.com');
$ci->email->to($list);
$ci->email->reply_to('my-email@gmail.com', 'Explendid Videos');
$ci->email->subject('This is an email test');
$ci->email->message('It is working. Great!');
$ci->email->send();

    return 1;    
}
?>