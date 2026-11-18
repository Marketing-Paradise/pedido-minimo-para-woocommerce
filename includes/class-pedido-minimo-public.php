<?php
/**
 * The frontend functionality of the plugin.
 *
 * @package    Pedido_Minimo_Woocommerce
 * @subpackage Pedido_Minimo_Woocommerce/frontend
 * @author     Marketing Paradise <rafael@mkparadise.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PedidoMinimo_Public {

	public function __construct() {
		add_action( 'woocommerce_check_cart_items', array( $this, 'woocommerce_minimum_order' ) );
	}

	/**
	 * Valida el subtotal del carrito frente al pedido mínimo configurado.
	 */
	public function woocommerce_minimum_order() {
		if ( ! WC()->cart || WC()->cart->is_empty() ) {
			return;
		}

		$minimum = (float) apply_filters(
			'pedidominimo_minimum_order',
			(float) get_option( 'pedidominimo_precio_minimo', 0 )
		);

		if ( $minimum <= 0 ) {
			return;
		}

		$incluir_descuentos = '1' === (string) get_option( 'pedidominimo_incluir_descuentos', '0' );
		$incluir_impuestos  = WC()->cart->display_prices_including_tax();

		if ( $incluir_descuentos ) {
			$subtotal_a_validar = (float) WC()->cart->get_cart_contents_total();
			if ( $incluir_impuestos ) {
				$subtotal_a_validar += (float) WC()->cart->get_cart_contents_tax();
			}
		} else {
			$subtotal_a_validar = (float) WC()->cart->get_subtotal();
			if ( $incluir_impuestos ) {
				$subtotal_a_validar += (float) WC()->cart->get_subtotal_tax();
			}
		}

		$subtotal_a_validar = (float) apply_filters( 'pedidominimo_cart_subtotal', $subtotal_a_validar, WC()->cart );

		if ( $subtotal_a_validar < $minimum ) {
			$mensaje = get_option( 'pedidominimo_mensaje_pedido_minimo', '' );
			if ( empty( trim( wp_strip_all_tags( $mensaje ) ) ) ) {
				/* translators: {minimum}: minimum price value that the cart subtotal must reach, {total}: the current cart subtotal. */
				$mensaje = esc_html__('You must place a <strong>minimum order of {minimum}</strong> to complete your purchase. Your cart total is currently {total}.', 'pedido-minimo-for-woocommerce');
			}

			$mensaje_formateado = str_replace(
				array( '{minimum}', '{total}' ),
				array( wc_price( $minimum ), wc_price( $subtotal_a_validar ) ),
				$mensaje
			);

			$allowed_html = array(
				'strong' => array(),
				'em'     => array(),
				'b'      => array(),
				'i'      => array(),
				'span'   => array(
					'class' => array(),
					'style' => array(),
				),
			);

			wc_add_notice( wp_kses( $mensaje_formateado, $allowed_html ), 'error' );
		}
	}
}