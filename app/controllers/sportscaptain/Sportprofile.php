<?php

class SportProfile extends Controller{
    
    private function getUserId() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userid'])) {
            die("User not logged in.");
        }
        return $_SESSION['userid'];
    }

   public function index(){

    $sportModel = new Sport();
    $sport = $sportModel->getSport();

    $newsModel = new News();
    $news = $newsModel->getnewsbysport();

        $this->view('sportscaptain/sportprofile',['sport'=>$sport , 'news'=>$news]);
    }

   public function addnews(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $topic = $_POST['topic'];
        $content = $_POST['content'];
        $published_date = $_POST['published_date'];
        $sport_id = $_POST['sport_id'];

        if(empty($topic) || empty($content)){
            die("Topic and content are required.");
        }

        try{

            $newsModel = new News();
            $result = $newsModel->addnews($topic, $content, $published_date, $sport_id);

            if($result){
                $_SESSION['success'] = 'News added successfully';
            }else{
                $_SESSION['error'] = 'Failed to add news';
            }
        }catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('location: ' .ROOT . '/sportscaptain/sportprofile');
    
    exit();
   }

}