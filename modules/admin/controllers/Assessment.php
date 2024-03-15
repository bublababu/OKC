<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Assessment extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
    }

    // Frontend User CRUD
    public function index()
    {
        $crud = $this->generate_crud('assessment');
        $crud->columns('id', 'question', 'status');
        $crud->order_by('id', 'DESC');
        $crud->callback_add_field('status', [$this, 'add_field_callback_1']);
        $crud->callback_add_field('correct_answer', [$this, 'add_field_callback_2']);
        $crud->callback_edit_field('status', [$this, 'edit_field_callback_1']);
        $crud->callback_edit_field('correct_answer', [$this, 'edit_field_callback_2']);

        $crud->callback_column('status', [$this, 'active_question']);

        $crud->required_fields('question', 'correct_answer', 'option1', 'option2', 'option3', 'option4');
        $this->mPageTitle = 'Assessment';
        $this->render_crud();
    }

    public function settings()
    {
        $form = $this->form_builder->create_form('admin/assessment/settings', 'class="form-horizontal"', 'id="settings_save"');
        $this->mViewData['form'] = $form;
        if ($this->input->method() === 'post') {
            /// Update data
            if ($this->input->post('settings_action') == 1) {
                $data = [
                    'no_of_question' => $this->input->post('no_of_question'),
                    'pass_marks' => $this->input->post('pass_marks'),
                ];

                $this->db->update('exam_settings', $data);
                $msg = "<strong>Success!</strong> Data updated successfully.";
                $this->system_message->set_success($msg);
            }
        }

        $this->db->select('*');
        $this->db->from('exam_settings');
        $query = $this->db->get();
        $examData = $query->result_array();

        $this->mViewData['examData'] = $examData;

        $this->mPageTitle = 'Settings';
        $this->render('custom/exam_settings', 'with_breadcrumb');
    }

    public function ppt()
    {
        $crud = $this->generate_crud('ppt_manager');
        $crud->columns('id', 'title', 'file_name');
        $crud->unset_add();
        $crud->unset_delete();
        $crud->set_field_upload('file_name', 'uploads/ppt');
        $crud->required_fields('title');
        $this->mPageTitle = 'Manage PPT';
        $this->render_crud();
    }

    public function active_question($value, $row)
    {
        if ($value == 1) {
            return '<div style="color:green;">Active</div>';
        } else {
            return '<div style="color:red;">Disabled</div>';
        }
    }

    function add_field_callback_1()
    {
        return ' <input type="radio" name="status" value="1"  /> Active
        <input type="radio" name="status" value="0" /> Inactive';
    }

    function add_field_callback_2()
    {
        return ' <select id="correct_answer" name="correct_answer">
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="3">Option 3</option>
          <option value="4">Option 4</option>
        </select>';
    }

    function edit_field_callback_1($value)
    {
        if ($value == 1) {
            return ' <input type="radio" name="status" value="1" checked="checked"   /> Active
        <input type="radio" name="status" value="0" /> Inactive';
        }
        return ' <input type="radio" name="status" value="1"   /> Active
        <input type="radio" name="status" value="0" checked="checked"  /> Inactive';
    }

    function edit_field_callback_2($value)
    {
        $str1 = $str2 = $str3 = $str4 = '';
        if ($value == 1) {
            $str1 = 'selected="selected"';
        }
        if ($value == 2) {
            $str2 = 'selected="selected"';
        }
        if ($value == 3) {
            $str3 = 'selected="selected"';
        }
        if ($value == 4) {
            $str4 = 'selected="selected"';
        }

        $return =
            ' <select id="correct_answer" name="correct_answer">
          <option value="1"' .
            $str1 .
            '"  >Option 1</option>
          <option value="2"' .
            $str2 .
            '">Option 2</option>
          <option value="3"' .
            $str3 .
            '">Option 3</option>
          <option value="4"' .
            $str4 .
            '">Option 4</option>
        </select>';

        return $return;
    }
}
?>
