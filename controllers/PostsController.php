<?php

class PostsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Posts";
        $this->db = new PostsModel();
    }

    public function index() {
        $this->authorise();
        $this->posts = $this->db->getAll();
        $this->renderView();
    }
}