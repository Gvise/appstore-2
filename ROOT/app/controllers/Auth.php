<?php
class Auth {
    public static function check($reverse = false) {
        if($reverse) {
            if (session('user') != null) {
                redirect('');
                exit();
            }
            return;
        }

        if(session('user') == null) {
            redirect('join', [
                'status' => 'Please Log In !'
            ]);
            exit();
        }
    }

    public static function proirity($proirity) {
        switch ($proirity) {
            case 3:
                if(session('user')->type < 3) {
                    redirect('', [
                        'status' => 'You are not an administrator !'
                    ]);
                    exit();
                }
            break;

            case 2:
                if(session('user')->type < 2) {
                    redirect('', [
                        'status' => 'You are not a developer !'
                    ]);
                    exit();
                }
        }
    }

    public function getJoin() {
        Auth::check(true);
        $title = Config::get('title');
    	$subtitle = 'Join';
    	render('join', compact(
    		'title', 'subtitle'
    	));
    }

    public function postLogin() {
        Auth::check(true);
        $error = required([
            'email',
            'password'
        ]);

        if($error->hasError) {
            redirect('join', [
                'loginOnly' => 1,
                'lerror' => $error->content
            ]);
            return;
        }

        $email = inputs('email');
        $password = encrypt(inputs('password'));

        $query = new Query('users');
        $query->select('users.*, profiles.name')
              ->innerJoin('profiles')
              ->on('users.id', 'profiles.user_id')
              ->where('users.email',$email)
              ->and()
              ->where('users.password', $password);

        try {
            $results = DB::exec($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }

        if($results == null) {
            redirect('join', [
                'loginOnly' => 1,
                'lerror' => [
                    'Incorrect username and password.'
                ]
            ]);
            return;
        }

        $user = $results[0];
        unset($user->password);

        session('user', $user);
        redirect('');
    }

    public function postRegister() {
        Auth::check(true);
        $error = required([
            'email',
            'password',
            'confirmPassword',
            'name',
            'nrc',
            'billingInfo',
            'address'
        ]);

        if($error->hasError) {
            redirect('join', [
                'rerror' => $error->content
            ]);
            return;
        }

        $email = inputs('email');
        $password = inputs('password');
        $confirmPassword = inputs('confirmPassword');
        $name = inputs('name');
        $nrc = inputs('nrc');
        $billingInfo = inputs('billingInfo');
        $address = inputs('address');
        $developer = inputs('developer');

        if($password != $confirmPassword) {
            redirect('join', [
                'rerror' => [
                    'Password do not match !'
                ]
            ]);
            return;
        }

        $password = encrypt($password);
        $userId = -1;
        $success = false;

        $query = new Query('users');
        $query->insert('email,password,type',[
            $email,
            $password,
            $developer == 'on' ? 2 : 1
        ]);

        try {
            $result = DB::exec($query);
        } catch (PDOException $e) {
            if (strstr($e->getMessage(), 'Duplicate')) {
                redirect('join', [
                    'rerror' => [
                        'Email already exists.'
                    ]
                ]);
            } else {
                redirect('join', [
                    'rerror' => [
                        'Error ! Something went wrong .'
                    ]
                ]);
            }
            return;
        }

        if($result->affectedRows > 0) {
            $userId = $result->lastId;
        }

        $query = new Query('profiles');
        $query->insert('user_id, name, nrc, billing_info, address, balance', [
            $userId,
            $name,
            $nrc,
            $billingInfo,
            $address,
            0
        ]);

        try {
            $result = DB::exec($query);
        } catch (PDOException $e) {
            $query = new Query('users');
            $query->delete()->where('id',$userId);
            DB::exec($query);

            if (strstr($e->getMessage(), 'Duplicate')) {
                redirect('join', [
                    'rerror' => [
                        'NRC already exists.'
                    ]
                ]);
            } else {
                redirect('join', [
                    'rerror' => [
                        'Error ! Something went wrong .'
                    ]
                ]);
            }
            return;
        }

        if($result->affectedRows > 0) {
            $success = true;
        }

        if($success) {
            redirect('join', [
                'status' => 'Registeration Success !'
            ]);
            return;
        } else {
            redirect('join', [
                'rerror' => [
                    'Error ! Something went wrong .'
                ]
            ]);
        }
    }

    public function getRecover() {
        $title = Config::get('title');
        $subtitle = 'Recover';
        render('recover', compact(
            'title', 'subtitle'
        ));
    }

    public function postRecover() {

    }

    public function getLogout() {
        session('user', null);
        redirect('');
    }
}
