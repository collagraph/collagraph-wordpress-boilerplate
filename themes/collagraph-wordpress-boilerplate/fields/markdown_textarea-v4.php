<?php

class acf_field_markdown_textarea extends acf_field {
    // vars
    var $settings, // will hold info such as dir / path
        $defaults; // will hold default field options

    function __construct() {
        // vars
        $this->name = 'markdown_textarea';
        $this->label = __('Markdown Text Area');
        $this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
        $this->defaults = array(
            // add default here to merge into your field.
            // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
            //'preview_size' => 'thumbnail'
        );

        // do not delete!
        parent::__construct();

        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );
    }

    /*
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $field  - an array holding all the field's data
    */

    function create_options( $field ) {
        // vars
        $key = $field['name'];

        ?>
        <tr class="field_option">
            <td class="label">
                <label>This field requires PHP-Markdown!</label>
            </td>
            <td>
                <p>This field requires the PHP Markdown Extra 1.2.8 plugin.</p>
                <p>Download it from <a href="http://michelf.ca/projects/php-markdown/classic/" title="Visit the PHP Markdown Extra home page">http://michelf.ca/projects/php-markdown/classic/</a>.</p>
                <p><a href="http://old.support.advancedcustomfields.com/discussion/comment/10559#Comment_10559" title="View the thread on the Advanced Custom Fields forums">This thread</a> was helpful in the creation of this custom field.</p>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Default Value",'acf'); ?></label>
                <p><?php _e("Appears when creating a new post",'acf') ?></p>
            </td>
            <td>
                <?php
                do_action('acf/create_field', array(
                    'type'  =>  'textarea',
                    'name'  =>  'fields['.$key.'][default_value]',
                    'value' =>  $field['default_value'],
                ));
                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Placeholder Text",'acf'); ?></label>
                <p><?php _e("Appears within the input",'acf') ?></p>
            </td>
            <td>
                <?php
                do_action('acf/create_field', array(
                    'type'  =>  'text',
                    'name'  =>  'fields[' .$key.'][placeholder]',
                    'value' =>  $field['placeholder'],
                ));
                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Character Limit",'acf'); ?></label>
                <p><?php _e("Leave blank for no limit",'acf') ?></p>
            </td>
            <td>
                <?php
                    do_action('acf/create_field', array(
                        'type'  =>  'number',
                        'name'  =>  'fields[' . $key . '][maxlength]',
                        'value' =>  $field['maxlength'],
                    ));
                ?>
            </td>
        </tr>

        <?php
    }

    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param   $field - an array holding all the field's data
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    */

    function create_field($field) {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */

        // perhaps use $field['preview_size'] to alter the markup?

        // create Field HTML
        // vars
        $o = array('id', 'class', 'name', 'placeholder');
        $e = '';

        // maxlength
        if($field['maxlength'] !== "") {
            $o[] = 'maxlength';
        }

        $e .= '<textarea rows="4"';

        foreach( $o as $k ) {
            $e .= ' ' . $k . '="' . esc_attr($field[$k]) . '"';
        }

        $e .= '>';
        $e .= esc_textarea($field['value']);
        $e .= '</textarea>';

        // return
        echo $e;
    }

    function format_value_for_api($value, $post_id, $field) {
        // validate type
        if(!is_string($value)) {
            return $value;
        }

        // convert to markdown
        $MB_Markdown_Parser = new Markdown_Parser();
        $value = $MB_Markdown_Parser->transform($value);

        return $value;
    }
}

// create field
new acf_field_markdown_textarea();

?>