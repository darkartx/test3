<?php namespace Test\Controller;

use Test\Model\TaskModel;

class TaskController extends BaseController {

    const PER_PAGE_COUNT = 3;

    public function listAction($routeParams) {
        $currentPage = \intval($_GET['page']) ?: 1;
        $orderBy = $_GET['order_by'];
        $orderDir = $_GET['order_dir'] ? \strtolower($_GET['order_dir']) : null;

        $itemsCount = TaskModel::count();
        $pageTotal = \intval(ceil($itemsCount / static::PER_PAGE_COUNT));

        $list = TaskModel::get(
            static::PER_PAGE_COUNT, 
            ($currentPage - 1) * static::PER_PAGE_COUNT,
            $orderBy,
            $orderDir
        );

        $this->render('list.php', [
            'current_page' => $currentPage,
            'order_by' => $orderBy,
            'order_dir' => $orderDir,
            'page_total' => $pageTotal,
            'list' => $list
        ]);
    }

    public function newAction($routeParams) {
        $model = new TaskModel; 
        $messages = [];    

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->username = \htmlspecialchars($_POST['username']);
            $model->email = \htmlspecialchars($_POST['email']);
            $model->content = \htmlspecialchars($_POST['content']);

            if ($model->validate($messages)) {
                if ($model->save()) {
                    return static::redirectTo('/');
                } else {
                    array_push($messages, ['danger', 'Ошибка при сохранении']);
                }
            }
        }

        $this->render('new.php', [
            'model' => $model,
            'messages' => $messages
        ]);
    }

    public function editAction($routeParams) {
        $messages = [];
        $model = TaskModel::findById($routeParams[1]);

        if (\is_null($model)) {
            return static::show404();
        }

        if (!$this->isAdmin()) {
            return static::redirectTo('/login');
        }          

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->status = $_POST['status'] == 'on';

            $newContent = \htmlspecialchars($_POST['content']);
            if ($model->content != $newContent) {
                $model->content = $newContent;
                $model->is_changed = true;
            }

            if ($model->save()) {
                return static::redirectTo('/');
            } else {
                array_push($messages, ['danger', 'Ошибка при сохранении']);
            }
        }

        $this->render('edit.php', [
            'model' => $model,
            'messages' => $messages
        ]);
    }

}