<?php

class CommentsController extends BaseController{
    private $db;

    public function onInit() {
        $this->db = new CommentsModel;
    }
    public function showComments($post_id) {
        $this->comments = $this->db->getAll($post_id);
        $this->renderView('showComments', false);
    }








}