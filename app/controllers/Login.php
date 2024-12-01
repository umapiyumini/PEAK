<?php

class Login extends Controller{
    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User;
            
            // Validate the login credentials
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if ($row = $user->first(['username' => $username])) {
                // Check if the password is correct
                if (password_verify($password, $row->password)) {
                    // Check if user is active
                        // Authenticate user
                        $_SESSION['userid'] = $row->userid;
                        
                        // // Update last login
                        // $user->update(
                        //     $row->userid,  // First parameter: ID value
                        //     ['last_login' => date('Y-m-d H:i:s')],  // Second parameter: data to update
                        //     'userid'  // Third parameter: ID column name
                        // );
                        
                        
                        if($row->role === 'External User') {
                            header('Location:external/externalhome');
                            exit; //done
                        } else if ($row->role === 'GroundIndoorStaff') {
                            header('Location:staff/staffdashboard');
                            exit; 

                        } else if ($row->role === 'Gym Instructor') {
                            header('Location: gym/gymdashboard');
                            exit; // done
                        } else if ($row->role === 'Internal User') {
                            header('Location: student/home');
                            exit; 
                        } else if ($row->role === 'Amalgamated Club Executive') {
                            header('Location: choose1');
                            exit; 

                        } else if ($row->role === 'Sports Captain') {
                            header('Location: choose2');
                            exit; //done
                        } 
                        
                        else {
                            $user->errors['username'] = "Error retrieving user role";
                        }
                } else {
                    $user->errors['username'] = "Invalid username or password";
                }
            } else {
                $user->errors['username'] = "Invalid username or password";
            }

            $data['errors'] = $user->errors;
        }

        $this->view('Login', $data);
    }
}