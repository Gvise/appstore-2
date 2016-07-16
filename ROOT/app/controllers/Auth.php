<?php
class Auth {
    public function getJoin() {
        $title = Config::get('title');
    	$subtitle = 'Join';
    	render('join', compact(
    		'title', 'subtitle'
    	));
    }

    public function postLogin() {
        //Log In Error တက်ရင် loginOnly => 1 နဲ့ Redirect လုပ်ပေး
    }

    public function postRegister() {

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
        cookie('user', null);
        redirect(url('home'));
    }
}
