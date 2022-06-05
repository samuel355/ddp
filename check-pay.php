<?php

    include_once "config.php";
    if(!isset($_GET['ref'])){
        header('location: error-payment.php');
    }else{
        $reference_code  = $_GET['ref'];
        $email = $_GET['email'];
        $full_name = $_GET['full_name'];
        $phone = $_GET['phone'];
        $amount = $_GET['amount'];
        $comment = $_GET['comment'];

        if(empty($reference_code)){
            header('location: error-payment.php');
        }else{
            //Insert into db
            $donation_date = date('y-m-d'). ' At '. date('h:i:s');

            $qr_insert = "INSERT INTO donations(fullname, phone, email, amount, comment, donation_date)
                        VALUES('{$full_name}', '{$phone}', '{$email}', '{$amount}', '{$comment}', '{$donation_date}' )";
            $query_insert = mysqli_query($con, $qr_insert);

            if($query_insert){
                //Send live message to donator
                echo 'success';
            }else{
                echo 'error insert order details';
            }
            
        }
    }
?>