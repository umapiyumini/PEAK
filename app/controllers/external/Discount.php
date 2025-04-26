<?php

class Discount extends Controller {
    public function index() {
        $discountModel = new Discounts();

        // Map your DB keys to display labels
        $userTypes = [
            'universities' => 'State Universities',
            'clubs' => 'Registered Student Clubs & Associations',
            'govt schools' => 'Government Schools',
            'semi govt' => 'Semi-Government Schools'
        ];

        $discounts = [];
        foreach ($userTypes as $dbKey => $label) {
            $discount = $discountModel->getDiscountByUserType($dbKey);
            // If not found, set to 0 (so view never gets null)
            $discounts[$label] = $discount !== null ? $discount : 0;
        }

        $this->view('external/discount', ['discounts' => $discounts]);
    }
}
