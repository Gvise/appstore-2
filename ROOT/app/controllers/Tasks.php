<?php
class Tasks {
    public function getAppDownload($id) {
        try {
            $path = DB::exec(
                QB::table('appdetails')
                ->select('path')
                ->where('app_id', $id)
            )[0]->path;

            $file = Config::get('apppath') . $path;
            if(!file_exists($file)) {
                redirect('app/' . $id, [
                    'status' => 'Download failed'
                ]);
            } else {
                DB::query('update appdetails set downloads = downloads + 1 where app_id = ?', [$id]);

                header("Cache-Control: public");
                header("Content=Description: File Transfer");
                header("Content-Disposition: attachment; filename=$path");
                header("Content-Type: application/zip");
                header("Content-Transfer-Encodeing: binary");

                readfile($file);
            }
        } catch (Exception $e) {

        }
    }

    public function getAppBuy($id) {
        Auth::check();

        try {
            $alreadyDone = DB::exec(
                QB::table('purchases')
                ->select('count(*) as count')
                ->where('user_id', session('user')->id)
                ->and()
                ->where('app_id', $id)
            )[0]->count != 0 ? true : false;

            if (!$alreadyDone) {
                $application = DB::exec(
                    QB::table('applications')
                    ->select('applications.user_id as sellerId, appdetails.price')
                    ->innerJoin('appdetails')->on('applications.id', 'appdetails.app_id')
                    ->where('applications.id', $id)
                )[0];
                $buyerId = session('user')->id;

                $buyerBalance = DB::exec(
                    QB::table('profiles')
                    ->select('balance')
                    ->where('user_id', $buyerId)
                )[0]->balance;

                if ($buyerBalance < $application->price) {
                    redirect('app/' . $id, [
                        'status' => 'Not enough balance'
                    ]);
                } else {
                    DB::query('update profiles set balance = balance - ? where user_id = ?', [
                        $application->price,
                        $buyerId
                    ]);

                    $price2Seller = $application->price * (1 - Config::get('percent'));
                    $price2Admin = $application->price - $price2Seller;
                    DB::query('update profiles set balance = balance + ? where user_id = ?', [
                        $price2Seller,
                        $application->sellerId
                    ]);

                    DB::query('update profiles set balance = balance + ? where user_id = ?', [
                        $price2Admin,
                        Config::get('adminId')
                    ]);

                    DB::exec(
                        QB::table('purchases')
                        ->insert('user_id, app_id, price, date', $buyerId, $id, $application->price, date('Y-m-d h-m-s'))
                    );

                    redirect('app/' . $id, [
                        'status' => 'Operation success'
                    ]);
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            redirect('home', [
                'status' => 'Something went wrong'
            ]);
        }

    }

    public function getAppRate($id, $star) {
        Auth::check();

        if ($star > 4 || $star < 0) {
            redirect('app/' . $id, [
                'status' => 'Something went wrong'
            ]);
            return;
        }
        try {
            $alreadyDone = DB::exec(
                QB::table('stars')
                ->select('count(*) as count')
                ->where('user_id', session('user')->id)
                ->and()
                ->where('app_id', $id)
            )[0]->count != 0 ? true : false;

            if (!$alreadyDone) {
                $affectedRows = DB::exec(
                    QB::table('stars')
                    ->insert('user_id, app_id, star', session('user')->id, $id, $star)
                )->affectedRows;

                if ($affectedRows > 0) {
                    $this->fixRating($id);

                    redirect('app/' . $id, [
                        'status' => 'Operation success'
                    ]);
                } else {
                    redirect('app/' . $id, [
                        'status' => 'Something went wrong'
                    ]);
                }
            } else {
                $affectedRows = DB::exec(
                    QB::table('stars')
                    ->update('star', $star)
                    ->where('user_id', session('user')->id)->and()
                    ->where('app_id', $id)
                )->affectedRows;

                if ($affectedRows > 0) {
                    $this->fixRating($id);

                    redirect('app/' . $id, [
                        'status' => 'Operation success'
                    ]);
                } else {
                    redirect('app/' . $id, [
                        'status' => 'Something went wrong'
                    ]);
                }
            }


        } catch (Exception $e) {
            redirect('home', [
                'status' => 'Something went wrong'
            ]);
        }

    }

    public function fixRating($id) {
        $ratings = [];
        $ratings[] = DB::exec(
            QB::table('stars')
            ->select('count(*) as count')
            ->where('app_id', $id)
            ->and()
            ->where('star', 1)
        )[0]->count;

        $ratings[] = DB::exec(
            QB::table('stars')
            ->select('count(*) as count')
            ->where('app_id', $id)
            ->and()
            ->where('star', 2)
        )[0]->count;

        $ratings[] = DB::exec(
            QB::table('stars')
            ->select('count(*) as count')
            ->where('app_id', $id)
            ->and()
            ->where('star', 3)
        )[0]->count;

        $ratings[] = DB::exec(
            QB::table('stars')
            ->select('count(*) as count')
            ->where('app_id', $id)
            ->and()
            ->where('star', 4)
        )[0]->count;

        $ratings[] = DB::exec(
            QB::table('stars')
            ->select('count(*) as count')
            ->where('app_id', $id)
            ->and()
            ->where('star', 5)
        )[0]->count;

        $max = 0;
        $n = 0;

        foreach ($ratings as $key => $value) {
            $max += ($key + 1) * $value;
            $n += $value;
        }

        $rating = $max/$n;

        $afr = DB::exec(
            QB::table('applications')
            ->update('rating', $rating)
            ->where('id', $id)
        )->affectedRows;

        return $afr > 0 ? true : false;
    }

    public function getAddToWishlist($id) {
        Auth::check();
        try {
            $alreadyDone = DB::exec(
                QB::table('wishlist')
                ->select('count(*) as count')
                ->where('user_id', session('user')->id)
                ->and()
                ->where('app_id', $id)
            )[0]->count != 0 ? true : false;

            if (!$alreadyDone) {
                $affectedRows = DB::exec(
                    QB::table('wishlist')
                    ->insert('user_id, app_id', session('user')->id, $id)
                )->affectedRows;

                if ($affectedRows > 0) {
                    redirect('app/' . $id, [
                        'status' => 'Operation success'
                    ]);
                } else {
                    redirect('app/' . $id, [
                        'status' => 'Something went wrong'
                    ]);
                }
            } else {
                redirect('app/' . $id, [
                    'status' => 'Already in your wishlist'
                ]);
            }
        } catch (Exception $e) {
            redirect('home' . $id, [
                'status' => 'Something went wrong'
            ]);
        }
    }

    public function getAppReport($id) {
        Auth::check();
        try {
            $alreadyDone = DB::exec(
                QB::table('inappropirateapps')
                ->select('count(*) as count')
                ->where('user_id', session('user')->id)
                ->and()
                ->where('app_id', $id)
            )[0]->count != 0 ? true : false;

            if (!$alreadyDone) {
                $affectedRows = DB::exec(
                    QB::table('inappropirateapps')
                    ->insert('user_id, app_id', session('user')->id, $id)
                )->affectedRows;

                if ($affectedRows > 0) {
                    redirect('app/' . $id, [
                        'status' => 'Operation success'
                    ]);
                } else {
                    redirect('app/' . $id, [
                        'status' => 'Something went wrong'
                    ]);
                }
            } else {
                redirect('app/' . $id, [
                    'status' => 'You have already reported this app'
                ]);
            }
        } catch (Exception $e) {
            redirect('home', [
                'status' => 'Something went wrong'
            ]);
        }
    }

    public function getWishlistDelete($id) {
        Auth::check();
        try {
            $result = DB::exec(
                QB::table('wishlist')
                ->delete()
                ->where('app_id', $id)
                ->and()
                ->where('user_id', session('user')->id)
            );

            if ($result->affectedRows > 0 ) {
                redirect('wishlist', [
                    'status' => 'Operation success'
                ]);
            }
        } catch (Exception $e) {
            redirect('wishlist', [
                'status' => 'Something went wrong'
            ]);
        }
    }

    public function clearNotifications() {
        Auth::check();

        $id = session('user')->id;
        $results = DB::exec(QB::table('notifications')->delete()->where('user_id', $id));
        redirect('', [
            'status' => $results->affectedRows . ' notifications deleted !'
        ]);
    }

    public function postNotificationSend() {
        Auth::proirity(3);
        try
        {
            $error = required([
                'content',
                'proirity'
            ]);

            $id = inputs('id');
            $proirity = inputs('proirity');
            $content = inputs('content');

            if ($error->hasError) {
                redirect(('admin/notify'), [
                    $id == "0" ? 'errorAll' : 'error' => $error->content
                ]);
            } else {
                if($id == "0") {
                    $userIds = DB::exec(
                        QB::table('users')
                        ->select('id')
                    );

                    foreach ($userIds as $key => $value) {
                        DB::exec(
                            QB::table('notifications')
                            ->insert('user_id,proirity,content', $value->id, $proirity, $content)
                        );
                    }
                } else {
                    DB::exec(
                        QB::table('notifications')
                        ->insert('user_id,proirity,content', $id, $proirity, $content)
                    );
                }

                redirect('admin/notify', [
                    'status' => 'Notification sent !'
                ]);
            }
        } catch (Exception $e) {
            echo $e->getMessage(); die();
            redirect('admin/notify', [
                'error' => [
                    'Something went wrong',
                    'Please try again'
                ]
            ]);
        }
    }

    public function filterStatistics() {
        Auth::check();
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
        Auth::check();
        Auth::proirity(3);

        $error = required([
            'categoryName'
        ]);

        if($error->hasError) {
            redirect(('admin/cateplat'), [
                'error' => $error->content
            ]);
            return;
        }

        $categoryName = inputs('categoryName');
        $isGame = inputs('isGame');

        if($isGame == "on")
            $categoryName = 'G_' . $categoryName;

        $results = DB::exec(
            QB::table('categories')
            ->insert('name', $categoryName)
        );

        if($results->affectedRows > 0) {
            redirect('admin/cateplat', [
                'status' => 'New category added'
            ]);
        } else {
            redirect('admin/cateplat', [
                'error' => [
                    'Something went wrong',
                    'Please try again'
                ]
            ]);
        }
    }

    public function postAdminAddPlatform() {
        Auth::check();
        Auth::proirity(3);

        $error = required([
            'platformName'
        ]);

        if($error->hasError) {
            redirect(('admin/cateplat'), [
                'error' => $error->content
            ]);
            return;
        }

        $platformName = inputs('platformName');
        $results = DB::exec(
            QB::table('platforms')
            ->insert('name', $platformName)
        );

        if($results->affectedRows > 0) {
            redirect('admin/cateplat', [
                'status' => 'New platform added'
            ]);
        } else {
            redirect('admin/cateplat', [
                'error' => [
                    'Something went wrong',
                    'Please try again'
                ]
            ]);
        }
    }

    public function getAdminDelCategory($id) {
        Auth::check();
        Auth::proirity(3);

        DB::query('delete from categories where id = ?', [
            $id
        ]);

        redirect(('admin/cateplat'), [
            'status' => 'Category deleted !'
        ]);
    }

    public function getAdminDelPlatform($id) {
        Auth::check();
        Auth::proirity(3);

        DB::query('delete from platforms where id = ?', [
            $id
        ]);

        redirect(('admin/cateplat'), [
            'status' => 'Platform deleted !'
        ]);
    }
}
