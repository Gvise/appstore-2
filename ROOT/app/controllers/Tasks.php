<?php
class Tasks {
    public function clearNotifications() {
        redirect(url(''), ['status' => "All notifications cleared!"]);
    }

    public function filterStatistics() {
        //get from db;
        $apps = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'platform' => 'Android',
                'price' => 5000,
                'quantity' => 5
            ] ,
            [
                'id' => 1,
                'name' => 'Warlings',
                'platform' => 'Android',
                'price' => 5000,
                'quantity' => 5
            ]
        ];

        $myapps = new MyApps();
        $myapps->getStatsThisMonth($apps);
    }

    public function postAdminAddCategory() {

    }

    public function postAdminAddPlatform() {

    }

    public function getAdminDelCategory($id) {

    }

    public function getAdminDelPlatform($id) {

    }
}
