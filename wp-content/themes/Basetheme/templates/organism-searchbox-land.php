<section id="search" class="col-lg-6">
        <div class="filter">
            <label for="suburb">REFINE SEARCH TERMS</label>
            <select name="suburb" id="suburb" multiple>
                <?php
                            for ($i=0; $i <= sizeof($terms); $i++) {
                                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
                            }
                ?>
            </select>
            <button onclick="search(true);">SEARCH</button>
        </div>

        

        <div class="field">
            <label for="property_category">PROPERTY TYPE</label>

            <select name="property_category" id="type" class="">
                <option value="" selected="selected">Any</option>
                <option value="Commercial" >Commercial</option>
                <option value="Residential">Residential</option>
            </select>

        </div>

        <div class="field">
            <label for="">FENCED</label>
            <select name="" id="fenced">
                <option value="any">Any</option>
                <option value="1"> Yes </option>
                <option value="0"> No </option>
                <?php
                            /*for ($i=0; $i <= sizeof($terms); $i++) {
                                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
                            }*/
                ?>
            </select>
        </div>
        <div class="surrounding pull-left">
            <input id="surrounding" type="checkbox" name="surrounding" value="include" checked="checked"> INCLUDE SURROUNDING PROPERTIES
        </div>
          <div id="otherSearch" class="pull-right ">
            <a href="/buying/property-search/" class="">SEARCHING FOR PROPERTIES?</a>
        </div>

    </section>