<?php
/**
 * Contact actions
 */
class BasedmContactActions extends myFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new DmContactForm();

    if ($request->hasParameter($form->getName()))
    {
      $data = $request->getParameter($form->getName());

      if($form->isCaptchaEnabled())
      {
        $data = array_merge($data, array('captcha' => array(
          'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
          'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        )));
      }

      $form->bind($data, $request->getFiles($form->getName()));

      if ($form->isValid())
      {
        $form->save();

        $this->getUser()->setFlash('contact_form_valid', true);

        $this->getService('dispatcher')->notify(new sfEvent($this, 'dm_contact.saved', array(
          'contact' => $form->getObject()
        )));

        $this->redirectBack();
      }
    }

    $this->forms['DmContact'] = $form;
  }

}
