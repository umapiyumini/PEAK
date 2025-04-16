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

   

}