<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			<footer id="site-footer" class="header-footer-group">
				<div class="section-inner">
					<div class="footer-credits">
                        <div class="footer-items">
                            <div>
                                <p>logo</p>
                            </div>
                            <div>
                                <p>
                                    <h4>Products</h4>
                                </p>
                                <li class="nav-item">Product list</li>
                                <li class="nav-item">product 1</li>
                                <li class="nav-item">product 2</li>
                                <li class="nav-item">product 3</li>
                            </div>
                            <div>
                                <p>
                                    <h4>Solutions</h4>
                                </p>
                                <li class="nav-item">indistries</li>
                                <li class="nav-item">Waste incineration</li>
                                <li class="nav-item">Petro chemical</li>
                                <li class="nav-item">Steel smelting</li>
                                <li class="nav-item">Cement</li>
                                <li class="nav-item">Electricity</li>
                            </div>
                            <div>
                                <p>
                                    <h4>Company</h4>
                                </p>
                                <li class="nav-item">Our values</li>
                                <li class="nav-item">Terms & Conditions</li>
                                <li class="nav-item">Cookies</li>
                            </div>
                            <div>
                                <p>
                                    <h4>Career</h4>
                                </p>
                                <li class="nav-item">Work with us</li>
                                <li class="nav-item">Applications</li>
                            </div>
                            <div>
                                <p>
                                    <h4>Publication</h4>
                                </p>
                                <li class="nav-item">Blog</li>
                                <li class="nav-item">Article</li>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <hr color="white" />
                            <p class="footer-copyright">&copy;
                                <a  href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                            </p><!-- .footer-copyright -->
                        </div>
					</div><!-- .footer-credits -->
				</div><!-- .section-inner -->
			</footer><!-- #site-footer -->
		<?php wp_footer(); ?>
	</body>
</html>
