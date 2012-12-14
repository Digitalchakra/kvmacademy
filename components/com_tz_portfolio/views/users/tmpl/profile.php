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

?>

<div class="registration">
	<?php if ($this->params->get('show_page_heading')) : ?>
	    <h1><span><?php echo $this->escape($this->params->get('page_heading')); ?></span></h1>
    <?php endif; ?>
	<form class="form-validate"
          method="post"
          autocomplete="off"
          action="<?php echo JRoute::_('index.php?'); ?>"
          id="member-profile"
            enctype="multipart/form-data">
        <fieldset>
            <label class="title"><?php echo JText::_('Edit Your Profile');?></label>
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
                           value="<?php echo $this -> user -> name;?>"
                           id="jform_name"
                           name="jform[name]"
                            aria-required="true"
                           required="required">
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
                           readonly="readonly"
                           size="40"
                           class="validate-username required"
                           id="jform_username"
                           name="jform[username]"
                           aria-required="true"
                           required="required"
                           aria-invalid="false"
                           value="<?php echo $this -> user -> username;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Password::Enter your desired password - Enter a minimum of 4 characters"
                           class="hasTip required"
                           for="jform_password1"
                           id="jform_password1-lbl">
                            <?php echo JText::_('Password');?>:<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                        </label>
                    </td>
                    <td>
                        <input type="password"
                           size="40"
                           class="validate-password"
                           autocomplete="off"
                           value=""
                           id="jform_password1"
                           name="jform[password1]"
                           aria-invalid="false">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="Confirm Password::Confirm your password"
                           class="hasTip required"
                           for="jform_password2"
                           id="jform_password2-lbl">
                            <?php echo JText::_('Confirm Password');?>:<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                        </label>
                    </td>
                    <td>
                        <input type="password"
                           size="40"
                           class="validate-password"
                           autocomplete="off"
                           value=""
                           id="jform_password2"
                           aria-invalid="false"
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
                           id="jform_email1"
                           class="validate-email required"
                           name="jform[email1]"
                           aria-required="true"
                           required="required"
                           aria-invalid="false"
                           value="<?php echo $this -> user -> email?>">
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
                           id="jform_email2"
                           class="validate-email required"
                           name="jform[email2]"
                           aria-required="true"
                               required="required"
                               aria-invalid="false"
                           value="<?php echo $this -> user -> email;?>">
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
                           id="jform_gender1"
                           name="gender"
                           value="m"
                            <?php if($this -> TZUser AND $this -> TZUser -> gender == 'm') echo ' checked="checked"';?>
                        >
                        <label for="jform_gender1"><?php echo JText::_('Male');?></label>

                        <input type="radio"
                           id="jform_gender2"
                           name="gender"
                           value="f"
                            <?php if($this -> TZUser AND $this -> TZUser -> gender == 'f') echo ' checked="checked';?>
                        >
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
                               name="jform[client_images]"
                               class="">
                    </td>
                </tr>

                <?php if($this -> TZUser AND !empty($this -> TZUser -> images)):?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <img src="<?php echo $this -> TZUser -> images;?>" style="max-width:120px;"/>
                            <input type="hidden" name="current_images"
                                   value="<?php echo $this -> TZUser -> imageName?>">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="checkbox" name="delete_images" value="1">
                                <label><?php echo JText::_('COM_TZ_PORTFOLIO_DELETE_IMAGES');?></label>
                        </td>
                    </tr>
                <?php endif;?>

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
                               value="<?php if($this -> TZUser) echo $this -> TZUser -> twitter?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo JText::_('Facebook');?></label>
                    </td>
                    <td>
                        <input type="text" name="url_facebook" size="40"
                               value="<?php if($this -> TZUser) echo $this -> TZUser -> facebook;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><?php echo JText::_('Google +1');?></label>
                    </td>
                    <td>
                        <input type="text" name="url_google_one_plus" size="40"
                               value="<?php if($this -> TZUser) echo $this -> TZUser -> google_one;?>">
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <label><?php echo JText::_('Description');?></label>
                    </td>
                    <td>
                        <textarea rows="10" cols="50" name="description">
                            <?php if($this -> TZUser) echo $this -> TZUser -> description;?>
                        </textarea>
                    </td>
                </tr>
            </table>

        </fieldset>

        <div>
            <button class="validate" type="submit"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('COM_USERS_OR'); ?>
            <a href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" value="<?php echo $this -> user -> id;?>" id="jform_id" name="jform[id]">
            <input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
            <?php echo JHTML::_('form.token');?>
        </div>
	</form>
</div>