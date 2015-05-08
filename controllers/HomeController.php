<?php

class HomeController extends BaseController {

    public function onInit() {
        $this->title = "Home";
        $this->db = new HomeModel();
        $this->dbTags = new TagsModel();
        $this->tagSidebar = $this->dbTags->getPopularTags();
    }

    public function index($page = 0, $pageSize = 4) {
        $from = $page * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->posts = $this->db->getPosts($from, $pageSize);
        $this->renderView();
    }


}



