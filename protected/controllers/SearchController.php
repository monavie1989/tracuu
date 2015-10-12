<?php

class SearchController extends Controller {

    public $layout = 'search';

    public function actionIndex() {

        $keyword = Yii::app()->request->getParam('q');
        $page = Yii::app()->request->getParam('page', 1);

        $model = new Post;
        $post = $model->searchByKeyword(str_replace(' ', ' +', $keyword), $page);
        $pager = new CPagination((int) $model->countByKeyword(str_replace(' ', ' +', $keyword)));
        $pager->pageSize = (int) Yii::app()->params['defaultPageSize'];
        $this->render('index', array('post' => $post, 'pages' => $pager, 'keyword' => $keyword));
    }

}
