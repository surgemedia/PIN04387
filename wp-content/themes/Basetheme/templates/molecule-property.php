<xsl:template name="property">
        <xsl:for-each select="//property">
            <article class="property-card col-lg-6" style="background-image:url('{property_image}');">
             <a href="{link}" class="property-link"></a>
                <a href="{link}" class="content">
                    <div class="suburb"><xsl:value-of select="property_meta/property_address_suburb"/></div>
                    <div class="street">
                            <span>
                                <xsl:value-of select="property_meta/property_address_street_number"/>
                            </span>
                            <span>
                                <xsl:value-of select="property_meta/property_address_street"/>
                            </span>
                    </div>
                    <i class="icon-BED"><xsl:value-of select="property_meta/property_bedrooms"/></i>
                    <i class="icon-BATH"><xsl:value-of select="property_meta/property_bathrooms"/></i>
                    <i class="icon-CAR"><xsl:value-of select="property_meta/property_garage"/>   </i>
                </a>
        </article>
        </xsl:for-each>
        
    </xsl:template>