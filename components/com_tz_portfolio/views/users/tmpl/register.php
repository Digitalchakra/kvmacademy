<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

$doc    = &JFactory::getDocument();
$doc -> addStyleSheet('components/com_tz_portfolio/css/tz_portfolio.css');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$editor = &JFactory::getEditor();
?>
 
<div class="registration">
	<?php if ($this->params->get('show_page_heading')) : ?>
	    <h1><span><?php echo $this->escape($this->params->get('page_heading')); ?></span></h1>
    <?php endif; ?>
    <p class="note">If you already have an account with us, please login at the <a href="<?php echo JRoute::_('index.php/login-form'); ?>">login page.</a></p>
	<form class="form-validate"
          method="post"
          action="<?php echo JRoute::_('index.php?option=com_users&amp;task=registration.register'); ?>"
          id="member-registration"
            enctype="multipart/form-data">
        <fieldset>
            <label class="title"><?php echo JText::_('User Registration');?></label>
            <table class="tz_portfolio_user_register">
                <tr>
                    <td>
                        <span class="spacer">
                            <span class="before"></span>
                            <span class="text">
                                <label class="" id="jform_spacer-lbl">
                                    <strong class="red">*</strong>
                                    <?php echo JText::_('Required field');?>
                                </label>
                            </span>
                            <span class="after"></span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Name::Enter your full name"
                           class="hasTip required"
                           for="jform_name" id="jform_name-lbl">
                            <?php echo JText::_('Name')?>:<span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input type="text"
                               size="40"
                           class="required"
                           value=""
                           id="jform_name"
                           name="jform[name]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Username::Enter your desired user name"
                           class="hasTip required"
                           for="jform_username"
                           id="jform_username-lbl">
                            <?php echo JText::_('Username');?>:<span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input type="text"
                           size="40"
                           class="validate-username required"
                           value="" id="jform_username" name="jform[username]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Password::Enter your desired password - Enter a minimum of 4 characters"
                           class="hasTip required"
                           for="jform_password1"
                           id="jform_password1-lbl">
                            <?php echo JText::_('Password');?>:<span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input type="password"
                           size="40"
                           class="validate-password required"
                           autocomplete="off"
                           value=""
                           id="jform_password1"
                           name="jform[password1]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Confirm Password::Confirm your password"
                           class="hasTip required"
                           for="jform_password2"
                           id="jform_password2-lbl">
                            <?php echo JText::_('Confirm Password');?>:<span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input type="password"
                           size="40"
                           class="validate-password required"
                           autocomplete="off"
                           value=""
                           id="jform_password2"
                           name="jform[password2]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Email Address::Enter your email address"
                           class="hasTip required"
                           for="jform_email1"
                           id="jform_email1-lbl">
                            <?php echo JText::_('Email Address');?>:<span class="star">&nbsp;*</span>
                        </label>
                    </td>
                    <td>
                        <input type="text"
                           size="40"
                           value=""
                           id="jform_email1"
                           class="validate-email required"
                           name="jform[email1]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Confirm email Address::Confirm your email address"
                           class="hasTip required"
                           for="jform_email2"
                           id="jform_email2-lbl">
                        <?php echo JText::_('Confirm email Address');?>:<span class="star">&nbsp;*</span>
                    </label>
                    </td>
                    <td>
                        <input type="text"
                           size="40"
                           value=""
                           id="jform_email2"
                           class="validate-email required"
                           name="jform[email2]">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Gender::Select a gender"
                           class="hasTip required"
                           >
                        <?php echo JText::_('Gender');?>:
                    </label>
                    </td>
                    <td class="tz_radio">
                        <input type="radio"
                           value="m"
                           id="jform_gender1"
                           name="jform[gender]">
                        <label for="jform_gender1"><?php echo JText::_('Male');?></label>
                        <input type="radio"
                           value="f"
                           id="jform_gender2"
                           name="jform[gender]">
                        <label for="jform_gender2"><?php echo JText::_('Female');?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label id="jform_client_images-lbl"
                               class=""
                               for="jform_client_images"
                               aria-invalid="false">
                            <?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_CLIENT_IMAGES_LABEL')?>
                        </label>

                    </td>
                    <td>
                        <input id="jform_client_images"
                                type="file"
                               size="50"
                               value="" name="jform[client_images]"
                               class="">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label id="jform_url_images-lbl"
                               class=""
                               for="jform_url_images"
                               aria-invalid="false">
                            <?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_URL_IMAGES_LABEL');?></label>
                    </td>
                    <td>
                        <input id="jform_url_images"
                               class=""
                               type="text" size="40"
                               value=""
                               name="jform[url_images]"
                               aria-invalid="false">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo JText::_('Twitter');?></label>
                    </td>
                    <td>
                        <input type="text" name="url_twitter" size="40"
                               value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo JText::_('Facebook');?></label>
                    </td>
                    <td>
                        <input type="text" name="url_facebook" size="40"
                               value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo JText::_('Google +1');?></label>
                    </td>
                    <td>
                        <input type="text" name="url_google_one_plus" size="40"
                               value="">
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label><?php echo JText::_('Description');?></label>
                    </td>
                    <td>
                        <textarea rows="10" cols="50" name="description"></textarea>
                    </td>
                </tr>
				<?php if($this -> params -> get('captcha')):?>
                    <?php foreach ($this->form->getFieldsets() as $fieldset):?>
                        <?php $fields = $this->form->getFieldset($fieldset->name);?>
                        <?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
                            <?php if(strtolower($field -> fieldname) == 'captcha'):?>
                                <tr>
                                    <td><?php echo $field -> label;?></td>
                                    <td><?php echo $field -> input;?></td>
                                </tr>
                                <?php break;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endforeach;?>
                <?php endif;?>
            </table>

        </fieldset>
        
        <div>
            <button class="validate" type="submit"><?php echo JText::_('JREGISTER');?></button>
            <?php echo JText::_('COM_USERS_OR');?>
            <a href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" value="com_users" name="option">
            <input type="hidden" value="registration.register" name="task">
            <?php echo JHTML::_('form.token');?>
        </div>
	</form>
</div>