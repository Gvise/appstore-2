<?php
class Tasks {
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
