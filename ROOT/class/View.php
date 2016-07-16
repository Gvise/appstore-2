<?php
class View {
    public static function render($view, array $raw = array()) {
        // $data = new Data($raw);
        // unset($raw);
        foreach ($raw as $key => $value) {
            if (is_string($value)) {
                $raw[$key] = htmlspecialchars($value);
            }
        }
        extract($raw);

		$view = str_replace('.', '/', $view);
		$view_path = Config::get('views').$view.'.php';

		if(!file_exists($view_path))
			throw new \Exception('View not found!');
		require $view_path;
	}
}
