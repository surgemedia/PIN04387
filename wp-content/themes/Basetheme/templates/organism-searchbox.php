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
            <button onclick="search();">SEARCH</button>
        </div>

        <div class="surrounding">
            <input id="surrounding" type="checkbox" name="surrounding" value="include"> INCLUDE SURROUNDING PROPERTIES
        </div>

        <div class="field">
            <label for="property_category">PROPERTY TYPE</label>

            <select name="property_category" id="type" class="">
                <option value="" selected="selected">Any</option>
                <option value="House" >House</option>
                <option value="Unit">Unit</option>
                <option value="Townhouse">Townhouse</option>
                <option value="Villa">Villa</option>
                <option value="Apartment">Apartment</option>
                <option value="Flat">Flat</option>
                <option value="Studio">Studio</option>
                <option value="Warehouse">Warehouse</option>
                <option value="DuplexSemi-detached">Duplex Semi-detached</option>
                <option value="Alpine">Alpine</option>
                <option value="AcreageSemi-rural">Acreage Semi-rural</option>
                <option value="Retirement">Retirement</option>
                <option value="BlockOfUnits">Block Of Units</option>
                <option value="Terrace">Terrace</option>
                <option value="ServicedApartment">Serviced Apartment</option>
                <option value="Other">Other</option>
            </select>

        </div>

        <div class="field">
            <label for="">BEDROOMS</label>
            <select name="" id="bed">
                <option value=""> Any </option>
                <option value="1"> 1+ </option>
                <option value="2"> 2+ </option>
                <option value="3"> 3+ </option>
                <?php
                            /*for ($i=0; $i <= sizeof($terms); $i++) {
                                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
                            }*/
                ?>
            </select>
        </div>

        <div class="field">
            <label for="">BATHROOMS</label>
            <select name="" id="bath">
                <option value=""> Any </option>
                <option value="1"> 1+ </option>
                <option value="2"> 2+ </option>
                <option value="3"> 3+ </option>
                <?php
                            /*for ($i=0; $i <= sizeof($terms); $i++) {
                                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
                            }*/
                ?>
            </select>
        </div>

        <div class="field">
            <label for="">CAR SPACES</label>
            <select name="" id="car">
                <option value=""> Any </option>
                <option value="1"> 1+ </option>
                <option value="2"> 2+ </option>
                <option value="3"> 3+ </option>
                <?php
                                /* for ($i=0; $i <= sizeof($terms); $i++) {
                                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
                            }*/
                ?>
            </select>
        </div>
    </section>