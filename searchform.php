<form role="search" method="get" class="searchform" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" value="<?php echo get_search_query() ?>" name="s" class="searchform__input" id="s" placeholder="Поиск по сайту" />
    <button type="submit" class="searchform__submit" id="searchsubmit"><?php icon('search', 1) ?></button>
</form>