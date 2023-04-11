<?php
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "eventsite";
        $con = mysqli_connect($servername, $username, $password, $db);

        $event_id = 3;
        $full_name = "TestName3";
        $email = "test@example.com" ;
        $mobile = "1111111111";
        $college = "testCollege";
        $branch = "testBranch";

        $sql = "INSERT INTO `participants` 
		        (`p_id`,`event_id`, `fullname`, `email`, `mobile`,  `college`, `branch`) 
		        VALUES (NULL,'$event_id', '$full_name',  '$email', '$mobile', '$college', '$branch')";
        $run_query = mysqli_query($con, $sql);
        if (!$run_query) {
            $this->fail("Query failed: " . mysqli_error($con));
        }
        $count = mysqli_affected_rows($con);

        $this->assertTrue($count > 0);

        $sql = "SELECT * FROM `participants` WHERE fullname = '$full_name' LIMIT 1" ;
        $user = mysqli_query($con, $sql)->fetch_assoc();

        $this->assertEquals($email, $user['email']);
    }
}

