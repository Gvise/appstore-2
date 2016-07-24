<?php
class Pages {

    public static function load($stitle, $page) {
    	$title = Config::get('title');
    	$subtitle = $stitle;

        //get categories and notifications from db;
        $wishlistCount = 8;
    	$categories = [
            [ 'id' => 1, 'name' => 'Category 1']
        ];

        $categoryGames = [
            [ 'id' => 2, 'name' => 'G_Category 1']
        ];

    	$notifications = ['adsfsdfasdf'];

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
            'selectNewReleases', 'currentPage'
        );
    }

    public function getIndex() {
        redirect(url('home'));
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
        Auth::proirity(3);

        $data = static::load('Account Settings', 'Account Settings');
        $userInfos = DB::query('select profiles.name, users.email, profiles.nrc, profiles.billing_info as billingInfo, profiles.address from users, profiles where users.id = profiles.user_id and users.id = ?', [
            session('user')['id']
        ])[0];

        $data = $data + $userInfos;

        render('user-settings', $data);
    }

    public function postUser() {
        Auth::check();
        Auth::proirity(3);

        $error = required([
            'name', 'email', 'nrc',
            'billingInfo','address'
        ]);

        if(count($error) > 0) {
            redirect(url('user'), [
                'profileError' => $error
            ]);
            return;
        }

        $name = inputs('name');
        $email = inputs('email');
        $nrc = inputs('nrc');
        $billingInfo = inputs('billingInfo');
        $address = inputs('address');

        $results = DB::query('update users set email = ? where id = ?', [
            $email,
            session('user')['id']
        ]);

        if(strstr($results, 'Duplicate entry') == false) {
            $results = DB::query('update profiles set name = ?, nrc = ?, billing_info = ?, address = ? where user_id = ?', [
                $name,
                $nrc,
                $billingInfo,
                $address,
                session('user')['id']
            ]);

            if(strstr($results, 'Duplicate entry') == false) {
                redirect(url('user'), [
                    'status' => 'Operation success !'
                ]);
                return;
            } else {
                $error[] = 'Duplicated NRC';
            }
        } else {
            $error[] = 'Duplicated email';
        }

        redirect(url('user'), [
            'profileError' => $error
        ]);
    }

    public function postUserPassword() {
        Auth::check();
        Auth::proirity(3);

        $error = required([
            'oldPassword',
            'password',
            'confirmPassword'
        ]);

        if(count($error) > 0) {
            redirect(url('user'), [
                'passwordError' => $error
            ]);
            return;
        }

        $oldPassword = inputs('oldPassword');
        $password = inputs('password');
        $confirmPassword = inputs('confirmPassword');

        if($password != $confirmPassword) {
            redirect(url('user'), [
                'passwordError' => [
                    'Confirm password do not match !'
                ]
            ]);
            return;
        }

        $result = DB::query('select count(*) as count from users where password = ? and id = ?', [
            encrypt($oldPassword),
            session('user')['id']
        ])[0]['count'];

        if($result != 1) {
            redirect(url('user'), [
                'passwordError' => [
                    'Password do not match !'
                ]
            ]);
            return;
        }

        $result = DB::query('update users set password = ? where id= ?', [
            encrypt($password),
            session('user')['id']
        ]);

        if ($result['affectedRows'] > 0) {
            redirect(url('user'), [
                'status' => 'Operaton success !'
            ]);
        } else {
            redirect(url('user'), [
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

        Auth::check();

        if(count($error = required([
            'withdrawAmount'
        ])) > 0) {
            redirect(url('withdraw'), [
                'error' => $error
            ]);
        } else {
            $withdrawAmount = inputs('withdrawAmount');

            if($withdrawAmount < Config::get('minwithdraw')) {
                $error[]= 'Minimum withdraw amount is 5000 MMK';
                redirect(url('withdraw'), [
                    'error' => $error
                ]);
            } else {
                // var_dump((new DateTime())->format('Y-m-d'));
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
        $data = static::load('Logs', 'Logs');
        //get from database
        $data['deposit'] = [
            [
                'amount' => 10000,
                'date' => '06/03/2016',
                'completed' => true
            ],
            [
                'amount' => 20000,
                'date' => '07/03/2016',
                'completed' => false
            ]
        ];

        $data['withdraw'] = [
            [
                'amount' => 10000,
                'date' => '06/03/2016',
                'completed' => true
            ],
            [
                'amount' => 20000,
                'date' => '07/03/2016',
                'completed' => false
            ]
        ];
        render('transitions.logs', $data);
    }
}
