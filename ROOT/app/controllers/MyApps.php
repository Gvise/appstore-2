<?php
class MyApps {
    public function getMyAppsPurchased() {
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

    public function getMyAppsPublished() {
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

    public function getMyAppsStatsToday() {
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

    public function getMyAppsStatsThisWeek() {
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

    public function getMyAppsStatsThisMonth(array $apps = null) {
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

    public function getMyAppsInapp() {
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
}
