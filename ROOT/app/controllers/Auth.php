<?php
class Auth {
    public static function check($reverse = false) {
        if($reverse) {
            if (session('user') != null) {
                redirect(url(''));
                exit();
            }
            return;
        }

        if(session('user') == null) {
            redirect(url(''), [
                'status' => 'Please Log In !'
            ]);
            exit();
        }
    }

    public static function proirity($proirity) {
        switch ($proirity) {
            case 3:
                if(session('user')['type'] != 3) {
                    redirect(url(''), [
                        'status' => 'You are not an administrator !'
                    ]);
                    exit();
                }
            break;

            case 2:
                if(session('user')['type'] != 3) {
                    redirect(url(''), [
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
        //Log In Error တက်ရင် loginOnly => 1 နဲ့ Redirect လုပ်ပေး
        $error = required([
            'email',
            'password'
        ]);

        if(count($error) > 0) {
            redirect(url('join'), [
                'loginOnly' => 1,
                'lerror' => $error
            ]);
            return;
        }

        $email = inputs('email');
        $password = encrypt(inputs('password'));
        $query = 'select users.*,profiles.name from users, profiles where users.email=? and users.password=? and users.id = profiles.user_id';
        $results = DB::query($query, [
            $email,
            $password
        ]);

        if($results == null) {
            redirect(url('join'), [
                'loginOnly' => 1,
                'lerror' => [
                    'Incorrect username and password.'
                ]
            ]);
            return;
        }

        $user = $results[0];
        unset($user['password']);

        session('user', $user);
        redirect(url(''));
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

        if(count($error) > 0) {
            redirect(url('join'), [
                'rerror' => $error
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
            redirect(url('join'), [
                'rerror' => [
                    'Password do not match !'
                ]
            ]);
            return;
        }

        $password = encrypt($password);
        $userId = -1;
        $success = false;

        $results = DB::query('insert into users (email, password, type) values(?,?,?)', [
            $email, $password, $developer == "on" ? 2 : 1
        ]);

        if($results['affectedRows'] > 0) {
            $userId = $results['lastId'];
        }

        $results = DB::query('insert into profiles (user_id, name, nrc, billing_info, address, balance) values (?,?,?,?,?,?)', [
            $userId,
            $name,
            $nrc,
            $billingInfo,
            $address,
            0
        ]);

        if($results['affectedRows'] > 0) {
            $success = true;
        }

        if($success) {
            redirect(url('join'), [
                'status' => 'Registeration Success !'
            ]);
            return;
        } else {
            redirect(url('join'), [
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
        redirect(url(''));
    }
}
