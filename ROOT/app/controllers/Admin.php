<?php
class Admin {
    public function __construct() {
        Auth::check();
        Auth::proirity(3);
    }

    public function getUserDelete($id) {
        try {
            $result = DB::exec(
                QB::table('users')
                    ->delete()
                    ->where('id', $id)
            );

        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }

        if($result->affectedRows > 0) {
            redirect('admin', [
                'status' => 'User deletion success !'
            ]);
        } else {
            redirect('admin', [
                'status' => 'Error ! Something went wrong.'
            ]);
        }
    }

    public function getUsers() {
        try {
            $data = Pages::load('Users', 'Users');

            $data['users'] = DB::exec(
                QB::table('users')
                    ->select('users.id, profiles.name, users.email')
                    ->innerJoin('profiles')
                    ->on('users.id', 'profiles.user_id')
                    ->where('users.type', 1)
            );

            $data['developers'] = DB::exec(
                QB::table('users')
                    ->select('users.id, profiles.name, users.email')
                    ->innerJoin('profiles')
                    ->on('users.id', 'profiles.user_id')
                    ->where('users.type', 2)
            );

            for ($i=0; $i < count($data['developers']); $i++) {
                $id = $data['developers'][$i]->id;

                $query = new Query('applications');
                $query->select('count(*) as count')
                    ->where('user_id', $id);
                $data['developers'][$i]->appcount = DB::exec($query)[0]->count;
            }

            $query = QB::table('users')
                ->select('users.id, profiles.name, users.email')
                ->innerJoin('profiles')
                ->on('users.id', 'profiles.user_id')
                ->where('users.type', 3);

            if (session('user')->id != 1) {
                $query->and()->where('users.id', '<>', 1);
            }

            $data['admins'] = DB::exec($query);

            for ($i=0; $i < count($data['admins']); $i++) {
                $id = $data['admins'][$i]->id;

                $query = new Query('applications');
                $query->select('count(*) as count')
                    ->where('user_id', $id);
                $data['admins'][$i]->appcount = DB::exec($query)[0]->count;
            }

            render('admin.users', $data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getNotify() {
        $data = Pages::load('Notify', 'Notify');

        $data['id'] = Request::inputs('id');

        try {
            $data['users'] = DB::exec(
                QB::table('users')
                    ->select('users.id, profiles.name')
                    ->innerJoin('profiles')
                    ->on('users.id', 'profiles.user_id')
            );
        } catch (Exception $e) {
            redirect('admin/notify', [
                'error' => [
                    'Something went wrong',
                    'Please try again'
                ]
            ]);
        }

        render('admin.notify', $data);
    }

    public function getCatePlat() {
        try {
            $data = Pages::load('Categories & Platform', 'Categories and Platform');
            $data['mainCategories'] = DB::exec(
                QB::table('categories')->select()
            );

            foreach ($data['mainCategories'] as $key => $value) {
                $count = DB::exec(
                    QB::table('applications')
                    ->select('count(*) as count')
                    ->where('category_id', $value->id)
                )[0]->count;
                $data['mainCategories'][$key]->count = $count;
            }

            $data['mainPlatforms'] = DB::exec(
                QB::table('platforms')->select()
            );

            foreach ($data['mainPlatforms'] as $key => $value) {
                $count = DB::exec(
                    QB::table('applications')
                    ->select('count(*) as count')
                    ->where('platform_id', $value->id)
                )[0]->count;
                $data['mainPlatforms'][$key]->count = $count;
            }

            render('admin.cateplat', $data);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getTransitions() {
        try
        {
            $data = Pages::load('Transitions', 'Transitions');
            $data['deposit'] = DB::exec(
                QB::table('transactions')
                ->select('transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date')
                ->innerJoin('profiles')
                ->on('profiles.user_id', 'transactions.user_id')
                ->where('transactions.type', Config::get('transaction.deposit'))
                ->and()
                ->where('transactions.completed', 1)
                ->orderByDesc('transactions.date')
            );

            $data['withdraw'] = DB::exec(
                QB::table('transactions')
                ->select('transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date')
                ->innerJoin('profiles')
                ->on('profiles.user_id', 'transactions.user_id')
                ->where('transactions.type', Config::get('transaction.withdraw'))
                ->and()
                ->where('transactions.completed', 1)
                ->orderByDesc('transactions.date')
            );

            $data['pending'] = DB::exec(
                QB::table('transactions')
                ->select('transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date, transactions.type')
                ->innerJoin('profiles')
                ->on('profiles.user_id', 'transactions.user_id')
                ->where('transactions.completed', 0)
                ->orderByDesc('transactions.date')
            );

            render('admin.transitions', $data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getConfirmTransition($id) {
        $info = DB::exec(
            QB::table('transactions')
            ->select('amount, type')
            ->where('id', $id)
        )[0];
        $newamount = $info->amount;
        $type = $info->type;

        if ($newamount == null) {
            redirect(url('admin/transitions'), [
                'error' => [
                    'Transition not found !'
                ]
            ]);
        } else {
            $result = DB::exec(
                QB::table('transactions')
                ->update('completed', 1)
                ->where('id', $id)
            );
            if ($result->affectedRows < 0) {
                redirect('admin/transitions', [
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
                        session('user')->id
                    ]);

                    if ($result->affectedRows < 0) {
                        redirect('admin/transitions', [
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

        DB::exec(
            QB::table('transactionreports')->delete()->where('transaction_id', $id)
        );

        redirect('admin/transitions', [
            'status' => 'Operation success !'
        ]);
    }

    public function getDeleteTransition($id) {
        $info = DB::exec(
            QB::table('transactions')
            ->select('type, amount')
            ->where('id', $id)
        )[0];
        $type = $info->type;
        $amount = $info->amount;

        if ($type == Config::get('transaction.deposit')) {
            $result = DB::exec(
                QB::table('transactions')
                ->delete()->where('id', $id)
            );
            if ($result->affectedRows < 0) {
                redirect('admin/transitions', [
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
                session('user')->id
            ]);

            $result = DB::exec(
                QB::table('transactions')
                ->delete()->where('id', $id)
            );
            if ($result->affectedRows < 0) {
                redirect('admin/transitions', [
                    'error' => [
                        'Something went wrong !',
                        'Please try again.'
                    ]
                ]);
                return;
            }
        }

        redirect('admin/transitions', [
            'status' => 'Operation success !'
        ]);
    }

    public function getDeleteAllTransition($type) {
        $result = DB::query('delete from transactions where type = ? and completed = 1', [$type]);
        if($result->affectedRows > 0) {
            redirect('admin/transitions', [
                'status' => 'Operation success !'
            ]);
        } else {
            redirect('admin/transitions', [
                'error' => [
                    'Something went wrong !',
                    'Please try again.'
                ]
            ]);
        }
    }

    public function getTransitonReports() {
        $data = Pages::load('Transition Reports', 'Transition Reports');

        $data['deposit'] = DB::exec(
            QB::table('transactions')
            ->select('transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date')
            ->innerJoin('profiles')->on('profiles.user_id', 'transactions.user_id')
            ->innerJoin('transactionreports')->on('transactionreports.transaction_id', 'transactions.id')
            ->where('transactions.type', Config::get('transaction.deposit'))
        );

        $data['withdraw'] = DB::exec(
            QB::table('transactions')
            ->select('transactions.id, transactions.amount, profiles.billing_info as billingInfo, transactions.date')
            ->innerJoin('profiles')->on('profiles.user_id', 'transactions.user_id')
            ->innerJoin('transactionreports')->on('transactionreports.transaction_id', 'transactions.id')
            ->where('transactions.type', Config::get('transaction.withdraw'))
        );

        render('admin.transitionreports', $data);
    }

    public function getInappropirate() {
        $data = Pages::load('Inappropirate Apps', 'Inappropirate Apps');
        //get from db

        render('admin.inappropirate', $data);
    }
}
