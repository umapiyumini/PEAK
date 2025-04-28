<?php

class Discount extends Controller {
    public function index() {
        $discountModel = new Discounts();

        $userTypes = [
            'universities' => 'State Universities',
            'clubs' => 'Registered Student Clubs & Associations',
            'govt schools' => 'Government Schools',
            'semi govt' => 'Semi-Government Schools'
        ];

        $discounts = [];
        foreach ($userTypes as $dbKey => $label) {
            $discount = $discountModel->getDiscountByUserType($dbKey);
            
            $discounts[$label] = $discount !== null ? $discount : 0;
        }

        $this->view('external/discount', ['discounts' => $discounts]);
    }
}
