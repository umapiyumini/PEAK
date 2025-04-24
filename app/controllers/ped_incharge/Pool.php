<?php
    class Pool extends Controller{
        public function index(){
            $poolBookingModel = new PoolBooking();
            $poolBookingList = $poolBookingModel->findAllBookings();
            $poolSettingsModel = new PoolSettings();
            $poolSettingsList = $poolSettingsModel->findAllSettings();
            $this->view('ped_incharge/pool',['poolBookingList'=>$poolBookingList, 'poolSettingsList'=>$poolSettingsList, 'bookings' => json_encode($poolBookingList)]);
            
           
        }

        public function saveSettings(){
            $poolSettingsModel = new PoolSettings();
            $poolSettingsModel->saveSettings($_POST);

            header('Location: ' . ROOT . '/ped_incharge/pool');
        }

        public function cancelBooking($bookingID){
            $poolBookingModel = new PoolBooking();
            $poolBookingModel->deleteBooking($bookingID);

            header('Location: ' . ROOT . '/ped_incharge/pool');
        }
    }