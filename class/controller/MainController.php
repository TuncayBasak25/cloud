<?php

class MainController extends Controller_ABS
{

  public function __construct($executionStrategy, $model, $view)
  {
    $this->executionStrategy = $executionStrategy;
    $this->model = $model;
    $this->view = $view;
  }

  public function execute() {
    $this->executionStrategy->execute($this);
  }

}
