<?php
/**
 * Contact actions
 */
class BasedmContactComponents extends myFrontModuleComponents
{

  public function executeForm()
  {
      if(!$this->form = $this->getRequest()->getAttribute('dm_contact_form')) {
        $this->form = new DmContactForm();
      }
  }
  
}
