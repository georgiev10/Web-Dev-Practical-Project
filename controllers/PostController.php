<?php

class PostController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Post";
        $this->db = new PostModel;
    }

    public function index($id) {
        $this->post = $this->db->getPostById($id);
        $this->renderView();
    }
}