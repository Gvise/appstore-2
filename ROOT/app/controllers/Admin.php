<?php
class Admin {
    public function __construct() {
        Auth::check();
        Auth::proirity(3);
    }

    public function getUserDelete($id) {
        $result = DB::query('delete from users where id = ?', [$id]);
        // var_dump($result);return;
        if($result['affectedRows'] > 0) {
            redirect(url('admin'), [
                'status' => 'User deletion success !'
            ]);
        } else {
            redirect(url('admin'), [
                'status' => 'Error ! Something went wrong.'
            ]);
        }
    }

    public function getUsers() {

        $data = Pages::load('Users', 'Users');

        $query = 'select users.id, profiles.name, users.email from users, profiles where users.id = profiles.user_id and users.type = ?';
        $data['users'] = DB::query($query, [1]);

        $query = 'select users.id, profiles.name, users.email from users, profiles where users.id = profiles.user_id and users.type = ?';
        $data['developers'] = DB::query($query, [2]);

        for ($i=0; $i < count($data['developers']); $i++) {
            $id = $data['developers'][$i]['id'];
            $data['developers'][$i]['appcount'] = DB::query('select count(*) as count from applications where user_id = ?', [$id])[0]['count'];
        }

        $query = 'select users.id, profiles.name, users.email from users, profiles where users.id = profiles.user_id and users.type = ? and users.id <> 1';
        if (session('user')['id'] == 1) {
            $query = 'select users.id, profiles.name, users.email from users, profiles where users.id = profiles.user_id and users.type = ?';
        }

        $data['admins'] = DB::query($query, [3]);
        for ($i=0; $i < count($data['admins']); $i++) {
            $id = $data['admins'][$i]['id'];
            $data['admins'][$i]['appcount'] = DB::query('select count(*) as count from applications where user_id = ?', [$id])[0]['count'];
        }

        // var_dump($data['admins']); die();

        render('admin.users', $data);
    }

    public function getNotify() {
        $data = Pages::load('Notify', 'Notify');
        //get from db
        $data['id'] = Request::inputs('id');

        $data['users'] = DB::query('select users.id, profiles.name from users, profiles where users.id = profiles.user_id');

        render('admin.notify', $data);
    }

    public function getCatePlat() {
        $data = Pages::load('Categories & Platform', 'Categories and Platform');
        $data['mainCategories'] = DB::query('select * from categories');

        foreach ($data['mainCategories'] as $key => $value) {
            $count = DB::query('select count(*) as count from applications where category_id = ?', [
                $value['id']
            ])[0];
            $data['mainCategories'][$key]['count'] = $count['count'];
        }

        $data['mainPlatforms'] = DB::query('select * from platforms');

        foreach ($data['mainPlatforms'] as $key => $value) {
            $count = DB::query('select count(*) as count from applications where platform_id = ?', [
                $value['id']
            ])[0];
            $data['mainPlatforms'][$key]['count'] = $count['count'];
        }

        render('admin.cateplat', $data);
    }

    public function getTransitions() {
        $data = Pages::load('Transitions', 'Transitions');
        $query
        = 'select transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date
        from transactions, profiles
        where profiles.user_id = transactions.user_id and transactions.type = ? and transactions.completed = ? order by transactions.date desc';
        $data['deposit'] = DB::query($query, [
            Config::get('transaction.deposit'),
            1
        ]);

        $query
        = 'select transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date
        from transactions, profiles
        where profiles.user_id = transactions.user_id and transactions.type = ?  and transactions.completed = ? order by transactions.date desc';
        $data['withdraw'] = DB::query($query, [
            Config::get('transaction.withdraw'),
            1
        ]);

        $query
        = 'select transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date, transactions.type
        from transactions, profiles
        where profiles.user_id = transactions.user_id and transactions.completed = ? order by transactions.date desc';
        $data['pending'] = DB::query($query, [
            0
        ]);

        render('admin.transitions', $data);
    }

    public function getConfirmTransition($id) {
        $info = DB::query('select amount, type from transactions where id = ?', [$id])[0];
        $newamount = $info['amount'];
        $type = $info['type'];

        if ($newamount == null) {
            redirect(url('admin/transitions'), [
                'error' => [
                    'Transition not found !'
                ]
            ]);
        } else {
            $result = DB::query('update transactions set completed = ? where id = ?', [1, $id]);
            if ($result['affectedRows'] < 0) {
                redirect(url('admin/transitions'), [
                    'error' => [
                        'Something went wrong !',
                        'Please try again.'
                    ]
                ]);
                return;
            } else {
                if ($type == Config::get('transaction.deposit')) {
                    $query = 'update profiles set balance = balance + ? where user_id = ?';
                    $result = DB::query($query, [
                        $newamount,
                        session('user')['id']
                    ]);

                    if ($result['affectedRows'] < 0) {
                        redirect(url('admin/transitions'), [
                            'error' => [
                                'Something went wrong !',
                                'Please try again.'
                            ]
                        ]);
                        $result = DB::query('update transactions set completed = ? where id = ?', [0, $id]);
                        return;
                    }
                }
            }
        }

        DB::query('delete from transactionreports where transaction_id = ?' ,[$id]);
        redirect(url('admin/transitions'), [
            'status' => 'Operation success !'
        ]);
    }

    public function getDeleteTransition($id) {
        $info = DB::query('select type, amount from transactions where id = ?', [$id])[0];
        $type = $info['type'];
        $amount = $info['amount'];

        if ($type == Config::get('transaction.deposit')) {
            $result = DB::query('delete from transactions where id = ?', [$id]);
            if ($result['affectedRows'] < 0) {
                redirect(url('admin/transitions'), [
                    'error' => [
                        'Something went wrong !',
                        'Please try again.'
                    ]
                ]);
                return;
            }
        } else {
            DB::query('update profiles set balance = balance + ? where user_id = ?', [
                $amount,
                session('user')['id']
            ]);

            $result = DB::query('delete from transactions where id = ?', [$id]);
            if ($result['affectedRows'] < 0) {
                redirect(url('admin/transitions'), [
                    'error' => [
                        'Something went wrong !',
                        'Please try again.'
                    ]
                ]);
                return;
            }
        }

        redirect(url('admin/transitions'), [
            'status' => 'Operation success !'
        ]);
    }

    public function getDeleteAllTransition($type) {
        $result = DB::query('delete from transactions where type = ? and completed = 1', [$type]);
        if($result['affectedRows'] > 0) {
            redirect(url('admin/transitions'), [
                'status' => 'Operation success !'
            ]);
        } else {
            redirect(url('admin/transitions'), [
                'error' => [
                    'Something went wrong !',
                    'Please try again.'
                ]
            ]);
        }
    }

    public function getTransitonReports() {
        $data = Pages::load('Transition Reports', 'Transition Reports');
        $query
        = 'select transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date
        from transactions, transactionreports, profiles
        where profiles.user_id = transactions.user_id and transactions.id = transactionreports.transaction_id and transactions.type = ?';

        $data['deposit'] = DB::query($query, [
            Config::get('transaction.deposit')
        ]);


        $query
        = 'select transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date
        from transactions, transactionreports, profiles
        where profiles.user_id = transactions.user_id and transactions.id = transactionreports.transaction_id and transactions.type = ?';

        $data['withdraw'] = DB::query($query, [
            Config::get('transaction.withdraw')
        ]);
        render('admin.transitionreports', $data);
    }

    public function getInappropirate() {
        $data = Pages::load('Inappropirate Apps', 'Inappropirate Apps');
        //get from db

        render('admin.inappropirate', $data);
    }
}
