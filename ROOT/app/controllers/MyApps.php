<?php
class MyApps {
    public function __construct() {
        Auth::check();
    }

    public function getPurchased() {
        $data = Pages::load('Purchased', 'My Apps');

        //get from database;
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

        render('myapps.purchased', $data);
    }

    public function getPublished() {
        $data = Pages::load('Published', 'My Apps');

        //get from database;
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

        render('myapps.published', $data);
    }

    public function getStatsToday() {
        $data = Pages::load('Stats', 'My Apps');
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'platform' => 'Android',
                'price' => 5000,
                'quantity' => 5
            ]
        ];
        render('myapps.stats.today', $data);
    }

    public function getStatsThisWeek() {
        $data = Pages::load('Stats', 'My Apps');
        $data['apps'] = [
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
        render('myapps.stats.week', $data);
    }

    public function getStatsThisMonth(array $apps = null) {
        $data = Pages::load('Stats', 'My Apps');
        if ($apps != null) {
            $data['apps'] = $apps;
        } else {
            //get from db
            $data['apps'] = [
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
        }
        render('myapps.stats.month', $data);
    }

    public function getInapp() {
        $data = Pages::load('My Inappropirate Apps', 'My Apps');
        $data['apps'] = [
            [
                'id' => 1,
                'name' => 'Warlings',
                'platform' => 'Android',
                'reportcount' => 5
            ]
        ];
        render('myapps.inapps', $data);
    }

    public function getPublish() {
        Auth::proirity(2);

        $data = Pages::load('Publish', 'My Apps');

        render('myapps.publish', $data);
    }

    public function postPublish() {
        Auth::proirity(2);
        if(count($error = required([
            'name',
            'appPlatform',
            'appCategory',
            'price',
            'version',
            'details',
            'extra'
        ])) > 0) {
            redirect(url('myapps/publish'), [
                'error' => $error
            ]);
            return;
        }

        if(count($error = filesRequired([
            'icon',
            'screenshots',
            'app'
        ])) > 0) {
            redirect(url('myapps/publish'), [
                'error' => $error
            ]);
            return;
        }

        $name = inputs('name');
        $appPlatform = inputs('appPlatform');
        $appCategory = inputs('appCategory');
        $price = inputs('price');
        $version = inputs('version');
        $details = inputs('details');
        $extra = inputs('extra');
        $size = $_FILES['app']['size'];

        $prefix = session('user')['id'].date('ymdhms');
        $icon = $prefix.$_FILES['icon']['name'];
        $app = $prefix.$_FILES['app']['name'];
        $screenshots = $_FILES['screenshots']['name'];


        $keyword = strtolower(str_replace(' ', '_', $name));
        $query = 'insert into applications (user_id, category_id, platform_id, keyword, rating, updated_date, icon) values(?,?,?,?,?,now(),?)';
        $result = DB::query($query, [
            session('user')['id'],
            $appCategory,
            $appPlatform,
            $keyword,
            0,
            $icon
        ]);

        $appId = $result['lastId'];

        $query = 'insert into appdetails (app_id,name,path,version,price,size,downloads,details,extra) values (?,?,?,?,?,?,?,?,?)';
        $result = DB::query($query, [
            $appId,
            $name,
            $app,
            $version,
            $price,
            $size,
            0,
            $details,
            $extra
        ]);

        foreach ($screenshots as $key => $value) {
            $file = $prefix.$value;
            DB::query('insert into screenshots (app_id,path) values(?,?)',[
                $appId,
                $file
            ]);
        }

        File::upload('icon', [
            'sizelimit' => 15097152,
            'extensions' => ['jpg', 'jpeg', 'png', 'webp', 'ico'],
            'name' => $icon,
            'path' => Config::get('iconpath')
        ], function($result) {
            redirect(url('myapps/publish'), [
                'error' => $result
            ]);
            exit();
        });

        File::upload('app', [
            'name' => $app,
            'path' => Config::get('apppath')
        ], function($result) {
            redirect(url('myapps/publish'), [
                'error' => $result
            ]);
            exit();
        });

        File::uploadMany('screenshots', [
            'sizelimit' => 15097152,
            'extensions' => ['jpg', 'jpeg', 'png', 'webp', 'ico'],
            'prefix' => $prefix,
            'path' => Config::get('sspath')
        ], function($errors) {
            redirect(url('myapps/publish'), [
                'error' => $errors
            ]);
            exit();
        });

        redirect(url('myapps/publish'), [
            'status' => 'Operation success !'
        ]);
   }
}
