<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Controller;

use View;
use BaseController;

class Article extends BaseController
{
    public function showIndex()
    {
        return View::make('index');
    }
}

