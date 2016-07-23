<?php
class Admin {
    public function getAdmin() {
        $data = Pages::load('Users', 'Users');
        //get from db
        $data['users'] = [
            [
                'id' => '2',
                'name' => 'Chan',
                'email' => 'chan@chan.com'
            ]
        ];

        $data['developers'] = [
            [
                'id' => '3',
                'name' => 'Chan',
                'email' => 'chan@chan.com',
                'appcount' => 123
            ]
        ];

        $data['admins'] = [
            [
                'id' => '3',
                'name' => 'Chan',
                'email' => 'chan@chan.com',
                'appcount' => 123
            ]
        ];

        render('admin.users', $data);
    }

    public function getAdminNotify() {
        $data = Pages::load('Notify', 'Notify');
        //get from db
        $data['id'] = Request::inputs('id');

        $data['users'] = [
            ['id' => 1, 'name' => 'Chan'],
            ['id' => 2, 'name' => 'Nyein'],
        ];

        render('admin.notify', $data);
    }

    public function getAdminCatePlat() {
        $data = Pages::load('Categories & Platform', 'Categories and Platform');
        //get from db

        render('admin.cateplat', $data);
    }

    public function getAdminTransitions() {
        $data = Pages::load('Transitions', 'Transitions');
        //get from db

        render('admin.transitions', $data);
    }

    public function getAdminTransitonReports() {
        $data = Pages::load('Transition Reports', 'Transition Reports');
        //get from db

        render('admin.transitionreports', $data);
    }

    public function getAdminInappropirate() {
        $data = Pages::load('Inappropirate Apps', 'Inappropirate Apps');
        //get from db

        render('admin.inappropirate', $data);
    }
}
