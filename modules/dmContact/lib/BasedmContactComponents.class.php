<?php
/**
 * Contact actions
 */
class BasedmContactComponents extends myFrontModuleComponents
{

  public function executeForm()
  {
    $this->form = $this->forms['DmContact'];
  }
  
}