<?php
class Pages {

    public static function load($stitle, $page) {
        try {
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

            $wishlistCount = DB::exec(
                QB::table('wishlist')
                    ->select('count(*) as count')
                    ->where('user_id', session('user')->id)
            )[0]->count;

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

            $accountBalance = DB::exec(
                QB::table('profiles')
                    ->select('balance')
                    ->where('user_id', session('user')->id)
            )[0]->balance;

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

        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];
        //get from db
        $data['games'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

    	render('home', $data);
    }

    public function getNewReleases() {
        $data = static::load('New Releases', 'newreleases');

        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

    	render('newreleases', $data);
    }

    public function getSearch() {
        $data = static::load('Search', 'Search Results');
        $data['keyword'] = Request::inputs('q');

        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

        render('search', $data);
    }

    public function getWishlist() {
        $data = static::load('Wishlist', 'Wishlist');
        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

        render('categories', $data);
    }

    public function getCategories($id) {
        //get category name from $id;
        $catname = 'Category Name';
        $data = static::load('Search', 'Category : ' . $catname);
        $data['category'] = $catname;
        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

        render('categories', $data);
    }

    public function getPopularApps() {
        $data = static::load('Popular Apps', 'Popular Apps');

        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

        render('newreleases', $data);
    }

    public function getPopularGames() {
        $data = static::load('Popular Games', 'Popular Games');

        //get from db
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Warlings',
                'icon' => 'warlings.webp',
                'stars' => 5,
                'price' => 0,
                'url' => ''
            ],
            [
                'id' => 1,
                'name' => 'Instagram',
                'icon' => 'instagram.webp',
                'stars' => 4,
                'price' => 1000,
                'url' => ''
            ],
        ];

        render('newreleases', $data);
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
        $data['billingAddress'] = DB::query('select profiles.billing_info as billingAddress from profiles, users where profiles.user_id = users.id and users.id = ?', [
            session('user')['id']
        ])[0]['billingAddress'];
        render('transitions.deposit', $data);
    }

    public function postDeposit() {
        Auth::check();

        if(count($error = required([
            'depositAmount'
        ])) > 0) {
            redirect(url('deposit'), [
                'error' => $error
            ]);
        } else {
            $depositAmount = inputs('depositAmount');

            if($depositAmount < Config::get('mindeposit')) {
                $error[]= 'Minimum deposit amount is 5000 MMK';
                redirect(url('deposit'), [
                    'error' => $error
                ]);
            } else {
                // var_dump((new DateTime())->format('Y-m-d'));
                $result = DB::query('insert into transactions (user_id, completed, date, amount, type) values(?,?,now(),?, ?)', [
                    session('user')['id'],
                    0,
                    $depositAmount,
                    Config::get('transaction.deposit')
                ]);
                if ($result['affectedRows'] > 0) {
                    redirect(url('deposit'), [
                        'status' => 'Deposit request sent !'
                    ]);
                } else {
                    $error[]= 'Something went wrong !';
                    $error[]= 'Please try again';
                    redirect(url('deposit'), [
                        'error' => $error
                    ]);
                }
            }
        }
    }

    public function getWithdraw() {
        $data = static::load('Withdraw', 'Withdraw');

        render('transitions.withdraw', $data);
    }

    public function postWithdraw() {
        Auth::check();
        Auth::proirity(2);

        if(count($error = required([
            'withdrawAmount'
        ])) > 0) {
            redirect(url('withdraw'), [
                'error' => $error
            ]);
        } else {
            $balance = DB::query('select balance from profiles where user_id = ?', [
                session('user')['id']
            ])[0]['balance'];

            $withdrawAmount = inputs('withdrawAmount');

            if($withdrawAmount < Config::get('minwithdraw')) {
                $error[]= 'Minimum withdraw amount is 5000 MMK';
                redirect(url('withdraw'), [
                    'error' => $error
                ]);
            } elseif($withdrawAmount > $balance) {
                $error[]= 'Not enouch balance';
                redirect(url('withdraw'), [
                    'error' => $error
                ]);
            } else {
                DB::query('update profiles set balance = balance - ? where user_id = ?', [
                    $withdrawAmount,
                    session('user')['id']
                ]);

                $result = DB::query('insert into transactions (user_id, completed, date, amount, type) values(?,?,now(),?, ?)', [
                    session('user')['id'],
                    0,
                    $withdrawAmount,
                    Config::get('transaction.withdraw')
                ]);

                if ($result['affectedRows'] > 0) {
                    redirect(url('withdraw'), [
                        'status' => 'Withdraw request sent !'
                    ]);
                } else {
                    $error[]= 'Something went wrong !';
                    $error[]= 'Please try again';
                    redirect(url('withdraw'), [
                        'error' => $error
                    ]);
                }
            }
        }
    }

    public function getLogs() {
        Auth::check();

        $data = static::load('Logs', 'Logs');

        $data['deposit'] = DB::query('select transactions.id, transactions.amount, transactions.date, transactions.completed from transactions where user_id = ? and type = ?', [
            session('user')['id'],
            Config::get('transaction.deposit')
        ]);

        $data['withdraw'] = DB::query('select transactions.id, transactions.amount, transactions.date, transactions.completed from transactions where user_id = ? and type = ?', [
            session('user')['id'],
            Config::get('transaction.withdraw')
        ]);

        render('transitions.logs', $data);
    }

    public function reportLog($id) {
        Auth::check();

        $result = DB::query('insert into transactionreports (transaction_id) values (?)', [
            $id
        ]);

        if (strstr($result, 'Duplicate entry') == false && $result['affectedRows'] > 0) {
            redirect(url('logs'), [
                'status' => 'Operation success !'
            ]);
        } else {
            redirect(url('logs'), [
                'status' => 'This transaction is already reported !'
            ]);
        }
    }
}
