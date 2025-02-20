<?php
    class Inventory_stocks extends Controller{
        public function index(){
            $stock = new Stocks;
            $stockdata = $stock->findAllStocks();

            $this->view('ped_incharge/inventory_stocks', ['stockdata' => $stockdata]);
        }

        public function filterStocks($eqp) {
            $stock = new Stocks;
            $stockdatafiltered = $stock->findStockByEquipmentId($eqp);

            $this->view('ped_incharge/inventory_stocks', ['stockdatafiltered' => $stockdatafiltered]);
        }

        public function addStockRecord() {
            $stock = new Stocks;
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $stock->saveStockRecord($_POST);
                $eqpid = $_POST['equipmentid'];
                header('Location:' . ROOT . '/ped_incharge/inventory_stocks/filterStocks/'.$eqpid);
            }
        }

        public function issueStock() {
            $stock = new Stocks;
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $stock->issueStockss($_POST);
                // show($_POST);
                $eqpid = $stock->findEqpId($_POST['stockId']);
                header('Location:' . ROOT . '/ped_incharge/inventory_stocks/filterStocks/'.$eqpid);
            }
        }

    }