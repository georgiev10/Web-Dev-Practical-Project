<?php

class TagsController extends BaseController{
    private $db;

    public function onInit() {
        $this->db = new TagsModel();
    }
    public function index() {
        $this->tags = $this->db->getPopularTags();
        $this->renderView();
    }
}