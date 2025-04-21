<?php
class External_customer extends Controller
{
    public function index() {
        $userModel = new User();
        $externalUserModel = new External_User();
        $feedbackModel = new Feedback();

        // Fetch external users
        $query = "SELECT u.userid, u.name, eu.company_name, u.nic, u.email, u.contact_number, u.address
                  FROM user u
                  JOIN external_user eu ON u.userid = eu.userid";
        $external_users = $userModel->query($query);

        // Fetch feedbacks ordered by date ascending (earliest to latest)
        $feedbacks = $feedbackModel->query("SELECT * FROM feedback ORDER BY date ASC");

        // Prepare feedbacks with user info
        $feedbackList = [];
        foreach ($feedbacks as $feedback) {
            $user = $userModel->getUser($feedback->userid)[0] ?? null;
            if ($user) {
                $feedbackList[] = [
                    'content' => $feedback->content,
                    'rating' => $feedback->rating,
                    'date' => $feedback->date,
                    'user_name' => $user->name,
                    'user_image' => !empty($user->image) ? $user->image : 'default.jpg',
                ];
            }
        }

        // Pass both external users and feedbacks to the view
        $this->view('ped_incharge/external_customer', [
            'external_users' => $external_users,
            'feedbacks' => $feedbackList
        ]);
    }
}
