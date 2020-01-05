 <!------------- Search Bar ------------->
            
 <div id="search-position" class="col-md-4">
    <section id="search-card" class="card all-posts-container">
        <form action="/marvel/search" method="post">
            <div class=" card-body">
                <h5 class="card-title text-white">Search:</h5>
                <div class="input-group">
                    <input name="search" type="text" class="form-control search-field" placeholder="Search By..." >
                    <span class="input-group-prepend" >
                        <button name="submitsearch" class="btn button-search"  type="submit">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                </div>
                    <div class="text-white pt-3" name="search-option">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label class="form-check-label" for="inlineRadio1">Username</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Title</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" checked>
                            <label class="form-check-label" for="inlineRadio3">Tags</label>
                        </div>
                    </div>
            </div>
        </form>
    </section>
</div>

 