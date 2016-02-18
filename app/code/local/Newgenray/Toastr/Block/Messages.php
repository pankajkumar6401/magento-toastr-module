<?php
/**
 * Created by PhpStorm.
 * User: Pankaj
 * Date: 18-02-2016
 * Time: 04:29
 * Contact: For any type of assistance please send email to: pankaj@newgenray.com
 */
class Newgenray_Toastr_Block_Messages extends Mage_Core_Block_Messages
{
    /**
     * Retrieve messages in HTML format grouped by type
     *
     * @param   string $type
     * @return  string
     */
    public function getGroupedHtml()
    {
        if(Mage::getSingleton('admin/session')->isLoggedIn()){
            $html = parent::getGroupedHtml();
            return $html;
        }else{
            $types = array(
                Mage_Core_Model_Message::ERROR,
                Mage_Core_Model_Message::WARNING,
                Mage_Core_Model_Message::NOTICE,
                Mage_Core_Model_Message::SUCCESS
            );
            $html = '';
            foreach ($types as $type) {
                if ( $messages = $this->getMessages($type) ) {
                    if ( !$html ) {
                        $html .= '<script type="text/javascript">';
                        $html .= 'jQuery(function($){';
                        $html .= 'toastr.options = {
                                "positionClass": "toast-bottom-left",
                                "preventDuplicates": false,
                                "timeOut": "10000",
                            };';
                    }
                    switch($type){
                        case "success" : foreach ( $messages as $message ) {
                            $msg = ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText();
                            $html .= 'toastr.success("' . $msg . '");';
                        }
                            break;
                        case "warning" : foreach ( $messages as $message ) {
                            $msg = ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText();
                            $html .= 'toastr.warning("' . $msg . '");';
                            //$html .= 'toastr.warning(' . ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText() . ');';
                        }
                            break;
                        case "notice" : foreach ( $messages as $message ) {
                            $msg = ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText();
                            $html .= 'toastr.info("' . $msg . '");';
                            // $html .= 'toastr.info(' . ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText() . ');';
                        }
                            break;
                        case "error" : foreach ( $messages as $message ) {
                            $msg = ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText();
                            $html .= 'toastr.error("' . $msg . '");';
                            //$html .= 'toastr.error(' . ($this->_escapeMessageFlag) ? $this->escapeHtml($message->getText()) : $message->getText() . ');';
                        }
                            break;
                    }
                }
            }
            if ( $html) {
                $html .= '});';
                $html .= '</script>';
            }

            return $html;
        }


    }
}