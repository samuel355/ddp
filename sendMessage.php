<?php
    include_once "config.php";

    if(isset($_POST['email'])){
        $fullname = mysqli_escape_string($con, $_POST['name']);
        $email = mysqli_escape_string($con, $_POST['email']);
        $phone = mysqli_escape_string($con, $_POST['phone']);
        $subject = mysqli_escape_string($con, $_POST['subject']);
        $message = mysqli_escape_string($con, $_POST['message']);
        $msg_date = date('y-m-d'). ' at '.date('h:i:s');

        //insert
        $query = "INSERT INTO messages(fullname, phone, email, subject, message, date)
        VALUES('{$fullname}', '{$phone}', '{$email}', '{$subject}', '{$message}', '{$msg_date}')";
        $insert = mysqli_query($con, $query);

        echo 'success';
        
        if($insert){
            //send message on live server
            echo 'success';
            $to = 'info@diasporadreamproject.com';
                    
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: Possible client <".$email."> " . "\r\n" .
            "Reply-To: ".$email."" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
            
            $subject = "Diaspora Dream Project ";
            
            
            $messageSend = " 
                <html>
                    <body>
                        <h4> Message from Diapora Dream Project website </h4> <br>
                        Full Name:  ".$fullname."<br>
                        Email: ".$email."<br>
                        Phone : ".$phone." <br> <br><br>
                        Subject : ".$subject." <br> <br><br>
                        <h4> Message</h4> <br>
                        ".$message."
                    </body>
                </html> 
            "; 

            mail ($to, $subject, $messageSend, $headers);
        }else{
            echo 'Sorry your message could not send. Try again later';
        }
        
    }else{
        echo "message could not be delivered";
    }
?>