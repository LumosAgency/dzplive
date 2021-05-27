<?php get_header(); ?>
<?php
$hero = get_field('hero', 351);
if (have_posts()) : while (have_posts()) : the_post();
        set_query_var('do_not_duplicate', $post->ID);
        $event = get_field('event_date');
        $eventStart = $event['start_date'];
        $month = date("F", strtotime($eventStart));
        $day = date("jS", strtotime($eventStart));
        $year = date("Y", strtotime($eventStart));
        $time = date("g:i A", strtotime($eventStart));
        $date = $month . " " . $day . ", " . $year;
        $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        $term = get_the_terms($post->ID, 'venues');
        $address = get_field('map', $term[0]->taxonomy . '_' . $term[0]->term_id);
        $price = get_field('ticket_prices');
        $ticketURL = get_field('tickets_url');
        $eventURL = get_field('event_url');
        $supportingActs = get_field('supporting_acts');
?>
        <div id="single" class="event lazy bg-image" data-src="<?php echo $hero['background_image'] ?>">
            <div class="page-header">
                <h1><?php single_post_title(); ?></h1>
                <div class="share-wrap">
                    <?php get_template_part('partials/post', 'share'); ?>
                </div>
            </div>
            <article>
                <div class="container">
                    <div class="content">
                        <div class="inner">
                            <div class="details">
                                <div class="image" style="background-image: url('<?php echo $backgroundImg[0]; ?>');">

                                </div>
                                <div class="table">
                                    <?php if ($date) { ?>
                                        <div class="row">
                                            <span class="label">When:</span>
                                            <?php echo $date; ?> at <?php echo $time; ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($address) { ?>
                                        <div class="row">
                                            <span class="label">Where:</span>
                                            <?php echo esc_attr($term[0]->name); ?>
                                        </div>
                                        <div class="row">
                                            <span class="label">Address:</span>
                                            <a data-scroll href="#map"><?php echo esc_attr($address['address']); ?></a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($price) { ?>
                                        <div class="row">
                                            <span class="label">Price:</span>
                                            <?php echo $price; ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($supportingActs) { ?>
                                        <div class="row">
                                            <span class="label">Supporting Acts:</span>
                                            <?php echo $supportingActs; ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($eventURL) { ?>
                                        <div class="row">
                                            <span class="label">More Info:</span>
                                            <a href="<?php echo $eventURL; ?>" target="_blank">Click Here</a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($ticketURL) { ?>
                                        <a href="<?php echo $ticketURL; ?>" class="read-more">
                                            <?php if (get_field('custom_ticket_text')) { ?>
                                                <span class="text"><?php the_field('custom_ticket_text'); ?></span>
                                            <?php } else { ?>
                                                <span class="text">Purchase Tickets</span>
                                            <?php } ?>
                                            <span class="border"></span>
                                        </a>
                                    <?php } else { ?>
                                        <?php
                                        get_template_part(
                                            'partials/button',
                                            null,
                                            array(
                                                'text' => 'Purchase Tickets',
                                                'url' => $eventURL,
                                            )
                                        );
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="description">
                                <div class="post-date">
                                    <?php echo $date; ?>
                                </div>
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($address) { ?>
                    <div id="map">
                        <div class="marker" data-lat="<?php echo esc_attr($address['lat']); ?>" data-lng="<?php echo esc_attr($address['lng']); ?>">
                            <div class="marker-inner">
                                <h3><?php echo esc_attr($term[0]->name); ?></h3>
                                <p><?php echo esc_attr($address['address']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </article>
        <?php
    endwhile;
else : ?>
        <article>
            <div class="container">
                <div class="content">
                    <h1>Sorry...</h1>
                    <p><?php _e('Sorry, we didnt find your event.'); ?></p>
                </div>
            </div>
        </article>
    <?php endif; ?>

    <?php get_template_part('partials/events', 'list', $do_not_duplicate); ?>
        </div>

        <script type="text/javascript">
            (function($) {

                /**
                 * initMap
                 *
                 * Renders a Google Map onto the selected jQuery element
                 *
                 * @date    22/10/19
                 * @since   5.8.6
                 *
                 * @param   jQuery $el The jQuery element.
                 * @return  object The map instance.
                 */
                function initMap($el) {

                    // Find marker elements within map.
                    var $markers = $el.find('.marker');

                    // Create gerenic map.
                    var args = {
                        zoom: $el.data('zoom') || 14,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{
                                "featureType": "all",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#090a2c",
                                    "weight": "0.01"
                                }]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                        "saturation": 36
                                    },
                                    {
                                        "color": "#f2f9ff"
                                    },
                                    {
                                        "lightness": 40
                                    }
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.text.stroke",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 16
                                    },
                                    {
                                        "weight": "0.44"
                                    },
                                    {
                                        "gamma": "0.00"
                                    }
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#090a2c"
                                }]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#090a2c"
                                }]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#ffa100"
                                }]
                            },
                            {
                                "featureType": "road",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "weight": "0.01"
                                }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "all",
                                "stylers": [{
                                    "color": "#30647a"
                                }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "color": "#295d73"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#30647a"
                                }]
                            }
                        ],
                    };
                    var map = new google.maps.Map($el[0], args);
                    ($el[0], args);

                    // Add markers.
                    map.markers = [];
                    $markers.each(function() {
                        initMarker($(this), map);
                    });

                    // Center map based on markers.
                    centerMap(map);

                    // Return map instance.
                    return map;
                }

                function initMarker($marker, map) {

                    // Get position from marker.
                    var lat = $marker.data('lat');
                    var lng = $marker.data('lng');
                    var latLng = {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    };

                    // Create marker instance.
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });

                    // Append to reference for later use.
                    map.markers.push(marker);

                    // If marker contains HTML, add it to an infoWindow.
                    if ($marker.html()) {

                        // Create info window.
                        var infowindow = new google.maps.InfoWindow({
                            content: $marker.html(),
                            maxWidth: 320
                        });

                        // Show info window when marker is clicked.
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                }

                function centerMap(map) {

                    // Create map boundaries from all map markers.
                    var bounds = new google.maps.LatLngBounds();
                    map.markers.forEach(function(marker) {
                        bounds.extend({
                            lat: marker.position.lat(),
                            lng: marker.position.lng()
                        });
                    });

                    // Case: Single marker.
                    if (map.markers.length == 1) {
                        map.setCenter(bounds.getCenter());

                        // Case: Multiple markers.
                    } else {
                        map.fitBounds(bounds);
                    }
                }

                // Render maps on page load.
                $(document).ready(function() {
                    $('#map').each(function() {
                        var map = initMap($(this));
                    });
                });

            })(jQuery);
        </script>


        <?php wp_reset_postdata();
        get_footer(); ?>