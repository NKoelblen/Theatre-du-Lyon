<?php

// How to use: $meta_value = get_post_meta( $post_id, $field_id, true );
// Example: get_post_meta( get_the_ID(), "my_metabox_field", true );

class InformationsdelieuMetabox
{

    private $screens = array('lieu');

    private $fields = array(
        array(
            'label' => 'URL',
            'id' => 'url',
            'type' => 'url',
            'default' => 'http://',
        ),
        array(
            'label' => 'Texte du lien',
            'id' => 'text-url',
            'type' => 'text',
        ),
        array(
            'label' => 'Complément d\'adresse',
            'id' => 'address1',
            'type' => 'text',
        ),
        array(
            'label' => 'Numéro, type et nom de la voie',
            'id' => 'address2',
            'type' => 'text',
        ),
        array(
            'label' => 'Lieu-dit',
            'id' => 'address3',
            'type' => 'text',
        ),
        array(
            'label' => 'Code postal',
            'id' => 'postal-code',
            'type' => 'text',
        ),
        array(
            'label' => 'Ville',
            'id' => 'city',
            'type' => 'text',
        ),
        array(
            'label' => 'Informations complémentaires',
            'id' => 'infos',
            'type' => 'textarea',
        )
    );

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_fields'));
    }

    public function add_meta_boxes()
    {
        foreach ($this->screens as $s) {
            add_meta_box(
                'Informationsdelieu',
                __('Informations', 'textdomain'),
                array($this, 'meta_box_callback'),
                $s,
                'normal',
                'default'
            );
        }
    }

    public function meta_box_callback($post)
    {
        wp_nonce_field('Informationsdelieu_data', 'Informationsdelieu_nonce');
        $this->field_generator($post);
    }

    public function field_generator($post)
    {
        $output = '';
        foreach ($this->fields as $field) {
            $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
            $meta_value = get_post_meta($post->ID, $field['id'], true);
            if (empty($meta_value)) {
                if (isset($field['default'])) {
                    $meta_value = $field['default'];
                }
            }
            switch ($field['type']) {
                case 'textarea':
                    $input = sprintf(
                        '<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
                        $field['id'],
                        $field['id'],
                        $meta_value
                    );
                    break;

                default:
                    $input = sprintf(
                        '<input %s id="%s" name="%s" type="%s" value="%s">',
                        $field['type'] !== 'color' ? 'style="width: 100%"' : '',
                        $field['id'],
                        $field['id'],
                        $field['type'],
                        $meta_value
                    );
            }
            $output .= $this->format_rows($label, $input);
        }
        echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
    }

    public function format_rows($label, $input)
    {
        return '<div style="margin-top: 10px;"><strong>' . $label . '</strong></div><div>' . $input . '</div>';
    }



    public function save_fields($post_id)
    {
        if (!isset($_POST['Informationsdelieu_nonce'])) {
            return $post_id;
        }
        $nonce = $_POST['Informationsdelieu_nonce'];
        if (!wp_verify_nonce($nonce, 'Informationsdelieu_data')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        foreach ($this->fields as $field) {
            if (isset($_POST[$field['id']])) {
                update_post_meta($post_id, $field['id'], $_POST[$field['id']]);
            }
        }
    }
}

if (class_exists('InformationsdelieuMetabox')) {
    new InformationsdelieuMetabox;
};
