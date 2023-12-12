<?php

/**
 * Metabox Generator, used by :
 * mb_calendrier
 * mb_collaborateur
 * mb_lieu
 * mb_spectacle
 */


class MetaboxGenerator
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add']);
        add_action('save_post', [$this, 'save_fields']);
    } // End of __construct


    /* Post-types where the metabox will be generate */

    private $screens;

    /**
     *** How to use : ***
     * method set_screens($post_types) :
     *   $post_types = array of post-types
     */
    public function set_screens($new_screens)
    {
        $this->screens = $new_screens;
    } // End of set_screens


    /* Add Metabox to Post-types */

    public function add()
    {
        foreach ($this->screens as $screen) :
            add_meta_box(
                'MetaboxGenerator',
                __('Informations', 'textdomain'),
                [$this, 'callback'],
                $screen,
                'normal',
                'default'
            );
        endforeach; // Endforeach screen
    } // End of add

    public function callback($post)
    {
        wp_nonce_field('MetaboxGenerator_data', 'MetaboxGenerator_nonce');
        $this->field_generator($post);
    } // End of callback


    /* Form fields */

    private $fields;

    /**
     *** How tu use : ***
     * method set_fields($groups_of_fields) :
     *   $groups_of_fields = array of arrays for each $group_of_fields
     *       each $group_of_fields = array
     *           beggin with 'group_label' => string (required, can be empty)
     *           continue with arrays for each $field
     *               each $field = array of $arguments used to generate the field in mb_generator
     *                   $arguments :
     *                       'label' => string
     *                       'id' => string
     *                       'type' => string (text | select | date | time | url | WYSIWYG)
     *                       'options' => array of $options (required for 'type' => 'select')
     *                           $options = array of arrays for each $option
     *                               each $option = ['value' => string, 'label' => string]
     *                       'width' => string (width of the label and the field)
     *                       'repeatable' => bool
     *                       'repeatable-fields' => array of $repeatable_fields 
     *                           $repeatable fields = array of arrays for each $repeatable field
     *                               each $repeatable_field = array of $arguments
     *                                   $arguments :
     *                                       'label' => string
     *                                       'id' => string
     *                                       'type' => string (text | date | time)
     */
    public function set_fields($new_fields)
    {
        $this->fields = $new_fields;
    } // End of set_fields

    public function field_generator($post)
    {

        foreach ($this->fields as $group_of_fields) : ?>

            <!-- Form groups -->

            <fieldset style="margin-top: 10px; margin-bottom: 10px;">
                <?php if ($group_of_fields['group_label']) : ?>
                    <legend>
                        <h3><?= $group_of_fields['group_label'] ?></h3>
                    </legend>
                <?php endif; // Endif group_label
                array_shift($group_of_fields);

                /* Fields */

                foreach ($group_of_fields as $field) :

                    if (isset($field['width'])) :
                        $width = $field['width'];
                    else :
                        $width = "100%";
                    endif; // Endif width

                    /* Registered Meta values */
                    $meta_value = get_post_meta($post->ID, $field['id'], true); ?>

                    <!-- Label + Field box -->
                    <div style="display: inline-block; width: <?= $width ?>">

                        <!-- Label -->
                        <?php if (isset($field['label']) && $field['label'] !== "") : ?>
                            <div style="margin-left: 5px; margin-right: 5px;"><label for="<?= $field['id'] ?>"><strong><?= $field['label'] ?></strong></label></div>
                        <?php endif; // Endif label 
                        ?>

                        <!-- Field box -->
                        <div style="margin-left: 5px; margin-right: 5px;">

                            <!-- Repeatable Fields -->
                            <?php if (isset($field['repeatable']) && $field['repeatable'] === true) : ?>
                                <table class="items-table">
                                    <tbody>
                                        <tr>
                                            <?php foreach ($field['repeatable-fields'] as $repeatable_field) : ?>
                                                <th><?= $repeatable_field['label']; ?></th>
                                            <?php endforeach; // Endforeach repeatable_field 
                                            ?>
                                        </tr>
                                        <?php if ($meta_value) :
                                            array_multisort(array_column($meta_value, 'public'), SORT_ASC, array_column($meta_value, 'date'), SORT_ASC, array_column($meta_value, 'heure'), SORT_ASC, $meta_value);
                                            $meta_value_type = [];
                                            foreach ($field['repeatable-fields'] as $repeatable_field) :
                                                $meta_value_type[] = $repeatable_field['type'];
                                            endforeach; // Endforeach repeatable_field
                                            $meta_values = [];
                                            foreach ($meta_value as $item_values) :
                                                $values = [];
                                                foreach ($item_values as $item_key => $item_value) :
                                                    $values[] = ['id' => $item_key, 'value' => $item_value];
                                                endforeach; // Endforeach item_value
                                                $values_and_type = [];
                                                foreach ($values as $key => $value) :
                                                    $values_and_type[] = $value + ['type' => $meta_value_type[$key]];
                                                endforeach; // Endforeach value
                                                $meta_values[] = $values_and_type;
                                            endforeach; // Endforeach item_values
                                        ?>
                                            <?php foreach ($meta_values as $item_key => $item_values) : ?>
                                                <tr class="sub-row">
                                                    <?php foreach ($item_values as $item_value) : ?>
                                                        <td><input type="<?= $item_value['type'] ?>" name="<?= $field['id'] . '[' . $item_key . ']' . '[' . $item_value['id'] . ']'; ?>" id="<?= $field['id'] . '[' . $item_key . ']' . '[' . $item_value['id'] . ']'; ?>" value="<?= $item_value['value'] ?>"></td>
                                                    <?php endforeach; // Endforeach item_value 
                                                    ?>
                                                    <td><button class="remove-item button" type="button">Supprimer</button></td> <!-- Used in /assets/js/metaboxes.js to remove the sub-row -->
                                                </tr>
                                            <?php endforeach; // Endforeach item_values
                                            ?>
                                        <?php else : ?>
                                            <tr class="sub-row">
                                                <?php foreach ($field['repeatable-fields'] as $repeatable_field) : ?>
                                                    <td><input type="<?= $repeatable_field['type'] ?>" name="<?= $field['id'] . '[0]' . '[' . $repeatable_field['id'] . ']'; ?>" id="<?= $field['id'] . '[0]' . '[' . $repeatable_field['id'] . ']'; ?>"></td>
                                                <?php endforeach; // Endforeach repeatable_field 
                                                ?>
                                                <td><button class="remove-item button" type="button">Supprimer</button></td> <!-- Used in /assets/js/metaboxes.js to remove the sub-row -->
                                            </tr>
                                        <?php endif; // Endif meta_value
                                        ?>
                                        <tr class="hide-tr"> <!-- Used in /assets/js/metaboxes.js to append a new sub-row -->
                                            <?php foreach ($field['repeatable-fields'] as $repeatable_field) : ?>
                                                <td><input type="<?= $repeatable_field['type'] ?>" name="hide_<?= $field['id'] . '[rand_no]' . '[' . $repeatable_field['id'] . ']' ?>" id="hide_<?= $field['id'] . '[rand_no]' . '[' . $repeatable_field['id'] . ']' ?>"></td>
                                            <?php endforeach; // Endforeach repeatable_field 
                                            ?>
                                            <td><button class="remove-item button" type="button">Supprimer</button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><button class="add-item button button-secondary" type="button">Ajouter</button></td> <!-- Used in /assets/js/metaboxes.js to append a new sub-row -->
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- Endif Repeatable Fields
                                
                                Select -->
                                <?php elseif ($field['type'] === "select") :
                                if ($meta_value) :
                                    $selected  = isset($meta_value) ? $meta_value : '';
                                    $selected_key = array_search($selected, array_column($field['options'], 'id')); ?>
                                    <select id="<?= $field['id'] ?>" name="<?= $field['id'] ?>" style="width: 100%;">
                                        <option value="<?= $selected ?>"><?= $field['options'][$selected_key]['title']; ?></option>
                                        <?php unset($field['options'][$selected_key]);
                                        foreach ($field['options'] as $option) : ?>
                                            <option value="<?= $option['id'] ?>"><?= $option['title'] ?></option>
                                        <?php endforeach; // Endforeach option 
                                        ?>
                                        <option value=""></option>
                                    <?php else : ?>
                                        <select id="<?= $field['id'] ?>" name="<?= $field['id'] ?>" style="width: 100%;">
                                            <option value=""></option>
                                            <?php foreach ($field['options'] as $option) : ?>
                                                <option value="<?= $option['id'] ?>"><?= $option['title'] ?></option>
                                        <?php endforeach; // Endforeach option
                                        endif; // Endif meta_value 
                                        ?>
                                        </select>
                                        <!-- Endif Select

                                    WYSIWYG -->
                                    <?php elseif ($field['type'] === "WYSIWYG") :
                                    ob_start();
                                    wp_editor($meta_value, $field['id']);
                                    $input = ob_get_contents();
                                    ob_end_clean();
                                    echo $input; ?>
                                        <!-- Endif WYSIWYG

                                    Inputs -->
                                    <?php else : ?>
                                        <input id="<?= $field['id'] ?>" name="<?= $field['id'] ?>" type="<?= $field['type'] ?>" value="<?= $meta_value ?>" style="width: 100%;">

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

    /* Save fields */

    public function save_fields($post_id)
    {
        if (!isset($_POST['MetaboxGenerator_nonce'])) :
            return $post_id;
        endif; // !isset metaboxgenerator_nonce

        $nonce = $_POST['MetaboxGenerator_nonce'];
        if (!wp_verify_nonce($nonce, 'MetaboxGenerator_data')) :
            return $post_id;
        endif; // Endif nonce

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) :
            return $post_id;
        endif; // Endif defined DOING_AUTOSAVE

        foreach ($this->fields as $group_of_fields) :

            array_shift($group_of_fields);
            foreach ($group_of_fields as $field) :

                if (isset($_POST[$field['id']])) :
                    update_post_meta($post_id, $field['id'], $_POST[$field['id']]);
                endif; // Endif isset field id

            endforeach; // Endforeach field

        endforeach; // Endforeach group_of_fields
    } // End of save_fields

} // End of MetaboxGenerator
