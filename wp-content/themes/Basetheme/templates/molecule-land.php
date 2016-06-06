<xsl:template name="property">
        <xsl:for-each select="//property">
            <article class="property-card col-lg-6" style="background-image:url('{property_image}');">
             <a href="{link}" class="property-link">
                <div class="content">
                    <div class="suburb"><xsl:value-of select="property_meta/property_address_suburb"/></div>
                    <div class="street">
                            <span>
                                <xsl:value-of select="property_meta/property_address_street_number"/>
                            </span>
                            <span>
                                <xsl:value-of select="property_meta/property_address_street"/>
                            </span>
                    </div>
                    <i class="icon-ruler" data-toggle="tooltip" data-placement="top" title="Area"><xsl:value-of select="property_meta/property_land_area"/></i>
                    
                    <i class="icon-house" data-toggle="tooltip" data-placement="top" title="Type"><xsl:value-of select="property_meta/property_category"/></i>

                    <i class="icon-fence" data-toggle="tooltip" data-placement="top" title="Fully Fenced"><xsl:value-of select="property_meta/property_land_fully_fenced"/></i>
                    

                </div>
                </a>
        </article>
        </xsl:for-each>
        
    </xsl:template>