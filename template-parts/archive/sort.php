<form class="woocommerce-ordering" method="get">
    <select name="orderby" class="orderby relative h-12 flex justify-center items-center gap-2 bg-[#31344A0A] border border-black hover:brightness-80 transition-all px-4" x-data="select()" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>" onchange="this.form.submit()">
        <?php
        $catalog_orderby = apply_filters(
            'woocommerce_catalog_orderby',
            array(
                'menu_order' => __('Sort By: Default', 'woocommerce'),
                'alphabet_asc'  => __('Sort By: A-Z', 'woocommerce'),
                'alphabet_desc' => __('Sort By: Z-A', 'woocommerce'),
                'product_code_alphabet_asc'  => __('Sort By: Product Code A-Z', 'woocommerce'),
                'product_code_alphabet_asc'  => __('Sort By: Product Code A-Z', 'woocommerce'),
            )
        );

        foreach ($catalog_orderby as $id => $name) : ?>
            <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>