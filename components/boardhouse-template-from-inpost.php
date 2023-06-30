<tr class="shipping paczkomaty-shipping">
    <td colspan="2">
        <label for="paczkomat_id"><?php _e('Paczkomat', 'paczkomaty'); ?></label>
        <div class="flex flex-wrap">
            <select data-cod="<?php echo esc_attr( $args['cod'] ); ?>"
                data-end_of_week_collection="<?php echo esc_attr( $args['end_of_week_collection'] ); ?>"
                id="paczkomat_id" name="paczkomat_id">
                <?php if( $args['select_type'] !== 'select2_ajax' ): ?>
                <option value=""><?php _e('Wybierz paczkomat...', 'paczkomaty'); ?></option>

                <?php if (count($args['nearly']) > 0): ?>
                <optgroup label="<?php _e('w pobliżu', 'woocommerce-paczkomaty-inpost'); ?>">
                    <?php foreach ($args['nearly'] as $key => $value): ?>
                    <?php
                            $selected = '';
                            if ( $key == $args['selected'] ) {
                                $selected = ' selected';
                            }
                        ?>
                    <option value="<?php echo $key ?>" <?php echo $selected; ?>>[<?php echo $key; ?>]
                        <?php echo $value; ?>
                    </option>
                    <?php endforeach; ?>
                </optgroup>
                <optgroup label="<?php _e('pozostałe', 'woocommerce-paczkomaty-inpost'); ?>">
                    <?php endif; ?>

                    <?php foreach ($args['other'] as $key => $value): ?>
                    <?php
    	                $selected = '';
	                    if ( $key == $args['selected'] ) {
		                    $selected = ' selected';
	                    }
	                ?>
                    <option value="<?php echo $key ?>" <?php echo $selected; ?>>[<?php echo $key; ?>]
                        <?php echo $value; ?>
                    </option>

                    <?php endforeach; ?>

                    <?php if (count($args['nearly']) > 0): ?>
                </optgroup>
                <?php endif; ?>

                <?php else: ?>
                <?php $paczkomat_id = WC()->session->get( 'paczkomat_id' ); ?>
                <?php if ( ! empty( $paczkomat_id ) && isset( $args['other'][ $paczkomat_id ] ) ): ?>
                <option value="<?php echo $paczkomat_id; ?>" selected="selected">
                    <?php echo $args['other'][ $paczkomat_id ]; ?></option>
                <?php endif; ?>
                <?php endif; ?>
            </select>
            <div><a href="#"
                    id="open-geowidget"><?php _e( 'Wybierz paczkomat na mapie', 'woocommerce-paczkomaty-inpost' ); ?></a>
            </div>
        </div>
    </td>
</tr>