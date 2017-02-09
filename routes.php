<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'home':
      require_once('models/user.php');
        $controller = new HomeController();
      break;
      case 'admin':
              require_once('models/user.php');
              require_once('models/adminData.php');
        $controller = new AdminController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('home'=>['index','catalog','contacts','partners','BuyLV','error'                   ],'admin' => ['index','login','logout','users','singleUser','applications','approve','settings']);
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('home', 'error');
    }
  } else {
    call('home', 'error');
  }
?>