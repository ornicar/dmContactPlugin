<?php
// Contact : Form
// Vars : $form

if($sf_user->hasFlash('contact_form_valid'))
{
  echo _tag('p.form_valid', __('Thank you, your contact request has been sent.'));
}

// open the form tag with a dm_contact_form css class
echo $form->open();

// write name label, field and error message
echo $form['name']->label()->field()->error();

// same with email
echo $form['email']->label()->field()->help()->error();

echo $form['body']->label()->field()->error();

// render captcha if enabled
if($form->isCaptchaEnabled())
{
  echo $form['captcha']->label('Captcha', 'for=false')->field()->error();
}

echo $form->renderHiddenFields();

// change the submit button text
echo _tag('div.submit_wrap', $form->submit(__('Send')));

// close the form tag
echo $form->close();  