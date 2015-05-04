<?php

class HomeController extends BaseController {

    public function onInit() {
        $this->title = "Home";
        $this->db = new HomeModel();
    }
    public function index($page = 0, $pageSize = 5) {
        $from = $page * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->posts = $this->db->getPosts($from, $pageSize);
        $this->renderView();
    }
}



