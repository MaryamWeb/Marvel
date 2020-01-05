<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center" id='pagination_index'  >
        <?php
            //Disable Previous(First Post)
            if($count != 0){
                if($page == 0 || $page == 1 && $count != 0){
                    echo " <li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
                }else{
                    echo " <li class='page-item'><a class='page-link' href='/marvel/category/{$post_category_id}/page/{$previous_page}'>Previous</a></li>";  
                }
            }

            //Pages Number
            for($i=1; $i<=$count;$i++){
                if($i==$page){
                    echo "<li class='page-item  active'><a class='page-link' href='/marvel/category/{$post_category_id}/page/{$i}'>{$i}</a></li>";
                }else{
                    echo "<li class='page-item'><a class='page-link' href='/marvel/category/{$post_category_id}/page/{$i}'>{$i}</a></li>";
                }
            }

            //Disable Next(last Post)
            if($count != 0){
                if($page == $count){
                    echo " <li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
                }else{
                    echo " <li class='page-item'><a class='page-link' href='/marvel/category/{$post_category_id}/page/{$next_page}'>Next</a></li>";
                }
            }
        ?>
    </ul>
</nav>