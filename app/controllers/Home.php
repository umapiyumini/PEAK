<?php

   

class Home extends Controller {
    public function index() {
        $feedbackModel = new Feedback();
        $userModel = new User();

        $latestFeedbacks = $feedbackModel->getLatest(2);

        foreach ($latestFeedbacks as &$feedback) {
            $user = $userModel->getUser($feedback->userid);
            if (!empty($user) && isset($user[0])) {
                $feedback->user_name = $user[0]->name;
                $feedback->user_image = $user[0]->image;
            } else {
                $feedback->user_name = 'Unknown';
                $feedback->user_image = null;
            }
        }

        $this->view('home', [
            'feedbacks' => $latestFeedbacks
        ]);
    }
}



