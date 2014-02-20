<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ArticleController extends BaseController
{
    public function showSingle()
    {
        return View::make('simple');
    }
/*
    public function showSingle($articleId)
    {
        return View::make('single');
    }
 * 
 */
}
