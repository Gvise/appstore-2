<?php
class Pages {

    public static function load($stitle, $page) {
        try
        {
            $title = Config::get('title');
        	$subtitle = $stitle;

            $platforms = DB::exec(
                QB::table('platforms')
                    ->select()
            );

            session('platforms', $platforms);
            if (session('currentPlatform') == null) {
                session('currentPlatform', $platforms[0]);
            }

            $categories = DB::exec(
                QB::table('categories')
                    ->select()
                    ->where('name', 'NOT LIKE', 'G_%')
            );

            $categoryGames = DB::exec(
                QB::table('categories')
                    ->select()
                    ->where('name', 'LIKE', 'G_%')
            );

            $notifications = DB::exec(
                QB::table('notifications')
                    ->select()
                    ->where('user_id', session('user')->id)
                    ->orderBy('proirity')
            );

            if (session('user') != null) {
                $wishlistCount = DB::exec(
                    QB::table('wishlist')
                        ->select('count(*) as count')
                        ->where('user_id', session('user')->id)
                )[0]->count;

                $accountBalance = DB::exec(
                    QB::table('profiles')
                        ->select('balance')
                        ->where('user_id', session('user')->id)
                )[0]->balance;
            }

            switch ($page) {
                case 'home':
                    $selectHome = 'custom-active';
                    break;
                case 'newreleases':
                    $selectNewReleases = 'custom-active';
                    break;

                default:
                    $currentPage = $page;
                    break;
            }

        	return compact (
                'title', 'subtitle', 'categories','wishlistCount',
                'categoryGames', 'notifications', 'selectHome',
                'selectNewReleases', 'currentPage', 'accountBalance'
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getIndex() {
        redirect('home');
    }

    public function getChangePlatform($id) {
        foreach (session('platforms') as $key => $value) {
            if ($value->id == $id) {
                session('currentPlatform', session('platforms')[$key]);
            }
        }

        redirect('');
    }

    public function getHome() {
        $data = static::load('Home', 'home');

        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('applications.platform_id', session('currentPlatform')->id)
            ->and()
            ->where('categories.name', 'NOT LIKE', 'G_%')
            ->orderByDesc('applications.rating')
            ->limit(6)
        );

        //get from db
        $data['games'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('applications.platform_id', session('currentPlatform')->id)
            ->and()
            ->where('categories.name', 'LIKE', 'G_%')
            ->orderByDesc('applications.rating')
            ->limit(6)
        );

    	render('home', $data);
    }

    public function getNewReleases() {
        $data = static::load('New Releases', 'newreleases');
        $date = date('Y-m-d', strtotime("-5 day"));
        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('applications.platform_id', session('currentPlatform')->id)
            ->and()
            ->where('applications.updated_date','>',$date)
            ->orderByDesc('applications.updated_date')
        );

    	render('newreleases', $data);
    }

    public function getSearch() {
        $data = static::load('Search', 'Search Results');
        $data['keyword'] = Request::inputs('q');
        $searchKeyword = strtolower(str_replace(' ', '_', $data['keyword']));

        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('applications.keyword', 'LIKE', '%'.$searchKeyword.'%')
            ->and()
            ->where('applications.platform_id', session('currentPlatform')->id)
            ->orderByDesc('applications.rating')
        );

        render('search', $data);
    }

    public function getWishlist() {
        $data = static::load('Wishlist', 'Wishlist');

        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->innerJoin('wishlist')
            ->on('applications.id', 'wishlist.app_id')
            ->where('wishlist.user_id', session('user')->id)
            ->and()
            ->where('applications.platform_id', session('currentPlatform')->id)
        );

        render('wishlist', $data);
    }

    public function getCategories($id) {
        $categoryName = DB::query('select name from categories where id=?', [$id])[0]->name;
        $categoryName = str_replace('G_','Game: ',$categoryName);
        $data = static::load('Search', '' . $categoryName);
        $data['category'] = $categoryName;

        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('categories.id', $id)
            ->and()
            ->where('applications.platform_id', session('currentPlatform')->id)
            ->orderByDesc('appplications.rating')
        );

        render('categories', $data);
    }

    public function getUser() {
        Auth::check();
        $data = static::load('Account Settings', 'Account Settings');

        try {
            $userInfos = DB::exec(
                QB::table('users')
                    ->select('profiles.name, users.email, profiles.nrc, profiles.billing_info as billingInfo, profiles.address')
                    ->innerJoin('profiles')
                    ->on('users.id', 'profiles.user_id')
                    ->where('users.id', session('user')->id)
            )[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }

        $data = $data + get_object_vars($userInfos);

        render('user-settings', $data);
    }

    public function postUser() {
        Auth::check();

        $error = required([
            'name', 'email', 'nrc',
            'billingInfo','address'
        ]);

        if($error->hasError) {
            redirect(url('user'), [
                'profileError' => $error->content
            ]);
            return;
        }

        $name = inputs('name');
        $email = inputs('email');
        $nrc = inputs('nrc');
        $billingInfo = inputs('billingInfo');
        $address = inputs('address');

        try {
            DB::exec(
                QB::table('users')
                    ->update('email', $email)
                    ->where('id', session('user')->id)
            );
        } catch (Exception $e) {
            redirect('user', [
                'profileError' => ['Email already exists.']
            ]);
            return;
        }

        try {
            DB::exec(
                QB::table('profiles')
                    ->update('name, nrc, billing_info, address', $name, $nrc, $billingInfo, $address)
                    ->where('user_id', session('user')->id)
            );
        } catch (Exception $e) {
            redirect('user', [
                'profileError' => ['NRC already exists']
            ]);
            return;
        }

        redirect('user', [
            'status' => 'Operation success !'
        ]);
    }

    public function postUserPassword() {
        Auth::check();

        $error = required([
            'oldPassword',
            'password',
            'confirmPassword'
        ]);

        if($error->hasError) {
            redirect('user', [
                'passwordError' => $error->content
            ]);
            return;
        }

        $oldPassword = inputs('oldPassword');
        $password = inputs('password');
        $confirmPassword = inputs('confirmPassword');

        if($password != $confirmPassword) {
            redirect('user', [
                'passwordError' => [
                    'Confirm password do not match !'
                ]
            ]);
            return;
        }

        try {
            $result = DB::exec(
                QB::table('users')
                ->select('count(*) as count')
                ->where('password', encrypt($oldPassword))
                ->and()
                ->where('id', session('user')->id)
            )[0]->count;
        } catch (Exception $e) {
            redirect('user', [
                'passwordError' => [
                    'Something went wrong !',
                    'Please try again.'
                ]
            ]);
        }

        if($result != 1) {
            redirect('user', [
                'passwordError' => [
                    'Password do not match !'
                ]
            ]);
            return;
        }

        try {
            $result = DB::exec(
                QB::table('users')
                ->update('password', encrypt($password))
                ->where('id', session('user')->id)
            );
        } catch (Exception $e) {
            redirect('user', [
                'passwordError' => [
                    'Something went wrong !',
                    'Please try again.'
                ]
            ]);
        }

        if ($result->affectedRows > 0) {
            redirect('user', [
                'status' => 'Operaton success !'
            ]);
        } else {
            redirect('user', [
                'passwordError' => [
                    'Something went wrong !',
                    'Please try again.'
                ]
            ]);
        }
    }

    public function getDeposit() {
        Auth::check();

        $data = static::load('Deposit', 'Deposit');
        $data['billingAddress'] = DB::exec(
            QB::table('profiles')
            ->select('profiles.billing_info as billingAddress')
            ->innerJoin('users')
            ->on('profiles.user_id', 'users.id')
            ->where('users.id', session('user')->id)
        )[0]->billingAddress;
        render('transitions.deposit', $data);
    }

    public function postDeposit() {
        Auth::check();
        $error = required([
            'depositAmount'
        ]);

        if($error->hasError) {
            redirect('deposit', [
                'error' => $error->content
            ]);
        } else {
            $depositAmount = inputs('depositAmount');

            if($depositAmount < Config::get('mindeposit')) {
                redirect('deposit', [
                    'error' => ['Minimum deposit amount is 5000 MMK']
                ]);
            } else {
                $result = DB::exec(
                    QB::table('transactions')
                    ->insert('user_id, completed, date, amount, type', session('user')->id, 0, date('Y-m-d H:i:s') , $depositAmount, Config::get('transaction.deposit'))
                );

                if ($result->affectedRows > 0) {
                    redirect('deposit', [
                        'status' => 'Deposit request sent !'
                    ]);
                } else {
                    redirect('deposit',
                        [
                            'error' => [
                                'Someting went wrong',
                                'Please try again'
                            ]
                        ]
                    );
                }
            }
        }
    }

    public function getWithdraw() {
        Auth::check();
        Auth::proirity(2);
        $data = static::load('Withdraw', 'Withdraw');
        render('transitions.withdraw', $data);
    }

    public function postWithdraw() {
        Auth::check();
        Auth::proirity(2);

        $error = required([
            'withdrawAmount'
        ]);
        if($error->hasError) {
            redirect('withdraw', [
                'error' => $error->content
            ]);
        } else {
            $balance = DB::exec(
                QB::table('profiles')
                ->select('balance')
                ->where('user_id', session('user')->id)
            )[0]->balance;

            $withdrawAmount = inputs('withdrawAmount');

            if($withdrawAmount < Config::get('minwithdraw')) {
                redirect('withdraw', [
                    'error' => ['Min withdraw amount is 5000 MMK']
                ]);
            }
            elseif($withdrawAmount > $balance) {
                redirect('withdraw', [
                    'error' => [
                        'Not enouch balance'
                    ]
                ]);
            } // 15000 - 11000 = 4000
            elseif(($balance - $withdrawAmount) < 5000 && ($balance - $withdrawAmount) != 0) {
                $left = $balance - $withdrawAmount;
                $require_amount = 5000 - $left;
                redirect('withdraw', [
                    'error' => [
                        'You can\'t withdraw',
                        'You can\'t leave money less than 5000 in your account',
                        'Please try ' . ($withdrawAmount + $left) . ' MMK or ' . ($withdrawAmount - $require_amount) . ' MMK'
                    ]
                ]);
            }else {
                DB::query('update profiles set balance = balance - ? where user_id = ?', [
                    $withdrawAmount,
                    session('user')->id
                ]);

                $result = DB::exec(
                    QB::table('transactions')
                    ->insert('user_id, completed, date, amount, type', session('user')->id, 0, date('Y-m-d H:i:s') ,$withdrawAmount, Config::get('transaction.withdraw'))
                );

                if ($result->affectedRows > 0) {
                    redirect('withdraw', [
                        'status' => 'Withdraw request sent !'
                    ]);
                } else {
                    redirect('withdraw', [
                        'error' => [
                            'Something went wrong',
                            'Please try again'
                        ]
                    ]);
                }
            }
        }
    }

    public function getLogs() {
        Auth::check();

        $data = static::load('Logs', 'Logs');

        $data['deposit'] = DB::exec(
            QB::table('transactions')
            ->select('id, amount, date, completed')
            ->where('user_id', session('user')->id)
            ->and()
            ->where('type', Config::get('transaction.deposit'))
        );

        $data['withdraw'] = DB::exec(
            QB::table('transactions')
            ->select('id, amount, date, completed')
            ->where('user_id', session('user')->id)
            ->and()
            ->where('type', Config::get('transaction.withdraw'))
        );

        render('transitions.logs', $data);
    }

    public function reportLog($id) {
        Auth::check();

        try {
            $result = DB::exec(
                QB::table('transactionreports')
                ->insert('transaction_id', $id)
            );

            redirect('logs', [
                'status' => 'Operation success'
            ]);
        } catch (Exception $e) {
            if (strstr($e->getMessage(), 'Duplicate entry')) {
                redirect('logs', [
                    'status' => 'This transaction is already reported'
                ]);
            }
        }
    }
}
