<?php

// How to use: $meta_value = get_post_meta( $post_id, $field_id, true );
// Example: get_post_meta( get_the_ID(), "my_metabox_field", true );


class MetaboxGenerator
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_fields']);
    } // End of __construct


    // Post-types

    private $screens;

    public function set_screens($new_screens)
    {
        $this->screens = $new_screens;
    } // End of set_screens


    // Metabox

    public function add_meta_boxes()
    {
        foreach ($this->screens as $screen) :
            add_meta_box(
                'MetaboxGenerator',
                __('Informations', 'textdomain'),
                [$this, 'meta_box_callback'],
                $screen,
                'normal',
                'default'
            );
        endforeach;
    } // End of add_meta_boxes

    public function meta_box_callback($post)
    {
        wp_nonce_field('MetaboxGenerator_data', 'MetaboxGenerator_nonce');
        $this->field_generator($post);
    } // End of meta_box_callback


    // Form fields

    private $fields;

    public function set_fields($new_fields)
    {
        $this->fields = $new_fields;
    } // End of set_fields

    public function field_generator($post)
    {
        foreach ($this->fields as $fields_group) : ?>

            <!-- Form groups -->

            <fieldset style="margin-top: 10px; margin-bottom: 10px;">
                <?php if (!empty($fields_group['group_label'])) : ?>
                    <legend><strong><?php echo $fields_group['group_label'] ?></strong></legend>
                <?php endif;
                array_shift($fields_group);

                // Fields

                foreach ($fields_group as $group_field) :

                    if (isset($group_field['width'])) :
                        $width = $group_field['width'];
                    else :
                        $width = "100%";
                    endif; // Endif width

                    // Meta data
                    $meta_value = get_post_meta($post->ID, $group_field['id'], true);
                    if (empty($meta_value) && isset($group_field['default'])) :
                        $meta_value = $group_field['default'];
                    endif; // Endif Default 
                ?>

                    <!-- Label + Field box -->
                    <div style="display: inline-block; width: <?php echo $width ?>">

                        <!-- Label -->
                        <div style="margin-left: 5px; margin-right: 5px;"><label for="<?php echo $group_field['id'] ?>"><?php echo $group_field['label'] ?></label></div>

                        <!-- Field box -->
                        <div style="margin-left: 5px; margin-right: 5px;">

                            <!-- Repeatable Fields -->
                            <?php if (isset($group_field['repeatable']) && $group_field['repeatable'] === true) : ?>
                                <table class="item-table">
                                    <tbody>
                                        <?php if ($meta_value) :
                                            foreach ($meta_value as $item_key => $item_value) :
                                                $item1  = isset($item_value) ? $item_value : ''; ?>
                                                <tr class="sub-row">
                                                    <td><input type="<?php echo $group_field['type'] ?>" name="<?php echo esc_attr($group_field['id'] . '[' . $item_key . ']'); ?>" value="<?php echo esc_attr($item1); ?>"></td>
                                                    <td><button class="remove-item button" type="button">Supprimer</button></td>
                                                </tr>
                                            <?php endforeach; // Endforeach meta_value
                                        else : ?>
                                            <tr class="sub-row">
                                                <td><input type="<?php echo $group_field['type'] ?>" name="<?php echo $group_field['id'] ?>[0]"></td>
                                                <td><button class="remove-item button" type="button">Supprimer</button></td>
                                            </tr>
                                        <?php endif; // Endif meta_value 
                                        ?>
                                        <tr class="hide-tr">
                                            <td><input name="hide_<?php echo $group_field['id'] ?>[rand_no]" type="<?php echo $group_field['type'] ?>"></td>
                                            <td><button class="remove-item button" type="button">Supprimer</button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><button class="add-item button button-secondary" type="button">Ajouter</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- Endif Repeatable Fields
                                
                            Textarea -->
                            <?php elseif ($group_field['type'] === "textarea") : ?>
                                <textarea id="<?php echo $group_field['id'] ?>" name="<?php echo $group_field['id'] ?>" style="width: 100%;"><?php echo $meta_value ?></textarea>
                                <!-- Endif Textarea
                                
                                Select -->
                                <?php elseif ($group_field['type'] === "select") :
                                if ($meta_value) :
                                    $selected  = isset($meta_value) ? $meta_value : '';
                                    $selected_key = array_search($selected, array_column($group_field['options'], 'id')); ?>
                                    <select id="<?php echo $group_field['id'] ?>" name="<?php echo $group_field['id'] ?>" style="width: 100%;">
                                        <option value="<?php echo $selected ?>"><?php echo $group_field['options'][$selected_key]['title']; ?></option>
                                        <?php unset($group_field['options'][$selected_key]);
                                        foreach ($group_field['options'] as $option) : ?>
                                            <option value="<?php echo $option['id'] ?>"><?php echo $option['title'] ?></option>
                                        <?php endforeach; // Enforeach option 
                                        ?>
                                        <option value=""></option>
                                    <?php else : ?>
                                        <select id="<?php echo $group_field['id'] ?>" name="<?php echo $group_field['id'] ?>" style="width: 100%;">
                                            <option value=""></option>
                                            <?php foreach ($group_field['options'] as $option) : ?>
                                                <option value="<?php echo $option['id'] ?>"><?php echo $option['title'] ?></option>
                                        <?php endforeach; // Endforeach option
                                        endif; // Endif meta_value 
                                        ?>
                                        </select>
                                        <!-- Endif Select
                                        
                                    Inputs -->
                                    <?php else : ?>
                                        <input id="<?php echo $group_field['id'] ?>" name="<?php echo $group_field['id'] ?>" type="<?php echo $group_field['type'] ?>" value="<?php echo $meta_value ?>" style="width: 100%;">

                                    <?php endif; // Endif type of fields 
                                    ?>

                        </div> <!-- End of Field box -->

                    </div> <!-- End of Label + Field box -->

                <?php endforeach; // Endforeach field 
                ?>

            </fieldset>
            <hr>

    <?php endforeach; // Endforeach groups

    } // End of field_generator

    public function save_fields($post_id)
    {
        if (!isset($_POST['MetaboxGenerator_nonce'])) :
            return $post_id;
        endif;

        $nonce = $_POST['MetaboxGenerator_nonce'];
        if (!wp_verify_nonce($nonce, 'MetaboxGenerator_data')) :
            return $post_id;
        endif;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
            return $post_id;
        endif;

        foreach ($this->fields as $fields_group) :

            array_shift($fields_group);
            foreach ($fields_group as $group_field) :

                if (isset($_POST[$group_field['id']])) :
                    update_post_meta($post_id, $group_field['id'], $_POST[$group_field['id']]);
                endif;

            endforeach;

        endforeach;
    } // End of save_fields

} // End of MetaboxGenerator

// Repeatable JQuery
add_action('admin_footer', 'repeatable_field_footer');
function repeatable_field_footer()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery(document).on('click', '.remove-item', function() {
                jQuery(this).parents('tr.sub-row').remove();
            });
            jQuery(document).on('click', '.add-item', function() {
                var p_this = jQuery(this);
                var row_no = parseFloat(jQuery('.item-table tr.sub-row').length);
                var row_html = jQuery('.item-table .hide-tr').html().replace(/rand_no/g, row_no).replace(/hide_/g, '');
                jQuery('.item-table tbody').append('<tr class="sub-row">' + row_html + '</tr>');
            });
        });
    </script>
<?php
}

// Repeatable Style
add_action('admin_head', 'repeatable_field_header');
function repeatable_field_header()
{
?>
    <style type="text/css">
        .hide-tr {
            display: none;
        }
    </style>
<?php
}
