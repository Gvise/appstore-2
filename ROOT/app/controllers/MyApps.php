<?php
class MyApps {
    public function __construct() {
        Auth::check();
    }

    public function getDelete($id) {
        Auth::proirity(2);

        $userId = session('user')->id;
        $appId = $id;

        try {
            $icon = Config::get('iconpath') . DB::exec(
                QB::table('applications')
                ->select('icon')
                ->where('id', $appId)
                ->and()
                ->where('user_id', $userId)
            )[0]->icon;

            $file = Config::get('apppath') . DB::exec(
                QB::table('appdetails')
                ->select('path as file')
                ->innerJoin('applications')->on('applications.id', 'appdetails.app_id')
                ->where('app_id', $appId)
                ->and()
                ->where('applications.user_id', $userId)
            )[0]->file;

            $screenshots = DB::exec(
                QB::table('screenshots')
                ->select('path')
                ->innerJoin('applications')->on('screenshots.app_id', 'applications.id')
                ->where('screenshots.app_id', $appId)
                ->and()
                ->where('applications.user_id', $userId)
            );

            foreach ($screenshots as $key => $value) {
                $screenshots[$key] = Config::get('sspath') . $value->path;
            }

            $toDelete = $screenshots;
            $toDelete[] = $file;
            $toDelete[] = $icon;

            foreach ($toDelete as $key => $value) {
                unlink($value);
            }

            $affectedRows = DB::exec(
                QB::table('applications')
                ->delete()
                ->where('id', $appId)->and()
                ->where('user_id', $userId)
            )->affectedRows;

            if ($affectedRows > 0) {
                redirect('myapps', [
                    'status' => 'Operation Success'
                ]);
            } else {
                redirect('myapps', [
                    'status' => 'Something went wrong'
                ]);
            }
        } catch (Exception $e) {
            redirect('myapps', [
                'status' => 'Something went wrong'
            ]);
        }
    }

    public function getPurchased() {
        $data = Pages::load('Purchased', 'My Apps');

        $data['apps'] = DB::exec(
            QB::table('purchases')
            ->select('applications.id, appdetails.name, profiles.name as developerName, categories.name as categoryName, platforms.name as platformName, purchases.price, purchases.date')
            ->innerJoin('appdetails')
            ->on('purchases.app_id', 'appdetails.app_id')
            ->innerJoin('profiles')
            ->on('purchases.user_id', 'profiles.user_id')
            ->innerJoin('applications')
            ->on('applications.id', 'purchases.app_id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->innerJoin('platforms')
            ->on('applications.platform_id', 'platforms.id')
            ->where('purchases.user_id', session('user')->id)
            ->orderByDesc('date')
        );

        render('myapps.purchased', $data);
    }

    public function getPublished() {
        Auth::proirity(2);

        $data = Pages::load('Published', 'My Apps');

        $data['apps'] = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name, applications.icon, applications.rating, appdetails.price,categories.name as categoryName')
            ->innerJoin('appdetails')
            ->on('appdetails.app_id', 'applications.id')
            ->innerJoin('categories')
            ->on('applications.category_id', 'categories.id')
            ->where('applications.user_id', session('user')->id)
            ->and()
            ->where('applications.platform_id', session('currentPlatform')->id)
        );

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
        Auth::proirity(2);

        $data = Pages::load('My Inappropirate Apps', 'My Apps');

        $apps = DB::exec(
            QB::table('applications')
            ->select('applications.id, appdetails.name as appName, platforms.name as platformName')
            ->innerJoin('appdetails')->on('appdetails.app_id', 'applications.id')
            ->innerJoin('platforms')->on('applications.platform_id', 'platforms.id')
            ->where('applications.user_id', session('user')->id)
        );

        if (!empty($apps)) {
            foreach ($apps as $key => $value) {
                $apps[$key]->reportCount = DB::exec(
                    QB::table('inappropirateapps')
                    ->select('count(*) as count')
                    ->where('app_id', $value->id)
                )[0]->count;

                if ($apps[$key]->reportCount <= 0) {
                    unset($apps[$key]);
                }
            }

            $data['apps'] = $apps;
        }

        render('myapps.inapps', $data);
    }

    public function getPublish() {
        Auth::proirity(2);

        $data = Pages::load('Publish', 'My Apps');

        render('myapps.publish', $data);
    }

    public function postPublish() {
        Auth::proirity(2);
        $error = required([
            'name',
            'appPlatform',
            'appCategory',
            'price',
            'version',
            'details',
            'extra'
        ]);

        if($error->hasError) {
            redirect('myapps/publish', [
                'error' => $error->content
            ]);
            return;
        }

        $error = filesRequired([
            'icon',
            'screenshots',
            'app'
        ]);

        if($error->hasError) {
            redirect('myapps/publish', [
                'error' => $error->content
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

        $keyword = strtolower(str_replace(' ', '_', $name));

        $prefix = session('user')->id . date('ymdhms');
        $icon = $prefix.$_FILES['icon']['name'];
        $app = $prefix.$keyword.$version. '.' .pathinfo($_FILES['app']['name'], PATHINFO_EXTENSION);
        $screenshots = $_FILES['screenshots']['name'];
        $result = DB::exec(
            QB::table('applications')
            ->insert('user_id, category_id, platform_id, keyword, rating, updated_date, icon',
                session('user')->id, $appCategory, $appPlatform, $keyword, 0, date('Y-m-d H:i:s') , $icon
            )
        );

        $appId = $result->lastId;

        $result = DB::exec(
            QB::table('appdetails')
            ->insert('app_id, name, path, version, price, size, downloads, details, extra',
                $appId, $name, $app, $version, $price, $size, 0, $details, $extra
            )
        );

        foreach ($screenshots as $key => $value) {
            $file = $prefix.$value;
            DB::exec(
                QB::table('screenshots')
                ->insert('app_id, path', $appId, $file)
            );
        }

        File::upload('icon', [
            'sizelimit' => 15097152,
            'extensions' => ['jpg', 'jpeg', 'png', 'webp', 'ico'],
            'name' => $icon,
            'path' => Config::get('iconpath')
        ], function($result) {
            redirect('myapps/publish', [
                'error' => $result
            ]);
            exit();
        });

        File::upload('app', [
            'name' => $app,
            'path' => Config::get('apppath')
        ], function($result) {
            redirect('myapps/publish', [
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
            redirect('myapps/publish', [
                'error' => $errors
            ]);
            exit();
        });

        redirect('myapps/publish', [
            'status' => 'Operation success !'
        ]);
   }
}
