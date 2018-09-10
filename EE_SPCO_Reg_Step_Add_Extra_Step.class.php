<?php
class EE_SPCO_Reg_Step_Add_Extra_Step extends EE_SPCO_Reg_Step
{
    /**
     * constructor
     *
     * @param EE_Checkout $checkout
     */
    public function __construct(EE_Checkout $checkout)
    {
        $this->_slug = 'select_tickets';
        $this->_name = 'Course Selection';
        $this->_template = '';
        $this->checkout = $checkout;
        $this->_reset_success_message();
    }
    public function translate_js_strings()
    {
    }
    public function enqueue_styles_and_scripts()
    {
    }
    /**
     * Initialize the reg step
     *
     * @return boolean
     */
    public function initialize_reg_step()
    {
        $this->checkout->skip_reg_step($this->_slug);
        return false;
    }
    public function generate_reg_form()
    {
    }
    public function process_reg_step()
    {
        $this->set_completed();
        return true;
    }
    public function update_reg_step()
    {
    }
}