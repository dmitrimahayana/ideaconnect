<?php
/**
 * AppConfigBehavior class file
 * 
 * Controll application language
 * 
 * @author Agus susilo <smartgdi@gmail.com>
 * @copyright &copy; 2011 Swevel Media
 */
class AppConfigBehavior extends CBehavior
{
	public function events() {
        return array_merge(parent::events(), array(
            'onBeginRequest'=>'beginRequest',)
        );
    }
 
    /**
     * Load configuration that cannot be put in config/main
     */
    public function beginRequest() {
		if ($this->owner->user->getState('appLang')) {
			$this->owner->language = $this->owner->user->getState('appLang');
		}else {
			$this->owner->language = 'id';
		}
    }
}
