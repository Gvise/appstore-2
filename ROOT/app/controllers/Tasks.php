<?php
class Tasks {
    public function clearNotifications() {
        Auth::check();

        $id = session('user')['id'];
        $results = DB::query('delete from notifications where user_id = ?', [
            $id
        ]);
        redirect(url(''), [
            'status' => $results['affectedRows'] . ' notifications deleted !'
        ]);
    }

    public function postNotificationSend() {
        if(session('user')['type'] < 3) {
            redirect(url(''));
            return;
        }

        $error = required([
            'content',
            'proirity'
        ]);

        $id = inputs('id');
        $proirity = inputs('proirity');
        $content = inputs('content');

        if (count($error) > 0) {
            redirect(url('admin/notify'), [
                $id == "0" ? 'errorAll' : 'error' => $error
            ]);
            return;
        }

        if($id == "0") {
            $userIds = DB::query('select id from users');
            foreach ($userIds as $key => $value) {
                DB::query('insert into notifications (user_id, proirity, content) values (?,?,?)', [
                    $value['id'],
                    $proirity,
                    $content
                ]);
            }
        } else {
            DB::query('insert into notifications (user_id, proirity, content) values (?,?,?)', [
                $id,
                $proirity,
                $content
            ]);
        }

        redirect(url('admin/notify'), [
            'status' => 'Notification sent !'
        ]);
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

        if(count($error) > 0) {
            redirect(url('admin/cateplat'), [
                'error' => $error
            ]);
            return;
        }

        $categoryName = inputs('categoryName');
        $isGame = inputs('isGame');

        if($isGame == "on")
            $categoryName = 'G_' . $categoryName;

        $results = DB::query('insert into categories (name) values (?)', [
            $categoryName
        ]);

        if($results['affectedRows'] > 0) {
            redirect(url('admin/cateplat'), [
                'status' => 'New category added !'
            ]);
        } else {
            redirect(url('admin/cateplat'), [
                'error' => [
                    'Something went wrong !',
                    'Please try again.'
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

        if(count($error) > 0) {
            redirect(url('admin/cateplat'), [
                'error' => $error
            ]);
            return;
        }

        $platformName = inputs('platformName');
        $results = DB::query('insert into platforms (name) values (?)', [
            $platformName
        ]);

        if($results['affectedRows'] > 0) {
            redirect(url('admin/cateplat'), [
                'status' => 'New platform added !'
            ]);
        } else {
            redirect(url('admin/cateplat'), [
                'error' => [
                    'Something went wrong !',
                    'Please try again.'
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

        redirect(url('admin/cateplat'), [
            'status' => 'Category deleted !'
        ]);
    }

    public function getAdminDelPlatform($id) {
        Auth::check();
        Auth::proirity(3);

        DB::query('delete from platforms where id = ?', [
            $id
        ]);

        redirect(url('admin/cateplat'), [
            'status' => 'Platform deleted !'
        ]);
    }
}
