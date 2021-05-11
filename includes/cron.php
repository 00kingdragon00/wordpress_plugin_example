<?php

function r_generate_daily_recipe() {
    set_transient( 'r_daily_recipe', r_get_random_recipe(), DAY_IN_SECONDS );
}