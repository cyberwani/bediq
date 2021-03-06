<?php
global $post;

$room_size = get_post_meta( $post->ID, 'room_size', true );
$occupancy_adults = get_post_meta( $post->ID, 'occupancy_adults', true );
$occupancy_child = get_post_meta( $post->ID, 'occupancy_child', true );
$extra_bed = get_post_meta( $post->ID, 'extra_beds', true );
$pet_policy = get_post_meta( $post->ID, 'pet_policy', true );

$entertain = get_post_meta( $post->ID, 'entertainment' );
$bed_features = get_post_meta( $post->ID, 'bed_features' );
$bath = get_post_meta( $post->ID, 'bath' );
$communication = get_post_meta( $post->ID, 'communication' );
$safety = get_post_meta( $post->ID, 'safety' );
$on_request = get_post_meta( $post->ID, 'on_request' );
$offers = get_post_meta( $post->ID, 'offers' );

// Find connected pages
$connected = new WP_Query( array(
    'connected_type' => 'room_to_offer',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
) );
?>

<div class="bediq-accordion">

    <h3><?php _e( 'Facilities', 'bediq' ); ?></h3>

	<div class="bediq-tabs">
		<ul>
			<li class="active"><a href="#bediq-room" data-toggle="tab"><i class="icon-home"></i> <?php _e( 'Room', 'bediq' ); ?></a></li>

	        <?php if ( count( $entertain ) > 0 && $entertain[0] != '' ) { ?>
	            <li><a href="#bediq-entertainment" data-toggle="tab"><i class="icon-film"></i> <?php _e( 'Entertainment', 'bediq' ); ?></a></li>
	        <?php } ?>

	        <?php if ( count( $bed_features ) > 0 && $bed_features[0] != '' ) { ?>
	            <li><a href="#bediq-bed" data-toggle="tab"><i class="icon-file"></i> <?php _e( 'Bed', 'bediq' ); ?></a></li>
	        <?php } ?>


	        <?php if ( count( $bath ) > 0 && $bath[0] != '' ) { ?>
	            <li><a href="#bediq-bath" data-toggle="tab"><i class="icon-tint"></i> <?php _e( 'Bathroom', 'bediq' ); ?></a></li>
	        <?php } ?>


	        <?php if ( count( $communication ) > 0 && $communication[0] != '' ) { ?>
	            <li><a href="#bediq-comm" data-toggle="tab"><i class="icon-volume-up"></i> <?php _e( 'Communication', 'bediq' ); ?></a></li>
	        <?php } ?>

	        <?php if ( count( $safety ) > 0 && $safety[0] != '' ) { ?>
	            <li><a href="#bediq-safety" data-toggle="tab"><i class="icon-ok-sign"></i> <?php _e( 'Safety', 'bediq' ); ?></a></li>
	        <?php } ?>

	        <?php if ( count( $on_request ) > 0 && $on_request[0] != '' ) { ?>
	            <li><a href="#bediq-on-req" data-toggle="tab"><i class="icon-question-sign"></i> <?php _e( 'on-request', 'bediq' ); ?></a></li>
	        <?php } ?>
		</ul>

		<div class="tab-pane active" id="bediq-room">
            <table class="table table-hover">
                <?php if ( !empty( $room_size ) ) { ?>
                    <tr><td><?php _e( 'Room Size:', 'bediq' ); ?> </td><td><?php echo $room_size; ?></td></tr>
                <?php } ?>

                <?php if ( !empty( $occupancy_adults ) || !empty( $occupancy_child ) ) { ?>
                    <tr>
                        <td><?php _e( 'Suited for: ', 'bediq' ); ?></td>
                        <td> max.
                            <?php
                            if ( !empty( $occupancy_adults ) ) {
                                printf( __( '%s adults', 'bediq' ), $occupancy_adults );
                            }

                            if ( !empty( $occupancy_child ) ) {
                                printf( __( ' and %s kids', 'bediq' ), $occupancy_child );
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>

                <?php if ( !empty( $extra_bed ) ) { ?>
                    <tr>
                        <td>
                            <?php _e( 'Offers space for:', 'bediq' ); ?>
                        </td>
                        <td><?php echo $extra_bed; ?> <?php _e( 'Extrabeds', 'bediq' ); ?></td>
                    </tr>
                <?php } ?>

                <?php if ( !empty( $pet_policy ) ) { ?>
                    <tr>
                        <td><?php _e( 'Pet Policy:', 'bediq' ); ?></td>
                        <td><?php echo $pet_policy; ?></td>
                    </tr>
                <?php } ?>

                <tr>
                	<td><?php _e( 'Room Facilities:', 'bediq' ); ?></td>
                	<td>
                		<?php bediq_display_multi_meta( 'facilities_room', $post->ID ); ?>
                	</td>
                </tr>
            </table>
		</div>

        <?php if ( $entertain ) { ?>
            <div class="tab-pane" id="bediq-entertainment"><p><?php bediq_display_multi_meta( 'entertainment', $post->ID ); ?></p></div>
        <?php } ?>

        <?php if ( $bed_features ) { ?>
            <div class="tab-pane" id="bediq-bed"><p><?php bediq_display_multi_meta( 'bed_features', $post->ID ); ?></p></div>
        <?php } ?>

        <?php if ( $bath ) { ?>
            <div class="tab-pane" id="bediq-bath"><p><?php bediq_display_multi_meta( 'bath', $post->ID ); ?></p></div>
        <?php } ?>

        <?php if ( $communication ) { ?>
            <div class="tab-pane" id="bediq-comm"><p><?php bediq_display_multi_meta( 'communication', $post->ID ); ?></p></div>
        <?php } ?>

        <?php if ( $safety ) { ?>
            <div class="tab-pane" id="bediq-safety"><p><?php bediq_display_multi_meta( 'safety', $post->ID ); ?></p></div>
        <?php } ?>

        <?php if ( $on_request ) { ?>
            <div class="tab-pane" id="bediq-on-req"><p><?php bediq_display_multi_meta( 'on_request', $post->ID ); ?></p></div>
        <?php } ?>

	</div> <!-- .bediq-tabs -->
</div>

<?php // Display connected pages
if ( is_array( $offers ) && count( $offers ) > 0 ) {
?>
<h3><?php _e( 'Current Offers for the', 'bediq' ); ?> <?php the_title(); ?></h3>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<ul>
        <?php foreach ($offers as $offer_id) { ?>
            <li><a itemprop="url" href="<?php echo get_the_permalink( $offer_id ); ?>"><?php echo get_the_title( $offer_id ); ?></a></li>
        <?php } ?>
    </ul>
</div>
<?php
// Prevent weirdness
wp_reset_postdata();
} ?>
