<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'mindshows_register_development_acf_fields');

function mindshows_register_development_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_dev_hero',
        'title' => 'Development: 01 Hero Section',
        'fields' => array(
            array(
                'key' => 'field_dev_hero_title',
                'label' => 'Hero Title',
                'name' => 'dev_hero_title',
                'type' => 'text',
                'default_value' => 'Dezvoltarea Inteligentei Emotionale',
                'placeholder' => 'Dezvoltarea Inteligentei Emotionale',
            ),
            array(
                'key' => 'field_dev_hero_subtitle',
                'label' => 'Hero Badge / Subtitle',
                'name' => 'dev_hero_subtitle',
                'type' => 'text',
                'default_value' => 'Modul 1: Dragoste si Frica',
                'placeholder' => 'Modul 1: Dragoste si Frica',
            ),
            array(
                'key' => 'field_dev_hero_description',
                'label' => 'Hero Description',
                'name' => 'dev_hero_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
            ),
            array(
                'key' => 'field_dev_hero_button_text',
                'label' => 'Hero Button Text',
                'name' => 'dev_hero_button_text',
                'type' => 'text',
                'default_value' => 'Inscriere',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 1,
    ));

    $obiective_subfields = array(
        array(
            'key' => 'field_dev_obiective_title',
            'label' => 'Section Title',
            'name' => 'dev_obiective_title',
            'type' => 'text',
            'default_value' => 'Obiective',
        ),
    );

    for ($i = 1; $i <= 4; $i++) {
        $obiective_subfields[] = array(
            'key' => "field_dev_obiective_{$i}",
            'label' => "Obiectiv {$i}",
            'name' => "dev_obiective_{$i}",
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array(
                    'key' => "field_dev_ob_{$i}_title",
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'default_value' => 'Dezvoltare Gandire Strategica',
                ),
                array(
                    'key' => "field_dev_ob_{$i}_desc",
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'rows' => 2,
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                ),
                array(
                    'key' => "field_dev_ob_{$i}_icon",
                    'label' => 'Custom Diamond Icon (Optional)',
                    'name' => 'icon',
                    'type' => 'image',
                    'return_format' => 'array',
                ),
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_dev_obiective',
        'title' => 'Development: 02 Obiective Section',
        'fields' => $obiective_subfields,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 2,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_dev_galerie',
        'title' => 'Development: 03 Galerie Section',
        'fields' => array(
            array(
                'key' => 'field_dev_galerie_title',
                'label' => 'Section Title',
                'name' => 'dev_galerie_title',
                'type' => 'text',
                'default_value' => 'Galerie',
            ),
            array(
                'key' => 'field_dev_galerie_description',
                'label' => 'Section Description',
                'name' => 'dev_galerie_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
            ),
            array(
                'key' => 'field_dev_galerie_images',
                'label' => 'Carousel Images (5 Images Recommended)',
                'name' => 'dev_galerie_images',
                'type' => 'gallery',
                'return_format' => 'array',
                'insert' => 'append',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 3,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_dev_about',
        'title' => 'Development: 04 Concept Rows',
        'fields' => array(
            array(
                'key' => 'field_dev_about_1',
                'label' => 'Concept Row 1 (Image Left)',
                'name' => 'dev_about_1',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_ab1_img',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_dev_ab1_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Concept',
                    ),
                    array(
                        'key' => 'field_dev_ab1_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
                    ),
                ),
            ),
            array(
                'key' => 'field_dev_about_2',
                'label' => 'Concept Row 2 (Image Right)',
                'name' => 'dev_about_2',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_ab2_img',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_dev_ab2_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Concept',
                    ),
                    array(
                        'key' => 'field_dev_ab2_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 4,
                        'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien libero, ultrices eget nunc mattis, finibus maximus enim. Suspendisse neque augue, rutrum eu sollicitudin cursus, maximus in velit.',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 4,
    ));

    $principii_subfields = array(
        array(
            'key' => 'field_dev_principii_title',
            'label' => 'Section Title',
            'name' => 'dev_principii_title',
            'type' => 'text',
            'default_value' => 'Principii',
        ),
    );

    for ($i = 1; $i <= 5; $i++) {
        $principii_subfields[] = array(
            'key' => "field_dev_principiu_{$i}",
            'label' => "Principiu {$i}",
            'name' => "dev_principiu_{$i}",
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array(
                    'key' => "field_dev_pr_{$i}_title",
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'default_value' => 'Respect Reciproc',
                ),
                array(
                    'key' => "field_dev_pr_{$i}_desc",
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'rows' => 2,
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                ),
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_dev_principii',
        'title' => 'Development: 05 Principii Section',
        'fields' => $principii_subfields,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 5,
    ));

    $traineri_subfields = array(
        array(
            'key' => 'field_dev_traineri_title',
            'label' => 'Section Title',
            'name' => 'dev_traineri_title',
            'type' => 'text',
            'default_value' => 'Traineri',
        ),
    );

    for ($i = 1; $i <= 3; $i++) {
        $traineri_subfields[] = array(
            'key' => "field_dev_trainer_{$i}",
            'label' => "Trainer {$i}",
            'name' => "dev_trainer_{$i}",
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => array(
                array(
                    'key' => "field_dev_tr_{$i}_img",
                    'label' => 'Portrait Photo (Cutout)',
                    'name' => 'image',
                    'type' => 'image',
                    'return_format' => 'array',
                ),
                array(
                    'key' => "field_dev_tr_{$i}_name",
                    'label' => 'Name',
                    'name' => 'name',
                    'type' => 'text',
                    'default_value' => 'Christina Abrams',
                ),
                array(
                    'key' => "field_dev_tr_{$i}_role",
                    'label' => 'Role',
                    'name' => 'role',
                    'type' => 'text',
                    'default_value' => 'Development Trainer',
                ),
                array(
                    'key' => "field_dev_tr_{$i}_desc",
                    'label' => 'Bio / Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'rows' => 3,
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin felis ac aliquam rhoncus. Ut in purus in orci faucibus porta. Cras sollicitudin,',
                ),
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_dev_traineri',
        'title' => 'Development: 06 Traineri Section',
        'fields' => $traineri_subfields,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 6,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_dev_pentru_tine',
        'title' => 'Development: 07 Cursul Este Pentru Tine',
        'fields' => array(
            array(
                'key' => 'field_dev_pt_title',
                'label' => 'Section Title',
                'name' => 'dev_pt_title',
                'type' => 'text',
                'default_value' => 'CURSUL ESTE PENTRU TINE',
            ),
            array(
                'key' => 'field_dev_pt_items',
                'label' => 'Bullet Items',
                'name' => 'dev_pt_items',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Adaugă Punct',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_pt_text',
                        'label' => 'Item Text',
                        'name' => 'item_text',
                        'type' => 'text',
                        'default_value' => 'Daca Esti Dispus sa Aloci un Weekend Pentru Tine',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 7,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_dev_detalii',
        'title' => 'Development: 08 Detalii Section',
        'fields' => array(
            array(
                'key' => 'field_dev_detaliu_1',
                'label' => 'Metric 1',
                'name' => 'dev_detaliu_1',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_dt1_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Investitie',
                    ),
                    array(
                        'key' => 'field_dev_dt1_val',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'default_value' => '250 RON',
                    ),
                ),
            ),
            array(
                'key' => 'field_dev_detaliu_2',
                'label' => 'Metric 2',
                'name' => 'dev_detaliu_2',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_dt2_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Locatie',
                    ),
                    array(
                        'key' => 'field_dev_dt2_val',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'default_value' => 'Constanta',
                    ),
                ),
            ),
            array(
                'key' => 'field_dev_detaliu_3',
                'label' => 'Metric 3',
                'name' => 'dev_detaliu_3',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_dev_dt3_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Program',
                    ),
                    array(
                        'key' => 'field_dev_dt3_val',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'default_value' => 'Sambata si Duminica',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 8,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_dev_inscriere',
        'title' => 'Development: 09 Inscriere Section',
        'fields' => array(
            array(
                'key' => 'field_dev_inscriere_title',
                'label' => 'Section Title',
                'name' => 'dev_inscriere_title',
                'type' => 'text',
                'default_value' => 'Inscriere',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'development',
                ),
            ),
        ),
        'menu_order' => 9,
    ));
}
