<?php

namespace wfm\middleware;

class Guest
{

  public function handle()
  {
    if (checkAuth()) {
      redirect('/');
    }
  }
}