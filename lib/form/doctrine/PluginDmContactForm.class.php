<?php

/**
 * PluginDmContact form.
 *
 * This form uses the sfWidgetFormReCaptcha widget
 *
 * The ReCaptcha API documentation can be found at http://recaptcha.net/apidocs/captcha/
 *
 * To be able to use this widget, you need an API key: http://recaptcha.net/api/getkey
 *
 * As it's not possible to change the name of ReCaptcha fields, you will have to add them manually
 * when binding a form from an HTTP request.
 *
 * Here's a typical usage when embedding a captcha in a form with a contact[%s] name format:
 *
 *    $captcha = array(
 *      'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
 *      'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
 *    );
 *    $this->form->bind(array_merge($request->getParameter('contact'), array('captcha' => $captcha)));
 */
abstract class PluginDmContactForm extends BaseDmContactForm
{
  public function setup()
  {
    parent::setup();
    
    $this->validatorSchema['body']
    ->setOption('required', true)
    ->setMessage('required', 'Please enter a message');

    $this->changeToEmail('email');

    $this->widgetSchema->setHelp('email', 'Your email will never be published');

    $this->widgetSchema['body']->setLabel('Your message');

    if ($this->isCaptchaEnabled())
    {
      $this->addCaptcha();
    }
  }

  public function addCaptcha()
  {
    $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
      'public_key' => sfConfig::get('app_recaptcha_public_key')
    ));

    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => sfConfig::get('app_recaptcha_private_key')
    ));
  }

  public function isCaptchaEnabled()
  {
    return sfConfig::get('app_recaptcha_enabled');
  }
}