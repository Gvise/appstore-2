<?php
class Tasks {
    public function clearNotifications() {
        redirect(url(''), ['status' => "All notifications cleared!"]);
    }
}
