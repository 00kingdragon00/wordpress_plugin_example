<?php

function r_recipe_creator_shortcode()
{
    $recipe_options      =   get_option('r_opts');

    if(!is_user_logged_in() && $recipe_options['recipe_submission_login_required'] == 2) {
        return 'You must be login to submit to recipe.';
    }
    $creatorHTML             =  file_get_contents('creator-template.php', true);
    $editorHTML              =  r_generate_content_editor();
    $creatorHTML             =  str_replace('CONTENT_EDITOR', $editorHTML, $creatorHTML);

    return $creatorHTML;
}

function r_generate_content_editor() 
{
    ob_start();
    wp_editor('', 'recipecontenteditor');

    $editor_contents        =   ob_get_clean();
    return $editor_contents;
}